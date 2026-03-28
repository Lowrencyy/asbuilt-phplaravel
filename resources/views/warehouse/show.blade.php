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

/* Breadcrumb */
.bc{display:flex;align-items:center;gap:.35rem;font-size:.74rem;color:var(--muted);margin-bottom:.7rem;}
.bc a{color:var(--p);text-decoration:none;font-weight:600;}
.bc a:hover{text-decoration:underline;}

/* Header */
.hd{display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.4rem;}
.hd-left{display:flex;align-items:center;gap:.9rem;}
.logo-box{width:54px;height:54px;flex-shrink:0;border-radius:14px;border:1px solid var(--bdr);background:var(--surf2);display:flex;align-items:center;justify-content:center;overflow:hidden;}
.logo-box img{width:100%;height:100%;object-fit:contain;padding:.4rem;}
.logo-box i{font-size:1.5rem;color:var(--p);}
.eyebrow{font-size:.67rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--p);display:flex;align-items:center;gap:.35rem;margin-bottom:.12rem;}
.eyebrow::before{content:'';width:14px;height:2px;background:var(--p);border-radius:2px;display:inline-block;}
.hd h2{margin:0;font-size:1.45rem;font-weight:800;color:var(--txt);letter-spacing:-.02em;line-height:1.15;}
.hd p{margin:.2rem 0 0;color:var(--txt2);font-size:.77rem;}
.hd-actions{display:flex;align-items:center;gap:.55rem;flex-shrink:0;}
.btn-p{display:inline-flex;align-items:center;gap:.45rem;padding:.52rem 1.05rem;background:var(--p);color:#fff;border:none;border-radius:12px;font-size:.81rem;font-weight:700;font-family:var(--ff);cursor:pointer;text-decoration:none;transition:background .15s;}
.btn-p:hover{background:var(--p2);}
.btn-ghost{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem .95rem;border:1px solid var(--bdr);border-radius:12px;background:var(--surf);color:var(--txt2);font-size:.81rem;font-weight:600;font-family:var(--ff);text-decoration:none;cursor:pointer;transition:all .15s;}
.btn-ghost:hover{background:var(--surf2);color:var(--txt);}

/* ── 4 Main item hero cards ── */
.hero-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.4rem;}
@media(max-width:800px){.hero-grid{grid-template-columns:repeat(2,1fr);}}
.hero-card{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;display:flex;flex-direction:column;}
.hero-strip{height:5px;}
.hero-body{padding:1rem 1.1rem .85rem;}
.hero-icon-row{display:flex;align-items:center;gap:.6rem;margin-bottom:.7rem;}
.hero-icon{width:38px;height:38px;border-radius:11px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.hero-icon i{font-size:1.15rem;}
.hero-type{font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);}
.hero-count{font-size:2.2rem;font-weight:800;font-family:var(--fm);line-height:1;color:var(--txt);}
.hero-unit{font-size:.72rem;color:var(--muted);font-family:var(--fm);margin-top:.2rem;}
.hero-row{display:flex;gap:1rem;border-top:1px solid var(--bdr);padding:.55rem 1.1rem;}
.hero-stat{display:flex;flex-direction:column;gap:.08rem;}
.hero-stat-val{font-size:.85rem;font-weight:800;font-family:var(--fm);}
.hero-stat-lbl{font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);}

