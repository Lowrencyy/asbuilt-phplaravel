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
}
body{font-family:var(--ff);}

.wd-wrap{padding:1rem 1.5rem 2.5rem;}

/* eyebrow */
.eyebrow{font-size:.63rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--p);display:flex;align-items:center;gap:.4rem;margin-bottom:.2rem;}
.eyebrow::before{content:'';display:inline-block;width:14px;height:2px;background:var(--p);border-radius:2px;}

/* page header */
.pg-hd{display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.4rem;}
.pg-hd h2{margin:.1rem 0 0;font-size:1.5rem;font-weight:900;color:var(--txt);letter-spacing:-.02em;line-height:1.1;}
.pg-hd p{margin:.2rem 0 0;font-size:.77rem;color:var(--txt2);}
.hd-btns{display:flex;gap:.5rem;}
.btn-p{display:inline-flex;align-items:center;gap:.35rem;padding:.48rem .95rem;background:var(--p);color:#fff;border:none;border-radius:10px;font-size:.8rem;font-weight:700;font-family:var(--ff);cursor:pointer;text-decoration:none;transition:background .15s;}
.btn-p:hover{background:var(--p2);}
.btn-ghost{display:inline-flex;align-items:center;gap:.35rem;padding:.46rem .9rem;border:1px solid var(--bdr);border-radius:10px;background:var(--surf);color:var(--txt2);font-size:.8rem;font-weight:600;font-family:var(--ff);text-decoration:none;}
.btn-ghost:hover{background:var(--surf2);color:var(--txt);}

/* flash */
.flash{display:flex;align-items:center;gap:.5rem;padding:.65rem 1rem;border-radius:10px;font-size:.8rem;font-weight:600;margin-bottom:1rem;}
.flash-ok{background:rgba(22,163,74,.08);border:1px solid rgba(22,163,74,.2);color:#15803d;}
.flash-err{background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);color:#dc2626;}

/* stat cards */
.stat-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:.85rem;margin-bottom:1.4rem;}
@media(max-width:1100px){.stat-grid{grid-template-columns:repeat(3,1fr);}}
@media(max-width:640px){.stat-grid{grid-template-columns:repeat(2,1fr);}}
.stat-card{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);padding:1rem 1.1rem;position:relative;overflow:hidden;}
.stat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;border-radius:3px 3px 0 0;background:var(--sc-accent,var(--p));}
.stat-card .sc-val{font-size:2rem;font-weight:900;font-family:var(--fm);color:var(--txt);line-height:1.1;margin-top:.25rem;}
.stat-card .sc-lbl{font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);margin-top:.3rem;}
.stat-card .sc-icon{position:absolute;bottom:.7rem;right:.85rem;font-size:1.5rem;opacity:.08;}

/* section title */
.sec-hd{display:flex;align-items:center;gap:.6rem;margin-bottom:.85rem;}
.sec-hd-bar{width:3px;height:18px;border-radius:2px;background:var(--p);flex-shrink:0;}
.sec-hd span{font-size:.88rem;font-weight:800;color:var(--txt);}
.sec-count{padding:.18rem .6rem;border-radius:999px;background:var(--pg);color:var(--p);font-size:.68rem;font-weight:700;}

/* panel */
.tpanel{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;margin-bottom:1.25rem;}
.tpanel-hd{display:flex;align-items:center;gap:.5rem;padding:.8rem 1.1rem;border-bottom:1px solid var(--bdr);background:var(--surf2);}
.tpanel-title{font-size:.86rem;font-weight:800;color:var(--txt);}
.tpanel-link{margin-left:auto;font-size:.75rem;font-weight:700;color:var(--p);text-decoration:none;}
.tpanel-link:hover{text-decoration:underline;}

