<x-layout>

@push('styles')
<style>
*,*::before,*::after{box-sizing:border-box;}
:root{
  --p:#2563eb;--p2:#1d4ed8;--pg:rgba(37,99,235,.08);
  --surf:#fff;--surf2:#f8fafc;
  --bdr:#e2e8f0;
  --txt:#0f172a;--txt2:#475569;--muted:#94a3b8;
  --r:14px;
  --sh:0 1px 3px rgba(15,23,42,.06),0 4px 16px rgba(15,23,42,.06);
  --sh-md:0 8px 28px rgba(15,23,42,.13);
  --ff:system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;--fm:"SF Mono","Fira Code",Consolas,monospace;
}
body{font-family:var(--ff);}

/* ── Page wrapper ─────────────────────────────────────── */
.inv-wrap{max-width:1600px;margin:0 auto;padding:1rem 1.5rem 2.5rem;}

/* ── Flash messages ───────────────────────────────────── */
.flash{display:inline-flex;align-items:center;gap:.6rem;padding:.55rem 1.1rem;border-radius:999px;font-size:.82rem;font-weight:600;margin-bottom:1.25rem;border:1px solid transparent;}
.flash-ok{background:rgba(22,163,74,.08);border-color:rgba(22,163,74,.22);color:#15803d;}
.flash-err{background:rgba(239,68,68,.08);border-color:rgba(239,68,68,.22);color:#dc2626;}
.flash i{font-size:.9rem;}

/* ── Page header ──────────────────────────────────────── */
.hd{display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.75rem;}
.hd-left{display:flex;flex-direction:column;gap:.2rem;}
.eyebrow{font-size:.68rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--p);display:flex;align-items:center;gap:.45rem;margin-bottom:.15rem;}
.eyebrow::before{content:'';display:inline-block;width:16px;height:2px;background:var(--p);border-radius:2px;}
.hd h2{margin:0;font-size:1.65rem;font-weight:800;color:var(--txt);letter-spacing:-.025em;line-height:1.15;}
.hd-sub{margin:.3rem 0 0;color:var(--txt2);font-size:.82rem;}
.hd-actions{display:flex;align-items:center;gap:.6rem;flex-wrap:wrap;}

/* ── Buttons ──────────────────────────────────────────── */
.btn-p{display:inline-flex;align-items:center;gap:.45rem;padding:.55rem 1.15rem;background:var(--p);color:#fff;border:none;border-radius:10px;font-size:.82rem;font-weight:700;font-family:var(--ff);cursor:pointer;text-decoration:none;transition:background .15s,box-shadow .15s;}
.btn-p:hover{background:var(--p2);box-shadow:0 4px 14px rgba(37,99,235,.28);}
.btn-ghost{display:inline-flex;align-items:center;gap:.45rem;padding:.52rem 1rem;border:1px solid var(--bdr);border-radius:10px;background:var(--surf);color:var(--txt2);font-size:.82rem;font-weight:600;font-family:var(--ff);text-decoration:none;transition:background .15s,color .15s;}
.btn-ghost:hover{background:var(--surf2);color:var(--txt);}

/* ── Global stats hero strip ──────────────────────────── */
.hero-strip{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:2rem;}
.hero-card{border-radius:var(--r);padding:1.4rem 1.5rem 1.3rem;display:flex;flex-direction:column;gap:.25rem;position:relative;overflow:hidden;}
.hero-card::after{content:'';position:absolute;right:-20px;bottom:-20px;width:90px;height:90px;border-radius:50%;background:rgba(255,255,255,.1);}
.hc-warehouses{background:linear-gradient(135deg,#2563eb,#3b82f6);}
.hc-instock{background:linear-gradient(135deg,#16a34a,#22c55e);}
.hc-transit{background:linear-gradient(135deg,#7c3aed,#a78bfa);}
.hero-card .hc-eyebrow{font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.12em;color:rgba(255,255,255,.75);}
.hero-card .hc-num{font-size:2.25rem;font-weight:800;color:#fff;line-height:1;font-family:var(--fm);margin:.15rem 0;}
.hero-card .hc-lbl{font-size:.75rem;font-weight:600;color:rgba(255,255,255,.85);}
.hero-card i.hc-icon{position:absolute;right:1.1rem;top:50%;transform:translateY(-50%);font-size:2.2rem;color:rgba(255,255,255,.2);}

/* ── Filter bar ───────────────────────────────────────── */
.filter-bar{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);padding:.8rem 1.1rem;display:flex;align-items:center;gap:.75rem;margin-bottom:1.75rem;flex-wrap:wrap;}
.filter-bar select,.filter-bar input{padding:.5rem .85rem;border:1px solid var(--bdr);border-radius:8px;background:var(--surf2);color:var(--txt);font-size:.83rem;font-family:var(--ff);outline:none;min-width:200px;}
.filter-bar select:focus,.filter-bar input:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(37,99,235,.1);}

/* ── Section title ────────────────────────────────────── */
.section-title{display:flex;align-items:center;gap:.6rem;margin-bottom:1rem;padding-left:.75rem;border-left:3px solid var(--p);}
.section-title span{font-size:.9rem;font-weight:800;color:var(--txt);}
.count-pill{padding:.18rem .6rem;border-radius:999px;background:var(--pg);color:var(--p);font-size:.7rem;font-weight:700;font-family:var(--fm);}
.section-title .st-meta{font-size:.72rem;color:var(--muted);}

/* ── Warehouse cards grid ─────────────────────────────── */
.wh-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1rem;margin-bottom:1.75rem;}
.wh-card{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;display:flex;flex-direction:column;transition:box-shadow .2s,transform .2s;}
.wh-card:hover{box-shadow:var(--sh-md);transform:translateY(-2px);}
.card-top-strip{height:4px;background:linear-gradient(90deg,var(--p),#60a5fa);}
.card-top-strip.warn{background:linear-gradient(90deg,#f59e0b,#fcd34d);}
.card-top-strip.danger{background:linear-gradient(90deg,#ef4444,#fca5a5);}
.card-head{display:flex;align-items:center;gap:.75rem;padding:.95rem 1rem .75rem;}
.logo-wrap{width:42px;height:42px;flex-shrink:0;border-radius:11px;border:1px solid var(--bdr);background:var(--surf2);display:flex;align-items:center;justify-content:center;overflow:hidden;}
.logo-wrap img{width:100%;height:100%;object-fit:contain;padding:.3rem;}
.logo-wrap i{font-size:1.25rem;color:var(--p);}
.card-title{font-size:.88rem;font-weight:800;color:var(--txt);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;line-height:1.25;}
.card-sub{font-size:.7rem;color:var(--txt2);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-top:.1rem;}

/* ── Stock row (in-card) ──────────────────────────────── */
.stock-row{display:grid;grid-template-columns:1fr 1fr 1fr;border-top:1px solid var(--bdr);border-bottom:1px solid var(--bdr);}
.stock-cell{padding:.65rem .4rem;text-align:center;}
.stock-cell+.stock-cell{border-left:1px solid var(--bdr);}
.stock-val{font-size:1.05rem;font-weight:800;font-family:var(--fm);}
.stock-lbl{font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);margin-top:.1rem;}
.sv-green{color:#16a34a;}
.sv-purple{color:#7c3aed;}
.sv-blue{color:#2563eb;}

/* ── Item chip strip ──────────────────────────────────── */
.item-strip{display:flex;gap:0;border-bottom:1px solid var(--bdr);overflow-x:auto;scrollbar-width:none;}
.item-strip::-webkit-scrollbar{display:none;}
.item-chip{flex:1;min-width:42px;padding:.55rem .2rem;display:flex;flex-direction:column;align-items:center;gap:.2rem;border-right:1px solid var(--bdr);}
.item-chip:last-child{border-right:none;}
.item-chip i{font-size:.95rem;}
.chip-qty{font-size:.73rem;font-weight:800;font-family:var(--fm);color:var(--txt);}
.chip-lbl{font-size:.53rem;color:var(--muted);font-weight:700;text-transform:uppercase;letter-spacing:.05em;text-align:center;line-height:1.1;}
.chip-zero{color:#ef4444;}
.chip-low{color:#f59e0b;}

/* ── Card footer ──────────────────────────────────────── */
.card-foot{display:flex;align-items:center;justify-content:space-between;padding:.65rem 1rem;}
.status-pill{display:inline-flex;align-items:center;gap:.3rem;font-size:.68rem;font-weight:700;padding:.25rem .65rem;border-radius:999px;}
.pill-ok{background:rgba(22,163,74,.1);color:#16a34a;}
.pill-warn{background:rgba(245,158,11,.1);color:#d97706;}
.pill-danger{background:rgba(239,68,68,.1);color:#dc2626;}
.manage-btn{display:inline-flex;align-items:center;gap:.3rem;font-size:.74rem;font-weight:700;color:var(--p);text-decoration:none;padding:.3rem .75rem;border:1px solid rgba(37,99,235,.22);border-radius:8px;background:rgba(37,99,235,.05);transition:background .15s;}
.manage-btn:hover{background:rgba(37,99,235,.12);}

/* ── Table panel ──────────────────────────────────────── */
.tpanel{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;margin-bottom:1.75rem;}
.tpanel-hd{display:flex;align-items:center;justify-content:space-between;padding:.9rem 1.15rem;border-bottom:1px solid var(--bdr);}
.tpanel-title{font-size:.88rem;font-weight:800;color:var(--txt);display:flex;align-items:center;gap:.5rem;}
.tpanel-link{font-size:.75rem;font-weight:700;color:var(--p);text-decoration:none;}
.tpanel-link:hover{text-decoration:underline;}
table{width:100%;border-collapse:collapse;}
thead th{padding:.6rem 1rem;text-align:left;font-size:.67rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);background:var(--surf2);border-bottom:1px solid var(--bdr);}
tbody tr{border-bottom:1px solid var(--bdr);transition:background .12s;}
tbody tr:last-child{border-bottom:none;}
tbody tr:hover{background:var(--surf2);}
tbody td{padding:.65rem 1rem;font-size:.81rem;color:var(--txt2);}
.td-main{color:var(--txt);font-weight:600;}
.empty-row td{text-align:center;padding:2.5rem;color:var(--muted);font-size:.83rem;}

/* ── Badges ───────────────────────────────────────────── */
.badge{display:inline-flex;align-items:center;gap:.3rem;padding:.22rem .62rem;border-radius:999px;font-size:.7rem;font-weight:700;}
.badge-transit{background:rgba(124,58,237,.1);color:#7c3aed;}
.badge-arrived{background:rgba(16,185,129,.1);color:#059669;}
.badge-received{background:rgba(22,163,74,.1);color:#16a34a;}
.badge-draft{background:rgba(156,163,175,.1);color:#6b7280;}
.mov-received{background:rgba(22,163,74,.1);color:#15803d;}
.mov-dispatched{background:rgba(124,58,237,.1);color:#7c3aed;}
.mov-deployed{background:rgba(37,99,235,.1);color:#1d4ed8;}
.mov-damaged{background:rgba(239,68,68,.1);color:#dc2626;}
.mov-adjustment{background:rgba(245,158,11,.1);color:#b45309;}

/* ── Empty state panel ────────────────────────────────── */
.empty-panel{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);padding:3rem;text-align:center;margin-bottom:1.75rem;}
.empty-panel i{font-size:2.4rem;color:var(--muted);display:block;margin-bottom:.75rem;}
.empty-panel p{color:var(--muted);font-size:.85rem;margin:0 0 1.1rem;}

/* ── Subcon identity banner ───────────────────────────── */
.subcon-banner{display:flex;align-items:center;gap:.9rem;background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);padding:1rem 1.25rem;margin-bottom:1.75rem;box-shadow:var(--sh);flex-wrap:wrap;}
.subcon-logo{width:44px;height:44px;flex-shrink:0;border-radius:12px;border:1px solid var(--bdr);background:var(--surf2);display:flex;align-items:center;justify-content:center;overflow:hidden;}
.subcon-logo img{width:100%;height:100%;object-fit:contain;padding:.25rem;}
.subcon-logo i{font-size:1.3rem;color:var(--p);}
.subcon-info{flex:1;}
.subcon-name{font-size:.95rem;font-weight:800;color:var(--txt);}
.subcon-meta{font-size:.72rem;color:var(--muted);margin-top:.15rem;}
.subcon-totals{display:flex;gap:.6rem;flex-wrap:wrap;}
.subcon-stat{text-align:center;padding:.4rem .8rem;border-radius:10px;border:1px solid transparent;}
.subcon-stat-num{font-size:1rem;font-weight:800;font-family:var(--fm);}
.subcon-stat-lbl{font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;margin-top:.05rem;}
.ss-green{background:rgba(22,163,74,.08);border-color:rgba(22,163,74,.2);color:#16a34a;}
.ss-purple{background:rgba(124,58,237,.08);border-color:rgba(124,58,237,.2);color:#7c3aed;}
.ss-blue{background:rgba(37,99,235,.08);border-color:rgba(37,99,235,.2);color:#2563eb;}

/* ── Inventory hero cards (subcon) ────────────────────── */
.inv-hero-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem;margin-bottom:1.75rem;}
.inv-hero-card{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;}
.ihc-strip{height:4px;}
.ihc-body{padding:1.05rem 1.1rem .95rem;}
.ihc-icon-row{display:flex;align-items:center;gap:.6rem;margin-bottom:.85rem;}
.ihc-icon-wrap{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.ihc-icon-wrap i{font-size:1.1rem;}
.ihc-type-lbl{font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);}
.ihc-status{font-size:.6rem;font-weight:700;}
.ihc-status.out{color:#dc2626;}
.ihc-status.low{color:#d97706;}
.ihc-big-num{font-size:2rem;font-weight:800;font-family:var(--fm);line-height:1;}
.ihc-unit{font-size:.68rem;font-weight:600;color:var(--muted);margin-left:.2rem;}
.ihc-in-stock-lbl{font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);margin-top:.2rem;}
.ihc-footer{display:flex;gap:.6rem;margin-top:.8rem;padding-top:.75rem;border-top:1px solid var(--bdr);}
.ihc-footer-col{flex:1;text-align:center;}
.ihc-footer-num{font-size:.82rem;font-weight:800;font-family:var(--fm);}
.ihc-footer-lbl{font-size:.57rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-top:.1rem;}
.ihc-divider{width:1px;background:var(--bdr);}
.ihc-util{margin-top:.75rem;padding-top:.65rem;border-top:1px solid var(--bdr);}
.ihc-util-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:.4rem;}
.ihc-util-label{font-size:.57rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);}
.ihc-util-pct{font-size:.65rem;font-weight:800;font-family:var(--fm);}
.ihc-util-sub{font-size:.54rem;color:var(--muted);margin-top:.3rem;}
.util-bar-track{height:6px;background:var(--bdr);border-radius:999px;overflow:hidden;}
.util-bar-fill{height:100%;border-radius:999px;transition:width .5s ease;}

/* ── Stock activity cards ─────────────────────────────── */
.activity-stack{display:flex;flex-direction:column;gap:.85rem;margin-bottom:1.75rem;}
.activity-card{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;}
.activity-day-hd{display:flex;align-items:center;justify-content:space-between;padding:.72rem 1rem .68rem;border-bottom:1px solid var(--bdr);background:var(--surf2);cursor:pointer;user-select:none;}
.activity-day-hd:hover{background:#f1f5f9;}
.day-hd-left{display:flex;align-items:center;gap:.6rem;}
.day-label{font-size:.85rem;font-weight:800;color:var(--txt);}
.day-sub{font-size:.67rem;color:var(--muted);font-family:var(--fm);}
.day-pills{display:flex;align-items:center;gap:.4rem;flex-wrap:wrap;}
.day-pill{display:inline-flex;align-items:center;gap:.25rem;font-size:.64rem;font-weight:700;padding:.18rem .55rem;border-radius:999px;}
.dp-in{background:rgba(22,163,74,.1);color:#15803d;}
.dp-out{background:rgba(124,58,237,.1);color:#7c3aed;}
.dp-dep{background:rgba(37,99,235,.1);color:#1d4ed8;}
.dp-adj{background:rgba(245,158,11,.1);color:#b45309;}
.dp-count{background:var(--pg);color:var(--p);}
.day-chev{font-size:.85rem;color:var(--muted);margin-left:.25rem;transition:transform .2s;flex-shrink:0;}

/* ── Activity movement sub-header ─────────────────────── */
.mov-subhd{display:flex;align-items:center;gap:.5rem;padding:.5rem 1rem .42rem;border-bottom:1px solid var(--bdr);}
.mov-subhd-label{font-size:.7rem;font-weight:800;text-transform:uppercase;letter-spacing:.07em;}
.mov-subhd-count{font-size:.64rem;color:var(--muted);}
.mov-ref-row{padding:.35rem 1rem .2rem;background:rgba(37,99,235,.03);}
.mov-ref-label{font-size:.66rem;font-weight:700;color:var(--p);}
.mov-entry{display:flex;align-items:center;gap:.75rem;padding:.48rem 1rem;}
.mov-entry-icon{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.mov-entry-icon i{font-size:.85rem;}
.mov-entry-body{flex:1;min-width:0;}
.mov-entry-name{font-size:.78rem;font-weight:700;color:var(--txt);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.mov-entry-meta{font-size:.63rem;color:var(--muted);}
.mov-attrib{display:flex;gap:.5rem;margin-top:.25rem;flex-wrap:wrap;}
.attrib-pill{display:inline-flex;align-items:center;gap:.2rem;font-size:.6rem;font-weight:700;padding:.1rem .45rem;border-radius:999px;}
.ap-lineman{background:rgba(234,88,12,.08);color:#c2410c;}
.ap-approver{background:rgba(22,163,74,.08);color:#15803d;}
.mov-entry-qty{font-size:.85rem;font-weight:800;font-family:var(--fm);white-space:nowrap;}

/* ── Responsive ───────────────────────────────────────── */
@media(max-width:680px){
  .hero-strip{grid-template-columns:1fr;}
  .hd{flex-direction:column;align-items:flex-start;}
  .hd-actions{width:100%;}
  .subcon-banner{flex-direction:column;align-items:flex-start;}
  .subcon-totals{width:100%;justify-content:flex-start;}
}
</style>
@endpush

@php
$itemTypes = \App\Models\WarehouseStock::ITEM_TYPES;
$itemColors = [
    'amplifier'            => ['i'=>'mgc_radio_line',          'c'=>'color:#7c3aed'],
    'node'                 => ['i'=>'mgc_router_line',         'c'=>'color:#2563eb'],
    'extender'             => ['i'=>'mgc_signal_line',         'c'=>'color:#0891b2'],
    'tsc'                  => ['i'=>'mgc_plug_line',           'c'=>'color:#ea580c'],
    'power_supply'         => ['i'=>'mgc_lightning_line',      'c'=>'color:#ca8a04'],
    'power_supply_housing' => ['i'=>'mgc_box_line',            'c'=>'color:#64748b'],
    'cable'                => ['i'=>'mgc_cable_line',          'c'=>'color:#0d9488'],
];
@endphp

<div class="col-span-full">
<div class="inv-wrap">

    {{-- Flash --}}
    @if (session('success'))
        <div class="flash flash-ok"><i class="mgc_check_circle_line"></i> {{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="flash flash-err"><i class="mgc_close_circle_line"></i> {{ session('error') }}</div>
    @endif

    {{-- Page header --}}
    <div class="hd">
        <div class="hd-left">
            <div class="eyebrow">Warehouse</div>
            <h2>Inventory Dashboard</h2>
            <p class="hd-sub">Real-time stock overview across all warehouses.</p>
        </div>
        <div class="hd-actions">
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin.warehouses.index') }}" class="btn-p">
                    <i class="mgc_add_line"></i> Add Warehouse
                </a>
            @endif
            <a href="{{ route('warehouse.dashboard') }}" class="btn-ghost">
                <i class="mgc_dashboard_line"></i> Dashboard
            </a>
        </div>
    </div>

    @if ($canSeeAll)
    {{-- ══════════════════════════════════════════════════════
         PM / ADMIN / EXEC — full warehouse dashboard
    ══════════════════════════════════════════════════════ --}}

    {{-- Global stats hero strip --}}
    <div class="hero-strip">
        <div class="hero-card hc-warehouses">
            <i class="mgc_warehouse_line hc-icon"></i>
            <div class="hc-eyebrow">Total</div>
            <div class="hc-num">{{ $allWarehouses->count() }}</div>
            <div class="hc-lbl">Warehouses</div>
        </div>
        <div class="hero-card hc-instock">
            <i class="mgc_box_3_line hc-icon"></i>
            <div class="hc-eyebrow">Across All Warehouses</div>
            <div class="hc-num">{{ number_format($allWarehouses->flatMap(fn($w) => $w->stocks)->sum('qty_in_stock'), 0) }}</div>
            <div class="hc-lbl">Total In Stock</div>
        </div>
        <div class="hero-card hc-transit">
            <i class="mgc_truck_line hc-icon"></i>
            <div class="hc-eyebrow">Currently Moving</div>
            <div class="hc-num">{{ number_format($allWarehouses->flatMap(fn($w) => $w->stocks)->sum('qty_in_transit'), 0) }}</div>
            <div class="hc-lbl">Total In Transit</div>
        </div>
    </div>

    {{-- Filter bar --}}
    <form method="GET" action="{{ route('warehouse.inventory.index') }}" class="filter-bar">
        <select name="warehouse_id" onchange="this.form.submit()">
            <option value="">All Warehouses ({{ $allWarehouses->count() }})</option>
            @foreach ($allWarehouses as $wh)
                <option value="{{ $wh->id }}" @selected(request('warehouse_id') == $wh->id)>{{ $wh->name }}</option>
            @endforeach
        </select>
        @if (request('warehouse_id'))
            <a href="{{ route('warehouse.inventory.index') }}" class="btn-ghost" style="padding:.47rem .9rem;">
                <i class="mgc_close_line"></i> Clear
            </a>
        @endif
    </form>

    {{-- Warehouse cards --}}
    <div class="section-title">
        <i class="mgc_warehouse_line" style="color:var(--p);font-size:1rem;"></i>
        <span>Warehouses</span>
        <span class="count-pill">{{ $warehouses->count() }}</span>
    </div>

    @if ($warehouses->isEmpty())
        <div class="empty-panel">
            <i class="mgc_building_2_line"></i>
            <p>No active warehouses found.</p>
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin.warehouses.index') }}" class="btn-p">Add First Warehouse</a>
            @endif
        </div>
    @else
        <div class="wh-grid">
            @foreach ($warehouses as $wh)
                @php
                    $stockByType    = $wh->stocks->keyBy('item_type');
                    $totalInStock   = $wh->stocks->sum('qty_in_stock');
                    $totalInTransit = $wh->stocks->sum('qty_in_transit');
                    $totalDeployed  = $wh->stocks->sum('qty_deployed');
                    $hasOut = $wh->stocks->count() > 0 && $wh->stocks->every(fn($s) => $s->qty_in_stock <= 0);
                    $hasLow = ! $hasOut && $wh->stocks->contains(fn($s) => $s->qty_in_stock > 0 && $s->qty_in_stock < 5);
                    $stripClass = $hasOut ? 'danger' : ($hasLow ? 'warn' : '');
                @endphp
                <div class="wh-card">
                    <div class="card-top-strip {{ $stripClass }}"></div>
                    <div class="card-head">
                        <div class="logo-wrap">
                            @if ($wh->subcontractor?->logo_url)
                                <img src="{{ $wh->subcontractor->logo_url }}" alt="{{ $wh->subcontractor->name }}"
                                    onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <i class="mgc_building_2_line" style="display:none;"></i>
                            @else
                                <i class="mgc_building_2_line"></i>
                            @endif
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div class="card-title" title="{{ $wh->display_name }}">{{ $wh->display_name }}</div>
                            <div class="card-sub">{{ $wh->subcontractor?->name ?? 'Internal' }}</div>
                        </div>
                    </div>
                    <div class="stock-row">
                        <div class="stock-cell">
                            <div class="stock-val sv-green">{{ number_format($totalInStock, 0) }}</div>
                            <div class="stock-lbl">In Stock</div>
                        </div>
                        <div class="stock-cell">
                            <div class="stock-val sv-purple">{{ number_format($totalInTransit, 0) }}</div>
                            <div class="stock-lbl">In Transit</div>
                        </div>
                        <div class="stock-cell">
                            <div class="stock-val sv-blue">{{ number_format($totalDeployed, 0) }}</div>
                            <div class="stock-lbl">Deployed</div>
                        </div>
                    </div>
                    <div class="item-strip">
                        @foreach ($itemTypes as $typeKey => $typeMeta)
                            @php
                                $stock  = $stockByType[$typeKey] ?? null;
                                $qty    = $stock ? (float) $stock->qty_in_stock : null;
                                $ic     = $itemColors[$typeKey] ?? ['i'=>'mgc_box_line','c'=>'color:var(--muted)'];
                                $qClass = $qty === null ? '' : ($qty <= 0 ? 'chip-zero' : ($qty < 5 ? 'chip-low' : ''));
                            @endphp
                            <div class="item-chip" title="{{ $typeMeta['label'] }}">
                                <i class="{{ $ic['i'] }}" style="{{ $ic['c'] }};font-size:1rem;"></i>
                                <div class="chip-qty {{ $qClass }}">{{ $qty !== null ? number_format($qty, $typeKey === 'cable' ? 1 : 0) : '—' }}</div>
                                <div class="chip-lbl">{{ Str::limit($typeMeta['label'], 5, '') }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-foot">
                        @if ($hasOut)
                            <span class="status-pill pill-danger"><i class="mgc_warning_line" style="font-size:.75rem;"></i> Stock out</span>
                        @elseif ($hasLow)
                            <span class="status-pill pill-warn"><i class="mgc_warning_line" style="font-size:.75rem;"></i> Low stock</span>
                        @else
                            <span class="status-pill pill-ok"><i class="mgc_check_line" style="font-size:.75rem;"></i> OK</span>
                        @endif
                        <a href="{{ route('warehouse.inventory.show', $wh) }}" class="manage-btn">
                            <i class="mgc_settings_4_line"></i> Manage
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Today's deliveries --}}
    <div class="section-title" style="margin-top:.25rem;">
        <i class="mgc_truck_line" style="color:var(--p);font-size:1rem;"></i>
        <span>Today's Deliveries</span>
        <span class="count-pill">{{ $todayDeliveries->count() }}</span>
        <span class="st-meta">{{ now()->format('F d, Y') }}</span>
    </div>
    <div class="tpanel">
        <div class="tpanel-hd">
            <div class="tpanel-title"><i class="mgc_truck_line" style="color:var(--p);"></i> Incoming &amp; Outgoing</div>
            <a href="{{ route('warehouse.deliveries.index') }}" class="tpanel-link">View All →</a>
        </div>
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Transmittal #</th>
                        <th>From → To</th>
                        <th>Items</th>
                        <th>Driver / Truck</th>
                        <th>Status</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($todayDeliveries as $d)
                        @php
                            $statusBadge = match($d->status) { 'in_transit'=>'badge badge-transit','arrived'=>'badge badge-arrived','received'=>'badge badge-received',default=>'badge badge-draft' };
                            $statusLabel = match($d->status) { 'in_transit'=>'In Transit','arrived'=>'Arrived','received'=>'Received','draft'=>'Pending',default=>ucfirst($d->status) };
                            $itemCount   = $d->transmittal?->items->count() ?? 0;
                        @endphp
                        <tr>
                            <td><div class="td-main">{{ $d->transmittal?->transmittal_number ?? '—' }}</div></td>
                            <td>
                                <div style="display:flex;align-items:center;gap:.4rem;">
                                    <span class="td-main" style="font-size:.78rem;">{{ $d->originWarehouse?->name ?? '—' }}</span>
                                    <i class="mgc_arrow_right_line" style="color:var(--muted);font-size:.8rem;"></i>
                                    <span class="td-main" style="font-size:.78rem;">{{ $d->destinationWarehouse?->name ?? '—' }}</span>
                                </div>
                            </td>
                            <td>
                                <span style="font-size:.78rem;font-weight:700;color:var(--txt);">{{ $itemCount }}</span>
                                <span style="font-size:.72rem;color:var(--muted);">type{{ $itemCount!==1?'s':'' }}</span>
                            </td>
                            <td><div class="td-main" style="font-size:.78rem;">{{ $d->driver_name ?: '—' }}</div></td>
                            <td><span class="{{ $statusBadge }}">{{ $statusLabel }}</span></td>
                            <td style="font-size:.72rem;color:var(--muted);white-space:nowrap;">{{ $d->created_at->format('g:i A') }}</td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="6">
                                <i class="mgc_truck_line" style="font-size:1.8rem;display:block;margin-bottom:.5rem;color:var(--muted);"></i>
                                No deliveries recorded today.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent stock movements --}}
    @if ($ledger->count())
        <div class="section-title" style="margin-top:.25rem;">
            <i class="mgc_receipt_line" style="color:var(--p);font-size:1rem;"></i>
            <span>Recent Stock Movements</span>
            <span class="count-pill">{{ $ledger->count() }}</span>
        </div>
        <div class="tpanel">
            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Warehouse</th>
                            <th>Item</th>
                            <th>Type</th>
                            <th style="text-align:right;">Qty</th>
                            <th>By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ledger as $entry)
                            @php $movClass='badge mov-'.$entry->movement_type; $qtyColor=$entry->quantity>=0?'color:#16a34a':'color:#dc2626'; @endphp
                            <tr>
                                <td style="white-space:nowrap;font-size:.73rem;color:var(--muted);">{{ $entry->created_at->format('M d, g:i A') }}</td>
                                <td class="td-main" style="font-size:.78rem;">{{ $entry->warehouse?->name ?? '—' }}</td>
                                <td>
                                    <div class="td-main" style="font-size:.78rem;">{{ $entry->description }}</div>
                                    <div style="font-size:.68rem;color:var(--muted);">{{ $itemTypes[$entry->item_type]['label'] ?? $entry->item_type }} · {{ $entry->unit }}</div>
                                </td>
                                <td><span class="{{ $movClass }}">{{ ucfirst($entry->movement_type) }}</span></td>
                                <td style="text-align:right;font-family:var(--fm);font-weight:700;font-size:.82rem;{{ $qtyColor }}">{{ $entry->quantity>=0?'+':'' }}{{ number_format($entry->quantity,2) }}</td>
                                <td style="font-size:.72rem;color:var(--muted);">{{ $entry->createdBy?->name ?? 'System' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @else
    {{-- ══════════════════════════════════════════════════════
         SUBCON — simple inventory summary view
    ══════════════════════════════════════════════════════ --}}
    @php
        $user       = auth()->user();
        $subcon     = $user->subcontractor;
        $allStocks  = $warehouses->flatMap(fn($w) => $w->stocks);

        // Aggregate totals per item type across all subcon warehouses
        $typeTotals = [];
        foreach ($itemTypes as $typeKey => $typeMeta) {
            $typeTotals[$typeKey] = [
                'label'      => $typeMeta['label'],
                'in_stock'   => $allStocks->where('item_type', $typeKey)->sum('qty_in_stock'),
                'in_transit' => $allStocks->where('item_type', $typeKey)->sum('qty_in_transit'),
                'deployed'   => $allStocks->where('item_type', $typeKey)->sum('qty_deployed'),
                'ic'         => $itemColors[$typeKey] ?? ['i'=>'mgc_box_line','c'=>'color:var(--muted)'],
            ];
        }

        // Show types with any quantity, plus always show power_supply
        $activeTypes = array_filter($typeTotals, fn($t, $k) =>
            $t['in_stock'] + $t['in_transit'] + $t['deployed'] > 0 || $k === 'power_supply'
        , ARRAY_FILTER_USE_BOTH);

        // Custom order: cable first, power_supply last
        $typeOrder = ['cable','amplifier','node','extender','tsc','power_supply_housing','power_supply'];
        uksort($activeTypes, fn($a,$b) =>
            array_search($a, $typeOrder) <=> array_search($b, $typeOrder)
        );

        $grandInStock   = $allStocks->sum('qty_in_stock');
        $grandInTransit = $allStocks->sum('qty_in_transit');
        $grandDeployed  = $allStocks->sum('qty_deployed');
    @endphp

    {{-- Subcon identity banner --}}
    <div class="subcon-banner">
        <div class="subcon-logo">
            @if ($subcon?->logo_url)
                <img src="{{ $subcon->logo_url }}">
            @else
                <i class="mgc_building_2_line"></i>
            @endif
        </div>
        <div class="subcon-info">
            <div class="subcon-name">{{ $subcon?->name ?? $user->name }}</div>
            <div class="subcon-meta">
                {{ $warehouses->count() }} warehouse{{ $warehouses->count()!==1?'s':'' }} &nbsp;·&nbsp; {{ now()->format('F d, Y') }}
            </div>
        </div>
        <div class="subcon-totals">
            <div class="subcon-stat ss-green">
                <div class="subcon-stat-num">{{ number_format($grandInStock, 0) }}</div>
                <div class="subcon-stat-lbl">In Stock</div>
            </div>
            <div class="subcon-stat ss-purple">
                <div class="subcon-stat-num">{{ number_format($grandInTransit, 0) }}</div>
                <div class="subcon-stat-lbl">In Transit</div>
            </div>
            <div class="subcon-stat ss-blue">
                <div class="subcon-stat-num">{{ number_format($grandDeployed, 0) }}</div>
                <div class="subcon-stat-lbl">Deployed</div>
            </div>
        </div>
    </div>

    {{-- Item type hero cards --}}
    <div class="section-title">
        <i class="mgc_box_3_line" style="color:var(--p);font-size:1rem;"></i>
        <span>Inventory Total</span>
        <span class="count-pill">{{ count($activeTypes) }} item types</span>
    </div>

    @if (empty($activeTypes))
        <div class="empty-panel">
            <i class="mgc_box_3_line"></i>
            <p>No stock recorded yet for your warehouse.</p>
        </div>
    @else
        <div class="inv-hero-grid">
            @foreach ($activeTypes as $typeKey => $t)
                @php
                    $inStock    = (float) $t['in_stock'];
                    $inTransit  = (float) $t['in_transit'];
                    $deployed   = (float) $t['deployed'];
                    $isLow      = $inStock > 0 && $inStock < 5;
                    $isOut      = $inStock <= 0;
                    $isCable    = $typeKey === 'cable';
                    // Parse color from css string like "color:#7c3aed"
                    preg_match('/#[0-9a-fA-F]{3,6}/', $t['ic']['c'], $colorMatch);
                    $clr = $colorMatch[0] ?? '#2d6ff7';
                    $clrAlpha = $clr . '18';
                @endphp
                <div class="inv-hero-card">
                    <div class="ihc-strip" style="background:{{ $clr }};"></div>
                    <div class="ihc-body">
                        <div class="ihc-icon-row">
                            <div class="ihc-icon-wrap" style="background:{{ $clrAlpha }};">
                                <i class="{{ $t['ic']['i'] }}" style="{{ $t['ic']['c'] }};"></i>
                            </div>
                            <div>
                                <div class="ihc-type-lbl">{{ $t['label'] }}</div>
                                @if ($isOut)
                                    <div class="ihc-status out">Stock Out</div>
                                @elseif ($isLow)
                                    <div class="ihc-status low">Low Stock</div>
                                @endif
                            </div>
                        </div>

                        <div class="ihc-big-num" style="color:{{ $isOut ? '#dc2626' : ($isLow ? '#d97706' : 'var(--txt)') }};">
                            {{ $isCable ? number_format($inStock, 1) : number_format($inStock, 0) }}<span class="ihc-unit">{{ $isCable ? 'm' : 'pcs' }}</span>
                        </div>
                        <div class="ihc-in-stock-lbl">In Stock</div>

                        <div class="ihc-footer">
                            <div class="ihc-footer-col">
                                <div class="ihc-footer-num" style="color:#7c3aed;">{{ $isCable ? number_format($inTransit,1) : number_format($inTransit,0) }}</div>
                                <div class="ihc-footer-lbl">In Transit</div>
                            </div>
                            <div class="ihc-divider"></div>
                            <div class="ihc-footer-col">
                                <div class="ihc-footer-num" style="color:#2563eb;">{{ $isCable ? number_format($deployed,1) : number_format($deployed,0) }}</div>
                                <div class="ihc-footer-lbl">Deployed</div>
                            </div>
                        </div>

                        @php
                            $totalQty  = $inStock + $inTransit + $deployed;
                            $usedPct   = $totalQty > 0 ? min(100, round(($deployed / $totalQty) * 100)) : 0;
                            $barClr    = $usedPct >= 80 ? '#ef4444' : ($usedPct >= 50 ? '#f59e0b' : '#10b981');
                            $barLabel  = $usedPct >= 80 ? 'High' : ($usedPct >= 50 ? 'Mid' : 'Low');
                        @endphp
                        <div class="ihc-util">
                            <div class="ihc-util-row">
                                <span class="ihc-util-label">Field Utilization</span>
                                <span class="ihc-util-pct" style="color:{{ $barClr }};">{{ $usedPct }}% <span style="font-weight:600;opacity:.7;">{{ $barLabel }}</span></span>
                            </div>
                            <div class="util-bar-track">
                                <div class="util-bar-fill" style="width:{{ $usedPct }}%;background:{{ $barClr }};"></div>
                            </div>
                            <div class="ihc-util-sub">
                                {{ $isCable ? number_format($deployed,1).'m' : number_format($deployed,0) }} deployed of {{ $isCable ? number_format($totalQty,1).'m' : number_format($totalQty,0) }} total
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Per-warehouse breakdown (compact) --}}
    @if ($warehouses->count() > 1)
        <div class="section-title">
            <i class="mgc_warehouse_line" style="color:var(--p);font-size:1rem;"></i>
            <span>By Warehouse</span>
            <span class="count-pill">{{ $warehouses->count() }}</span>
        </div>
        <div class="wh-grid">
            @foreach ($warehouses as $wh)
                @php
                    $stockByType    = $wh->stocks->keyBy('item_type');
                    $totalInStock   = $wh->stocks->sum('qty_in_stock');
                    $hasOut = $wh->stocks->count() > 0 && $wh->stocks->every(fn($s) => $s->qty_in_stock <= 0);
                    $hasLow = !$hasOut && $wh->stocks->contains(fn($s) => $s->qty_in_stock > 0 && $s->qty_in_stock < 5);
                    $stripClass = $hasOut ? 'danger' : ($hasLow ? 'warn' : '');
                @endphp
                <div class="wh-card">
                    <div class="card-top-strip {{ $stripClass }}"></div>
                    <div class="card-head">
                        <div class="logo-wrap"><i class="mgc_building_2_line"></i></div>
                        <div style="flex:1;min-width:0;">
                            <div class="card-title">{{ $wh->display_name }}</div>
                            <div class="card-sub sv-green">{{ number_format($totalInStock,0) }} in stock</div>
                        </div>
                    </div>
                    <div class="item-strip">
                        @foreach ($itemTypes as $typeKey => $typeMeta)
                            @php
                                $s    = $stockByType[$typeKey] ?? null;
                                $qty  = $s ? (float)$s->qty_in_stock : null;
                                $ic   = $itemColors[$typeKey] ?? ['i'=>'mgc_box_line','c'=>'color:var(--muted)'];
                                $qCls = $qty===null?'':($qty<=0?'chip-zero':($qty<5?'chip-low':''));
                            @endphp
                            <div class="item-chip" title="{{ $typeMeta['label'] }}">
                                <i class="{{ $ic['i'] }}" style="{{ $ic['c'] }};font-size:.9rem;"></i>
                                <div class="chip-qty {{ $qCls }}">{{ $qty!==null ? number_format($qty,$typeKey==='cable'?1:0) : '—' }}</div>
                                <div class="chip-lbl">{{ Str::limit($typeMeta['label'],5,'') }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-foot">
                        @if($hasOut)<span class="status-pill pill-danger"><i class="mgc_warning_line" style="font-size:.75rem;"></i> Stock out</span>
                        @elseif($hasLow)<span class="status-pill pill-warn"><i class="mgc_warning_line" style="font-size:.75rem;"></i> Low stock</span>
                        @else<span class="status-pill pill-ok"><i class="mgc_check_line" style="font-size:.75rem;"></i> OK</span>@endif
                        <a href="{{ route('warehouse.inventory.show', $wh) }}" class="manage-btn"><i class="mgc_settings_4_line"></i> View</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Stock Activity — date-grouped summary + detail --}}
    @if ($ledger->count())
        @php
            // Group ledger by calendar date, newest first
            $byDate = $ledger->groupBy(fn($e) => $e->created_at->format('Y-m-d'))
                             ->sortKeysDesc();

            $movColors = [
                'received'   => ['bg'=>'rgba(22,163,74,.1)',  'c'=>'#15803d', 'icon'=>'mgc_arrow_down_line'],
                'dispatched' => ['bg'=>'rgba(124,58,237,.1)', 'c'=>'#7c3aed', 'icon'=>'mgc_arrow_up_line'],
                'deployed'   => ['bg'=>'rgba(37,99,235,.1)',  'c'=>'#1d4ed8', 'icon'=>'mgc_send_line'],
                'damaged'    => ['bg'=>'rgba(239,68,68,.1)',  'c'=>'#dc2626', 'icon'=>'mgc_warning_line'],
                'adjustment' => ['bg'=>'rgba(245,158,11,.1)', 'c'=>'#b45309', 'icon'=>'mgc_edit_line'],
            ];
        @endphp

        <div class="section-title" style="margin-top:.25rem;">
            <i class="mgc_receipt_line" style="color:var(--p);font-size:1rem;"></i>
            <span>Stock Activity</span>
            <span class="count-pill">{{ $byDate->count() }} day{{ $byDate->count()!==1?'s':'' }}</span>
        </div>

        <div class="activity-stack">
            @foreach ($byDate as $dateKey => $entries)
                @php
                    $dateLabel  = \Carbon\Carbon::parse($dateKey)->isToday()
                        ? 'Today'
                        : (\Carbon\Carbon::parse($dateKey)->isYesterday()
                            ? 'Yesterday'
                            : \Carbon\Carbon::parse($dateKey)->format('F d, Y'));

                    // Totals for the day
                    $dayReceived   = $entries->where('movement_type','received')->sum('quantity');
                    $dayDispatched = $entries->where('movement_type','dispatched')->sum('quantity');
                    $dayDeployed   = $entries->where('movement_type','deployed')->sum('quantity');
                    $dayAdjusted   = $entries->whereIn('movement_type',['adjustment'])->sum('quantity');

                    // Group entries by movement_type for bunching
                    $byType = $entries->groupBy('movement_type');
                @endphp

                @php $dayId = 'day-' . $loop->index; $isFirst = $loop->first; @endphp
                <div class="activity-card">

                    {{-- Date header row — clickable toggle --}}
                    <div class="activity-day-hd" onclick="toggleDay('{{ $dayId }}')">
                        <div class="day-hd-left">
                            <i class="mgc_calendar_line" style="color:var(--p);font-size:.95rem;"></i>
                            <span class="day-label">{{ $dateLabel }}</span>
                            <span class="day-sub">{{ \Carbon\Carbon::parse($dateKey)->format('D, M d') }}</span>
                        </div>
                        <div class="day-pills">
                            @if ($dayReceived > 0)
                                <span class="day-pill dp-in">
                                    <i class="mgc_arrow_down_line" style="font-size:.65rem;"></i>+{{ number_format($dayReceived,0) }} in
                                </span>
                            @endif
                            @if ($dayDispatched > 0)
                                <span class="day-pill dp-out">
                                    <i class="mgc_arrow_up_line" style="font-size:.65rem;"></i>{{ number_format($dayDispatched,0) }} out
                                </span>
                            @endif
                            @if ($dayDeployed > 0)
                                <span class="day-pill dp-dep">
                                    <i class="mgc_send_line" style="font-size:.65rem;"></i>{{ number_format($dayDeployed,0) }} deployed
                                </span>
                            @endif
                            @if ($dayAdjusted != 0)
                                <span class="day-pill dp-adj">
                                    <i class="mgc_edit_line" style="font-size:.65rem;"></i>{{ $dayAdjusted > 0 ? '+' : '' }}{{ number_format($dayAdjusted,0) }} adj
                                </span>
                            @endif
                            <span class="day-pill dp-count">{{ $entries->count() }} entries</span>
                            <i id="chev-{{ $dayId }}" class="mgc_chevron_down_line day-chev" style="{{ $isFirst ? '' : 'transform:rotate(-90deg);' }}"></i>
                        </div>
                    </div>

                    {{-- Collapsible body --}}
                    <div id="{{ $dayId }}" style="{{ $isFirst ? '' : 'display:none;' }}">

                    {{-- Grouped by movement type --}}
                    @foreach ($byType as $movType => $movEntries)
                        @php
                            $mc = $movColors[$movType] ?? ['bg'=>'rgba(156,163,175,.1)','c'=>'#6b7280','icon'=>'mgc_box_line'];
                            // Bundle by pole/node reference from notes
                            $bunched = $movEntries->groupBy(fn($e) => $e->notes ?? 'General');
                        @endphp

                        <div class="mov-subhd">
                            <i class="{{ $mc['icon'] }}" style="color:{{ $mc['c'] }};font-size:.8rem;"></i>
                            <span class="mov-subhd-label" style="color:{{ $mc['c'] }};">{{ ucfirst(str_replace('_',' ',$movType)) }}</span>
                            <span class="mov-subhd-count">— {{ $movEntries->count() }} item{{ $movEntries->count()!==1?'s':'' }}</span>
                        </div>

                        {{-- Grouped rows per reference (pole/node/etc) --}}
                        @foreach ($bunched as $ref => $refEntries)
                            @if ($ref !== 'General')
                                <div class="mov-ref-row">
                                    <span class="mov-ref-label"><i class="mgc_link_line" style="font-size:.65rem;"></i> {{ Str::limit($ref, 80) }}</span>
                                </div>
                            @endif
                            @foreach ($refEntries as $entry)
                                @php
                                    $qColor = $entry->quantity >= 0 ? '#16a34a' : '#dc2626';
                                    $ic2    = $itemColors[$entry->item_type] ?? ['i'=>'mgc_box_line','c'=>'color:var(--muted)'];
                                    $isCbl  = $entry->item_type === 'cable';
                                @endphp
                                <div class="mov-entry" style="border-bottom:1px solid {{ $loop->last && $loop->parent->last ? 'transparent' : 'var(--bdr)' }};padding-bottom:{{ $loop->last && $loop->parent->last ? '.6rem' : '.48rem' }};">
                                    <div class="mov-entry-icon" style="background:{{ $mc['bg'] }};">
                                        <i class="{{ $ic2['i'] }}" style="{{ $ic2['c'] }};"></i>
                                    </div>
                                    <div class="mov-entry-body">
                                        <div class="mov-entry-name">
                                            {{ $entry->description ?: ($itemTypes[$entry->item_type]['label'] ?? $entry->item_type) }}
                                        </div>
                                        <div class="mov-entry-meta">
                                            {{ $itemTypes[$entry->item_type]['label'] ?? $entry->item_type }}
                                            &nbsp;·&nbsp;{{ $entry->created_at->format('g:i A') }}
                                            @if ($entry->warehouse)&nbsp;·&nbsp;{{ $entry->warehouse->name }}@endif
                                        </div>
                                        @php
                                            $refKey = $entry->reference_id ?? null;
                                            $isReceipt = $refKey && str_contains($entry->reference_type ?? '', 'WarehouseReceipt');
                                            $attrib = $isReceipt ? ($receiptMap[$refKey] ?? []) : [];
                                        @endphp
                                        @if (!empty($attrib['lineman']) || !empty($attrib['approver']))
                                            <div class="mov-attrib">
                                                @if (!empty($attrib['lineman']))
                                                    <span class="attrib-pill ap-lineman">
                                                        <i class="mgc_user_3_line" style="font-size:.6rem;"></i> {{ $attrib['lineman'] }}
                                                    </span>
                                                @endif
                                                @if (!empty($attrib['approver']))
                                                    <span class="attrib-pill ap-approver">
                                                        <i class="mgc_check_circle_line" style="font-size:.6rem;"></i> {{ $attrib['approver'] }}
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mov-entry-qty" style="color:{{ $qColor }};">
                                        {{ $entry->quantity >= 0 ? '+' : '' }}{{ $isCbl ? number_format($entry->quantity,1).'m' : number_format($entry->quantity,0).' pcs' }}
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @endforeach

                    </div>{{-- end collapsible --}}
                </div>
            @endforeach
        </div>
    @endif

    @endif {{-- end @if ($canSeeAll) / @else --}}

</div>
</div>

@push('scripts')
<script>
function toggleDay(id) {
    const body  = document.getElementById(id);
    const chev  = document.getElementById('chev-' + id);
    const open  = body.style.display !== 'none';
    body.style.display = open ? 'none' : '';
    chev.style.transform = open ? 'rotate(-90deg)' : '';
}
</script>
@endpush

</x-layout>
