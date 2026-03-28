<x-layout>

@push('styles')
<style>
*,*::before,*::after{box-sizing:border-box;}
:root{
  --p:#2563eb;--p2:#1d4ed8;--pg:rgba(37,99,235,.08);
  --surf:#ffffff;--surf2:#f8fafc;
  --bdr:#e2e8f0;--txt:#0f172a;--txt2:#475569;--muted:#94a3b8;
  --r:14px;--sh:0 1px 3px rgba(15,23,42,.05),0 4px 16px rgba(15,23,42,.07);
  --ff:system-ui,-apple-system,sans-serif;--fm:'JetBrains Mono','Fira Mono',monospace;
  --green:#16a34a;--amber:#d97706;--red:#dc2626;
}
body{font-family:var(--ff);}

.dv-wrap{padding:1rem 1.5rem 2.5rem;}

.eyebrow{font-size:.63rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--p);display:flex;align-items:center;gap:.4rem;margin-bottom:.2rem;}
.eyebrow::before{content:'';display:inline-block;width:14px;height:2px;background:var(--p);border-radius:2px;}

.pg-hd{display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.4rem;}
.pg-hd h2{margin:.1rem 0 0;font-size:1.5rem;font-weight:900;color:var(--txt);letter-spacing:-.02em;line-height:1.1;}
.pg-hd p{margin:.2rem 0 0;font-size:.77rem;color:var(--txt2);}
.hd-btns{display:flex;gap:.5rem;}
.btn-p{display:inline-flex;align-items:center;gap:.35rem;padding:.48rem .95rem;background:var(--p);color:#fff;border:none;border-radius:10px;font-size:.8rem;font-weight:700;font-family:var(--ff);cursor:pointer;text-decoration:none;transition:background .15s;}
.btn-p:hover{background:var(--p2);}
.btn-ghost{display:inline-flex;align-items:center;gap:.35rem;padding:.46rem .9rem;border:1px solid var(--bdr);border-radius:10px;background:var(--surf);color:var(--txt2);font-size:.8rem;font-weight:600;font-family:var(--ff);text-decoration:none;}
.btn-ghost:hover{background:var(--surf2);color:var(--txt);}

.flash{display:flex;align-items:center;gap:.5rem;padding:.65rem 1rem;border-radius:10px;font-size:.8rem;font-weight:600;margin-bottom:1rem;}
.flash-ok{background:rgba(22,163,74,.08);border:1px solid rgba(22,163,74,.2);color:#15803d;}
.flash-err{background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);color:#dc2626;}

/* map */
.map-panel{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;margin-bottom:1.4rem;}
.map-panel-hd{display:flex;align-items:center;gap:.5rem;padding:.8rem 1.1rem;border-bottom:1px solid var(--bdr);background:var(--surf2);}
.map-icon{color:#7c3aed;font-size:1rem;}
#liveMap{height:280px;width:100%;}

/* tpanel */
.tpanel{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;margin-bottom:1.25rem;}
.tpanel-hd{display:flex;align-items:center;gap:.5rem;padding:.8rem 1.1rem;border-bottom:1px solid var(--bdr);background:var(--surf2);}
.tpanel-title{font-size:.86rem;font-weight:800;color:var(--txt);}
.tpanel-count{margin-left:auto;font-size:.7rem;font-weight:700;color:var(--muted);}

/* filter */
.filter-bar{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);padding:1rem 1.1rem;margin-bottom:1.1rem;}
.filter-row{display:flex;flex-wrap:wrap;gap:.75rem;align-items:flex-end;}
.f-group{display:flex;flex-direction:column;gap:.3rem;min-width:150px;}
.f-group label{font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);}
.f-group select{border:1px solid var(--bdr);border-radius:8px;padding:.42rem .7rem;font-size:.82rem;font-family:var(--ff);color:var(--txt);background:var(--surf);outline:none;}
.f-group select:focus{border-color:var(--p);}
.btn-filter{padding:.44rem 1rem;background:var(--p);color:#fff;border:none;border-radius:8px;font-size:.8rem;font-weight:700;font-family:var(--ff);cursor:pointer;}
.btn-filter:hover{background:var(--p2);}
.btn-clear{padding:.42rem .9rem;border:1px solid var(--bdr);border-radius:8px;background:var(--surf);color:var(--txt2);font-size:.8rem;font-weight:600;font-family:var(--ff);text-decoration:none;}
.btn-clear:hover{background:var(--surf2);}

/* field delivery cards */
.fd-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(360px,1fr));gap:1rem;padding:1rem;}
.fd-card{border:1px solid var(--bdr);border-radius:12px;overflow:hidden;transition:box-shadow .15s;}
.fd-card:hover{box-shadow:0 4px 20px rgba(15,23,42,.1);}
.fd-card.today{border-color:#bbf7d0;background:linear-gradient(135deg,#f0fdf4 0%,#fff 100%);}
.fd-card.today .fd-date-badge{background:#dcfce7;color:#15803d;}
.fd-card.overdue{border-color:#fecaca;}
.fd-card.overdue .fd-date-badge{background:#fee2e2;color:#b91c1c;}

.fd-card-hd{display:flex;align-items:center;gap:.6rem;padding:.75rem 1rem;border-bottom:1px solid var(--bdr);}
.fd-node{font-family:var(--fm);font-size:.78rem;font-weight:700;color:var(--txt);background:var(--pg);padding:.18rem .55rem;border-radius:6px;}
.fd-project{font-size:.73rem;color:var(--txt2);flex:1;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.fd-date-badge{font-size:.65rem;font-weight:800;padding:.22rem .6rem;border-radius:999px;background:var(--surf2);color:var(--txt2);white-space:nowrap;}

.fd-body{padding:.75rem 1rem;}
.fd-items{display:flex;flex-wrap:wrap;gap:.4rem;margin-bottom:.65rem;}
.fd-item-chip{display:inline-flex;align-items:center;gap:.25rem;padding:.2rem .55rem;background:var(--surf2);border:1px solid var(--bdr);border-radius:8px;font-size:.7rem;font-weight:700;color:var(--txt);}
.fd-item-chip i{font-size:.8rem;color:var(--p);}

.fd-meta{font-size:.7rem;color:var(--muted);margin-bottom:.7rem;display:flex;flex-direction:column;gap:.2rem;}
.fd-meta span{display:flex;align-items:center;gap:.3rem;}

.fd-proof{width:100%;height:90px;object-fit:cover;border-radius:8px;margin-bottom:.65rem;cursor:pointer;}

.fd-actions{display:flex;gap:.5rem;align-items:center;flex-wrap:wrap;}
.btn-approve{display:inline-flex;align-items:center;gap:.35rem;padding:.45rem 1rem;background:#16a34a;color:#fff;border:none;border-radius:8px;font-size:.78rem;font-weight:700;font-family:var(--ff);cursor:pointer;transition:background .15s;}
.btn-approve:hover{background:#15803d;}
.btn-proof{display:inline-flex;align-items:center;gap:.3rem;padding:.43rem .85rem;border:1px solid var(--bdr);background:var(--surf);color:var(--txt2);font-size:.75rem;font-weight:600;font-family:var(--ff);border-radius:8px;cursor:pointer;}
.btn-proof:hover{background:var(--surf2);}

/* approve modal */
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(15,23,42,.45);z-index:1000;align-items:center;justify-content:center;}
.modal-overlay.open{display:flex;}
.modal{background:#fff;border-radius:18px;width:96%;max-width:480px;box-shadow:0 20px 60px rgba(15,23,42,.2);overflow:hidden;}
.modal-hd{display:flex;align-items:center;gap:.5rem;padding:1.1rem 1.2rem;border-bottom:1px solid var(--bdr);background:var(--surf2);}
.modal-title{font-size:.95rem;font-weight:800;color:var(--txt);flex:1;}
.modal-close{background:none;border:none;font-size:1.2rem;color:var(--muted);cursor:pointer;line-height:1;}
.modal-body{padding:1.2rem;}
.modal-label{font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);margin-bottom:.35rem;display:block;}
.modal-upload{border:2px dashed var(--bdr);border-radius:10px;padding:1.1rem;text-align:center;cursor:pointer;transition:border-color .15s;position:relative;}
.modal-upload:hover{border-color:var(--p);}
.modal-upload input{position:absolute;inset:0;opacity:0;cursor:pointer;}
.modal-upload-txt{font-size:.8rem;color:var(--muted);margin-top:.3rem;}
.modal-preview{width:100%;max-height:160px;object-fit:cover;border-radius:8px;margin-top:.6rem;display:none;}
.modal-footer{display:flex;gap:.65rem;justify-content:flex-end;padding:.9rem 1.2rem;border-top:1px solid var(--bdr);background:var(--surf2);}

/* transmittal table */
.dv-table{width:100%;border-collapse:collapse;}
.dv-table thead th{padding:.6rem 1rem;text-align:left;font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);background:var(--surf2);border-bottom:1px solid var(--bdr);white-space:nowrap;}
.dv-table tbody tr{border-bottom:1px solid var(--bdr);transition:background .1s;}
.dv-table tbody tr:last-child{border-bottom:none;}
.dv-table tbody tr:hover{background:#f0f6ff;}
.dv-table tbody td{padding:.75rem 1rem;font-size:.8rem;color:var(--txt2);vertical-align:middle;}
.td-main{color:var(--txt);font-weight:700;font-size:.8rem;}
.td-mono{font-family:var(--fm);font-size:.75rem;color:var(--txt);font-weight:700;}
.td-sub{font-size:.72rem;color:var(--muted);margin-top:.15rem;}

.badge{display:inline-flex;align-items:center;padding:.22rem .65rem;border-radius:999px;font-size:.67rem;font-weight:800;white-space:nowrap;}
.b-draft    {background:#f1f5f9;color:#64748b;}
.b-transit  {background:#ede9fe;color:#7c3aed;}
.b-arrived  {background:#dbeafe;color:#1d4ed8;}
.b-received {background:#fef3c7;color:#b45309;}
.b-completed{background:#dcfce7;color:#166534;}
.b-pending  {background:#fff7ed;color:#c2410c;}
.b-today    {background:#dcfce7;color:#15803d;}
.b-default  {background:#f1f5f9;color:#64748b;}

.gps-btn{display:inline-flex;align-items:center;gap:.25rem;color:#7c3aed;font-size:.75rem;font-weight:700;background:none;border:none;cursor:pointer;font-family:var(--ff);}
.gps-btn:hover{text-decoration:underline;}

.pg-wrap{padding:.85rem 1.1rem;border-top:1px solid var(--bdr);}
.empty-state{text-align:center;padding:2.5rem 1rem;color:var(--muted);}
.empty-state i{font-size:2rem;display:block;margin-bottom:.5rem;}
.empty-state p{font-size:.82rem;margin:0;}

/* lightbox */
.lb-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.85);z-index:2000;align-items:center;justify-content:center;cursor:pointer;}
.lb-overlay.open{display:flex;}
.lb-overlay img{max-width:90vw;max-height:90vh;border-radius:10px;box-shadow:0 8px 40px rgba(0,0,0,.6);}
</style>
@endpush

<div class="col-span-full dv-wrap">

    {{-- Flash --}}
    @if(session('success'))
        <div class="flash flash-ok"><i class="mgc_check_circle_line"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash flash-err"><i class="mgc_close_circle_line"></i> {{ session('error') }}</div>
    @endif

    {{-- Header --}}
    <div class="pg-hd">
        <div>
            <div class="eyebrow"><i class="mgc_truck_line"></i> Logistics</div>
            <h2>Deliveries</h2>
            <p>Field teardown returns and transmittal deliveries in one view.</p>
        </div>
        <div class="hd-btns">
            <a href="{{ route('warehouse.dashboard') }}" class="btn-ghost">
                <i class="mgc_home_3_line"></i> Dashboard
            </a>
            <a href="{{ route('warehouse.transmittals.index') }}" class="btn-ghost">
                <i class="mgc_file_list_line"></i> Transmittals
            </a>
        </div>
    </div>

    {{-- Live Map --}}
    @if($liveDeliveries->count())
        <div class="map-panel">
            <div class="map-panel-hd">
                <i class="mgc_map_line map-icon"></i>
                <span class="tpanel-title">Live Delivery Map</span>
                <span style="margin-left:auto;font-size:.72rem;color:var(--muted);">{{ $liveDeliveries->count() }} truck(s) active</span>
            </div>
            <div id="liveMap"></div>
        </div>
    @endif

    {{-- ═══════════════════════════════════════════════════════════
         SECTION 1 — EXPECTED FIELD DELIVERIES (from lineman reports)
         ═══════════════════════════════════════════════════════════ --}}
    @php
        $todayCount    = $fieldReceipts->filter(fn($r) => $r->delivery_date && $r->delivery_date->isToday())->count();
        $overdueCount  = $fieldReceipts->filter(fn($r) => $r->delivery_date && $r->delivery_date->isPast() && !$r->delivery_date->isToday())->count();
    @endphp
    <div class="tpanel">
        <div class="tpanel-hd">
            <i class="mgc_box_line" style="color:#16a34a;font-size:1rem;"></i>
            <span class="tpanel-title">Expected Field Returns</span>
            @if($todayCount)
                <span class="badge b-today" style="margin-left:.5rem;">{{ $todayCount }} today</span>
            @endif
            @if($overdueCount)
                <span class="badge b-pending" style="margin-left:.3rem;">{{ $overdueCount }} overdue</span>
            @endif
            <span class="tpanel-count">{{ $fieldReceipts->count() }} pending</span>
        </div>

        @if($fieldReceipts->isEmpty())
            <div class="empty-state">
                <i class="mgc_box_line"></i>
                <p>No pending field deliveries. All caught up!</p>
            </div>
        @else
            <div class="fd-grid">
                @foreach($fieldReceipts as $r)
                    @php
                        $isToday   = $r->delivery_date && $r->delivery_date->isToday();
                        $isOverdue = $r->delivery_date && $r->delivery_date->isPast() && !$isToday;
                        $cardCls   = $isToday ? 'today' : ($isOverdue ? 'overdue' : '');
                        $lineman   = $fieldUserMap[$r->submission?->submitted_by ?? 0] ?? null;
                        $approver  = $fieldUserMap[$r->submission?->pm_reviewed_by ?? 0] ?? null;
                    @endphp
                    <div class="fd-card {{ $cardCls }}">
                        {{-- Card header --}}
                        <div class="fd-card-hd">
                            <span class="fd-node">
                                {{ $r->node?->node_id ?? '—' }}
                            </span>
                            <span class="fd-project">
                                {{ $r->project?->project_name ?? '—' }}
                            </span>
                            <span class="fd-date-badge">
                                @if($isToday)
                                    Today
                                @elseif($r->delivery_date)
                                    {{ $r->delivery_date->format('M d') }}
                                @else
                                    TBD
                                @endif
                            </span>
                        </div>

                        {{-- Body --}}
                        <div class="fd-body">
                            {{-- Items chips --}}
                            <div class="fd-items">
                                @if((float)$r->collected_cable > 0)
                                    <span class="fd-item-chip"><i class="mgc_cable_line"></i> {{ number_format((float)$r->collected_cable, 0) }}m cable</span>
                                @endif
                                @if((int)$r->collected_node > 0)
                                    <span class="fd-item-chip"><i class="mgc_node_line"></i> {{ (int)$r->collected_node }} node</span>
                                @endif
                                @if((int)$r->collected_amplifier > 0)
                                    <span class="fd-item-chip"><i class="mgc_signal_line"></i> {{ (int)$r->collected_amplifier }} amp</span>
                                @endif
                                @if((int)$r->collected_extender > 0)
                                    <span class="fd-item-chip"><i class="mgc_wifi_line"></i> {{ (int)$r->collected_extender }} ext</span>
                                @endif
                                @if((int)$r->collected_tsc > 0)
                                    <span class="fd-item-chip"><i class="mgc_device_line"></i> {{ (int)$r->collected_tsc }} tsc</span>
                                @endif
                                @if(!$r->collected_cable && !$r->collected_node && !$r->collected_amplifier && !$r->collected_extender && !$r->collected_tsc)
                                    <span style="font-size:.72rem;color:var(--muted);">No items recorded</span>
                                @endif
                            </div>

                            {{-- Meta --}}
                            <div class="fd-meta">
                                @if($r->warehouse_location)
                                    <span><i class="mgc_warehouse_line"></i> To: <b>{{ $r->warehouse_location }}</b></span>
                                @endif
                                @if($r->node?->node_name)
                                    <span><i class="mgc_node_line"></i> {{ $r->node->node_name }}</span>
                                @endif
                                @if($lineman)
                                    <span><i class="mgc_user_line"></i> Lineman: {{ $lineman }}</span>
                                @endif
                                @if($approver)
                                    <span><i class="mgc_check_line"></i> PM: {{ $approver }}</span>
                                @endif
                            </div>

                            {{-- Proof of delivery preview --}}
                            @if($r->delivery_proof)
                                <img src="{{ Storage::url($r->delivery_proof) }}"
                                     alt="Proof of delivery"
                                     class="fd-proof"
                                     onclick="openLightbox('{{ Storage::url($r->delivery_proof) }}')" />
                            @endif

                            {{-- Actions --}}
                            <div class="fd-actions">
                                <button class="btn-approve"
                                        onclick="openApprove({{ $r->id }}, '{{ addslashes($r->node?->node_id ?? 'Receipt #'.$r->id) }}', '{{ addslashes($r->project?->project_name ?? '') }}')">
                                    <i class="mgc_check_circle_line"></i> Approve & Receive
                                </button>
                                @if(!$r->delivery_proof)
                                    <button class="btn-proof"
                                            onclick="openProof({{ $r->id }}, '{{ addslashes($r->node?->node_id ?? 'Receipt #'.$r->id) }}')">
                                        <i class="mgc_camera_line"></i> Attach Proof
                                    </button>
                                @else
                                    <button class="btn-proof"
                                            onclick="openProof({{ $r->id }}, '{{ addslashes($r->node?->node_id ?? 'Receipt #'.$r->id) }}')">
                                        <i class="mgc_refresh_2_line"></i> Replace Proof
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- ═══════════════════════════════════════════
         SECTION 2 — TRANSMITTAL DELIVERIES
         ═══════════════════════════════════════════ --}}
    <div class="filter-bar">
        <form method="GET" action="{{ route('warehouse.deliveries.index') }}" class="filter-row">
            <div class="f-group">
                <label>Status</label>
                <select name="status">
                    <option value="">All Statuses</option>
                    @foreach(['draft'=>'Draft','in_transit'=>'In Transit','arrived'=>'Arrived','received'=>'Received','completed'=>'Completed'] as $val=>$lbl)
                        <option value="{{ $val }}" @selected(request('status') === $val)>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn-filter">Filter</button>
            <a href="{{ route('warehouse.deliveries.index') }}" class="btn-clear">Clear</a>
        </form>
    </div>

    <div class="tpanel">
        <div class="tpanel-hd">
            <i class="mgc_truck_line" style="color:var(--p);font-size:1rem;"></i>
            <span class="tpanel-title">Transmittal Deliveries</span>
        </div>
        <div style="overflow-x:auto;">
            <table class="dv-table" style="min-width:800px;">
                <thead>
                    <tr>
                        <th>Transmittal</th>
                        <th>Driver / Truck</th>
                        <th>Route</th>
                        <th>Project</th>
                        <th>Status</th>
                        <th>Departed</th>
                        <th>Arrived</th>
                        <th style="width:80px;">GPS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($deliveries as $d)
                        @php
                            $bCls = match($d->status) {
                                'draft'      => 'b-draft',
                                'in_transit' => 'b-transit',
                                'arrived'    => 'b-arrived',
                                'received'   => 'b-received',
                                'completed'  => 'b-completed',
                                default      => 'b-default',
                            };
                        @endphp
                        <tr>
                            <td>
                                @if($d->transmittal)
                                    <span class="td-mono">{{ $d->transmittal->transmittal_number }}</span>
                                @else
                                    <span style="color:var(--muted);">—</span>
                                @endif
                            </td>
                            <td>
                                <div class="td-main">{{ $d->driver_name ?? '—' }}</div>
                                @if($d->truck_plate)
                                    <div class="td-sub td-mono">{{ $d->truck_plate }}</div>
                                @endif
                                @if($d->driver_contact)
                                    <div class="td-sub">{{ $d->driver_contact }}</div>
                                @endif
                            </td>
                            <td>
                                <div style="font-weight:600;color:var(--txt);font-size:.78rem;">
                                    {{ $d->originWarehouse?->name ?? '—' }}
                                </div>
                                <div style="display:flex;align-items:center;gap:.3rem;color:var(--muted);font-size:.72rem;margin-top:.1rem;">
                                    <i class="mgc_arrow_down_line" style="font-size:.85rem;"></i>
                                    {{ $d->destinationWarehouse?->name ?? '—' }}
                                </div>
                            </td>
                            <td>
                                <span class="td-main">{{ $d->project?->project_name ?? '—' }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $bCls }}">{{ ucfirst(str_replace('_',' ',$d->status)) }}</span>
                            </td>
                            <td style="font-size:.73rem;color:var(--muted);white-space:nowrap;">
                                {{ $d->departed_at ? $d->departed_at->format('M d, g:i A') : '—' }}
                            </td>
                            <td style="font-size:.73rem;color:var(--muted);white-space:nowrap;">
                                {{ $d->arrived_at ? $d->arrived_at->format('M d, g:i A') : '—' }}
                            </td>
                            <td>
                                @if($d->last_latitude && $d->last_longitude)
                                    <button class="gps-btn" onclick="focusMarker({{ $d->last_latitude }},{{ $d->last_longitude }},'{{ addslashes($d->truck_plate ?? 'Truck') }}')">
                                        <i class="mgc_location_line"></i> Track
                                    </button>
                                    <div class="td-sub">{{ $d->last_location_at?->diffForHumans() ?? '' }}</div>
                                @else
                                    <span style="color:var(--muted);font-size:.72rem;">No signal</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="mgc_truck_line"></i>
                                    <p>No deliveries found.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($deliveries->hasPages())
            <div class="pg-wrap">{{ $deliveries->links() }}</div>
        @endif
    </div>

</div>

{{-- Approve Modal --}}
<div class="modal-overlay" id="approveModal">
    <div class="modal">
        <div class="modal-hd">
            <i class="mgc_check_circle_line" style="color:#16a34a;font-size:1.1rem;"></i>
            <span class="modal-title" id="approveTitle">Approve & Receive</span>
            <button class="modal-close" onclick="closeApprove()">✕</button>
        </div>
        <form id="approveForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div style="font-size:.82rem;color:var(--txt2);margin-bottom:1rem;">
                    Mark this delivery as received. Optionally attach proof of delivery.
                </div>
                <label class="modal-label">Proof of Delivery (optional)</label>
                <div class="modal-upload" onclick="document.getElementById('approveImg').click()">
                    <input type="file" id="approveImg" name="proof_image" accept="image/*"
                           onchange="previewApproveImg(this)" style="display:none;">
                    <i class="mgc_camera_line" style="font-size:1.4rem;color:var(--muted);"></i>
                    <div class="modal-upload-txt">Tap to attach photo</div>
                    <img id="approveImgPreview" class="modal-preview" alt="Preview">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeApprove()" class="btn-ghost" style="font-size:.8rem;">Cancel</button>
                <button type="submit" class="btn-approve">
                    <i class="mgc_check_circle_line"></i> Confirm Received
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Proof-only Modal --}}
<div class="modal-overlay" id="proofModal">
    <div class="modal">
        <div class="modal-hd">
            <i class="mgc_camera_line" style="color:var(--p);font-size:1.1rem;"></i>
            <span class="modal-title" id="proofTitle">Attach Proof of Delivery</span>
            <button class="modal-close" onclick="closeProof()">✕</button>
        </div>
        <form id="proofForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <label class="modal-label">Delivery Photo</label>
                <div class="modal-upload" onclick="document.getElementById('proofImg').click()">
                    <input type="file" id="proofImg" name="proof_image" accept="image/*" required
                           onchange="previewProofImg(this)" style="display:none;">
                    <i class="mgc_camera_line" style="font-size:1.4rem;color:var(--muted);"></i>
                    <div class="modal-upload-txt">Tap to select photo</div>
                    <img id="proofImgPreview" class="modal-preview" alt="Preview">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeProof()" class="btn-ghost" style="font-size:.8rem;">Cancel</button>
                <button type="submit" class="btn-p" style="font-size:.8rem;">
                    <i class="mgc_upload_2_line"></i> Upload
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Lightbox --}}
<div class="lb-overlay" id="lightbox" onclick="closeLightbox()">
    <img id="lbImg" src="" alt="Proof">
</div>

{{-- Leaflet --}}
@if($liveDeliveries->count())
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @php
        $liveMapData = $liveDeliveries->map(fn($d) => [
            'plate'  => $d->truck_plate,
            'status' => $d->status,
            'from'   => $d->originWarehouse?->name,
            'to'     => $d->destinationWarehouse?->name,
            'lat'    => (float)$d->last_latitude,
            'lng'    => (float)$d->last_longitude,
            'pinged' => $d->last_location_at?->diffForHumans(),
        ]);
    @endphp
    <script>
    (function(){
        const data = @json($liveMapData);
        const valid = data.filter(d => d.lat && d.lng);
        if (!valid.length) return;
        const map = L.map('liveMap').setView([valid[0].lat, valid[0].lng], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{attribution:'&copy; OpenStreetMap'}).addTo(map);
        const markers = {};
        valid.forEach(d => {
            const m = L.marker([d.lat,d.lng]).addTo(map)
                .bindPopup(`<b>${d.plate??'Truck'}</b><br>${d.from??''} → ${d.to??''}<br><em>${(d.status||'').replace('_',' ')}</em>${d.pinged?'<br>'+d.pinged:''}`);
            markers[d.lat+'_'+d.lng] = m;
        });
        if (valid.length > 1) map.fitBounds(L.latLngBounds(valid.map(d=>[d.lat,d.lng])),{padding:[30,30]});
        window.focusMarker = (lat,lng,plate) => {
            map.setView([lat,lng],15);
            const m = markers[lat+'_'+lng];
            if (m) m.openPopup();
            document.getElementById('liveMap').scrollIntoView({behavior:'smooth',block:'center'});
        };
    })();
    </script>
@else
    <script>function focusMarker(){}</script>
@endif

<script>
// Approve modal
function openApprove(id, node, project) {
    document.getElementById('approveTitle').textContent = `Receive – ${node} · ${project}`;
    document.getElementById('approveForm').action = `/warehouse/receipts/${id}/receive`;
    document.getElementById('approveImg').value = '';
    document.getElementById('approveImgPreview').style.display = 'none';
    document.getElementById('approveModal').classList.add('open');
}
function closeApprove() { document.getElementById('approveModal').classList.remove('open'); }
function previewApproveImg(input) {
    const prev = document.getElementById('approveImgPreview');
    if (input.files && input.files[0]) {
        prev.src = URL.createObjectURL(input.files[0]);
        prev.style.display = 'block';
    }
}

// Proof-only modal
function openProof(id, node) {
    document.getElementById('proofTitle').textContent = `Proof – ${node}`;
    document.getElementById('proofForm').action = `/warehouse/receipts/${id}/proof`;
    document.getElementById('proofImg').value = '';
    document.getElementById('proofImgPreview').style.display = 'none';
    document.getElementById('proofModal').classList.add('open');
}
function closeProof() { document.getElementById('proofModal').classList.remove('open'); }
function previewProofImg(input) {
    const prev = document.getElementById('proofImgPreview');
    if (input.files && input.files[0]) {
        prev.src = URL.createObjectURL(input.files[0]);
        prev.style.display = 'block';
    }
}

// Lightbox
function openLightbox(url) {
    document.getElementById('lbImg').src = url;
    document.getElementById('lightbox').classList.add('open');
}
function closeLightbox() { document.getElementById('lightbox').classList.remove('open'); }
</script>

</x-layout>
