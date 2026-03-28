<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Project;
use App\Models\StockLedger;
use App\Models\Subcontractor;
use App\Models\Transmittal;
use App\Models\Warehouse;
use App\Models\WarehouseStock;
use Illuminate\Http\Request;

class WarehousePortalController extends Controller
{
    private function authorizeAccess(): void
    {
        $allowed = ['admin', 'pm', 'project_manager', 'warehouse', 'subcon', 'executives'];
        if (! in_array(auth()->user()?->role, $allowed)) {
            abort(403);
        }
    }

    public function dashboard()
    {
        $this->authorizeAccess();

        $user = auth()->user();

        $transmittalsQuery = Transmittal::query();
        $deliveriesQuery   = Delivery::query();

        $isIncharge = $user->is_warehouse_incharge && $user->warehouse_id;
        $isSubcon   = $user->role === 'subcon' && $user->subcontractor_id;
        $isManager  = in_array($user->role, ['admin', 'pm', 'project_manager', 'executives']);

        // Scoped visibility: managers see all; subcon sees their subcon's warehouses; incharge sees their warehouse
        if ($isIncharge && ! $isManager) {
            $transmittalsQuery->where(function ($q) use ($user) {
                $q->where('origin_warehouse_id', $user->warehouse_id)
                  ->orWhere('destination_warehouse_id', $user->warehouse_id);
            });
            $deliveriesQuery->where(function ($q) use ($user) {
                $q->where('origin_warehouse_id', $user->warehouse_id)
                  ->orWhere('destination_warehouse_id', $user->warehouse_id);
            });
        } elseif ($isSubcon && ! $isManager) {
            $subconWarehouseIds = Warehouse::where('subcontractor_id', $user->subcontractor_id)->pluck('id');
            $transmittalsQuery->where(function ($q) use ($subconWarehouseIds) {
                $q->whereIn('origin_warehouse_id', $subconWarehouseIds)
                  ->orWhereIn('destination_warehouse_id', $subconWarehouseIds);
            });
            $deliveriesQuery->where(function ($q) use ($subconWarehouseIds) {
                $q->whereIn('origin_warehouse_id', $subconWarehouseIds)
                  ->orWhereIn('destination_warehouse_id', $subconWarehouseIds);
            });
        }

        $stats = [
            'total'      => (clone $transmittalsQuery)->count(),
            'pending'    => (clone $transmittalsQuery)->where('status', 'pending')->count(),
            'approved'   => (clone $transmittalsQuery)->where('status', 'approved')->count(),
            'in_transit' => (clone $deliveriesQuery)->where('status', 'in_transit')->count(),
            'completed'  => (clone $transmittalsQuery)->where('status', 'completed')->count(),
            'rejected'   => (clone $transmittalsQuery)->where('status', 'rejected')->count(),
        ];

        $recent = (clone $transmittalsQuery)
            ->with(['requestedBy:id,name', 'originWarehouse', 'destinationWarehouse', 'items'])
            ->latest()
            ->limit(8)
            ->get();

        $activeDeliveries = (clone $deliveriesQuery)
            ->with(['originWarehouse', 'destinationWarehouse'])
            ->whereIn('status', ['in_transit', 'arrived'])
            ->get();

        $warehouses = Warehouse::with('subcontractor')->where('status', 'active')->orderBy('name')->get();
        $projects   = Project::orderBy('project_name')->get(['id', 'project_name']);

        return view('warehouse.dashboard', compact('stats', 'recent', 'activeDeliveries', 'warehouses', 'projects'));
    }

