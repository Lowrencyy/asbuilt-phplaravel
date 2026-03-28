<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\DeliveryLocation;
use App\Models\StockLedger;
use App\Models\TransmittalItem;
use App\Models\WarehouseStock;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeliveryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Delivery::with(['transmittal', 'project:id,name'])
            ->orderByDesc('created_at');

        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return response()->json($query->paginate(20));
    }

    public function show(Delivery $delivery): JsonResponse
    {
        return response()->json(
            $delivery->load(['transmittal.items.node:id,node_id,node_name', 'project:id,name'])
        );
    }

    // Driver marks as departed + required departure photo
    public function depart(Request $request, Delivery $delivery): JsonResponse
    {
        if ($delivery->status !== 'draft') {
            return response()->json(['message' => 'Delivery already departed or completed.'], 422);
        }

        $request->validate([
            'photo' => 'required|file|mimes:jpg,jpeg,png|max:10240',
        ]);

        $path = $request->file('photo')->store('deliveries/departure', 'public');

        $delivery->update([
            'status'          => 'in_transit',
            'departure_photo' => $path,
            'departed_at'     => now(),
            'driver_user_id'  => $request->user()->id,
        ]);

        return response()->json($delivery->fresh());
    }

    // Driver pings GPS location every ~30 seconds
    public function pingLocation(Request $request, Delivery $delivery): JsonResponse
    {
        if ($delivery->status !== 'in_transit') {
            return response()->json(['message' => 'Delivery is not in transit.'], 422);
        }

        $data = $request->validate([
            'latitude'  => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'accuracy'  => 'nullable|numeric|min:0',
        ]);

        // Store ping in history
        DeliveryLocation::create([
            'delivery_id' => $delivery->id,
            'latitude'    => $data['latitude'],
            'longitude'   => $data['longitude'],
            'accuracy'    => $data['accuracy'] ?? null,
            'pinged_at'   => now(),
        ]);

        // Update last known location on delivery (fast lookup for map)
        $delivery->update([
            'last_latitude'    => $data['latitude'],
            'last_longitude'   => $data['longitude'],
            'last_location_at' => now(),
        ]);

        return response()->json(['ok' => true]);
    }

    // Warehouse officer sees current location of an in-transit delivery
    public function location(Delivery $delivery): JsonResponse
    {
        return response()->json([
            'delivery_id'      => $delivery->id,
            'status'           => $delivery->status,
            'driver_name'      => $delivery->driver_name,
            'truck_plate'      => $delivery->truck_plate,
            'last_latitude'    => $delivery->last_latitude ? (float) $delivery->last_latitude : null,
            'last_longitude'   => $delivery->last_longitude ? (float) $delivery->last_longitude : null,
            'last_location_at' => $delivery->last_location_at?->toDateTimeString(),
            'origin'           => $delivery->origin_warehouse,
            'destination'      => $delivery->destination_warehouse,
        ]);
    }

    // Driver marks arrived + required arrival photo
    public function arrive(Request $request, Delivery $delivery): JsonResponse
    {
        if ($delivery->status !== 'in_transit') {
            return response()->json(['message' => 'Delivery must be in transit first.'], 422);
        }

        $request->validate([
            'photo' => 'required|file|mimes:jpg,jpeg,png|max:10240',
        ]);

        $path = $request->file('photo')->store('deliveries/arrival', 'public');

        $delivery->update([
            'status'        => 'arrived',
            'arrival_photo' => $path,
            'arrived_at'    => now(),
        ]);

        return response()->json($delivery->fresh());
    }

    // Warehouse officer receives the delivery — inputs actual quantities
    public function receive(Request $request, Delivery $delivery): JsonResponse
    {
        if ($delivery->status !== 'arrived') {
            return response()->json(['message' => 'Delivery must be marked arrived before receiving.'], 422);
        }

        $data = $request->validate([
            'items'                       => 'required|array|min:1',
            'items.*.transmittal_item_id' => 'required|integer|exists:transmittal_items,id',
            'items.*.quantity_received'   => 'required|numeric|min:0',
            'items.*.notes'               => 'nullable|string',
            'notes'                       => 'nullable|string',
        ]);

        // Update quantity_received on each transmittal item and adjust warehouse stock
        foreach ($data['items'] as $itemData) {
            $tItem = TransmittalItem::find($itemData['transmittal_item_id']);
            if (! $tItem) continue;

            $qtyReceived = (float) $itemData['quantity_received'];

            $tItem->update([
                'quantity_received' => $qtyReceived,
                'notes'             => $itemData['notes'] ?? null,
            ]);

            // Add to destination warehouse stock
            WarehouseStock::adjust(
                $delivery->destination_warehouse_id,
                $tItem->item_type,
                $tItem->item_description,
                $tItem->unit,
                'qty_in_stock',
                $qtyReceived
            );

            // Deduct from origin warehouse in_transit
            WarehouseStock::adjust(
                $delivery->origin_warehouse_id,
                $tItem->item_type,
                $tItem->item_description,
                $tItem->unit,
                'qty_in_transit',
                -$qtyReceived
            );

            // Ledger: received at destination
            StockLedger::create([
                'warehouse_id'   => $delivery->destination_warehouse_id,
                'item_type'      => $tItem->item_type,
                'description'    => $tItem->item_description,
                'unit'           => $tItem->unit,
                'movement_type'  => 'received',
                'quantity'       => $qtyReceived,
                'reference_type' => Delivery::class,
                'reference_id'   => $delivery->id,
                'notes'          => $itemData['notes'] ?? null,
                'created_by'     => $request->user()?->id,
            ]);
        }

        $delivery->update([
            'status'      => 'received',
            'received_at' => now(),
            'notes'       => $data['notes'] ?? $delivery->notes,
        ]);

        // Mark the transmittal as completed
        if ($delivery->transmittal_id) {
            $delivery->transmittal->update(['status' => 'completed']);
        }

        // Return delivery with gap summary per item
        $transmittal = $delivery->transmittal?->load('items');
        $gaps = $transmittal?->items->map(fn ($i) => [
            'item_type'         => $i->item_type,
            'unit'              => $i->unit,
            'quantity_approved' => (float) ($i->quantity_approved ?? $i->quantity_requested),
            'quantity_received' => (float) ($i->quantity_received ?? 0),
            'gap'               => $i->gap,
        ]);

        return response()->json([
            'delivery' => $delivery->fresh(),
            'gaps'     => $gaps,
        ]);
    }
}