/* table */
.wd-table{width:100%;border-collapse:collapse;}
.wd-table thead th{padding:.6rem 1rem;text-align:left;font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);background:var(--surf2);border-bottom:1px solid var(--bdr);white-space:nowrap;}
.wd-table tbody tr{border-bottom:1px solid var(--bdr);transition:background .1s;}
.wd-table tbody tr:last-child{border-bottom:none;}
.wd-table tbody tr:hover{background:#f0f6ff;}
.wd-table tbody td{padding:.7rem 1rem;font-size:.8rem;color:var(--txt2);vertical-align:middle;}
.td-main{color:var(--txt);font-weight:700;font-size:.8rem;}
.td-mono{font-family:var(--fm);font-size:.75rem;color:var(--txt);font-weight:700;}

/* status badges */
.badge{display:inline-flex;align-items:center;padding:.22rem .65rem;border-radius:999px;font-size:.67rem;font-weight:800;white-space:nowrap;}
.b-pending  {background:#fef3c7;color:#b45309;}
.b-approved {background:#dbeafe;color:#1d4ed8;}
.b-transit  {background:#ede9fe;color:#7c3aed;}
.b-completed{background:#dcfce7;color:#166534;}
.b-rejected {background:#fee2e2;color:#dc2626;}
.b-default  {background:#f1f5f9;color:#64748b;}

/* map card */
.map-panel{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;margin-bottom:1.25rem;}
.map-panel-hd{display:flex;align-items:center;gap:.5rem;padding:.8rem 1.1rem;border-bottom:1px solid var(--bdr);background:var(--surf2);}
.map-icon{color:#7c3aed;font-size:1rem;}
#deliveryMap{height:320px;width:100%;}

/* icon helper */
.ic{font-size:1rem;}
</style>
@endpush

@php
    $cards = [
        ['label'=>'Total',      'value'=>$stats['total'],      'icon'=>'mgc_box_3_line',         'accent'=>'#64748b'],
        ['label'=>'Pending',    'value'=>$stats['pending'],    'icon'=>'mgc_time_line',           'accent'=>'#f59e0b'],
        ['label'=>'Approved',   'value'=>$stats['approved'],   'icon'=>'mgc_check_circle_line',   'accent'=>'#2563eb'],
        ['label'=>'In Transit', 'value'=>$stats['in_transit'], 'icon'=>'mgc_truck_line',          'accent'=>'#7c3aed'],
        ['label'=>'Completed',  'value'=>$stats['completed'],  'icon'=>'mgc_check_2_line',        'accent'=>'#16a34a'],
        ['label'=>'Rejected',   'value'=>$stats['rejected'],   'icon'=>'mgc_close_circle_line',   'accent'=>'#dc2626'],
    ];
@endphp

<div class="col-span-full wd-wrap">

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
            <div class="eyebrow"><i class="mgc_warehouse_line"></i> Operations</div>
            <h2>Warehouse Portal</h2>
            <p>Overview of transmittals, deliveries, and inventory movements.</p>
        </div>
        <div class="hd-btns">
            <a href="{{ route('warehouse.transmittals.index') }}" class="btn-p">
                <i class="mgc_file_list_line"></i> Transmittals
            </a>
            <a href="{{ route('warehouse.deliveries.index') }}" class="btn-ghost">
                <i class="mgc_truck_line"></i> Deliveries
            </a>
            <a href="{{ route('warehouse.inventory.index') }}" class="btn-ghost">
                <i class="mgc_box_3_line"></i> Inventory
            </a>
        </div>
    </div>

    {{-- Stat cards --}}
    <div class="stat-grid">
        @foreach($cards as $card)
            <div class="stat-card" style="--sc-accent:{{ $card['accent'] }}">
                <div class="sc-lbl">{{ $card['label'] }}</div>
                <div class="sc-val">{{ $card['value'] }}</div>
                <i class="{{ $card['icon'] }} sc-icon"></i>
            </div>
        @endforeach
    </div>

    {{-- Active Deliveries Map --}}
    @if($activeDeliveries->count())
        <div class="sec-hd">
            <div class="sec-hd-bar" style="background:#7c3aed;"></div>
            <span>Active Deliveries</span>
            <span class="sec-count" style="background:rgba(124,58,237,.1);color:#7c3aed;">{{ $activeDeliveries->count() }} truck{{ $activeDeliveries->count()!==1?'s':'' }}</span>
        </div>
        <div class="map-panel">
            <div class="map-panel-hd">
                <i class="mgc_map_line map-icon"></i>
                <span class="tpanel-title">Live Tracking</span>
                <span style="margin-left:auto;font-size:.72rem;color:var(--muted);">{{ $activeDeliveries->count() }} truck(s) active</span>
            </div>
            <div id="deliveryMap"></div>
        </div>
    @endif

    {{-- Recent Transmittals --}}
    <div class="sec-hd">
        <div class="sec-hd-bar"></div>
        <span>Recent Transmittals</span>
    </div>
    <div class="tpanel">
        <div class="tpanel-hd">
            <i class="mgc_file_list_line" style="color:var(--p);font-size:1rem;"></i>
            <span class="tpanel-title">Transmittal Log</span>
            <a href="{{ route('warehouse.transmittals.index') }}" class="tpanel-link">View all →</a>
        </div>
        <div style="overflow-x:auto;">
            <table class="wd-table" style="min-width:700px;">
                <thead>
                    <tr>
                        <th style="width:140px;">Number</th>
                        <th style="width:140px;">Requested By</th>
                        <th>From → To</th>
                        <th style="width:70px;text-align:center;">Items</th>
                        <th style="width:110px;">Status</th>
                        <th style="width:105px;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent as $t)
                        @php
                            $bCls = match($t->status) {
                                'pending'    => 'b-pending',
                                'approved'   => 'b-approved',
                                'in_transit' => 'b-transit',
                                'completed'  => 'b-completed',
                                'rejected'   => 'b-rejected',
                                default      => 'b-default',
                            };
                        @endphp
                        <tr>
                            <td><span class="td-mono">{{ $t->transmittal_number }}</span></td>
                            <td><span class="td-main">{{ $t->requestedBy?->name ?? '—' }}</span></td>
                            <td style="font-size:.78rem;">
                                <span style="font-weight:600;color:var(--txt);">{{ $t->originWarehouse?->name ?? '—' }}</span>
                                <span style="color:var(--muted);margin:0 .3rem;">→</span>
                                <span style="font-weight:600;color:var(--txt);">{{ $t->destinationWarehouse?->name ?? '—' }}</span>
                            </td>
                            <td style="text-align:center;font-weight:700;color:var(--txt);">{{ $t->items->count() }}</td>
                            <td><span class="badge {{ $bCls }}">{{ ucfirst(str_replace('_',' ',$t->status)) }}</span></td>
                            <td style="font-size:.73rem;color:var(--muted);white-space:nowrap;">{{ $t->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;padding:3rem;color:var(--muted);font-size:.82rem;">
                                <i class="mgc_file_list_line" style="font-size:1.8rem;display:block;margin-bottom:.5rem;"></i>
                                No transmittals yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- Leaflet map --}}
@if($activeDeliveries->count())
    <link rel="stylesheet" href="/assets/libs/leaflet/leaflet.css"/>
    <script src="/assets/libs/leaflet/leaflet.js"></script>
    @php
        $dashMapData = $activeDeliveries->map(function($d) {
            return [
                'id'     => $d->id,
                'plate'  => $d->truck_plate,
                'status' => $d->status,
                'from'   => $d->originWarehouse?->name,
                'to'     => $d->destinationWarehouse?->name,
                'lat'    => $d->last_latitude,
                'lng'    => $d->last_longitude,
            ];
        });
    @endphp
    <script>
    (function() {
        const deliveries = @json($dashMapData);
        const valid = deliveries.filter(d => d.lat && d.lng);
        if (!valid.length) return;
        const map = L.map('deliveryMap').setView([valid[0].lat, valid[0].lng], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
        valid.forEach(d => {
            L.marker([d.lat, d.lng]).addTo(map)
                .bindPopup(`<b>${d.plate ?? 'Truck'}</b><br>${d.from} → ${d.to}<br><span style="text-transform:capitalize">${(d.status||'').replace('_',' ')}</span>`);
        });
        if (valid.length > 1) map.fitBounds(L.latLngBounds(valid.map(d => [d.lat, d.lng])), {padding:[30,30]});
    })();
    </script>
@endif

</x-layout>
