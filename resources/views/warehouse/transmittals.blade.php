<x-layout>

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet"/>
<style>
*,*::before,*::after{box-sizing:border-box;}
:root{
  --p:#2d6ff7;--p2:#1a56d6;--pg:rgba(45,111,247,.1);
  --bg:#f0f4fa;--surf:#ffffff;--surf2:#f7f9fc;
  --bdr:#e2e8f2;--bdr2:#d0d9ea;
  --txt:#0d1526;--txt2:#536380;--muted:#9aaabf;
  --r:16px;
  --sh:0 1px 2px rgba(13,21,38,.04),0 4px 20px rgba(13,21,38,.06);
  --sh-md:0 8px 32px rgba(13,21,38,.12);
  --ff:'Sora',sans-serif;--fm:'Space Mono',monospace;
}
.dark{--bg:#08101f;--surf:#0f1c30;--surf2:#152540;--bdr:#1e3050;--bdr2:#26406a;--txt:#dce9ff;--txt2:#7a99c4;--muted:#3d5880;}
body{font-family:var(--ff);}

.hd{display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.4rem;}
.hd-left{}
.eyebrow{font-size:.68rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--p);display:flex;align-items:center;gap:.4rem;margin-bottom:.15rem;}
.eyebrow::before{content:'';display:inline-block;width:16px;height:2px;background:var(--p);border-radius:2px;}
.hd h2{margin:0;font-size:1.5rem;font-weight:800;color:var(--txt);letter-spacing:-.02em;}
.hd p{margin:.2rem 0 0;font-size:.78rem;color:var(--txt2);}
.hd-actions{display:flex;align-items:center;gap:.55rem;}
.btn-p{display:inline-flex;align-items:center;gap:.45rem;padding:.52rem 1.05rem;background:var(--p);color:#fff;border:none;border-radius:12px;font-size:.81rem;font-weight:700;font-family:var(--ff);cursor:pointer;text-decoration:none;transition:background .15s;}
.btn-p:hover{background:var(--p2);}
.btn-ghost{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem .95rem;border:1px solid var(--bdr);border-radius:12px;background:var(--surf);color:var(--txt2);font-size:.81rem;font-weight:600;font-family:var(--ff);text-decoration:none;cursor:pointer;transition:all .15s;}
.btn-ghost:hover{background:var(--surf2);color:var(--txt);}

/* Filter bar */
.filter-bar{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);padding:.85rem 1.1rem;display:flex;align-items:flex-end;gap:.75rem;margin-bottom:1.4rem;flex-wrap:wrap;}
.filter-bar label{display:block;font-size:.67rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);margin-bottom:.35rem;}
.filter-bar select,.filter-bar input{padding:.5rem .85rem;border:1px solid var(--bdr);border-radius:10px;background:var(--surf2);color:var(--txt);font-size:.83rem;font-family:var(--ff);outline:none;min-width:180px;}
.filter-bar select:focus,.filter-bar input:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(45,111,247,.1);}

/* Table panel */
.tpanel{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;margin-bottom:1.4rem;}
.tpanel-hd{display:flex;align-items:center;justify-content:space-between;padding:.8rem 1.1rem;border-bottom:1px solid var(--bdr);}
.tpanel-title{font-size:.88rem;font-weight:800;color:var(--txt);display:flex;align-items:center;gap:.5rem;}
table{width:100%;border-collapse:collapse;}
thead th{padding:.6rem 1rem;text-align:left;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);background:var(--surf2);border-bottom:1px solid var(--bdr);}
tbody tr{border-bottom:1px solid var(--bdr);transition:background .12s;}
tbody tr:last-child{border-bottom:none;}
tbody tr:hover{background:var(--surf2);}
tbody td{padding:.7rem 1rem;font-size:.81rem;color:var(--txt2);}
.td-main{color:var(--txt);font-weight:700;font-size:.83rem;}
.empty-row td{text-align:center;padding:3rem;color:var(--muted);font-size:.83rem;}