/* Colors per type */
.tc-node{--tc:#2563eb;--tcb:rgba(37,99,235,.1);}
.tc-amp{--tc:#7c3aed;--tcb:rgba(124,58,237,.1);}
.tc-tsc{--tc:#ea580c;--tcb:rgba(234,88,12,.1);}
.tc-cable{--tc:#0d9488;--tcb:rgba(13,148,136,.1);}

/* Section title */
.sec-title{display:flex;align-items:center;gap:.55rem;margin-bottom:.85rem;}
.sec-title span{font-size:.88rem;font-weight:800;color:var(--txt);}
.count-pill{padding:.2rem .65rem;border-radius:999px;background:var(--pg);color:var(--p);font-size:.7rem;font-weight:700;font-family:var(--fm);}

/* Section tab nav */
.sec-tabs{display:flex;gap:.5rem;flex-wrap:wrap;justify-content:center;margin-bottom:1.4rem;background:var(--surf2);border:1px solid var(--bdr);border-radius:14px;padding:.35rem;}
.sec-tab{display:inline-flex;align-items:center;gap:.45rem;padding:.5rem 1.1rem;border-radius:10px;border:1px solid var(--bdr);background:var(--surf);cursor:pointer;font-family:var(--fs);font-size:.8rem;font-weight:700;color:var(--muted);transition:background .15s,color .15s,border-color .15s,box-shadow .15s;white-space:nowrap;}
.sec-tab:hover{background:var(--surf);color:var(--txt);border-color:var(--p);box-shadow:0 1px 6px rgba(0,0,0,.07);}
.sec-tab.active{background:var(--p);color:#fff;border-color:var(--p);box-shadow:0 2px 10px rgba(var(--pr,99,102,241),.25);}
.sec-tab .tab-pill{padding:.1rem .5rem;border-radius:999px;font-size:.65rem;font-weight:700;background:rgba(0,0,0,.08);color:inherit;font-family:var(--fm);}
.sec-tab.active .tab-pill{background:rgba(255,255,255,.25);color:#fff;}
.sec-panel{display:none;}.sec-panel.active{display:block;}

/* Table panel */
.tpanel{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;margin-bottom:1.4rem;}
.tpanel-hd{display:flex;align-items:center;justify-content:space-between;padding:.8rem 1.1rem;border-bottom:1px solid var(--bdr);}
.tpanel-title{font-size:.88rem;font-weight:800;color:var(--txt);display:flex;align-items:center;gap:.5rem;}
.tpanel-sub{font-size:.72rem;color:var(--muted);}
table{width:100%;border-collapse:collapse;}
thead th{padding:.55rem .8rem;text-align:left;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);background:var(--surf2);border-bottom:1px solid var(--bdr);}
thead th.r{text-align:right;}
tbody tr{border-bottom:1px solid var(--bdr);transition:background .12s;}
tbody tr:last-child{border-bottom:none;}
tbody tr:hover{background:var(--surf2);}
tbody tr.row-out{background:rgba(239,68,68,.035);}
tbody tr.row-low{background:rgba(245,158,11,.035);}
tbody td{padding:.55rem .8rem;font-size:.78rem;color:var(--txt2);overflow:hidden;}
.td-main{color:var(--txt);font-weight:700;font-size:.83rem;}
.num{font-family:var(--fm);font-weight:700;}
.sv-green{color:#16a34a;}
.sv-purple{color:#7c3aed;}
.sv-blue{color:#2563eb;}

/* Type chip */
.type-chip{display:inline-flex;align-items:center;gap:.3rem;padding:.2rem .6rem;border-radius:8px;font-size:.7rem;font-weight:700;}

/* Status badge */
.badge{display:inline-flex;align-items:center;gap:.25rem;padding:.2rem .6rem;border-radius:999px;font-size:.7rem;font-weight:700;}
.badge-stock{background:rgba(22,163,74,.1);color:#15803d;}
.badge-transit{background:rgba(124,58,237,.1);color:#7c3aed;}
.badge-deployed{background:rgba(37,99,235,.1);color:#1d4ed8;}

/* Stock alert badges */
.sb-out{display:inline-flex;align-items:center;gap:.2rem;padding:.15rem .5rem;border-radius:999px;font-size:.67rem;font-weight:700;background:rgba(239,68,68,.1);color:#dc2626;}
.sb-low{display:inline-flex;align-items:center;gap:.2rem;padding:.15rem .5rem;border-radius:999px;font-size:.67rem;font-weight:700;background:rgba(245,158,11,.1);color:#d97706;}

/* Movement type */
.mov-received{background:rgba(22,163,74,.1);color:#15803d;}
.mov-dispatched{background:rgba(124,58,237,.1);color:#7c3aed;}
.mov-deployed{background:rgba(37,99,235,.1);color:#1d4ed8;}
.mov-adjustment{background:rgba(245,158,11,.1);color:#b45309;}
.mov-damaged{background:rgba(239,68,68,.1);color:#dc2626;}

/* Action buttons */
.act-bar{display:flex;align-items:center;justify-content:center;gap:.35rem;}
.act-adj{display:inline-flex;align-items:center;gap:.22rem;font-size:.71rem;font-weight:700;padding:.26rem .6rem;border-radius:8px;background:rgba(245,158,11,.1);color:#b45309;border:none;cursor:pointer;font-family:var(--ff);transition:all .15s;}
.act-adj:hover{background:rgba(245,158,11,.2);}
.act-del{display:inline-flex;align-items:center;gap:.2rem;font-size:.71rem;font-weight:700;padding:.26rem .52rem;border-radius:8px;background:rgba(239,68,68,.07);color:#dc2626;border:none;cursor:pointer;font-family:var(--ff);transition:all .15s;}
.act-del:hover{background:rgba(239,68,68,.17);}

/* Flash */
.flash{display:flex;align-items:center;gap:.6rem;padding:.7rem 1rem;border-radius:12px;font-size:.82rem;font-weight:600;margin-bottom:1.1rem;}
.flash-ok{background:rgba(22,163,74,.08);border:1px solid rgba(22,163,74,.2);color:#15803d;}
.flash-err{background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);color:#dc2626;}

/* Modal */
.modal-overlay{display:none;position:fixed;inset:0;z-index:60;background:rgba(8,16,31,.55);backdrop-filter:blur(4px);align-items:center;justify-content:center;padding:1rem;}
.modal-overlay.open{display:flex;}
.modal{background:var(--surf);border:1px solid var(--bdr);border-radius:20px;box-shadow:var(--sh-md);width:100%;max-width:440px;}
.modal-hd{display:flex;align-items:center;justify-content:space-between;padding:.85rem 1.2rem;border-bottom:1px solid var(--bdr);}
.modal-title{display:flex;align-items:center;gap:.5rem;font-size:.9rem;font-weight:800;color:var(--txt);}
.modal-close{width:30px;height:30px;border:1px solid var(--bdr);border-radius:9px;background:var(--surf2);color:var(--txt2);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .15s;}
.modal-close:hover{background:var(--bdr);}
.modal-body{padding:1.2rem;}
.modal-foot{display:flex;justify-content:flex-end;gap:.55rem;padding:.8rem 1.2rem;border-top:1px solid var(--bdr);}
.fld{margin-bottom:.9rem;}
.fld:last-child{margin-bottom:0;}
.fld label{display:block;font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--txt2);margin-bottom:.4rem;}
.fld input,.fld select{width:100%;padding:.58rem .88rem;border:1px solid var(--bdr);border-radius:10px;background:var(--surf2);color:var(--txt);font-size:.83rem;font-family:var(--ff);outline:none;transition:border-color .15s,box-shadow .15s;}
.fld input:focus,.fld select:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(45,111,247,.1);}
.fld-grid{display:grid;grid-template-columns:1fr 1fr;gap:.7rem;}
.info-box{background:var(--surf2);border:1px solid var(--bdr);border-radius:10px;padding:.6rem .95rem;margin-bottom:.9rem;}
.info-box p{margin:0;font-size:.82rem;font-weight:700;color:var(--txt);}
.info-box span{font-size:.7rem;color:var(--muted);margin-top:.1rem;display:block;}
.empty-row td{text-align:center;padding:2.5rem;color:var(--muted);font-size:.82rem;}
</style>
@endpush

@php
$itemTypes = \App\Models\WarehouseStock::ITEM_TYPES;

// Per-type meta for icons/colors
$typeMeta = [
    'amplifier'            => ['icon'=>'mgc_radio_line',      'cls'=>'tc-amp',   'strip'=>'background:linear-gradient(90deg,#7c3aed,#a78bfa)'],
    'node'                 => ['icon'=>'mgc_router_line',     'cls'=>'tc-node',  'strip'=>'background:linear-gradient(90deg,#2563eb,#60a5fa)'],
    'extender'             => ['icon'=>'mgc_signal_line',     'cls'=>'',         'strip'=>'background:linear-gradient(90deg,#0891b2,#67e8f9)'],
    'tsc'                  => ['icon'=>'mgc_plug_line',       'cls'=>'tc-tsc',   'strip'=>'background:linear-gradient(90deg,#ea580c,#fb923c)'],
    'power_supply'         => ['icon'=>'mgc_lightning_line',  'cls'=>'',         'strip'=>'background:linear-gradient(90deg,#ca8a04,#fde68a)'],
    'power_supply_housing' => ['icon'=>'mgc_box_line',        'cls'=>'',         'strip'=>'background:linear-gradient(90deg,#64748b,#94a3b8)'],
    'cable'                => ['icon'=>'mgc_cable_line',      'cls'=>'tc-cable', 'strip'=>'background:linear-gradient(90deg,#0d9488,#5eead4)'],
];

// Quick summary for hero items
$allStocks = collect($groupedStocks)->flatten();
$heroItems = [
    'node'      => ['label'=>'Node',      'icon'=>'mgc_router_line',  'strip'=>'background:linear-gradient(90deg,#2563eb,#60a5fa)', 'iconcls'=>'background:rgba(37,99,235,.12);color:#2563eb', 'receipt_col'=>'collected_node'],
    'amplifier' => ['label'=>'Amplifier', 'icon'=>'mgc_radio_line',   'strip'=>'background:linear-gradient(90deg,#7c3aed,#a78bfa)', 'iconcls'=>'background:rgba(124,58,237,.12);color:#7c3aed', 'receipt_col'=>'collected_amplifier'],
    'tsc'       => ['label'=>'TSC',       'icon'=>'mgc_plug_line',    'strip'=>'background:linear-gradient(90deg,#ea580c,#fb923c)', 'iconcls'=>'background:rgba(234,88,12,.12);color:#ea580c',  'receipt_col'=>'collected_tsc'],
    'cable'     => ['label'=>'Cable',     'icon'=>'mgc_cable_line',   'strip'=>'background:linear-gradient(90deg,#0d9488,#5eead4)', 'iconcls'=>'background:rgba(13,148,136,.12);color:#0d9488', 'receipt_col'=>'collected_cable'],
];

// Pre-compute expected today per type from WarehouseReceipts (teardown)
$expectedByType = [];
foreach ($heroItems as $tk => $h) {
    $col = $h['receipt_col'];
    $expectedByType[$tk] = $expectedToday->sum($col);
}

// Pre-compute incoming per type from in-transit deliveries heading here
$incomingByType = [];
foreach ($heroItems as $tk => $h) {
    $qty = 0;
    foreach ($incomingDeliveries as $del) {
        foreach ($del->transmittal?->items ?? [] as $item) {
            if ($item->item_type === $tk) {
                $qty += $item->quantity_requested;
            }
        }
    }
    $incomingByType[$tk] = $qty;
}
@endphp

<div class="col-span-full">

    {{-- Flash --}}
    @if (session('success'))
        <div class="flash flash-ok"><i class="mgc_check_circle_line"></i> {{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="flash flash-err"><i class="mgc_close_circle_line"></i> {{ session('error') }}</div>
    @endif

    {{-- Breadcrumb --}}
    <div class="bc">
        <a href="{{ route('warehouse.inventory.index') }}">Inventory</a>
        <i class="mgc_arrow_right_line"></i>
        <span>{{ $warehouse->display_name }}</span>
    </div>

    {{-- Header --}}
    <div class="hd">
        <div class="hd-left">
            <div class="logo-box">
                @if ($warehouse->subcontractor?->logo_url)
                    <img src="{{ $warehouse->subcontractor->logo_url }}" alt="{{ $warehouse->subcontractor->name }}"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <i class="mgc_building_2_line" style="display:none;"></i>
                @else
                    <i class="mgc_building_2_line"></i>
                @endif
            </div>
            <div>
                <div class="eyebrow">Warehouse</div>
                <h2>{{ $warehouse->display_name }}</h2>
                <p>{{ $warehouse->subcontractor?->name ?? 'Internal' }}@if ($warehouse->location) &middot; {{ $warehouse->location }}@endif</p>
            </div>
        </div>
        <div class="hd-actions">
            <button onclick="openAddModal()" class="btn-p">
                <i class="mgc_add_line"></i> Add Item
            </button>
            <a href="{{ route('warehouse.inventory.index') }}" class="btn-ghost">
                <i class="mgc_arrow_left_line"></i> Back
            </a>
        </div>
    </div>

    {{-- ── 4 HERO CARDS: Node / Amplifier / TSC / Cable ── --}}
    <div class="hero-grid">
        @foreach ($heroItems as $typeKey => $hero)
            @php
                $items      = $groupedStocks[$typeKey] ?? collect();
                $inStock    = $items->sum('qty_in_stock');
                $released   = $items->sum('qty_deployed');
                $dec        = $typeKey === 'cable' ? 1 : 0;
                $unit       = $typeKey === 'cable' ? 'meters / kg' : 'pcs';
                $expToday   = $expectedByType[$typeKey] ?? 0;
                $incoming   = $incomingByType[$typeKey] ?? 0;
            @endphp
            <div class="hero-card">
                <div class="hero-strip" style="{{ $hero['strip'] }}"></div>
                <div class="hero-body">
                    <div class="hero-icon-row">
                        <div class="hero-icon" style="{{ $hero['iconcls'] }}">
                            <i class="{{ $hero['icon'] }}"></i>
                        </div>
                        <div class="hero-type">{{ $hero['label'] }}</div>
                    </div>
                    <div class="hero-count">{{ number_format($inStock, $dec) }}</div>
                    <div class="hero-unit">on hand · {{ $unit }}</div>
                </div>
                <div class="hero-row">
                    {{-- Expected today from teardown (WarehouseReceipts) --}}
                    <div class="hero-stat">
                        <div class="hero-stat-val" style="color:{{ $expToday > 0 ? '#16a34a' : 'var(--muted)' }};">
                            {{ $expToday > 0 ? '+'.number_format($expToday, $dec) : '—' }}
                        </div>
                        <div class="hero-stat-lbl">Expected</div>
                    </div>
                    {{-- Incoming from other warehouse (in-transit deliveries) --}}
                    <div class="hero-stat">
                        <div class="hero-stat-val sv-purple">{{ $incoming > 0 ? number_format($incoming, $dec) : '—' }}</div>
                        <div class="hero-stat-lbl">Incoming</div>
                    </div>
                    {{-- Released (palabas ng warehouse) --}}
                    <div class="hero-stat">
                        <div class="hero-stat-val sv-blue">{{ $released > 0 ? number_format($released, $dec) : '—' }}</div>
                        <div class="hero-stat-lbl">Released</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @php $flatStocks = $allStocks->sortBy('item_type')->values(); @endphp

    {{-- ── WAREHOUSE INCHARGE PANEL (collapsible) ── --}}
    @php
        $mainIncharges    = $incharges->filter(fn($u) => $u->subcon_role !== 'lineman')->values();
        $linemanIncharges = $incharges->filter(fn($u) => $u->subcon_role === 'lineman')->values();
    @endphp
    <div style="background:var(--surf);border:1px solid var(--bdr);border-radius:14px;margin-bottom:1.2rem;overflow:hidden;">
        {{-- Header row — always visible, click to toggle --}}
        <div onclick="document.getElementById('inchargeBody').classList.toggle('hidden')"
            style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.6rem;padding:.75rem 1.2rem;cursor:pointer;user-select:none;">
            <div style="display:flex;align-items:center;gap:.5rem;">
                <i class="mgc_shield_user_line" style="font-size:.95rem;color:var(--p);"></i>
                <span style="font-size:.8rem;font-weight:800;color:var(--txt);font-family:var(--fs);">Warehouse Incharge</span>
                <span style="font-size:.65rem;font-weight:700;padding:.12rem .5rem;border-radius:999px;background:var(--pg);color:var(--p);">{{ $mainIncharges->count() }}</span>
                @if ($linemanIncharges->count())
                    <span style="font-size:.65rem;font-weight:700;padding:.12rem .5rem;border-radius:999px;background:rgba(234,88,12,.1);color:#c2410c;">{{ $linemanIncharges->count() }} lineman</span>
                @endif
            </div>
            <div style="display:flex;gap:.4rem;align-items:center;" onclick="event.stopPropagation()">
                @if ($linemanIncharges->count())
                    <button onclick="document.getElementById('linemanListModal').showModal()"
                        style="display:inline-flex;align-items:center;gap:.3rem;background:rgba(234,88,12,.07);color:#c2410c;border:1px solid rgba(234,88,12,.2);border-radius:7px;padding:.3rem .7rem;font-size:.72rem;font-weight:700;cursor:pointer;">
                        <i class="mgc_group_line"></i> Linemen
                    </button>
                @endif
                @if (in_array(auth()->user()->role, ['admin','pm','project_manager']))
                    <button onclick="document.getElementById('assignInchargeModal').showModal()"
                        style="display:inline-flex;align-items:center;gap:.3rem;background:var(--p);color:#fff;border:none;border-radius:7px;padding:.3rem .7rem;font-size:.72rem;font-weight:700;cursor:pointer;">
                        <i class="mgc_user_add_line"></i> Assign
                    </button>
                @endif
                <i class="mgc_down_line" style="font-size:.8rem;color:var(--muted);"></i>
            </div>
        </div>

        {{-- Collapsible body — hidden by default --}}
        <div id="inchargeBody" class="hidden" style="padding:.1rem 1.2rem .9rem;border-top:1px solid var(--bdr);">
            <div style="margin-top:.7rem;display:flex;flex-wrap:wrap;gap:.5rem;">
                @forelse ($mainIncharges as $ic)
                    @php
                        $roleTag = match($ic->role) {
                            'admin'            => 'Admin',
                            'pm','project_manager' => 'PM',
                            'warehouse'        => 'Warehouse',
                            'hr'               => 'HR',
                            'executives'       => 'Executive',
                            default            => ucfirst($ic->role),
                        };
                        $subconName = $ic->subcontractor?->name;
                    @endphp
                    <div style="display:inline-flex;align-items:center;gap:.45rem;background:var(--surf2);border:1px solid var(--bdr);border-radius:8px;padding:.35rem .65rem;">
                        <i class="mgc_user_3_line" style="font-size:.8rem;color:var(--p);"></i>
                        <span style="font-size:.75rem;font-weight:700;color:var(--txt);">
                            @if ($subconName)<span style="color:var(--muted);font-weight:500;">{{ $subconName }}:</span> @endif{{ $ic->name }}
                        </span>
                        <span style="font-size:.62rem;font-weight:700;padding:.08rem .38rem;border-radius:999px;background:var(--pg);color:var(--p);">{{ $roleTag }}</span>
                        @if (in_array(auth()->user()->role, ['admin','pm','project_manager']))
                            <form method="POST" action="{{ route('warehouse.inventory.incharge.remove', [$warehouse, $ic]) }}">
                                @csrf @method('DELETE')
                                <button type="submit" title="Remove"
                                    style="background:none;border:none;cursor:pointer;color:var(--muted);font-size:.85rem;line-height:1;padding:0;"
                                    onclick="return confirm('Remove {{ $ic->name }}?')">
                                    <i class="mgc_close_line"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <span style="font-size:.75rem;color:var(--muted);font-style:italic;">No incharge assigned yet.</span>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Linemen Modal --}}
    @if ($linemanIncharges->count())
    <dialog id="linemanListModal"
        style="border:none;border-radius:16px;padding:0;background:var(--surf);box-shadow:0 8px 40px rgba(0,0,0,.18);max-width:460px;width:90%;outline:none;"
        onclick="if(event.target===this)this.close()">
        <div style="padding:1.4rem 1.5rem .8rem;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
                <div>
                    <div style="font-size:.95rem;font-weight:800;color:var(--txt);font-family:var(--fs);">Assigned Linemen</div>
                    <div style="font-size:.72rem;color:var(--muted);margin-top:.05rem;">{{ $warehouse->name }} — {{ $linemanIncharges->count() }} lineman{{ $linemanIncharges->count() !== 1 ? 's' : '' }}</div>
                </div>
                <button onclick="this.closest('dialog').close()"
                    style="background:var(--surf2);border:1px solid var(--bdr);border-radius:8px;width:30px;height:30px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:1.1rem;line-height:1;">×</button>
            </div>
            <div style="display:flex;flex-direction:column;gap:.45rem;max-height:340px;overflow-y:auto;">
                @foreach ($linemanIncharges as $lm)
                    @php $lmSubcon = $lm->subcontractor?->name; @endphp
                    <div style="display:flex;align-items:center;gap:.6rem;background:var(--surf2);border:1px solid var(--bdr);border-radius:10px;padding:.55rem .8rem;">
                        <div style="width:30px;height:30px;border-radius:50%;background:rgba(234,88,12,.08);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="mgc_user_3_line" style="font-size:.85rem;color:#c2410c;"></i>
                        </div>
                        <div style="flex:1;">
                            <div style="font-size:.78rem;font-weight:700;color:var(--txt);">
                                @if ($lmSubcon)<span style="color:var(--muted);font-weight:500;">{{ $lmSubcon }}:</span> @endif{{ $lm->name }}
                                <span style="font-size:.62rem;font-weight:700;padding:.08rem .38rem;border-radius:999px;background:rgba(234,88,12,.1);color:#c2410c;margin-left:.3rem;">Lineman</span>
                            </div>
                            <div style="font-size:.65rem;color:var(--muted);">{{ $lm->email }}</div>
                        </div>
                        @if (in_array(auth()->user()->role, ['admin','pm','project_manager']))
                            <form method="POST" action="{{ route('warehouse.inventory.incharge.remove', [$warehouse, $lm]) }}">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    style="background:none;border:1px solid var(--bdr);border-radius:6px;padding:.2rem .45rem;cursor:pointer;color:var(--muted);font-size:.72rem;font-weight:700;"
                                    onclick="return confirm('Remove {{ $lm->name }}?')">
                                    Remove
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        <div style="padding:.8rem 1.5rem 1.2rem;border-top:1px solid var(--bdr);display:flex;justify-content:flex-end;">
            <button onclick="this.closest('dialog').close()"
                style="background:var(--p);color:#fff;border:none;border-radius:8px;padding:.42rem 1.2rem;font-size:.8rem;font-weight:700;cursor:pointer;">Close</button>
        </div>
    </dialog>
    @endif

    {{-- Assign Incharge Modal --}}
    @if (in_array(auth()->user()->role, ['admin','pm','project_manager']))
    <dialog id="assignInchargeModal"
        style="border:none;border-radius:16px;padding:0;background:var(--surf);box-shadow:0 8px 40px rgba(0,0,0,.18);max-width:420px;width:90%;outline:none;"
        onclick="if(event.target===this)this.close()">
        <div style="padding:1.4rem 1.5rem .8rem;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
                <div>
                    <div style="font-size:.95rem;font-weight:800;color:var(--txt);font-family:var(--fs);">Assign Warehouse Incharge</div>
                    <div style="font-size:.72rem;color:var(--muted);margin-top:.05rem;">{{ $warehouse->name }}</div>
                </div>
                <button onclick="this.closest('dialog').close()"
                    style="background:var(--surf2);border:1px solid var(--bdr);border-radius:8px;width:30px;height:30px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:1.1rem;line-height:1;">×</button>
            </div>
            <form method="POST" action="{{ route('warehouse.inventory.incharge.assign', $warehouse) }}">
                @csrf
                <div style="margin-bottom:1rem;">
                    <label style="font-size:.75rem;font-weight:700;color:var(--txt2);display:block;margin-bottom:.4rem;">Select User</label>
                    <select name="user_id" required
                        style="width:100%;padding:.5rem .75rem;border:1px solid var(--bdr);border-radius:8px;background:var(--surf2);color:var(--txt);font-size:.82rem;font-family:var(--fs);">
                        <option value="">— Choose a user —</option>
                        @foreach ($assignableUsers as $au)
                            @php
                                $roleLabel = match($au->role) {
                                    'admin'            => 'Admin',
                                    'pm','project_manager' => 'PM',
                                    'warehouse'        => 'Warehouse',
                                    'subcon'           => $au->subcon_role === 'lineman' ? 'Lineman' : 'PM (Subcon)',
                                    'hr'               => 'HR',
                                    'accounting'       => 'Accounting',
                                    'executives'       => 'Executive',
                                    default            => ucfirst($au->role),
                                };
                                $alreadyAssigned = $incharges->contains('id', $au->id);
                            @endphp
                            <option value="{{ $au->id }}" {{ $alreadyAssigned ? 'disabled' : '' }}>
                                [{{ $roleLabel }}] {{ $au->name }}{{ $alreadyAssigned ? ' — already assigned' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <p style="font-size:.73rem;color:var(--muted);margin:0 0 1rem;">
                    Their role will be set to <strong>Warehouse</strong> and assigned to this warehouse. Multiple people can be assigned.
                </p>
                <div style="display:flex;gap:.6rem;justify-content:flex-end;">
                    <button type="button" onclick="this.closest('dialog').close()"
                        style="background:var(--surf2);border:1px solid var(--bdr);border-radius:8px;padding:.42rem 1rem;font-size:.8rem;font-weight:700;cursor:pointer;color:var(--txt);">Cancel</button>
                    <button type="submit"
                        style="background:var(--p);color:#fff;border:none;border-radius:8px;padding:.42rem 1.2rem;font-size:.8rem;font-weight:700;cursor:pointer;">
                        <i class="mgc_user_add_line"></i> Assign
                    </button>
                </div>
            </form>
        </div>
    </dialog>
    @endif

    {{-- ── SECTION TAB NAV ── --}}
    <div class="sec-tabs">
        <button class="sec-tab" data-tab="inventory" onclick="switchTab('inventory')">
            <i class="mgc_inventory_line"></i> All Stock Items
            <span class="tab-pill">{{ $flatStocks->count() }}</span>
        </button>
        <button class="sec-tab" data-tab="teardown" onclick="switchTab('teardown')">
            <i class="mgc_hammer_line"></i> Expected Today — Teardown
            <span class="tab-pill" style="background:rgba(22,163,74,.15);color:#15803d;">{{ $expectedToday->count() }}</span>
        </button>
        <button class="sec-tab" data-tab="incoming" onclick="switchTab('incoming')">
            <i class="mgc_transfer_3_line"></i> Incoming from Other Warehouses
            <span class="tab-pill" style="background:rgba(124,58,237,.12);color:#7c3aed;">{{ $incomingDeliveries->count() }}</span>
        </button>
        <button class="sec-tab" data-tab="history" onclick="switchTab('history')">
            <i class="mgc_receipt_line"></i> Movement History
            <span class="tab-pill">{{ $ledger->count() }}</span>
        </button>
    </div>

    {{-- ── EXPECTED TODAY FROM teardown ── --}}
    <div id="sec-teardown" class="sec-panel">
    <div class="sec-title">
        <i class="mgc_hammer_line" style="color:#16a34a;font-size:1.05rem;"></i>
        <span>Expected Today — Teardown</span>
        <span class="count-pill" style="background:rgba(22,163,74,.1);color:#15803d;">{{ $expectedToday->count() }}</span>
        <span style="font-size:.72rem;color:var(--muted);margin-left:.2rem;">items to be received from field teardown</span>
    </div>

    <div class="tpanel" style="margin-bottom:1.4rem;">
        <div style="overflow-x:auto;">
            <table style="table-layout:fixed;width:100%;">
                <colgroup>
                    <col style="width:130px;">{{-- Project --}}
                    <col style="width:110px;">{{-- Node --}}
                    <col style="width:120px;">{{-- Pole Span --}}
                    <col style="width:160px;">{{-- Items Collected --}}
                    <col style="width:110px;">{{-- Lineman --}}
                    <col style="width:110px;">{{-- PM Approved --}}
                    <col style="width:110px;">{{-- Status --}}
                    <col style="width:90px;"> {{-- Date --}}
                    <col style="width:120px;">{{-- Action --}}
                </colgroup>
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Node</th>
                        <th style="text-align:center;">Pole Spans</th>
                        <th>Items Collected</th>
                        <th>Lineman</th>
                        <th>PM Approved</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Group receipts by node_id → one row per node
                        $groupedReceipts = $expectedToday->groupBy('node_id');
                    @endphp
                    @forelse ($groupedReceipts as $nodeId => $nodeReceipts)
                        @php
                            $firstReceipt = $nodeReceipts->first();
                            $node         = $firstReceipt->node;
                            $project      = $firstReceipt->project;

                            // Collect ALL unique spans from all receipts in this node group
                            $allSpans = collect();
                            $linemenIds = collect();
                            $pmIds      = collect();
                            $statuses   = collect();
                            $totals     = ['node'=>0,'amplifier'=>0,'extender'=>0,'tsc'=>0,'cable'=>0];

                            foreach ($nodeReceipts as $receipt) {
                                if ($receipt->submission) {
                                    foreach ($receipt->submission->items as $si) {
                                        $log = $si->teardownLog;
                                        if ($log && $log->poleSpan) {
                                            $allSpans->push($log->poleSpan);
                                        }
                                    }
                                    if ($receipt->submission->submitted_by)  $linemenIds->push($receipt->submission->submitted_by);
                                    if ($receipt->submission->pm_reviewed_by) $pmIds->push($receipt->submission->pm_reviewed_by);
                                }
                                $statuses->push($receipt->status);
                                $totals['node']      += (int) $receipt->collected_node;
                                $totals['amplifier'] += (int) $receipt->collected_amplifier;
                                $totals['extender']  += (int) $receipt->collected_extender;
                                $totals['tsc']       += (int) $receipt->collected_tsc;
                                $totals['cable']     += (float) $receipt->collected_cable;
                            }

                            $allSpans   = $allSpans->unique('id')->values();
                            $linemenIds = $linemenIds->unique()->values();
                            $pmIds      = $pmIds->unique()->values();

                            $firstSpan = $allSpans->first();

                            $itemParts = array_filter([
                                $totals['node']      ? "Node ×{$totals['node']}"              : null,
                                $totals['amplifier'] ? "Amp ×{$totals['amplifier']}"          : null,
                                $totals['extender']  ? "Ext ×{$totals['extender']}"           : null,
                                $totals['tsc']       ? "TSC ×{$totals['tsc']}"                : null,
                                $totals['cable']     ? "Cable {$totals['cable']}m"            : null,
                            ]);

                            // Dominant status
                            $dominantStatus = $statuses->contains('pending_delivery') ? 'pending_delivery'
                                : ($statuses->contains('approved') ? 'approved'
                                : ($statuses->contains('delivered') ? 'delivered'
                                : ($statuses->contains('received') ? 'received' : $statuses->first())));

                            $statusLabel = match($dominantStatus) {
                                'pending_delivery' => ['label'=>'Pending Delivery', 'bg'=>'rgba(245,158,11,.1)',  'color'=>'#d97706'],
                                'approved'         => ['label'=>'Approved',         'bg'=>'rgba(37,99,235,.1)',   'color'=>'#1d4ed8'],
                                'delivered'        => ['label'=>'Delivered',         'bg'=>'rgba(22,163,74,.1)',   'color'=>'#15803d'],
                                'received'         => ['label'=>'Received',          'bg'=>'rgba(22,163,74,.1)',   'color'=>'#15803d'],
                                default            => ['label'=>ucfirst($dominantStatus ?? 'Unknown'), 'bg'=>'rgba(156,163,175,.1)', 'color'=>'#6b7280'],
                            };

                            $groupModalId = 'spans-modal-node-' . $nodeId;
                        @endphp
                        <tr>
                            {{-- Project --}}
                            <td>
                                <div class="td-main" style="font-size:.75rem;font-weight:700;color:var(--txt);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $project?->project_name ?? '—' }}</div>
                                @if ($nodeReceipts->count() > 1)
                                    <div style="font-size:.63rem;color:var(--muted);margin-top:.1rem;">{{ $nodeReceipts->count() }} batches</div>
                                @endif
                            </td>

                            {{-- Node --}}
                            <td>
                                @if ($node)
                                    <div style="display:inline-flex;align-items:center;gap:.3rem;background:rgba(37,99,235,.08);color:#1d4ed8;border:1px solid rgba(37,99,235,.18);border-radius:7px;padding:.18rem .6rem;font-size:.72rem;font-weight:700;font-family:var(--fm);">
                                        <i class="mgc_router_line" style="font-family:unset;font-size:.75rem;"></i>
                                        {{ $node->node_id }}
                                    </div>
                                    @if ($node->node_name)
                                        <div style="font-size:.67rem;color:var(--muted);margin-top:.15rem;">{{ $node->node_name }}</div>
                                    @endif
                                @else
                                    <span style="color:var(--muted);">—</span>
                                @endif
                            </td>

                            {{-- Pole Spans — single button, all spans inside modal --}}
                            <td style="text-align:center;">
                                @if ($allSpans->count())
                                    <button onclick="document.getElementById('{{ $groupModalId }}').showModal()"
                                        style="display:inline-flex;align-items:center;gap:.35rem;background:rgba(234,88,12,.07);border:1px solid rgba(234,88,12,.22);border-radius:8px;padding:.28rem .6rem;cursor:pointer;color:#c2410c;font-size:.72rem;font-weight:700;font-family:var(--fm);transition:background .15s;white-space:nowrap;">
                                        <i class="mgc_map_pin_line" style="font-size:.75rem;"></i>
                                        {{ $allSpans->count() }} Span{{ $allSpans->count() !== 1 ? 's' : '' }}
                                        <i class="mgc_external_link_line" style="font-size:.65rem;opacity:.5;"></i>
                                    </button>

                                    {{-- Pole Spans Modal (grouped per node) --}}
                                    <dialog id="{{ $groupModalId }}"
                                        style="border:none;border-radius:16px;padding:0;background:var(--surf);box-shadow:0 8px 40px rgba(0,0,0,.18);max-width:540px;width:90%;outline:none;"
                                        onclick="if(event.target===this)this.close()">
                                        <div style="padding:1.4rem 1.5rem .8rem;">
                                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
                                                <div>
                                                    <div style="font-size:.95rem;font-weight:800;color:var(--txt);font-family:var(--fs);">Pole Spans Collected</div>
                                                    <div style="font-size:.72rem;color:var(--muted);margin-top:.1rem;">
                                                        {{ $node?->node_id }} — {{ $allSpans->count() }} span{{ $allSpans->count() !== 1 ? 's' : '' }}
                                                        @if ($nodeReceipts->count() > 1)
                                                            &nbsp;·&nbsp; {{ $nodeReceipts->count() }} batches
                                                        @endif
                                                    </div>
                                                </div>
                                                <button onclick="this.closest('dialog').close()"
                                                    style="background:var(--surf2);border:1px solid var(--bdr);border-radius:8px;width:30px;height:30px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:1.1rem;line-height:1;">
                                                    ×
                                                </button>
                                            </div>
                                            <div style="display:flex;flex-direction:column;gap:.4rem;max-height:360px;overflow-y:auto;padding-right:.2rem;">
                                                @foreach ($allSpans as $idx => $span)
                                                    <div style="display:flex;align-items:center;gap:.5rem;background:var(--surf2);border:1px solid var(--bdr);border-radius:10px;padding:.5rem .8rem;">
                                                        <span style="font-size:.65rem;font-weight:700;color:var(--muted);min-width:1.4rem;text-align:right;">{{ $idx + 1 }}</span>
                                                        <span style="background:rgba(234,88,12,.08);color:#c2410c;border:1px solid rgba(234,88,12,.18);border-radius:6px;padding:.12rem .5rem;font-size:.75rem;font-weight:700;font-family:var(--fm);">
                                                            {{ $span->fromPole?->pole_code ?? '?' }}
                                                        </span>
                                                        <i class="mgc_arrow_right_line" style="font-size:.72rem;color:var(--muted);"></i>
                                                        <span style="background:rgba(234,88,12,.08);color:#c2410c;border:1px solid rgba(234,88,12,.18);border-radius:6px;padding:.12rem .5rem;font-size:.75rem;font-weight:700;font-family:var(--fm);">
                                                            {{ $span->toPole?->pole_code ?? '?' }}
                                                        </span>
                                                        @if ($span->pole_span_code)
                                                            <span style="font-size:.65rem;color:var(--muted);margin-left:.2rem;">{{ $span->pole_span_code }}</span>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div style="padding:.8rem 1.5rem 1.2rem;border-top:1px solid var(--bdr);display:flex;justify-content:flex-end;">
                                            <button onclick="this.closest('dialog').close()"
                                                style="background:var(--p);color:#fff;border:none;border-radius:8px;padding:.45rem 1.2rem;font-size:.8rem;font-weight:700;cursor:pointer;">
                                                Close
                                            </button>
                                        </div>
                                    </dialog>
                                @elseif ($firstReceipt->pole_source)
                                    <span style="font-size:.73rem;color:var(--txt2);font-family:var(--fm);">{{ $firstReceipt->pole_source }}</span>
                                @else
                                    <span style="color:var(--muted);">—</span>
                                @endif
                            </td>

                            {{-- Items Collected — compact button → modal --}}
                            <td style="text-align:center;">
                                @php
                                    $itemChips = [
                                        ['icon'=>'mgc_router_line',  'color'=>'#2563eb', 'bg'=>'rgba(37,99,235,.08)',   'border'=>'rgba(37,99,235,.2)',   'val'=>$totals['node'],      'label'=>'Node'],
                                        ['icon'=>'mgc_radio_line',   'color'=>'#7c3aed', 'bg'=>'rgba(124,58,237,.08)', 'border'=>'rgba(124,58,237,.2)',  'val'=>$totals['amplifier'], 'label'=>'Amplifier'],
                                        ['icon'=>'mgc_plug_line',    'color'=>'#ea580c', 'bg'=>'rgba(234,88,12,.08)',  'border'=>'rgba(234,88,12,.2)',   'val'=>$totals['tsc'],       'label'=>'TSC'],
                                        ['icon'=>'mgc_cable_line',   'color'=>'#0d9488', 'bg'=>'rgba(13,148,136,.08)', 'border'=>'rgba(13,148,136,.2)', 'val'=>$totals['cable'],     'label'=>'Cable'],
                                    ];
                                    $itemsCount = count(array_filter($itemChips, fn($c) => $c['val'] > 0));
                                    $itemsModalId = 'items-modal-node-' . $nodeId;
                                @endphp
                                @if ($itemsCount)
                                    <button onclick="document.getElementById('{{ $itemsModalId }}').showModal()"
                                        style="display:inline-flex;align-items:center;gap:.35rem;background:rgba(45,111,247,.07);border:1px solid rgba(45,111,247,.22);border-radius:8px;padding:.28rem .6rem;cursor:pointer;color:var(--p);font-size:.72rem;font-weight:700;font-family:var(--fm);transition:background .15s;white-space:nowrap;">
                                        <i class="mgc_box_line" style="font-size:.75rem;"></i>
                                        {{ $itemsCount }} Item{{ $itemsCount !== 1 ? 's' : '' }}
                                        <i class="mgc_external_link_line" style="font-size:.65rem;opacity:.5;"></i>
                                    </button>

                                    <dialog id="{{ $itemsModalId }}"
                                        style="border:none;border-radius:16px;padding:0;background:var(--surf);box-shadow:0 8px 40px rgba(0,0,0,.18);max-width:400px;width:90%;outline:none;"
                                        onclick="if(event.target===this)this.close()">
                                        <div style="padding:1.4rem 1.5rem .8rem;">
                                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
                                                <div>
                                                    <div style="font-size:.95rem;font-weight:800;color:var(--txt);">Items Collected</div>
                                                    <div style="font-size:.72rem;color:var(--muted);margin-top:.1rem;">
                                                        {{ $node?->node_id }}@if($node?->node_name) — {{ $node->node_name }}@endif
                                                    </div>
                                                </div>
                                                <button onclick="this.closest('dialog').close()"
                                                    style="background:var(--surf2);border:1px solid var(--bdr);border-radius:8px;width:30px;height:30px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:1.1rem;line-height:1;">×</button>
                                            </div>
                                            <div style="display:flex;flex-direction:column;gap:.5rem;">
                                                @foreach ($itemChips as $chip)
                                                    @if ($chip['val'] > 0)
                                                        <div style="display:flex;align-items:center;gap:.75rem;background:{{ $chip['bg'] }};border:1px solid {{ $chip['border'] }};border-radius:10px;padding:.65rem .9rem;">
                                                            <div style="width:34px;height:34px;border-radius:9px;background:{{ $chip['bg'] }};border:1px solid {{ $chip['border'] }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                                                <i class="{{ $chip['icon'] }}" style="font-size:1rem;color:{{ $chip['color'] }};"></i>
                                                            </div>
                                                            <div style="flex:1;">
                                                                <div style="font-size:.72rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;">{{ $chip['label'] }}</div>
                                                                <div style="font-size:1.15rem;font-weight:800;color:{{ $chip['color'] }};font-family:var(--fm);line-height:1.2;">
                                                                    @if ($chip['label'] === 'Cable')
                                                                        {{ number_format($chip['val'], 1) }}<span style="font-size:.72rem;margin-left:.2rem;">meters</span>
                                                                    @else
                                                                        {{ $chip['val'] }}<span style="font-size:.72rem;margin-left:.2rem;">pcs</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            @if ($nodeReceipts->count() > 1)
                                                <div style="margin-top:.8rem;font-size:.67rem;color:var(--muted);text-align:center;">Totals across {{ $nodeReceipts->count() }} batches</div>
                                            @endif
                                        </div>
                                        <div style="padding:.8rem 1.5rem 1.2rem;border-top:1px solid var(--bdr);display:flex;justify-content:flex-end;">
                                            <button onclick="this.closest('dialog').close()"
                                                style="background:var(--p);color:#fff;border:none;border-radius:8px;padding:.42rem 1.2rem;font-size:.8rem;font-weight:700;cursor:pointer;">Close</button>
                                        </div>
                                    </dialog>
                                @else
                                    <span style="color:var(--muted);">—</span>
                                @endif
                            </td>

                            {{-- Linemen --}}
                            <td>
                                <div style="display:flex;flex-direction:column;gap:.2rem;">
                                    @foreach ($linemenIds as $lid)
                                        <div style="display:flex;align-items:center;gap:.25rem;overflow:hidden;">
                                            <i class="mgc_user_3_line" style="font-size:.72rem;color:var(--muted);flex-shrink:0;"></i>
                                            <span style="font-size:.72rem;font-weight:700;color:var(--txt);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $userMap[$lid] ?? '—' }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            {{-- PM Approved --}}
                            <td>
                                @if ($pmIds->count())
                                    @foreach ($pmIds as $pid)
                                        <div style="display:flex;align-items:center;gap:.25rem;margin-bottom:.15rem;overflow:hidden;">
                                            <i class="mgc_check_circle_line" style="font-size:.72rem;color:#16a34a;flex-shrink:0;"></i>
                                            <span style="font-size:.72rem;font-weight:700;color:#15803d;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $userMap[$pid] ?? '—' }}</span>
                                        </div>
                                    @endforeach
                                @else
                                    <span style="display:inline-flex;align-items:center;gap:.2rem;font-size:.67rem;font-weight:700;color:#d97706;background:rgba(245,158,11,.08);padding:.15rem .45rem;border-radius:6px;white-space:nowrap;">
                                        <i class="mgc_time_line" style="font-size:.65rem;"></i> Awaiting PM
                                    </span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td>
                                <span style="display:inline-flex;align-items:center;padding:.2rem .6rem;border-radius:999px;font-size:.7rem;font-weight:700;background:{{ $statusLabel['bg'] }};color:{{ $statusLabel['color'] }};">
                                    {{ $statusLabel['label'] }}
                                </span>
                            </td>

                            {{-- Date --}}
                            <td style="font-size:.72rem;color:var(--muted);white-space:nowrap;">
                                {{ $firstReceipt->delivery_date?->format('M d, Y') }}
                                @if ($firstReceipt->teardown_date)
                                    <div style="font-size:.65rem;margin-top:.1rem;">teardown: {{ $firstReceipt->teardown_date->format('M d') }}</div>
                                @endif
                            </td>

                            {{-- Action: Receive button (one per node group — uses first non-received receipt) --}}
                            <td style="text-align:center;">
                                @php
                                    $allReceived = $nodeReceipts->every(fn($r) => $r->status === 'received');
                                    $receiveTargets = $nodeReceipts->where('status', '!=', 'received');
                                @endphp
                                @if ($allReceived)
                                    <span style="display:inline-flex;align-items:center;gap:.3rem;font-size:.72rem;font-weight:700;color:#15803d;background:rgba(22,163,74,.08);border:1px solid rgba(22,163,74,.2);border-radius:8px;padding:.3rem .7rem;">
                                        <i class="mgc_check_circle_line"></i> Received
                                    </span>
                                @else
                                    {{-- Confirm modal trigger --}}
                                    <button onclick="document.getElementById('receive-modal-node-{{ $nodeId }}').showModal()"
                                        style="display:inline-flex;align-items:center;gap:.35rem;background:#16a34a;color:#fff;border:none;border-radius:8px;padding:.38rem .85rem;font-size:.76rem;font-weight:700;cursor:pointer;font-family:var(--fs);">
                                        <i class="mgc_inbox_line"></i> Mark Received
                                    </button>

                                    {{-- Confirm modal --}}
                                    <dialog id="receive-modal-node-{{ $nodeId }}"
                                        style="border:none;border-radius:16px;padding:0;background:var(--surf);box-shadow:0 8px 40px rgba(0,0,0,.18);max-width:420px;width:90%;outline:none;"
                                        onclick="if(event.target===this)this.close()">
                                        <div style="padding:1.4rem 1.5rem 1rem;">
                                            <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:.8rem;">
                                                <div style="width:36px;height:36px;border-radius:10px;background:rgba(22,163,74,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                                    <i class="mgc_inbox_line" style="color:#16a34a;font-size:1.1rem;"></i>
                                                </div>
                                                <div>
                                                    <div style="font-size:.92rem;font-weight:800;color:var(--txt);font-family:var(--fs);">Confirm Receipt</div>
                                                    <div style="font-size:.71rem;color:var(--muted);margin-top:.05rem;">{{ $node?->node_id }} — {{ $receiveTargets->count() }} batch{{ $receiveTargets->count() !== 1 ? 'es' : '' }}</div>
                                                </div>
                                            </div>
                                            <p style="font-size:.8rem;color:var(--txt2);margin:0 0 .9rem;line-height:1.5;">
                                                Marking as received will add the following items to warehouse stock:
                                            </p>
                                            <div style="display:flex;flex-wrap:wrap;gap:.3rem;margin-bottom:1rem;">
                                                @foreach ($itemParts as $part)
                                                    <span style="background:rgba(22,163,74,.08);border:1px solid rgba(22,163,74,.2);color:#15803d;border-radius:6px;padding:.15rem .55rem;font-size:.73rem;font-weight:700;">{{ $part }}</span>
                                                @endforeach
                                            </div>
                                            <p style="font-size:.75rem;color:var(--muted);margin:0;">This action cannot be undone.</p>
                                        </div>
                                        <div style="padding:.8rem 1.5rem 1.2rem;border-top:1px solid var(--bdr);display:flex;gap:.6rem;justify-content:flex-end;">
                                            <button onclick="this.closest('dialog').close()"
                                                style="background:var(--surf2);border:1px solid var(--bdr);border-radius:8px;padding:.42rem 1rem;font-size:.8rem;font-weight:700;cursor:pointer;color:var(--txt);">
                                                Cancel
                                            </button>
                                            {{-- Submit one form per pending receipt in the group --}}
                                            @foreach ($receiveTargets as $rt)
                                                <form method="POST" action="{{ route('warehouse.receipts.receive', $rt) }}" style="display:inline;">
                                                    @csrf
                                                </form>
                                            @endforeach
                                            <button onclick="submitReceive_{{ $nodeId }}()"
                                                style="background:#16a34a;color:#fff;border:none;border-radius:8px;padding:.42rem 1.1rem;font-size:.8rem;font-weight:700;cursor:pointer;">
                                                <i class="mgc_check_line"></i> Confirm Received
                                            </button>
                                        </div>
                                    </dialog>
                                    <script>
                                    function submitReceive_{{ $nodeId }}() {
                                        // Submit all pending receipt forms for this node group sequentially
                                        const forms = document.querySelectorAll('#receive-modal-node-{{ $nodeId }} form');
                                        if (forms.length > 0) forms[0].submit();
                                    }
                                    </script>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="9">
                                <i class="mgc_hammer_line" style="font-size:1.8rem;display:block;margin-bottom:.5rem;color:var(--muted);"></i>
                                No teardown deliveries expected today.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>{{-- end sec-teardown --}}

    {{-- ── INCOMING FROM OTHER WAREHOUSES ── --}}
    <div id="sec-incoming" class="sec-panel">
    <div class="sec-title">
        <i class="mgc_transfer_3_line" style="color:#7c3aed;font-size:1.05rem;"></i>
        <span>Incoming from Other Warehouses</span>
        <span class="count-pill" style="background:rgba(124,58,237,.1);color:#7c3aed;">{{ $incomingDeliveries->count() }}</span>
    </div>

    <div class="tpanel" style="margin-bottom:1.4rem;">
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Transmittal #</th>
                        <th>From Warehouse</th>
                        <th>Items</th>
                        <th>Driver / Truck</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($incomingDeliveries as $del)
                        @php
                            $items = $del->transmittal?->items ?? collect();
                        @endphp
                        <tr>
                            <td>
                                <div class="td-main" style="font-family:var(--fm);font-size:.78rem;color:#7c3aed;">
                                    {{ $del->transmittal?->transmittal_number ?? "Delivery #{$del->id}" }}
                                </div>
                            </td>
                            <td>
                                <div style="display:flex;align-items:center;gap:.4rem;">
                                    <i class="mgc_building_2_line" style="color:var(--muted);font-size:.85rem;"></i>
                                    <span class="td-main" style="font-size:.78rem;">{{ $del->originWarehouse?->name ?? '—' }}</span>
                                </div>
                            </td>
                            <td>
                                <div style="display:flex;flex-wrap:wrap;gap:.25rem;">
                                    @foreach ($items->groupBy('item_type') as $type => $typeItems)
                                        @php
                                            $lbl = $itemTypes[$type]['label'] ?? $type;
                                            $qty = $typeItems->sum('quantity_requested');
                                        @endphp
                                        <span style="background:var(--surf2);border:1px solid var(--bdr);border-radius:6px;padding:.12rem .5rem;font-size:.7rem;font-weight:700;color:var(--txt);">
                                            {{ $lbl }} ×{{ number_format($qty, 0) }}
                                        </span>
                                    @endforeach
                                    @if ($items->isEmpty())
                                        <span style="color:var(--muted);font-size:.73rem;">—</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="td-main" style="font-size:.78rem;">{{ $del->driver_name ?: '—' }}</div>
                                @if ($del->truck_plate)
                                    <div style="font-size:.68rem;font-family:var(--fm);color:var(--muted);margin-top:.1rem;">{{ $del->truck_plate }}</div>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-transit">
                                    <i class="mgc_transfer_3_line" style="font-size:.7rem;"></i> In Transit
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="5">
                                <i class="mgc_transfer_3_line" style="font-size:1.8rem;display:block;margin-bottom:.5rem;color:var(--muted);"></i>
                                No incoming shipments from other warehouses.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>{{-- end sec-incoming --}}

    {{-- ── ALL STOCK TABLE ── --}}
    <div id="sec-inventory" class="sec-panel">
    <div class="sec-title">
        <i class="mgc_inventory_line" style="color:var(--p);font-size:1.05rem;"></i>
        <span>All Stock Items</span>
        <span class="count-pill">{{ $flatStocks->count() }}</span>
    </div>

    <div class="tpanel">
        <div class="tpanel-hd">
            <div class="tpanel-title">
                <i class="mgc_box_3_line" style="color:var(--p);"></i>
                Current Inventory
            </div>
            <button onclick="openAddModal()" class="btn-p" style="padding:.38rem .85rem;font-size:.76rem;">
                <i class="mgc_add_line"></i> Add Item
            </button>
        </div>
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Unit</th>
                        <th class="r" style="color:#16a34a;">On Hand</th>
                        <th class="r" style="color:#7c3aed;">Incoming</th>
                        <th class="r" style="color:#2563eb;">Released</th>
                        <th>Status</th>
                        <th style="text-align:center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($flatStocks as $stock)
                        @php
                            $tm = $typeMeta[$stock->item_type] ?? ['icon'=>'mgc_box_line','strip'=>'','cls'=>''];
                            $tl = $itemTypes[$stock->item_type]['label'] ?? $stock->item_type;
                            $rowClass = $stock->qty_in_stock <= 0 ? 'row-out' : ($stock->qty_in_stock < 5 ? 'row-low' : '');
                        @endphp
                        <tr class="{{ $rowClass }}">
                            <td>
                                <div style="display:inline-flex;align-items:center;gap:.35rem;padding:.22rem .6rem;border-radius:8px;font-size:.7rem;font-weight:700;{{ $tm['strip'] ? str_replace('background:linear-gradient(90deg,','',$tm['strip']) : '' }}"
                                     style="background:var(--surf2);color:var(--txt2);">
                                    <i class="{{ $tm['icon'] }}"></i>
                                    {{ $tl }}
                                </div>
                            </td>
                            <td>
                                <div class="td-main">{{ $stock->description }}</div>
                            </td>
                            <td style="font-family:var(--fm);font-size:.73rem;color:var(--muted);text-transform:uppercase;">{{ $stock->unit }}</td>
                            <td style="text-align:right;">
                                <span class="num {{ $stock->qty_in_stock <= 0 ? 'sv-red' : 'sv-green' }}" style="{{ $stock->qty_in_stock <= 0 ? 'color:#dc2626;' : '' }}">
                                    {{ number_format($stock->qty_in_stock, $stock->unit !== 'pcs' ? 2 : 0) }}
                                </span>
                            </td>
                            <td style="text-align:right;"><span class="num sv-purple">{{ number_format($stock->qty_in_transit, 2) }}</span></td>
                            <td style="text-align:right;"><span class="num sv-blue">{{ number_format($stock->qty_deployed, 2) }}</span></td>
                            <td>
                                @if ($stock->qty_in_stock <= 0)
                                    <span class="sb-out"><i class="mgc_warning_line" style="font-size:.65rem;"></i> Out</span>
                                @elseif ($stock->qty_in_stock < 5)
                                    <span class="sb-low"><i class="mgc_warning_line" style="font-size:.65rem;"></i> Low</span>
                                @elseif ($stock->qty_in_transit > 0)
                                    <span class="badge badge-transit">Incoming</span>
                                @else
                                    <span class="badge badge-stock">OK</span>
                                @endif
                            </td>
                            <td>
                                <div class="act-bar">
                                    <button onclick="openAdjust({{ $stock->id }}, '{{ addslashes($stock->description) }}', '{{ $stock->unit }}')"
                                        class="act-adj"><i class="mgc_tune_line"></i> Adjust</button>
                                    <form method="POST" action="{{ route('warehouse.inventory.items.destroy', [$warehouse, $stock]) }}"
                                        onsubmit="return confirm('Remove {{ addslashes($stock->description) }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="act-del"><i class="mgc_delete_2_line"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="8">
                                <i class="mgc_box_3_line" style="font-size:2rem;display:block;margin-bottom:.5rem;color:var(--muted);"></i>
                                No stock items yet. Add the first item above.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>{{-- end sec-inventory --}}

    {{-- ── MOVEMENT HISTORY (Ledger) ── --}}
    <div id="sec-history" class="sec-panel">
    <div class="sec-title">
        <i class="mgc_receipt_line" style="color:var(--p);font-size:1.05rem;"></i>
        <span>Movement History</span>
        <span class="count-pill">{{ $ledger->count() }}</span>
    </div>

    <div class="tpanel">
        <div class="tpanel-hd">
            <div class="tpanel-title">
                <i class="mgc_transfer_3_line" style="color:var(--p);"></i>
                All Stock In / Out
            </div>
            <span class="tpanel-sub">Last 60 movements</span>
        </div>
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Movement</th>
                        <th class="r">Qty</th>
                        <th>Source / Node / Pole</th>
                        <th>By</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ledger as $entry)
                        @php
                            $tl = $itemTypes[$entry->item_type]['label'] ?? $entry->item_type;
                            $tm2 = $typeMeta[$entry->item_type] ?? ['icon'=>'mgc_box_line'];
                            $movClass = 'badge mov-' . $entry->movement_type;
                            $qtyPositive = $entry->quantity >= 0;
                        @endphp
                        <tr>
                            <td style="white-space:nowrap;font-size:.72rem;color:var(--muted);">
                                {{ $entry->created_at?->format('M d, Y') }}<br>
                                <span style="font-family:var(--fm);font-size:.68rem;">{{ $entry->created_at?->format('g:i A') }}</span>
                            </td>
                            <td>
                                <div style="display:inline-flex;align-items:center;gap:.3rem;font-size:.7rem;font-weight:700;color:var(--txt2);">
                                    <i class="{{ $tm2['icon'] }}"></i> {{ $tl }}
                                </div>
                            </td>
                            <td>
                                <div class="td-main" style="font-size:.8rem;">{{ $entry->description }}</div>
                                @if ($entry->notes)
                                    <div style="font-size:.68rem;color:var(--muted);margin-top:.1rem;">{{ $entry->notes }}</div>
                                @endif
                            </td>
                            <td><span class="{{ $movClass }}">{{ ucfirst(str_replace('_', ' ', $entry->movement_type)) }}</span></td>
                            <td style="text-align:right;font-family:var(--fm);font-weight:800;font-size:.83rem;{{ $qtyPositive ? 'color:#16a34a' : 'color:#dc2626' }}">
                                {{ $qtyPositive ? '+' : '' }}{{ number_format($entry->quantity, 2) }}
                                <div style="font-size:.63rem;font-weight:600;color:var(--muted);font-family:var(--ff);">{{ $entry->unit }}</div>
                            </td>
                            <td style="font-size:.72rem;">
                                @if ($entry->reference_type && $entry->reference_id)
                                    @php
                                        $refKey   = class_basename($entry->reference_type) . ':' . $entry->reference_id;
                                        $refLabel = $refMap[$refKey] ?? (class_basename($entry->reference_type) . ' #' . $entry->reference_id);
                                        $isNode   = str_contains($refLabel, 'Node');
                                        $isPole   = str_contains($refLabel, 'Pole');
                                        $refColor = $isNode ? 'background:rgba(37,99,235,.08);color:#1d4ed8;border-color:rgba(37,99,235,.2);'
                                                  : ($isPole ? 'background:rgba(13,148,136,.08);color:#0f766e;border-color:rgba(13,148,136,.2);'
                                                  : 'background:var(--surf2);color:var(--txt2);border-color:var(--bdr);');
                                    @endphp
                                    <span style="display:inline-flex;align-items:center;gap:.3rem;font-family:var(--fm);font-size:.68rem;font-weight:700;padding:.18rem .55rem;border-radius:6px;border:1px solid;{{ $refColor }}">
                                        @if ($isNode)<i class="mgc_router_line" style="font-size:.75rem;font-family:unset;"></i>
                                        @elseif ($isPole)<i class="mgc_signal_line" style="font-size:.75rem;font-family:unset;"></i>
                                        @endif
                                        {{ $refLabel }}
                                    </span>
                                @else
                                    <span style="color:var(--muted);">—</span>
                                @endif
                            </td>
                            <td style="font-size:.72rem;color:var(--muted);">{{ $entry->createdBy?->name ?? 'System' }}</td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="7">
                                <i class="mgc_receipt_line" style="font-size:1.8rem;display:block;margin-bottom:.5rem;color:var(--muted);"></i>
                                No movements recorded yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>{{-- end sec-history --}}

</div>

{{-- ── ADD ITEM MODAL ── --}}
<div id="addModal" class="modal-overlay">
    <div class="modal">
        <div class="modal-hd">
            <div class="modal-title">
                <i class="mgc_add_circle_line" style="color:var(--p);"></i>
                Add Item to Warehouse
            </div>
            <button class="modal-close" onclick="closeModal('addModal')"><i class="mgc_close_line"></i></button>
        </div>
        <form method="POST" action="{{ route('warehouse.inventory.items.store', $warehouse) }}">
            @csrf
            <div class="modal-body">
                <div class="fld">
                    <label>Item Type <span style="color:#ef4444;">*</span></label>
                    <select name="item_type" id="addItemType" required onchange="onTypeChange(this.value)">
                        <option value="">— Select type —</option>
                        @foreach ($itemTypes as $key => $meta)
                            <option value="{{ $key }}">{{ $meta['label'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="fld">
                    <label>Description / Spec <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="description" required placeholder="e.g. CATV Amplifier 860MHz, 75-ohm drop cable…">
                </div>
                <div class="fld-grid">
                    <div class="fld" style="margin-bottom:0;">
                        <label>Unit <span style="color:#ef4444;">*</span></label>
                        <div id="addUnitField">
                            <select name="unit" required>
                                <option value="pcs">pcs</option>
                                <option value="sets">sets</option>
                                <option value="rolls">rolls</option>
                                <option value="meters">meters</option>
                                <option value="kg">kg</option>
                            </select>
                        </div>
                    </div>
                    <div class="fld" style="margin-bottom:0;">
                        <label>Initial Qty</label>
                        <input type="number" name="qty" value="0" min="0" step="0.01" style="font-family:var(--fm);">
                    </div>
                </div>
                <div class="fld" style="margin-top:.9rem;">
                    <label>Notes</label>
                    <input type="text" name="notes" placeholder="Source, batch, reference node, etc.">
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn-ghost" onclick="closeModal('addModal')">Cancel</button>
                <button type="submit" class="btn-p">Add Item</button>
            </div>
        </form>
    </div>
</div>

{{-- ── ADJUST STOCK MODAL ── --}}
<div id="adjustModal" class="modal-overlay">
    <div class="modal" style="max-width:380px;">
        <div class="modal-hd">
            <div class="modal-title">
                <i class="mgc_tune_line" style="color:#d97706;"></i>
                Adjust Stock
            </div>
            <button class="modal-close" onclick="closeModal('adjustModal')"><i class="mgc_close_line"></i></button>
        </div>
        <form method="POST" id="adjustForm">
            @csrf
            <div class="modal-body">
                <div class="info-box">
                    <p id="adjustItemLabel">—</p>
                    <span id="adjustItemUnit"></span>
                </div>
                <div class="fld">
                    <label>Change Qty <span style="font-weight:400;text-transform:none;letter-spacing:0;color:var(--muted);">(use − to remove)</span></label>
                    <input type="number" name="qty_change" required step="0.01" placeholder="e.g. +10 or -3"
                           style="font-family:var(--fm);font-size:1.2rem;font-weight:700;text-align:center;">
                </div>
                <div class="fld" style="margin-bottom:0;">
                    <label>Reason / Notes</label>
                    <input type="text" name="notes" placeholder="Return, correction, transfer, etc.">
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn-ghost" onclick="closeModal('adjustModal')">Cancel</button>
                <button type="submit" class="btn-p" style="background:#d97706;">Save Adjustment</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }

function switchTab(name) {
    document.querySelectorAll('.sec-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.sec-tab').forEach(t => t.classList.remove('active'));
    document.getElementById('sec-' + name).classList.add('active');
    document.querySelector('[data-tab="' + name + '"]').classList.add('active');
}
// Default: show inventory
switchTab('inventory');

document.querySelectorAll('.modal-overlay').forEach(function(el) {
    el.addEventListener('click', function(e) { if (e.target === el) closeModal(el.id); });
});

function openAddModal(typeKey) {
    if (typeKey) { document.getElementById('addItemType').value = typeKey; onTypeChange(typeKey); }
    openModal('addModal');
}

function onTypeChange(type) {
    const field = document.getElementById('addUnitField');
    const base = 'width:100%;padding:.58rem .88rem;border:1px solid var(--bdr);border-radius:10px;background:var(--surf2);color:var(--txt);font-size:.83rem;font-family:var(--ff);outline:none;';
    if (type === 'cable') {
        field.innerHTML = `<select name="unit" required style="${base}"><option value="meters">meters</option><option value="kg">kg</option></select>`;
    } else {
        field.innerHTML = `<select name="unit" required style="${base}"><option value="pcs">pcs</option><option value="sets">sets</option><option value="rolls">rolls</option><option value="meters">meters</option><option value="kg">kg</option></select>`;
    }
}

function openAdjust(stockId, description, unit) {
    document.getElementById('adjustForm').action =
        `/warehouse/inventory/{{ $warehouse->id }}/items/${stockId}/adjust`;
    document.getElementById('adjustItemLabel').textContent = description;
    document.getElementById('adjustItemUnit').textContent  = 'Unit: ' + unit;
    openModal('adjustModal');
}
</script>

</x-layout>
