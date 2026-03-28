<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transmittal;
use App\Models\TransmittalItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransmittalController extends Controller
{
    // List transmittals — warehouse officer sees own project's, PM sees all
    public function index(Request $request): JsonResponse
    {
        $query = Transmittal::with(['requestedBy:id,name', 'approvedBy:id,name', 'items', 'delivery'])
            ->orderByDesc('created_at');

        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return response()->json($query->paginate(20));
    }

    public function show(Transmittal $transmittal): JsonResponse
    {
        return response()->json(
            $transmittal->load(['requestedBy:id,name', 'approvedBy:id,name', 'items.node:id,node_id,node_name', 'delivery'])
        );
    }

    // Warehouse officer creates a transmittal request
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'project_id'            => 'required|integer|exists:projects,id',
            'origin_warehouse'      => 'required|string|max:255',
            'destination_warehouse' => 'required|string|max:255',
            'driver_name'           => 'required|string|max:255',
            'truck_plate'           => 'required|string|max:50',
            'driver_contact'        => 'nullable|string|max:50',
            'reason'                => 'nullable|string',
            'items'                 => 'required|array|min:1',
            'items.*.item_type'        => 'required|string',
            'items.*.item_description' => 'nullable|string',
            'items.*.unit'             => 'nullable|string',
            'items.*.quantity_requested' => 'required|numeric|min:0.01',
            'items.*.node_id'          => 'nullable|integer|exists:nodes,id',
            'items.*.notes'            => 'nullable|string',
        ]);

        $transmittal = Transmittal::create([
            'project_id'            => $data['project_id'],
            'requested_by'          => $request->user()->id,
            'origin_warehouse'      => $data['origin_warehouse'],
            'destination_warehouse' => $data['destination_warehouse'],
            'driver_name'           => $data['driver_name'],
            'truck_plate'           => $data['truck_plate'],
            'driver_contact'        => $data['driver_contact'] ?? null,
            'reason'                => $data['reason'] ?? null,
            'status'                => 'pending',
        ]);

        foreach ($data['items'] as $item) {
            $transmittal->items()->create([
                'item_type'          => $item['item_type'],
                'item_description'   => $item['item_description'] ?? null,
                'unit'               => $item['unit'] ?? 'pcs',
                'quantity_requested' => $item['quantity_requested'],
                'node_id'            => $item['node_id'] ?? null,
                'notes'              => $item['notes'] ?? null,
            ]);
        }

        return response()->json($transmittal->load('items'), 201);
    }

    // PM approves — can adjust quantities
    public function approve(Request $request, Transmittal $transmittal): JsonResponse
    {
        if ($transmittal->status !== 'pending') {
            return response()->json(['message' => 'Only pending transmittals can be approved.'], 422);
        }

        $data = $request->validate([
            'adjustments'        => 'nullable|array',
            'adjustments.*.id'   => 'required|integer|exists:transmittal_items,id',
            'adjustments.*.quantity_approved' => 'required|numeric|min:0',
        ]);

        // Apply any quantity adjustments
        if (! empty($data['adjustments'])) {
            foreach ($data['adjustments'] as $adj) {
                TransmittalItem::where('id', $adj['id'])
                    ->where('transmittal_id', $transmittal->id)
                    ->update(['quantity_approved' => $adj['quantity_approved']]);
            }
        }

        $transmittal->update([
            'status'      => 'approved',
            'approved_by' => $request->user()->id,
            'approved_at' => now(),
        ]);

        // Auto-create a Delivery from this approved transmittal
        $delivery = $transmittal->delivery()->create([
            'project_id'            => $transmittal->project_id,
            'driver_name'           => $transmittal->driver_name,
            'truck_plate'           => $transmittal->truck_plate,
            'driver_contact'        => $transmittal->driver_contact,
            'origin_warehouse'      => $transmittal->origin_warehouse,
            'destination_warehouse' => $transmittal->destination_warehouse,
            'status'                => 'draft',
        ]);

        return response()->json([
            'transmittal' => $transmittal->fresh()->load('items'),
            'delivery'    => $delivery,
        ]);
    }

    // PM rejects
    public function reject(Request $request, Transmittal $transmittal): JsonResponse
    {
        if ($transmittal->status !== 'pending') {
            return response()->json(['message' => 'Only pending transmittals can be rejected.'], 422);
        }

        $data = $request->validate([
            'rejection_reason' => 'required|string',
        ]);

        $transmittal->update([
            'status'           => 'rejected',
            'approved_by'      => $request->user()->id,
            'rejection_reason' => $data['rejection_reason'],
            'rejected_at'      => now(),
        ]);

        return response()->json($transmittal->fresh());
    }
}