/* Direction badges */
.dir-papasok{display:inline-flex;align-items:center;gap:.28rem;padding:.22rem .65rem;border-radius:999px;font-size:.7rem;font-weight:800;background:rgba(22,163,74,.1);color:#15803d;border:1px solid rgba(22,163,74,.2);}
.dir-palabas{display:inline-flex;align-items:center;gap:.28rem;padding:.22rem .65rem;border-radius:999px;font-size:.7rem;font-weight:800;background:rgba(124,58,237,.1);color:#6d28d9;border:1px solid rgba(124,58,237,.2);}
.dir-both{display:inline-flex;align-items:center;gap:.28rem;padding:.22rem .65rem;border-radius:999px;font-size:.7rem;font-weight:800;background:rgba(45,111,247,.08);color:var(--p);border:1px solid rgba(45,111,247,.18);}

/* Status badges */
.badge{display:inline-flex;align-items:center;gap:.25rem;padding:.22rem .6rem;border-radius:999px;font-size:.7rem;font-weight:700;}
.s-pending{background:rgba(245,158,11,.1);color:#d97706;}
.s-approved{background:rgba(37,99,235,.1);color:#1d4ed8;}
.s-in_transit{background:rgba(124,58,237,.1);color:#7c3aed;}
.s-completed{background:rgba(22,163,74,.1);color:#15803d;}
.s-rejected{background:rgba(239,68,68,.1);color:#dc2626;}

/* Route arrow display */
.route-box{display:flex;flex-direction:column;gap:.2rem;}
.route-wh{font-size:.75rem;font-weight:700;color:var(--txt);}
.route-arrow{color:var(--muted);font-size:.72rem;display:flex;align-items:center;gap:.25rem;}

/* Item type chips */
.chip-row{display:flex;flex-wrap:wrap;gap:.22rem;}
.chip{display:inline-flex;align-items:center;gap:.2rem;padding:.14rem .5rem;border-radius:6px;font-size:.7rem;font-weight:700;background:var(--surf2);border:1px solid var(--bdr);color:var(--txt);}

/* Action buttons */
.act-approve{display:inline-flex;align-items:center;gap:.25rem;font-size:.72rem;font-weight:700;padding:.28rem .65rem;border-radius:8px;background:rgba(22,163,74,.1);color:#15803d;border:none;cursor:pointer;font-family:var(--ff);transition:all .15s;}
.act-approve:hover{background:rgba(22,163,74,.2);}
.act-reject{display:inline-flex;align-items:center;gap:.25rem;font-size:.72rem;font-weight:700;padding:.28rem .65rem;border-radius:8px;background:rgba(239,68,68,.08);color:#dc2626;border:none;cursor:pointer;font-family:var(--ff);transition:all .15s;}
.act-reject:hover{background:rgba(239,68,68,.18);}

/* Flash */
.flash{display:flex;align-items:center;gap:.6rem;padding:.7rem 1rem;border-radius:12px;font-size:.82rem;font-weight:600;margin-bottom:1.1rem;}
.flash-ok{background:rgba(22,163,74,.08);border:1px solid rgba(22,163,74,.2);color:#15803d;}
.flash-err{background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);color:#dc2626;}

/* Modal */
.modal-overlay{display:none;position:fixed;inset:0;z-index:60;background:rgba(8,16,31,.55);backdrop-filter:blur(4px);align-items:center;justify-content:center;padding:1rem;}
.modal-overlay.open{display:flex;}
.modal{background:var(--surf);border:1px solid var(--bdr);border-radius:20px;box-shadow:var(--sh-md);width:100%;max-width:600px;max-height:90vh;overflow-y:auto;}
.modal-sm{max-width:420px;}
.modal-hd{display:flex;align-items:center;justify-content:space-between;padding:.88rem 1.2rem;border-bottom:1px solid var(--bdr);position:sticky;top:0;background:var(--surf);z-index:1;}
.modal-title{display:flex;align-items:center;gap:.5rem;font-size:.9rem;font-weight:800;color:var(--txt);}
.modal-close{width:30px;height:30px;border:1px solid var(--bdr);border-radius:9px;background:var(--surf2);color:var(--txt2);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .15s;flex-shrink:0;}
.modal-close:hover{background:var(--bdr);}
.modal-body{padding:1.2rem;}
.modal-foot{display:flex;justify-content:flex-end;gap:.55rem;padding:.8rem 1.2rem;border-top:1px solid var(--bdr);position:sticky;bottom:0;background:var(--surf);}
.fld{margin-bottom:.9rem;}
.fld:last-child{margin-bottom:0;}
.fld label{display:block;font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--txt2);margin-bottom:.4rem;}
.fld label span{color:#ef4444;}
.fld input,.fld select,.fld textarea{width:100%;padding:.58rem .88rem;border:1px solid var(--bdr);border-radius:10px;background:var(--surf2);color:var(--txt);font-size:.83rem;font-family:var(--ff);outline:none;transition:border-color .15s,box-shadow .15s;}
.fld input:focus,.fld select:focus,.fld textarea:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(45,111,247,.1);}
.fld-grid{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;}

/* Items builder */
.items-builder{border:1px solid var(--bdr);border-radius:12px;overflow:hidden;}
.item-row{display:grid;grid-template-columns:1fr 100px 90px 36px;gap:.5rem;align-items:center;padding:.6rem .75rem;border-bottom:1px solid var(--bdr);background:var(--surf);}
.item-row:last-child{border-bottom:none;}
.item-row:nth-child(even){background:var(--surf2);}
.item-row select,.item-row input{padding:.45rem .65rem;border:1px solid var(--bdr);border-radius:8px;background:var(--surf);color:var(--txt);font-size:.8rem;font-family:var(--ff);outline:none;width:100%;}
.item-row select:focus,.item-row input:focus{border-color:var(--p);}
.item-row .unit-disp{padding:.45rem .5rem;border:1px solid var(--bdr);border-radius:8px;background:var(--surf2);color:var(--muted);font-size:.75rem;font-family:var(--fm);text-align:center;}
.add-item-btn{display:inline-flex;align-items:center;gap:.3rem;font-size:.76rem;font-weight:700;color:var(--p);cursor:pointer;padding:.4rem .6rem;border-radius:8px;background:rgba(45,111,247,.06);border:1px dashed rgba(45,111,247,.25);margin-top:.5rem;transition:all .15s;font-family:var(--ff);}
.add-item-btn:hover{background:rgba(45,111,247,.12);}
.remove-btn{width:28px;height:28px;border-radius:7px;background:rgba(239,68,68,.08);color:#dc2626;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:.85rem;transition:all .15s;}
.remove-btn:hover{background:rgba(239,68,68,.18);}

/* Items builder header */
.items-hd{display:grid;grid-template-columns:1fr 100px 90px 36px;gap:.5rem;padding:.45rem .75rem;background:var(--surf2);border-bottom:1px solid var(--bdr);}
.items-hd span{font-size:.63rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);}
</style>
@endpush

<div class="col-span-full">

    {{-- Flash --}}
    @if (session('success'))
        <div class="flash flash-ok"><i class="mgc_check_circle_line"></i> {{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="flash flash-err"><i class="mgc_close_circle_line"></i> {{ session('error') }}</div>
    @endif

    {{-- Header --}}
    <div class="hd">
        <div class="hd-left">
            <div class="eyebrow">Warehouse</div>
            <h2>Transmittals</h2>
            <p>Material transfer requests between warehouses.</p>
        </div>
        <div class="hd-actions">
            <button onclick="openModal('createModal')" class="btn-p">
                <i class="mgc_add_line"></i> New Transmittal
            </button>
            <a href="{{ route('warehouse.dashboard') }}" class="btn-ghost">
                <i class="mgc_dashboard_line"></i> Dashboard
            </a>
        </div>
    </div>

    {{-- Filter bar --}}
    <form method="GET" action="{{ route('warehouse.transmittals.index') }}" class="filter-bar">
        <div>
            <label>Status</label>
            <select name="status" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                @foreach (['pending','approved','in_transit','completed','rejected'] as $s)
                    <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Project</label>
            <select name="project_id" onchange="this.form.submit()">
                <option value="">All Projects</option>
                @foreach ($projects as $proj)
                    <option value="{{ $proj->id }}" @selected(request('project_id') == $proj->id)>{{ $proj->project_name }}</option>
                @endforeach
            </select>
        </div>
        @if (request('status') || request('project_id'))
            <div style="padding-bottom:.05rem;">
                <label style="opacity:0;">Clear</label>
                <a href="{{ route('warehouse.transmittals.index') }}" class="btn-ghost" style="padding:.48rem .9rem;">
                    <i class="mgc_close_line"></i> Clear
                </a>
            </div>
        @endif
    </form>

    {{-- Table --}}
    <div class="tpanel">
        <div class="tpanel-hd">
            <div class="tpanel-title">
                <i class="mgc_transfer_3_line" style="color:var(--p);"></i>
                All Transmittals
            </div>
            <span style="font-size:.72rem;color:var(--muted);">{{ $transmittals->total() }} total</span>
        </div>
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Direction</th>
                        <th>Transmittal #</th>
                        <th>Project</th>
                        <th>Route</th>
                        <th>Items</th>
                        <th>Driver / Truck</th>
                        <th>Requested By</th>
                        <th>Status</th>
                        <th>Date</th>
                        @if ($canApprove)
                            <th style="text-align:center;">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transmittals as $t)
                        @php
                            $isPapasok = in_array($t->destination_warehouse_id, $myWarehouseIds);
                            $isPalakas = in_array($t->origin_warehouse_id,      $myWarehouseIds);
                            $isBoth    = $isPapasok && $isPalakas;

                            $badgeClass = match($t->status) {
                                'pending'    => 's-pending',
                                'approved'   => 's-approved',
                                'in_transit' => 's-in_transit',
                                'completed'  => 's-completed',
                                'rejected'   => 's-rejected',
                                default      => 's-pending',
                            };

                            // Item chips
                            $itemChips = $t->items->groupBy('item_type')->map(function($rows, $type) {
                                $labels = [
                                    'amplifier'            => 'Amp',
                                    'node'                 => 'Node',
                                    'extender'             => 'Ext',
                                    'tsc'                  => 'TSC',
                                    'power_supply'         => 'PWR',
                                    'power_supply_housing' => 'PSH',
                                    'cable'                => 'Cable',
                                ];
                                $qty = $rows->sum('quantity_requested');
                                $lbl = $labels[$type] ?? ucfirst($type);
                                $unit = $type === 'cable' ? 'm' : '×';
                                return "{$lbl} {$unit}{$qty}";
                            })->values()->all();
                        @endphp
                        <tr>
                            {{-- Direction badge --}}
                            <td>
                                @if (empty($myWarehouseIds))
                                    <span class="dir-both"><i class="mgc_transfer_3_line"></i> Transfer</span>
                                @elseif ($isBoth)
                                    <span class="dir-both"><i class="mgc_transfer_3_line"></i> Internal</span>
                                @elseif ($isPapasok)
                                    <span class="dir-papasok"><i class="mgc_arrow_down_line"></i> Papasok</span>
                                @elseif ($isPalakas)
                                    <span class="dir-palabas"><i class="mgc_arrow_up_line"></i> Palabas</span>
                                @else
                                    <span class="dir-both"><i class="mgc_transfer_3_line"></i> Transfer</span>
                                @endif
                            </td>

                            {{-- Number --}}
                            <td>
                                <div class="td-main" style="font-family:var(--fm);font-size:.78rem;">{{ $t->transmittal_number }}</div>
                                <div style="font-size:.68rem;color:var(--muted);margin-top:.1rem;">{{ $t->items->count() }} item type{{ $t->items->count() !== 1 ? 's' : '' }}</div>
                            </td>

                            {{-- Project --}}
                            <td>
                                <div style="font-size:.78rem;color:var(--txt);">{{ $t->project?->project_name ?? '—' }}</div>
                            </td>

                            {{-- Route --}}
                            <td>
                                <div class="route-box">
                                    <div class="route-wh">
                                        <i class="mgc_building_2_line" style="font-size:.78rem;color:var(--muted);"></i>
                                        {{ $t->originWarehouse?->name ?? '—' }}
                                    </div>
                                    <div class="route-arrow">
                                        <i class="mgc_arrow_right_line"></i>
                                        {{ $t->destinationWarehouse?->name ?? '—' }}
                                    </div>
                                </div>
                            </td>

                            {{-- Items --}}
                            <td>
                                <div class="chip-row">
                                    @foreach ($itemChips as $chip)
                                        <span class="chip">{{ $chip }}</span>
                                    @endforeach
                                    @if (empty($itemChips))
                                        <span style="color:var(--muted);font-size:.73rem;">—</span>
                                    @endif
                                </div>
                            </td>

                            {{-- Driver --}}
                            <td>
                                <div class="td-main" style="font-size:.77rem;">{{ $t->driver_name ?: '—' }}</div>
                                @if ($t->truck_plate)
                                    <div style="font-size:.68rem;font-family:var(--fm);color:var(--muted);margin-top:.1rem;">{{ $t->truck_plate }}</div>
                                @endif
                                @if ($t->driver_contact)
                                    <div style="font-size:.68rem;color:var(--muted);margin-top:.1rem;">{{ $t->driver_contact }}</div>
                                @endif
                            </td>

                            {{-- Requested by --}}
                            <td style="font-size:.76rem;color:var(--txt);">{{ $t->requestedBy?->name ?? '—' }}</td>

                            {{-- Status --}}
                            <td>
                                <span class="badge {{ $badgeClass }}">{{ ucfirst(str_replace('_',' ',$t->status)) }}</span>
                                @if ($t->status === 'rejected' && $t->rejection_reason)
                                    <div style="font-size:.68rem;color:#dc2626;margin-top:.2rem;max-width:160px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $t->rejection_reason }}">
                                        {{ $t->rejection_reason }}
                                    </div>
                                @endif
                            </td>

                            {{-- Date --}}
                            <td style="font-size:.72rem;color:var(--muted);white-space:nowrap;">{{ $t->created_at->format('M d, Y') }}</td>

                            {{-- Actions --}}
                            @if ($canApprove)
                                <td style="text-align:center;">
                                    @if ($t->status === 'pending')
                                        <div style="display:flex;align-items:center;justify-content:center;gap:.35rem;">
                                            <form method="POST" action="{{ route('warehouse.transmittals.approve', $t) }}"
                                                onsubmit="return confirm('Approve {{ $t->transmittal_number }}?')">
                                                @csrf
                                                <button type="submit" class="act-approve">
                                                    <i class="mgc_check_line"></i> Approve
                                                </button>
                                            </form>
                                            <button onclick="openReject({{ $t->id }}, '{{ $t->transmittal_number }}')" class="act-reject">
                                                <i class="mgc_close_line"></i> Reject
                                            </button>
                                        </div>
                                    @else
                                        <span style="color:var(--muted);font-size:.72rem;">—</span>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="{{ $canApprove ? 10 : 9 }}">
                                <i class="mgc_transfer_3_line" style="font-size:2rem;display:block;margin-bottom:.5rem;color:var(--muted);"></i>
                                No transmittals found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($transmittals->hasPages())
            <div style="padding:.85rem 1.1rem;border-top:1px solid var(--bdr);">
                {{ $transmittals->links() }}
            </div>
        @endif
    </div>

</div>

{{-- ── CREATE TRANSMITTAL MODAL ── --}}
<div id="createModal" class="modal-overlay">
    <div class="modal">
        <div class="modal-hd">
            <div class="modal-title">
                <i class="mgc_transfer_3_line" style="color:var(--p);"></i>
                New Transfer Transmittal
            </div>
            <button class="modal-close" onclick="closeModal('createModal')"><i class="mgc_close_line"></i></button>
        </div>
        <form method="POST" action="{{ route('warehouse.transmittals.store') }}">
            @csrf
            <div class="modal-body">

                <div class="fld">
                    <label>Project <span>*</span></label>
                    <select name="project_id" required>
                        <option value="">— Select Project —</option>
                        @foreach ($projects as $proj)
                            <option value="{{ $proj->id }}">{{ $proj->project_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fld-grid">
                    <div class="fld" style="margin-bottom:0;">
                        <label>From Warehouse <span>*</span></label>
                        <select name="origin_warehouse_id" required>
                            <option value="">— Select Origin —</option>
                            @foreach ($warehouses as $wh)
                                <option value="{{ $wh->id }}">{{ $wh->name }}{{ $wh->subcontractor ? ' ('.$wh->subcontractor->name.')' : '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fld" style="margin-bottom:0;">
                        <label>To Warehouse <span>*</span></label>
                        <select name="destination_warehouse_id" required>
                            <option value="">— Select Destination —</option>
                            @foreach ($warehouses as $wh)
                                <option value="{{ $wh->id }}">{{ $wh->name }}{{ $wh->subcontractor ? ' ('.$wh->subcontractor->name.')' : '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="border-top:1px solid var(--bdr);margin:1rem 0;"></div>

                <div class="fld-grid">
                    <div class="fld" style="margin-bottom:0;">
                        <label>Driver Name</label>
                        <input type="text" name="driver_name" placeholder="Juan dela Cruz">
                    </div>
                    <div class="fld" style="margin-bottom:0;">
                        <label>Truck Plate</label>
                        <input type="text" name="truck_plate" placeholder="ABC 1234" style="text-transform:uppercase;font-family:var(--fm);">
                    </div>
                </div>

                <div class="fld-grid" style="margin-top:.75rem;">
                    <div class="fld" style="margin-bottom:0;">
                        <label>Driver Contact</label>
                        <input type="text" name="driver_contact" placeholder="+63 9XX XXX XXXX">
                    </div>
                    <div class="fld" style="margin-bottom:0;">
                        <label>Reason / Notes</label>
                        <input type="text" name="reason" placeholder="Material pullout, installation…">
                    </div>
                </div>

                <div style="border-top:1px solid var(--bdr);margin:1rem 0;"></div>

                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.6rem;">
                    <div style="font-size:.78rem;font-weight:800;color:var(--txt);">Items <span style="color:var(--muted);font-weight:500;font-size:.73rem;">— type + qty + unit</span></div>
                </div>

                <div class="items-builder">
                    <div class="items-hd">
                        <span>Item Type</span>
                        <span>Qty</span>
                        <span>Unit</span>
                        <span></span>
                    </div>
                    <div id="itemsContainer"></div>
                </div>
                <button type="button" class="add-item-btn" onclick="addItem()">
                    <i class="mgc_add_line"></i> Add Item
                </button>

            </div>
            <div class="modal-foot">
                <button type="button" class="btn-ghost" onclick="closeModal('createModal')">Cancel</button>
                <button type="submit" class="btn-p">Submit Transmittal</button>
            </div>
        </form>
    </div>
</div>

{{-- ── REJECT MODAL ── --}}
@if ($canApprove)
<div id="rejectModal" class="modal-overlay">
    <div class="modal modal-sm">
        <div class="modal-hd">
            <div class="modal-title">
                <i class="mgc_close_circle_line" style="color:#dc2626;"></i>
                <span id="rejectTitle">Reject Transmittal</span>
            </div>
            <button class="modal-close" onclick="closeModal('rejectModal')"><i class="mgc_close_line"></i></button>
        </div>
        <form method="POST" id="rejectForm">
            @csrf
            <div class="modal-body">
                <div class="fld">
                    <label>Rejection Reason <span style="color:#ef4444;">*</span></label>
                    <textarea name="rejection_reason" rows="3" required placeholder="State the reason for rejection…"
                        style="resize:none;width:100%;padding:.58rem .88rem;border:1px solid var(--bdr);border-radius:10px;background:var(--surf2);color:var(--txt);font-size:.83rem;font-family:var(--ff);outline:none;"></textarea>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn-ghost" onclick="closeModal('rejectModal')">Cancel</button>
                <button type="submit" class="btn-p" style="background:#dc2626;">Reject</button>
            </div>
        </form>
    </div>
</div>
@endif

<script>
// ── Modal helpers ──────────────────────────────────────────────────────────
function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-overlay').forEach(function(el) {
    el.addEventListener('click', function(e) { if (e.target === el) closeModal(el.id); });
});

// ── Item types (no description) ────────────────────────────────────────────
const ITEM_TYPES = [
    { value: 'amplifier',            label: 'Amplifier',            unit: 'pcs' },
    { value: 'node',                 label: 'Node',                 unit: 'pcs' },
    { value: 'extender',             label: 'Extender',             unit: 'pcs' },
    { value: 'tsc',                  label: 'TSC',                  unit: 'pcs' },
    { value: 'power_supply',         label: 'Power Supply',         unit: 'pcs' },
    { value: 'power_supply_housing', label: 'PS Housing',           unit: 'pcs' },
    { value: 'cable',                label: 'Cable',                unit: null  },
];

let itemIdx = 0;

function unitHtml(idx, unit) {
    const s = 'width:100%;padding:.45rem .5rem;border:1px solid var(--bdr);border-radius:8px;background:var(--surf);color:var(--txt);font-size:.8rem;font-family:var(--ff);outline:none;';
    if (unit === null) {
        return `<select name="items[${idx}][unit]" required style="${s}">
            <option value="meters">meters</option>
            <option value="kg">kg</option>
        </select>`;
    }
    return `<div class="unit-disp">${unit}<input type="hidden" name="items[${idx}][unit]" value="${unit}"></div>`;
}

function addItem() {
    const idx = itemIdx++;
    const container = document.getElementById('itemsContainer');
    const row = document.createElement('div');
    row.className = 'item-row';
    row.innerHTML = `
        <select name="items[${idx}][item_type]" required onchange="onType(this,${idx})">
            <option value="">— Select —</option>
            ${ITEM_TYPES.map(t => `<option value="${t.value}">${t.label}</option>`).join('')}
        </select>
        <input type="number" name="items[${idx}][quantity_requested]" placeholder="Qty" min="0.01" step="0.01" required>
        <div id="unit_${idx}">${unitHtml(idx, 'pcs')}</div>
        <button type="button" class="remove-btn" onclick="this.closest('.item-row').remove()">
            <i class="mgc_close_line"></i>
        </button>
    `;
    container.appendChild(row);
}

function onType(sel, idx) {
    const type = ITEM_TYPES.find(t => t.value === sel.value);
    document.getElementById(`unit_${idx}`).innerHTML = unitHtml(idx, type ? type.unit : 'pcs');
}

// Add one row by default
addItem();

// ── Reject modal ───────────────────────────────────────────────────────────
function openReject(id, number) {
    document.getElementById('rejectForm').action = `/warehouse/transmittals/${id}/reject`;
    document.getElementById('rejectTitle').textContent = `Reject ${number}`;
    openModal('rejectModal');
}
</script>

</x-layout>