    public function transmittals(Request $request)
    {
        $this->authorizeAccess();

        $user      = auth()->user();
        $isManager = in_array($user->role, ['admin', 'pm', 'project_manager', 'executives']);
        $isSubcon  = $user->role === 'subcon' && $user->subcontractor_id;
        $isIncharge= $user->is_warehouse_incharge && $user->warehouse_id;

        $query = Transmittal::with(['requestedBy:id,name', 'approvedBy:id,name', 'originWarehouse', 'destinationWarehouse', 'items']);

        if ($isIncharge && ! $isManager) {
            $query->where(function ($q) use ($user) {
                $q->where('origin_warehouse_id', $user->warehouse_id)
                  ->orWhere('destination_warehouse_id', $user->warehouse_id);
            });
        } elseif ($isSubcon && ! $isManager) {
            $subconWids = Warehouse::where('subcontractor_id', $user->subcontractor_id)->pluck('id');
            $query->where(function ($q) use ($subconWids) {
                $q->whereIn('origin_warehouse_id', $subconWids)
                  ->orWhereIn('destination_warehouse_id', $subconWids);
            });
        }
        // PM / admin / exec → no filter, sees all

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        $transmittals = $query->latest()->paginate(20)->withQueryString();
        $warehouses   = Warehouse::with('subcontractor')->where('status', 'active')->orderBy('name')->get();
        $projects     = Project::orderBy('project_name')->get(['id', 'project_name']);
        $canApprove   = $isManager;

        // IDs of warehouses "owned" by this user — used to show PAPASOK / PALABAS labels
        if ($isIncharge && ! $isManager) {
            $myWarehouseIds = [$user->warehouse_id];
        } elseif ($isSubcon && ! $isManager) {
            $myWarehouseIds = Warehouse::where('subcontractor_id', $user->subcontractor_id)->pluck('id')->all();
        } else {
            $myWarehouseIds = []; // PM/admin — sees all, no single "mine"
        }

        return view('warehouse.transmittals', compact('transmittals', 'warehouses', 'projects', 'canApprove', 'myWarehouseIds'));
    }

    public function deliveries(Request $request)
    {
        $this->authorizeAccess();

        $user  = auth()->user();
        $query = Delivery::with(['transmittal', 'originWarehouse', 'destinationWarehouse', 'project:id,project_name']);

        if ($user->role === 'warehouse' && $user->warehouse_id) {
            $query->where(function ($q) use ($user) {
                $q->where('origin_warehouse_id', $user->warehouse_id)
                  ->orWhere('destination_warehouse_id', $user->warehouse_id);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $deliveries = $query->latest()->paginate(20)->withQueryString();

        // Active in-transit for map
        $liveDeliveries = Delivery::with(['originWarehouse', 'destinationWarehouse'])
            ->whereIn('status', ['in_transit', 'arrived'])
            ->whereNotNull('last_latitude')
            ->get();

        // Field deliveries from lineman teardown submissions
        // Show all pending (not received), today's first
        $fieldReceiptsQuery = \App\Models\WarehouseReceipt::with([
            'project:id,project_name,project_code',
            'node:id,node_id,node_name',
            'team:id,name',
            'submission:id,submitted_by,pm_reviewed_by',
        ])->where('status', '!=', 'received')
          ->orderByRaw("CASE WHEN DATE(delivery_date) = CURDATE() THEN 0 ELSE 1 END")
          ->orderBy('delivery_date', 'asc')
          ->orderByDesc('created_at');

        if ($request->filled('field_status')) {
            $fieldReceiptsQuery->where('status', $request->field_status);
        }

        $fieldReceipts = $fieldReceiptsQuery->limit(50)->get();

        // Resolve lineman/approver names for field receipts
        $fieldUserIds = $fieldReceipts->flatMap(fn($r) => [
            $r->submission?->submitted_by,
            $r->submission?->pm_reviewed_by,
        ])->filter()->unique()->values()->all();
        $fieldUserMap = \App\Models\User::whereIn('id', $fieldUserIds)
            ->get(['id','name'])->keyBy('id')->map(fn($u) => $u->name)->all();

        return view('warehouse.deliveries', compact(
            'deliveries', 'liveDeliveries', 'fieldReceipts', 'fieldUserMap'
        ));
    }

    public function receiptProof(Request $request, \App\Models\WarehouseReceipt $receipt)
    {
        $this->authorizeAccess();

        $request->validate([
            'proof_image' => ['required', 'file', 'image', 'max:5120'],
        ]);

        $path = $request->file('proof_image')->store('delivery-proofs', 'public');
        $receipt->update(['delivery_proof' => $path]);

        return back()->with('success', 'Proof of delivery uploaded.');
    }

    // Web: create transmittal
    public function storeTransmittal(Request $request)
    {
        $this->authorizeAccess();

        $data = $request->validate([
            'project_id'               => ['required', 'exists:projects,id'],
            'origin_warehouse_id'      => ['required', 'exists:warehouses,id'],
            'destination_warehouse_id' => ['required', 'exists:warehouses,id', 'different:origin_warehouse_id'],
            'driver_name'              => ['nullable', 'string', 'max:255'],
            'truck_plate'              => ['nullable', 'string', 'max:20'],
            'driver_contact'           => ['nullable', 'string', 'max:50'],
            'reason'                   => ['nullable', 'string'],
            'items'                    => ['required', 'array', 'min:1'],
            'items.*.item_type'          => ['required', 'in:amplifier,node,extender,tsc,power_supply,power_supply_housing,cable'],
            'items.*.quantity_requested' => ['required', 'numeric', 'min:0.01'],
            'items.*.unit'               => ['required', 'string', 'max:50'],
        ]);

        $transmittal = Transmittal::create([
            'project_id'               => $data['project_id'],
            'requested_by'             => auth()->id(),
            'origin_warehouse_id'      => $data['origin_warehouse_id'],
            'destination_warehouse_id' => $data['destination_warehouse_id'],
            'driver_name'              => $data['driver_name'] ?? null,
            'truck_plate'              => $data['truck_plate'] ?? null,
            'driver_contact'           => $data['driver_contact'] ?? null,
            'reason'                   => $data['reason'] ?? null,
            'status'                   => 'pending',
        ]);

        foreach ($data['items'] as $item) {
            $transmittal->items()->create([
                'item_type'          => $item['item_type'],
                'item_description'   => $item['item_type'], // no description field — use type as label
                'unit'               => $item['unit'] ?? null,
                'quantity_requested' => $item['quantity_requested'],
                'quantity_approved'  => 0,
                'quantity_received'  => 0,
            ]);
        }

        return back()->with('success', "Transmittal {$transmittal->transmittal_number} submitted for approval.");
    }

    // Web: approve transmittal
    public function approveTransmittal(Request $request, Transmittal $transmittal)
    {
        $this->authorizeAccess();

        if (! in_array(auth()->user()->role, ['admin', 'pm', 'project_manager'])) {
            abort(403);
        }

        if ($transmittal->status !== 'pending') {
            return back()->with('error', 'Only pending transmittals can be approved.');
        }

        $transmittal->update([
            'status'      => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        // Auto-create delivery
        $transmittal->delivery()->create([
            'project_id'               => $transmittal->project_id,
            'driver_name'              => $transmittal->driver_name ?? '',
            'truck_plate'              => $transmittal->truck_plate ?? '',
            'driver_contact'           => $transmittal->driver_contact,
            'origin_warehouse_id'      => $transmittal->origin_warehouse_id,
            'destination_warehouse_id' => $transmittal->destination_warehouse_id,
            'status'                   => 'draft',
        ]);

        // Stamp approved qty = requested qty and move stock to in_transit at origin warehouse
        $transmittal->load('items');
        foreach ($transmittal->items as $item) {
            $item->update(['quantity_approved' => $item->quantity_requested]);

            WarehouseStock::adjust(
                $transmittal->origin_warehouse_id,
                $item->item_type,
                $item->item_description,
                $item->unit,
                'qty_in_stock',
                -$item->quantity_requested
            );

            WarehouseStock::adjust(
                $transmittal->origin_warehouse_id,
                $item->item_type,
                $item->item_description,
                $item->unit,
                'qty_in_transit',
                $item->quantity_requested
            );

            StockLedger::create([
                'warehouse_id'   => $transmittal->origin_warehouse_id,
                'item_type'      => $item->item_type,
                'description'    => $item->item_description,
                'unit'           => $item->unit,
                'movement_type'  => 'dispatched',
                'quantity'       => $item->quantity_requested,
                'reference_type' => \App\Models\Transmittal::class,
                'reference_id'   => $transmittal->id,
                'notes'          => 'Transmittal approved',
                'created_by'     => auth()->id(),
            ]);
        }

        return back()->with('success', "Transmittal {$transmittal->transmittal_number} approved.");
    }

    // Web: reject transmittal
    public function rejectTransmittal(Request $request, Transmittal $transmittal)
    {
        $this->authorizeAccess();

        if (! in_array(auth()->user()->role, ['admin', 'pm', 'project_manager'])) {
            abort(403);
        }

        $request->validate(['rejection_reason' => 'required|string']);

        if ($transmittal->status !== 'pending') {
            return back()->with('error', 'Only pending transmittals can be rejected.');
        }

        $transmittal->update([
            'status'           => 'rejected',
            'approved_by'      => auth()->id(),
            'rejection_reason' => $request->rejection_reason,
            'rejected_at'      => now(),
        ]);

        return back()->with('success', "Transmittal {$transmittal->transmittal_number} rejected.");
    }

    // ── Inventory ─────────────────────────────────────────────────────────────

    public function inventory(Request $request)
    {
        $this->authorizeAccess();

        $user      = auth()->user();
        $canSeeAll = in_array($user->role, ['admin', 'pm', 'project_manager', 'executives']);
        $isSubcon  = ! $canSeeAll && $user->role === 'subcon' && $user->subcontractor_id;
        $isIncharge= ! $canSeeAll && ! $isSubcon && $user->is_warehouse_incharge && $user->warehouse_id;

        $warehouseQuery = Warehouse::with(['stocks' => function ($q) {
            $q->orderBy('item_type')->orderBy('description');
        }, 'subcontractor'])->where('status', 'active');

        if ($canSeeAll) {
            // PM / Admin / Executives — all warehouses across all subcons
            if ($request->filled('warehouse_id')) {
                $warehouseQuery->where('id', $request->warehouse_id);
            }
        } elseif ($isSubcon) {
            // Subcon user — only their own subcontractor's warehouse(s)
            $warehouseQuery->where('subcontractor_id', $user->subcontractor_id);
        } elseif ($isIncharge) {
            // Warehouse incharge (non-PM, non-subcon) — only their assigned warehouse
            $warehouseQuery->where('id', $user->warehouse_id);
        }

        $warehouses    = $warehouseQuery->orderBy('name')->get();

        // Warehouse selector dropdown — only for PM/admin/executives
        $allWarehouses = $canSeeAll
            ? Warehouse::where('status', 'active')->orderBy('name')->get(['id', 'name'])
            : collect();

        // Ledger — scoped to match warehouse visibility
        $ledgerQuery = StockLedger::with(['warehouse', 'createdBy'])
            ->orderByDesc('created_at')
            ->limit(50);

        if ($canSeeAll && $request->filled('warehouse_id')) {
            $ledgerQuery->where('warehouse_id', $request->warehouse_id);
        } elseif ($isSubcon) {
            $ledgerQuery->whereHas('warehouse', fn ($q) =>
                $q->where('subcontractor_id', $user->subcontractor_id)
            );
        } elseif ($isIncharge) {
            $ledgerQuery->where('warehouse_id', $user->warehouse_id);
        }

        $ledger     = $ledgerQuery->get();
        $allSubcons = $canSeeAll ? Subcontractor::orderBy('name')->get(['id', 'name']) : collect();

        // Resolve WarehouseReceipt teardown attribution (lineman + PM approver)
        $receiptIds = $ledger
            ->where('reference_type', \App\Models\WarehouseReceipt::class)
            ->pluck('reference_id')->unique()->filter()->values()->all();

        $receiptMap = [];
        if (! empty($receiptIds)) {
            $receipts = \App\Models\WarehouseReceipt::with('submission')
                ->whereIn('id', $receiptIds)->get();

            $userIds = $receipts->flatMap(fn ($r) => [
                $r->submission?->submitted_by,
                $r->submission?->pm_reviewed_by,
            ])->filter()->unique()->values()->all();

            $receiptUserMap = \App\Models\User::whereIn('id', $userIds)
                ->get(['id', 'name'])->keyBy('id')->map(fn ($u) => $u->name)->all();

            foreach ($receipts as $r) {
                $receiptMap[$r->id] = [
                    'lineman'  => $receiptUserMap[$r->submission?->submitted_by  ?? 0] ?? null,
                    'approver' => $receiptUserMap[$r->submission?->pm_reviewed_by ?? 0] ?? null,
                ];
            }
        }

        // Today's deliveries (arrived or received today)
        $todayDeliveryQuery = Delivery::with([
                'transmittal.items',
                'originWarehouse',
                'destinationWarehouse',
            ])
            ->whereDate('created_at', today())
            ->orderByDesc('created_at');

        if (! $canSeeAll) {
            $warehouseIds = $warehouses->pluck('id');
            $todayDeliveryQuery->where(function ($q) use ($warehouseIds) {
                $q->whereIn('origin_warehouse_id', $warehouseIds)
                  ->orWhereIn('destination_warehouse_id', $warehouseIds);
            });
        }

        $todayDeliveries = $todayDeliveryQuery->get();

        return view('warehouse.inventory', compact(
            'warehouses', 'allWarehouses', 'allSubcons',
            'ledger', 'canSeeAll', 'todayDeliveries', 'receiptMap'
        ));
    }

    public function adjustStock(Request $request)
    {
        $this->authorizeAccess();

        $data = $request->validate([
            'warehouse_id' => ['required', 'exists:warehouses,id'],
            'item_type'    => ['required', 'in:amplifier,node,extender,tsc,power_supply,power_supply_housing,cable'],
            'description'  => ['required', 'string', 'max:255'],
            'unit'         => ['required', 'string', 'max:20'],
            'quantity'     => ['required', 'numeric'],
            'notes'        => ['nullable', 'string'],
        ]);

        WarehouseStock::adjust(
            $data['warehouse_id'],
            $data['item_type'],
            $data['description'],
            $data['unit'],
            'qty_in_stock',
            (float) $data['quantity']
        );

        StockLedger::create([
            'warehouse_id'  => $data['warehouse_id'],
            'item_type'     => $data['item_type'],
            'description'   => $data['description'],
            'unit'          => $data['unit'],
            'quantity'      => $data['quantity'],
            'movement_type' => 'adjustment',
            'notes'         => $data['notes'] ?? null,
            'created_by'    => auth()->id(),
        ]);

        return back()->with('success', 'Stock adjusted successfully.');
    }

    // ── Warehouse CRUD ────────────────────────────────────────────────────────

    public function warehouseCreate()
    {
        if (! in_array(auth()->user()?->role, ['admin', 'pm', 'project_manager'])) {
            abort(403);
        }

        $subcons = Subcontractor::orderBy('name')->get(['id', 'name', 'logo_path', 'warehouse']);
        $warehouses = Warehouse::with(['subcontractor', 'stocks'])->orderBy('name')->get();

        return view('warehouse.create', compact('subcons', 'warehouses'));
    }

    public function warehouseStore(Request $request)
    {
        $this->authorizeAccess();
        if (! in_array(auth()->user()->role, ['admin', 'pm', 'project_manager'])) {
            abort(403);
        }

        $data = $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'subcontractor_id' => ['nullable', 'exists:subcons,id'],
            'location'         => ['nullable', 'string', 'max:500'],
            'extension'        => ['nullable', 'string', 'max:10'],
        ]);

        Warehouse::create([
            'name'             => $data['name'],
            'subcontractor_id' => $data['subcontractor_id'] ?? null,
            'location'         => $data['location'] ?? null,
            'extension'        => $data['extension'] ?? null,
            'is_primary'       => false,
            'status'           => 'active',
        ]);

        return redirect()->route('admin.warehouses.index')->with('success', "Warehouse \"{$data['name']}\" created.");
    }

    // ── Warehouse detail / stock tinker ───────────────────────────────────────

    public function warehouseShow(Warehouse $warehouse)
    {
        $this->authorizeAccess();

        $user      = auth()->user();
        $isManager = in_array($user->role, ['admin', 'pm', 'project_manager', 'executives']);

        // Subcon (non-manager) can only see their own subcontractor's warehouse
        if (! $isManager && $user->role === 'subcon' && $warehouse->subcontractor_id !== $user->subcontractor_id) {
            abort(403);
        }
        // Warehouse incharge (non-manager, non-subcon) can only see their assigned warehouse
        if (! $isManager && $user->role !== 'subcon' && $user->is_warehouse_incharge && $user->warehouse_id !== $warehouse->id) {
            abort(403);
        }

        $stocks = $warehouse->stocks()
            ->orderBy('item_type')
            ->orderBy('description')
            ->get();

        $groupedStocks = $stocks->groupBy('item_type');

        $ledger = StockLedger::with('createdBy')
            ->where('warehouse_id', $warehouse->id)
            ->orderByDesc('created_at')
            ->limit(60)
            ->get();

        // Resolve reference labels per type for display
        $refMap = [];
        $groupedRef = $ledger->whereNotNull('reference_type')->whereNotNull('reference_id')
            ->groupBy('reference_type');
        foreach ($groupedRef as $type => $entries) {
            $ids   = $entries->pluck('reference_id')->unique()->values()->all();
            $short = class_basename($type);
            if ($short === 'Transmittal') {
                \App\Models\Transmittal::whereIn('id', $ids)->get(['id','transmittal_number'])
                    ->each(fn($r) => $refMap["Transmittal:{$r->id}"] = "Transmittal {$r->transmittal_number}");
            } elseif ($short === 'Delivery') {
                \App\Models\Delivery::whereIn('id', $ids)->get(['id'])
                    ->each(fn($r) => $refMap["Delivery:{$r->id}"] = "Delivery #{$r->id}");
            } elseif ($short === 'Node') {
                \App\Models\Node::whereIn('id', $ids)->get(['id','node_id','node_name'])
                    ->each(fn($r) => $refMap["Node:{$r->id}"] = "Node {$r->node_id}" . ($r->node_name ? " – {$r->node_name}" : ''));
            } elseif ($short === 'Pole') {
                \App\Models\Pole::whereIn('id', $ids)->get(['id','pole_code'])
                    ->each(fn($r) => $refMap["Pole:{$r->id}"] = "Pole {$r->pole_code}");
            }
        }

        // Expected today: WarehouseReceipts from baklas heading to this warehouse, not yet received
        $expectedToday = \App\Models\WarehouseReceipt::with([
            'project',
            'node',
            'team',
            'submission.items.teardownLog.poleSpan.fromPole',
            'submission.items.teardownLog.poleSpan.toPole',
        ])
            ->where('warehouse_location', $warehouse->name)
            ->whereDate('delivery_date', today())
            ->where('status', '!=', 'received')
            ->get();

        // Resolve lineman (submitted_by) and PM approver (pm_reviewed_by) for expected receipts
        $userIds = $expectedToday
            ->flatMap(fn($r) => [$r->submission?->submitted_by, $r->submission?->pm_reviewed_by])
            ->filter()->unique()->values()->all();
        $userMap = \App\Models\User::whereIn('id', $userIds)->get(['id','name'])
            ->keyBy('id')
            ->map(fn($u) => $u->name)
            ->all();

        // Incoming in-transit deliveries from other warehouses headed here
        $incomingDeliveries = \App\Models\Delivery::with(['transmittal.items', 'originWarehouse'])
            ->where('destination_warehouse_id', $warehouse->id)
            ->where('status', 'in_transit')
            ->get();

        // Warehouse incharges (users assigned to this warehouse)
        $incharges = \App\Models\User::with('subcontractor:id,name')
            ->where('warehouse_id', $warehouse->id)
            ->orderBy('name')->get(['id', 'name', 'email', 'role', 'subcon_role', 'subcontractor_id']);

        // All users that can be assigned as incharge (except visitors)
        $assignableUsers = \App\Models\User::whereNotIn('role', ['visitor'])
            ->where(function ($q) use ($warehouse) {
                $q->whereNull('warehouse_id')
                  ->orWhere('warehouse_id', $warehouse->id);
            })
            ->orderBy('role')->orderBy('name')
            ->get(['id', 'name', 'email', 'role', 'subcon_role']);

        return view('warehouse.show', compact(
            'warehouse', 'groupedStocks', 'ledger', 'refMap',
            'expectedToday', 'incomingDeliveries', 'userMap',
            'incharges', 'assignableUsers'
        ));
    }

    public function assignIncharge(Request $request, Warehouse $warehouse)
    {
        if (! in_array(auth()->user()->role, ['admin', 'pm', 'project_manager'])) abort(403);

        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $user = \App\Models\User::findOrFail($data['user_id']);

        // Unassign from any previous warehouse first
        if ($user->warehouse_id && $user->warehouse_id !== $warehouse->id) {
            // just reassign — don't block
        }

        $user->update([
            'warehouse_id'          => $warehouse->id,
            'is_warehouse_incharge' => true,
            // role is NOT changed — user keeps their existing role (pm, admin, subcon, etc.)
        ]);

        return back()->with('success', "{$user->name} assigned as warehouse incharge.");
    }

    public function removeIncharge(Warehouse $warehouse, \App\Models\User $user)
    {
        if (! in_array(auth()->user()->role, ['admin', 'pm', 'project_manager'])) abort(403);

        if ($user->warehouse_id !== $warehouse->id) {
            return back()->with('error', 'User is not assigned to this warehouse.');
        }

        $user->update([
            'warehouse_id'          => null,
            'is_warehouse_incharge' => false,
            // role is NOT reset — user keeps their existing role
        ]);

        return back()->with('success', "{$user->name} removed from warehouse.");
    }

    public function receiveReceipt(Request $request, \App\Models\WarehouseReceipt $receipt)
    {
        $this->authorizeAccess();

        if ($receipt->status === 'received') {
            return back()->with('error', 'Already marked as received.');
        }

        // Optional proof of delivery image
        if ($request->hasFile('proof_image')) {
            $path = $request->file('proof_image')->store('delivery-proofs', 'public');
            $receipt->update(['delivery_proof' => $path]);
        }

        // Resolve the warehouse from the receipt's warehouse_location name
        $warehouse = Warehouse::where('name', $receipt->warehouse_location)->first();
        if (! $warehouse) {
            return back()->with('error', 'Warehouse not found for this receipt.');
        }

        // Map collected fields → item_type keys
        $items = [
            'node'       => (int) $receipt->collected_node,
            'amplifier'  => (int) $receipt->collected_amplifier,
            'extender'   => (int) $receipt->collected_extender,
            'tsc'        => (int) $receipt->collected_tsc,
        ];
        if ((float) $receipt->collected_cable > 0) {
            $items['cable'] = (float) $receipt->collected_cable;
        }

        foreach ($items as $type => $qty) {
            if ($qty <= 0) continue;

            $unit = $type === 'cable' ? 'meters' : 'pcs';
            $desc = ucfirst($type) . ' (from teardown)';

            WarehouseStock::adjust($warehouse->id, $type, $desc, $unit, 'qty_in_stock', $qty);

            StockLedger::create([
                'warehouse_id'   => $warehouse->id,
                'item_type'      => $type,
                'description'    => $desc,
                'unit'           => $unit,
                'quantity'       => $qty,
                'movement_type'  => 'received',
                'reference_type' => \App\Models\WarehouseReceipt::class,
                'reference_id'   => $receipt->id,
                'notes'          => 'Received from field teardown — ' . ($receipt->node?->node_id ?? $receipt->warehouse_receipt_id),
                'created_by'     => auth()->id(),
            ]);
        }

        // Mark receipt as received
        $receipt->update(['status' => 'received']);

        // Mark submission item_status as warehouse if linked
        if ($receipt->submission) {
            $receipt->submission->update(['item_status' => 'warehouse']);
        }

        return back()->with('success', 'Receipt marked as received. Stock updated.');
    }

    public function stockStore(Request $request, Warehouse $warehouse)
    {
        $this->authorizeAccess();

        $data = $request->validate([
            'item_type'   => ['required', 'in:amplifier,node,extender,tsc,power_supply,power_supply_housing,cable'],
            'description' => ['required', 'string', 'max:255'],
            'unit'        => ['required', 'string', 'max:20'],
            'qty'         => ['required', 'numeric', 'min:0'],
            'notes'       => ['nullable', 'string'],
        ]);

        $existing = WarehouseStock::where([
            'warehouse_id' => $warehouse->id,
            'item_type'    => $data['item_type'],
            'description'  => $data['description'],
            'unit'         => $data['unit'],
        ])->first();

        if ($existing) {
            return back()->with('error', 'Item already exists. Use Adjust to change quantity.');
        }

        WarehouseStock::create([
            'warehouse_id' => $warehouse->id,
            'item_type'    => $data['item_type'],
            'description'  => $data['description'],
            'unit'         => $data['unit'],
            'qty_in_stock' => $data['qty'],
        ]);

        if ($data['qty'] > 0) {
            StockLedger::create([
                'warehouse_id'  => $warehouse->id,
                'item_type'     => $data['item_type'],
                'description'   => $data['description'],
                'unit'          => $data['unit'],
                'quantity'      => $data['qty'],
                'movement_type' => 'adjustment',
                'notes'         => $data['notes'] ?? 'Initial stock',
                'created_by'    => auth()->id(),
            ]);
        }

        return back()->with('success', 'Item added to warehouse.');
    }

    public function stockUpdate(Request $request, Warehouse $warehouse, WarehouseStock $stock)
    {
        $this->authorizeAccess();

        $data = $request->validate([
            'qty_change' => ['required', 'numeric'],
            'notes'      => ['nullable', 'string'],
        ]);

        $stock->increment('qty_in_stock', $data['qty_change']);

        StockLedger::create([
            'warehouse_id'  => $warehouse->id,
            'item_type'     => $stock->item_type,
            'description'   => $stock->description,
            'unit'          => $stock->unit,
            'quantity'      => $data['qty_change'],
            'movement_type' => 'adjustment',
            'notes'         => $data['notes'] ?? null,
            'created_by'    => auth()->id(),
        ]);

        return back()->with('success', 'Stock updated.');
    }

    public function stockDestroy(Warehouse $warehouse, WarehouseStock $stock)
    {
        $this->authorizeAccess();
        if (! in_array(auth()->user()->role, ['admin', 'pm', 'project_manager'])) {
            abort(403);
        }

        $stock->delete();
        return back()->with('success', 'Item removed from warehouse.');
    }
}
