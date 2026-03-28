<x-layout>

@push('styles')
<style>
*, *::before, *::after { box-sizing: border-box; }

:root{
    --bg:#f7f8fa;
    --surface:#ffffff;
    --surface-soft:#fcfcfd;
    --surface-muted:#f3f5f7;
    --line:#e7ebf0;
    --line-strong:#dbe2ea;

    --text:#111827;
    --text-soft:#5f6b7a;
    --text-muted:#98a2b3;

    --primary:#111827;
    --primary-soft:#eef2f7;
    --accent:#2563eb;
    --accent-soft:rgba(37,99,235,.08);

    --success:#15803d;
    --success-bg:#ecfdf3;
    --warning:#b45309;
    --warning-bg:#fff7ed;
    --danger:#dc2626;
    --danger-bg:#fef2f2;
    --violet:#6d28d9;
    --violet-bg:#f5f3ff;

    --radius-lg:22px;
    --radius-md:16px;
    --radius-sm:12px;

    --shadow-sm:0 1px 2px rgba(16,24,40,.04);
    --shadow-md:0 8px 24px rgba(16,24,40,.06);
    --shadow-lg:0 18px 50px rgba(16,24,40,.08);

    --mono:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
    --sans:"Instrument Sans","Plus Jakarta Sans","Manrope","Segoe UI",sans-serif;
}

body{
    font-family:var(--sans);
    background:
        radial-gradient(circle at top left, rgba(37,99,235,.04), transparent 30%),
        radial-gradient(circle at top right, rgba(17,24,39,.03), transparent 24%),
        var(--bg);
    color:var(--text);
}

/* page */
.rpt-wrap{
    padding:1.2rem 1.25rem 2.5rem;
}

/* header */
.page-top{
    display:flex;
    align-items:flex-end;
    justify-content:space-between;
    gap:1rem;
    margin-bottom:1.15rem;
}

.eyebrow{
    display:inline-flex;
    align-items:center;
    gap:.5rem;
    padding:.38rem .72rem;
    border:1px solid var(--line);
    border-radius:999px;
    background:rgba(255,255,255,.9);
    box-shadow:var(--shadow-sm);
    font-size:.67rem;
    font-weight:800;
    letter-spacing:.14em;
    text-transform:uppercase;
    color:var(--text-soft);
    margin-bottom:.7rem;
}
.eyebrow::before{
    content:"";
    width:8px;
    height:8px;
    border-radius:999px;
    background:linear-gradient(135deg,#2563eb,#111827);
    box-shadow:0 0 0 4px rgba(37,99,235,.08);
}
.page-title{
    margin:0;
    font-size:clamp(1.6rem,2vw,2.1rem);
    line-height:1.05;
    letter-spacing:-.04em;
    font-weight:900;
    color:var(--text);
}
.page-sub{
    margin:.35rem 0 0;
    color:var(--text-soft);
    font-size:.92rem;
    max-width:720px;
}

/* flash */
.flash{
    display:flex;
    align-items:center;
    gap:.6rem;
    padding:.9rem 1rem;
    border-radius:16px;
    margin-bottom:1rem;
    font-size:.86rem;
    font-weight:700;
    border:1px solid transparent;
    box-shadow:var(--shadow-sm);
}
.flash-ok{
    background:var(--success-bg);
    color:var(--success);
    border-color:rgba(21,128,61,.12);
}
.flash-err{
    background:var(--danger-bg);
    color:var(--danger);
    border-color:rgba(220,38,38,.12);
}

/* cards */
.card{
    background:rgba(255,255,255,.92);
    border:1px solid rgba(231,235,240,.95);
    border-radius:var(--radius-lg);
    box-shadow:var(--shadow-md);
    backdrop-filter:blur(8px);
}

/* filter bar */
.fbar{
    padding:1rem;
    display:flex;
    flex-wrap:wrap;
    gap:.8rem;
    align-items:end;
    margin-bottom:1.1rem;
}
.fgroup{
    min-width:150px;
    flex:1 1 160px;
}
.fgroup.fgroup-date{
    max-width:180px;
}
.fbar label{
    display:block;
    margin-bottom:.45rem;
    font-size:.66rem;
    font-weight:800;
    text-transform:uppercase;
    letter-spacing:.12em;
    color:var(--text-muted);
}
.fbar select,
.fbar input[type="date"]{
    width:100%;
    height:46px;
    padding:0 .95rem;
    border:1px solid var(--line);
    border-radius:14px;
    background:#fff;
    color:var(--text);
    font-size:.9rem;
    font-family:var(--sans);
    outline:none;
    transition:.18s ease;
    box-shadow:inset 0 1px 0 rgba(255,255,255,.7);
}
.fbar select:hover,
.fbar input[type="date"]:hover{
    border-color:var(--line-strong);
}
.fbar select:focus,
.fbar input[type="date"]:focus{
    border-color:rgba(37,99,235,.35);
    box-shadow:0 0 0 4px rgba(37,99,235,.08);
}

.btn{
    height:46px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:.45rem;
    padding:0 1rem;
    border-radius:14px;
    border:1px solid transparent;
    text-decoration:none;
    font-size:.88rem;
    font-weight:800;
    font-family:var(--sans);
    white-space:nowrap;
    cursor:pointer;
    transition:.18s ease;
}
.btn:focus{outline:none;}

.btn-primary{
    background:linear-gradient(180deg,#1f2937,#111827);
    color:#fff;
    box-shadow:0 10px 24px rgba(17,24,39,.14);
}
.btn-primary:hover{
    transform:translateY(-1px);
    box-shadow:0 14px 28px rgba(17,24,39,.18);
}

.btn-soft{
    background:#fff;
    color:var(--text-soft);
    border-color:var(--line);
}
.btn-soft:hover{
    background:var(--surface-soft);
    color:var(--text);
}

.btn-export{
    background:linear-gradient(180deg,#ffffff,#f6f8fa);
    border:1px solid var(--line);
    color:var(--text);
}
.btn-export:hover{
    background:#fff;
    border-color:var(--line-strong);
    transform:translateY(-1px);
}

/* panel */
.tpanel{
    overflow:hidden;
}
.tpanel-hd{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    padding:1rem 1.15rem;
    border-bottom:1px solid var(--line);
    background:
        linear-gradient(180deg, rgba(255,255,255,.96), rgba(248,250,252,.92));
}
.tpanel-title{
    display:flex;
    align-items:center;
    gap:.6rem;
    font-size:.95rem;
    font-weight:900;
    color:var(--text);
    letter-spacing:-.02em;
}
.tpanel-count{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:30px;
    height:30px;
    padding:0 .65rem;
    border-radius:999px;
    background:var(--primary-soft);
    color:var(--text-soft);
    font-size:.78rem;
    font-weight:800;
}

/* table */
.table-wrap{
    overflow-x:auto;
    background:#fff;
}
.rtable{
    width:100%;
    min-width:1600px;
    border-collapse:separate;
    border-spacing:0;
}
.rtable thead th{
    position:sticky;
    top:0;
    z-index:2;
    padding:.9rem .8rem;
    text-align:left;
    font-size:.66rem;
    font-weight:900;
    text-transform:uppercase;
    letter-spacing:.12em;
    color:var(--text-muted);
    background:#fbfcfd;
    border-bottom:1px solid var(--line);
    white-space:nowrap;
}
.rtable thead th.num{ text-align:right; }

.rtable tbody tr{
    transition:background .16s ease, transform .16s ease;
}
.rtable tbody tr:hover{
    background:linear-gradient(180deg,#fcfdff,#f8fbff);
}
.rtable tbody td{
    padding:1rem .8rem;
    border-bottom:1px solid #eef2f6;
    vertical-align:middle;
    font-size:.88rem;
}
.rtable tbody tr:last-child td{
    border-bottom:none;
}
.rtable tbody td.num{
    text-align:right;
    font-family:var(--mono);
    font-weight:800;
    color:var(--text);
    font-size:.83rem;
}
.rtable tbody td.num-zero{
    text-align:right;
    font-family:var(--mono);
    color:#b0b8c4;
    font-size:.83rem;
}

/* cells */
.date-main{
    font-family:var(--mono);
    font-size:.8rem;
    font-weight:800;
    color:var(--text);
}
.date-sub{
    margin-top:.18rem;
    font-size:.72rem;
    color:var(--text-muted);
}
.node-id{
    font-weight:900;
    letter-spacing:.01em;
    color:var(--text);
}
.node-name{
    color:var(--text-soft);
    font-weight:700;
}
.cell-strong{
    color:var(--text);
    font-weight:800;
}
.cell-soft{
    color:var(--text-soft);
    font-weight:700;
}

/* badges */
.badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:.35rem;
    min-height:30px;
    padding:.32rem .72rem;
    border-radius:999px;
    font-size:.68rem;
    font-weight:900;
    letter-spacing:.04em;
    white-space:nowrap;
    border:1px solid transparent;
}
.s-pending   { background:#fff7db; color:#9a6700; border-color:#f6df9c; }
.s-approved  { background:#ecfdf3; color:#027a48; border-color:#b7ebcb; }
.s-rework    { background:#fef2f2; color:#b42318; border-color:#fecaca; }
.s-delivery  { background:#eef4ff; color:#1d4ed8; border-color:#c7d7fe; }
.s-delivered { background:#edfdf2; color:#15803d; border-color:#c4f0d0; }
.s-transit   { background:#f5f3ff; color:#6d28d9; border-color:#ddd6fe; }
.s-onhold    { background:#fff8db; color:#a16207; border-color:#f6e6a7; }
.s-closed    { background:#f4f4f5; color:#52525b; border-color:#e4e4e7; }

/* user pills */
.by-pill{
    display:inline-flex;
    align-items:center;
    min-height:32px;
    padding:.36rem .72rem;
    border-radius:999px;
    background:#f8fafc;
    border:1px solid var(--line);
    color:var(--text);
    font-size:.74rem;
    font-weight:800;
    letter-spacing:.02em;
}
.by-empty{
    color:var(--text-muted);
    font-size:.78rem;
}

/* action button */
.btn-approve{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:.35rem;
    min-height:38px;
    padding:0 .9rem;
    border-radius:12px;
    border:1px solid rgba(21,128,61,.18);
    background:linear-gradient(180deg,#f5fff8,#ecfdf3);
    color:var(--success);
    font-size:.78rem;
    font-weight:900;
    font-family:var(--sans);
    cursor:pointer;
    transition:.16s ease;
    box-shadow:0 4px 14px rgba(21,128,61,.08);
}
.btn-approve:hover{
    transform:translateY(-1px);
    background:#ecfdf3;
    border-color:rgba(21,128,61,.3);
    box-shadow:0 8px 20px rgba(21,128,61,.12);
}

/* empty */
.empty-state{
    text-align:center;
    padding:4rem 1rem;
    color:var(--text-muted);
    font-size:.92rem;
}
.empty-state i{
    font-size:2.3rem;
    display:block;
    margin-bottom:.65rem;
    color:#c0c8d4;
}

/* pagination */
.pag{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    padding:1rem 1.15rem;
    border-top:1px solid var(--line);
    background:linear-gradient(180deg,#fff,#fbfcfd);
    font-size:.82rem;
    color:var(--text-soft);
}
.pag-links{
    display:flex;
    align-items:center;
    gap:.35rem;
    flex-wrap:wrap;
}
.pag-links a,
.pag-links span{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:34px;
    height:34px;
    padding:0 .55rem;
    border-radius:11px;
    border:1px solid var(--line);
    background:#fff;
    color:var(--text-soft);
    text-decoration:none;
    font-size:.8rem;
    font-weight:800;
    transition:.15s ease;
}
.pag-links a:hover{
    background:var(--accent-soft);
    color:var(--accent);
    border-color:rgba(37,99,235,.18);
}
.pag-links .active{
    background:#111827;
    color:#fff;
    border-color:#111827;
    box-shadow:0 8px 18px rgba(17,24,39,.15);
}

@media (max-width: 900px){
    .page-top{
        flex-direction:column;
        align-items:flex-start;
    }
    .fgroup{
        min-width:100%;
    }
    .fgroup.fgroup-date{
        max-width:none;
    }
    .pag{
        flex-direction:column;
        align-items:flex-start;
    }
}

/* ── Live alert banner ──────────────────────────────────────────── */
#live-alert{
    display:none;
    align-items:center;
    gap:.7rem;
    padding:.85rem 1rem;
    border-radius:16px;
    margin-bottom:1rem;
    font-size:.86rem;
    font-weight:700;
    background:linear-gradient(135deg,#ecfdf3,#f0fdf4);
    border:1px solid rgba(21,128,61,.18);
    color:#15803d;
    box-shadow:0 4px 16px rgba(21,128,61,.08);
    cursor:pointer;
    animation:slideIn .3s ease;
}
#live-alert.show{ display:flex; }
#live-alert .dot{
    width:9px; height:9px;
    border-radius:50%;
    background:#15803d;
    box-shadow:0 0 0 0 rgba(21,128,61,.5);
    animation:pulse 1.4s infinite;
    flex-shrink:0;
}
#live-alert .close-alert{
    margin-left:auto;
    background:none;
    border:none;
    color:#15803d;
    cursor:pointer;
    font-size:1rem;
    line-height:1;
    padding:0;
    opacity:.7;
}
#live-alert .close-alert:hover{ opacity:1; }

/* ── Live Teardown drawer ────────────────────────────────────────── */
.btn-live{
    background:linear-gradient(180deg,#1a3a6b,#112255);
    color:#fff;
    border:none;
    box-shadow:0 6px 18px rgba(17,34,85,.18);
    position:relative;
}
.btn-live:hover{
    transform:translateY(-1px);
    box-shadow:0 10px 24px rgba(17,34,85,.22);
}
.btn-live .live-dot{
    width:8px; height:8px;
    border-radius:50%;
    background:#4ade80;
    box-shadow:0 0 0 0 rgba(74,222,128,.5);
    animation:pulse 1.4s infinite;
    display:inline-block;
}

@keyframes pulse{
    0%   { box-shadow:0 0 0 0 rgba(74,222,128,.6); }
    70%  { box-shadow:0 0 0 7px rgba(74,222,128,0); }
    100% { box-shadow:0 0 0 0 rgba(74,222,128,0); }
}
@keyframes slideIn{
    from{ opacity:0; transform:translateY(-8px); }
    to  { opacity:1; transform:translateY(0); }
}

.drawer-overlay{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(17,24,39,.35);
    z-index:900;
    backdrop-filter:blur(3px);
}
.drawer-overlay.open{ display:block; }

.drawer{
    position:fixed;
    top:0; right:0;
    height:100%;
    width:min(500px,100vw);
    background:#fff;
    z-index:901;
    display:flex;
    flex-direction:column;
    transform:translateX(100%);
    transition:transform .28s cubic-bezier(.4,0,.2,1);
    box-shadow:-18px 0 50px rgba(17,24,39,.12);
}
.drawer.open{ transform:translateX(0); }

.drawer-hd{
    display:flex;
    align-items:center;
    gap:.65rem;
    padding:1.1rem 1.25rem;
    border-bottom:1px solid var(--line);
    background:linear-gradient(180deg,#fff,#f9fafb);
    flex-shrink:0;
}
.drawer-hd-title{
    font-size:.95rem;
    font-weight:900;
    color:var(--text);
    letter-spacing:-.02em;
    flex:1;
}
.drawer-close{
    background:none;
    border:none;
    cursor:pointer;
    font-size:1.15rem;
    color:var(--text-soft);
    line-height:1;
    padding:.3rem;
    border-radius:8px;
    transition:.15s ease;
}
.drawer-close:hover{ background:var(--surface-muted); color:var(--text); }

.drawer-toolbar{
    display:flex;
    align-items:center;
    gap:.6rem;
    padding:.65rem 1.25rem;
    border-bottom:1px solid var(--line);
    background:#fcfcfd;
    flex-shrink:0;
}
.drawer-status{
    font-size:.75rem;
    color:var(--text-muted);
    font-weight:700;
    flex:1;
}
.btn-refresh{
    height:34px;
    padding:0 .8rem;
    border-radius:10px;
    border:1px solid var(--line);
    background:#fff;
    color:var(--text-soft);
    font-size:.78rem;
    font-weight:800;
    font-family:var(--sans);
    cursor:pointer;
    display:inline-flex;
    align-items:center;
    gap:.35rem;
    transition:.15s ease;
}
.btn-refresh:hover{ background:var(--surface-muted); color:var(--text); }

.drawer-body{
    flex:1;
    overflow-y:auto;
    padding:.5rem 0;
}

.log-item{
    padding:.85rem 1.25rem;
    border-bottom:1px solid #f1f4f8;
    transition:background .14s ease;
}
.log-item:hover{ background:#f8fbff; }
.log-item:last-child{ border-bottom:none; }
.log-item.is-new{
    background:linear-gradient(90deg,#f0fdf4,#fff);
    border-left:3px solid #15803d;
    animation:slideIn .35s ease;
}

.log-span{
    font-size:.8rem;
    font-weight:900;
    color:var(--text);
    font-family:var(--mono);
    letter-spacing:.02em;
}
.log-meta{
    display:flex;
    flex-wrap:wrap;
    gap:.4rem .8rem;
    margin-top:.45rem;
}
.log-chip{
    font-size:.69rem;
    font-weight:800;
    color:var(--text-soft);
    background:var(--surface-muted);
    border-radius:6px;
    padding:.18rem .55rem;
    letter-spacing:.02em;
}
.log-chip.cable{ background:#eef4ff; color:#1d4ed8; }
.log-chip.offline{ background:#fff7ed; color:#b45309; }
.log-chip.team{ background:#f5f3ff; color:#6d28d9; }
.log-chip.time{ color:var(--text-muted); background:none; padding:0; }
.log-node{
    font-size:.72rem;
    color:var(--text-soft);
    font-weight:700;
    margin-top:.25rem;
}

.drawer-empty{
    text-align:center;
    padding:3rem 1rem;
    color:var(--text-muted);
    font-size:.88rem;
}
.drawer-empty i{ font-size:2rem; display:block; margin-bottom:.5rem; color:#d0d7e0; }
</style>
@endpush

@php
    $itemStatusMeta = [
        'onfield'           => ['label' => 'On Field',     'cls' => 's-pending'],
        'ready_for_delivery'=> ['label' => 'For Delivery', 'cls' => 's-delivery'],
        'ongoing_delivery'  => ['label' => 'In Transit',   'cls' => 's-transit'],
        'delivered'         => ['label' => 'Delivered',    'cls' => 's-delivered'],
        'delivery_onhold'   => ['label' => 'On Hold',      'cls' => 's-onhold'],
    ];

    $statusPending  = ['submitted_to_pm','pm_for_rework','pm_approved','submitted_to_telcovantage','telcovantage_for_rework'];
    $statusApproved = ['telcovantage_approved','ready_for_delivery','delivered','closed'];
@endphp

<div class="col-span-full rpt-wrap">

    @if(session('success'))
        <div class="flash flash-ok">
            <i class="mgc_check_circle_line"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="flash flash-err">
            <i class="mgc_close_circle_line"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- Live alert banner (shown by JS when new submissions arrive) --}}
    <div id="live-alert" role="alert" onclick="window.location.reload()">
        <span class="dot"></span>
        <span id="live-alert-msg">New daily report submitted — click to refresh.</span>
        <button class="close-alert" onclick="event.stopPropagation(); document.getElementById('live-alert').classList.remove('show');" aria-label="Dismiss">&times;</button>
    </div>

    {{-- Header --}}
    <div class="page-top">
        <div>
            <div class="eyebrow">
                <i class="mgc_file_line"></i>
                Field Reports
            </div>
            <h2 class="page-title">Daily Reports Overview</h2>
            <p class="page-sub">
                Track teardown collection reports submitted by linemen across nodes, projects, and delivery stages.
            </p>
        </div>

        {{-- Live Teardown button --}}
        <button class="btn btn-live" id="open-drawer" type="button" title="Live teardown logs from linemen">
            <span class="live-dot"></span>
            Live Teardown
        </button>
    </div>

    {{-- Filter bar --}}
    <form method="GET" action="{{ route('reports.index') }}">
        <div class="card fbar">
            <div class="fgroup">
                <label>Status</label>
                <select name="status">
                    <option value="">All</option>
                    <option value="pending" @selected(request('status')==='pending')>Pending</option>
                    <option value="approved" @selected(request('status')==='approved')>Approved</option>
                    @foreach($statuses as $val => $lbl)
                        <option value="{{ $val }}" @selected(request('status')===$val)>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>

            <div class="fgroup">
                <label>Project</label>
                <select name="project_id">
                    <option value="">All Projects</option>
                    @foreach($projects as $p)
                        <option value="{{ $p->id }}" @selected(request('project_id')==$p->id)>{{ $p->project_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="fgroup fgroup-date">
                <label>Date From</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}">
            </div>

            <div class="fgroup fgroup-date">
                <label>Date To</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}">
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="mgc_filter_line"></i>
                Filter
            </button>

            @if(request()->hasAny(['status','project_id','date_from','date_to']))
                <a href="{{ route('reports.index') }}" class="btn btn-soft">Clear</a>
            @endif
        </div>
    </form>

    {{-- Table panel --}}
    <div class="card tpanel">
        <div class="tpanel-hd">
            <span class="tpanel-title">
                <i class="mgc_list_check_line"></i>
                Reports
                <span class="tpanel-count">{{ $submissions->total() }}</span>
            </span>

            <a
                href="{{ route('reports.export') }}?{{ http_build_query(request()->only(['status','project_id','date_from','date_to'])) }}"
                class="btn btn-export"
            >
                <i class="mgc_download_2_line"></i>
                Export Excel
            </a>
        </div>

        <div class="table-wrap">
            <table class="rtable">
                <thead>
                    <tr>
                        <th style="width:105px;">Date</th>
                        <th style="width:110px;">Node ID</th>
                        <th style="width:140px;">Node Name</th>
                        <th style="width:90px;">City</th>
                        <th style="width:100px;">Province</th>
                        <th style="width:100px;">Area</th>
                        <th style="width:120px;">Project</th>
                        <th class="num" style="width:85px;">Strand (m)</th>
                        <th class="num" style="width:85px;">Cable (m)</th>
                        <th class="num" style="width:80px;">Amplifiers</th>
                        <th class="num" style="width:80px;">Extenders</th>
                        <th class="num" style="width:70px;">Nodes</th>
                        <th class="num" style="width:70px;">TSC</th>
                        <th style="width:120px;">Item Status</th>
                        <th style="width:130px;">Submitted By</th>
                        <th style="width:130px;">Approved By</th>
                        <th style="width:120px; text-align:center;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($submissions as $sub)
                        @php
                            $node = $sub->node;
                            $proj = $sub->project;
                            $isApproved = in_array($sub->status, $statusApproved);

                            $submittedBy = is_numeric($sub->submitted_by)
                                ? ($userNameMap[$sub->submitted_by] ?? "User #{$sub->submitted_by}")
                                : $sub->submitted_by;

                            $approvedBy = is_numeric($sub->telcovantage_reviewed_by)
                                ? ($userNameMap[$sub->telcovantage_reviewed_by] ?? "User #{$sub->telcovantage_reviewed_by}")
                                : $sub->telcovantage_reviewed_by;

                            $canApprove = !$isApproved && in_array($sub->status, [
                                'submitted_to_pm',
                                'pm_approved',
                                'submitted_to_telcovantage',
                                'pm_for_rework',
                                'telcovantage_for_rework'
                            ]);

                            $ism = $itemStatusMeta[$sub->item_status] ?? null;

                            $numFmt = fn($v) => ($v > 0) ? number_format((float)$v, $v == floor($v) ? 0 : 1) : null;

                            $strandKey = $sub->node_id . '_' . \Carbon\Carbon::parse($sub->report_date)->toDateString();
                            $totalStrand = $strandMap[$strandKey] ?? 0;
                        @endphp

                        <tr style="cursor:pointer;" onclick="window.location='{{ route('reports.show', $sub) }}'">

                            {{-- Date --}}
                            <td>
                                <div class="date-main">
                                    {{ \Carbon\Carbon::parse($sub->report_date)->format('M d, Y') }}
                                </div>
                                <div class="date-sub">
                                    {{ \Carbon\Carbon::parse($sub->report_date)->format('l') }}
                                </div>
                            </td>

                            {{-- Node ID --}}
                            <td class="node-id">
                                {{ $node?->node_id ?? '—' }}
                            </td>

                            {{-- Node Name --}}
                            <td class="node-name">
                                {{ $node?->node_name ?? '—' }}
                            </td>

                            {{-- City --}}
                            <td class="cell-strong">
                                {{ $node?->city ?: '—' }}
                            </td>

                            {{-- Province --}}
                            <td class="cell-soft">
                                {{ $node?->province ?: '—' }}
                            </td>

                            {{-- Area --}}
                            <td class="cell-soft">
                                {{ $node?->area ?? $node?->sites ?? $node?->region ?? '—' }}
                            </td>

                            {{-- Project --}}
                            <td class="cell-soft">
                                {{ $proj?->project_name ?? '—' }}
                            </td>

                            {{-- Strand --}}
                            @if($totalStrand > 0)
                                <td class="num">{{ $numFmt($totalStrand) }}</td>
                            @else
                                <td class="num-zero">—</td>
                            @endif

                            {{-- Cable --}}
                            @if($numFmt($sub->total_cable))
                                <td class="num">{{ $numFmt($sub->total_cable) }}</td>
                            @else
                                <td class="num-zero">—</td>
                            @endif

                            {{-- Amplifiers --}}
                            @if($sub->total_amplifier > 0)
                                <td class="num">{{ $sub->total_amplifier }}</td>
                            @else
                                <td class="num-zero">—</td>
                            @endif

                            {{-- Extenders --}}
                            @if($sub->total_extender > 0)
                                <td class="num">{{ $sub->total_extender }}</td>
                            @else
                                <td class="num-zero">—</td>
                            @endif

                            {{-- Nodes --}}
                            @if($sub->total_node > 0)
                                <td class="num">{{ $sub->total_node }}</td>
                            @else
                                <td class="num-zero">—</td>
                            @endif

                            {{-- TSC --}}
                            @if($sub->total_tsc > 0)
                                <td class="num">{{ $sub->total_tsc }}</td>
                            @else
                                <td class="num-zero">—</td>
                            @endif

                            {{-- Item Status --}}
                            <td>
                                @if($ism)
                                    <span class="badge {{ $ism['cls'] }}">{{ strtoupper($ism['label']) }}</span>
                                @else
                                    <span class="by-empty">—</span>
                                @endif
                            </td>

                            {{-- Submitted By --}}
                            <td>
                                @if($submittedBy)
                                    <span class="by-pill">{{ strtoupper($submittedBy) }}</span>
                                @else
                                    <span class="by-empty">—</span>
                                @endif
                            </td>

                            {{-- Approved By --}}
                            <td>
                                @if($approvedBy)
                                    <span class="by-pill">{{ strtoupper($approvedBy) }}</span>
                                @else
                                    <span class="by-empty">—</span>
                                @endif
                            </td>

                            {{-- Action --}}
                            <td style="text-align:center;" onclick="event.stopPropagation()">
                                @if($canApprove)
                                    <form method="POST" action="{{ route('reports.approve', $sub) }}">
                                        @csrf
                                        <button type="submit" class="btn-approve">
                                            <i class="mgc_check_line"></i>
                                            Approve
                                        </button>
                                    </form>
                                @elseif($isApproved)
                                    <span class="badge s-approved">✓ Approved</span>
                                @else
                                    <span class="by-empty">—</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="17">
                                <div class="empty-state">
                                    <i class="mgc_file_line"></i>
                                    No daily reports found
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($submissions->hasPages())
            <div class="pag">
                <span>
                    Showing {{ $submissions->firstItem() }}–{{ $submissions->lastItem() }} of {{ $submissions->total() }}
                </span>

                <div class="pag-links">
                    @if($submissions->onFirstPage())
                        <span style="opacity:.4;">‹</span>
                    @else
                        <a href="{{ $submissions->previousPageUrl() }}">‹</a>
                    @endif

                    @foreach($submissions->getUrlRange(max(1,$submissions->currentPage()-2), min($submissions->lastPage(),$submissions->currentPage()+2)) as $page => $url)
                        @if($page == $submissions->currentPage())
                            <span class="active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($submissions->hasMorePages())
                        <a href="{{ $submissions->nextPageUrl() }}">›</a>
                    @else
                        <span style="opacity:.4;">›</span>
                    @endif
                </div>
            </div>
        @endif
    </div>

</div>

{{-- ── Live Teardown Drawer ──────────────────────────────────────────── --}}
<div class="drawer-overlay" id="drawer-overlay"></div>
<div class="drawer" id="teardown-drawer" role="dialog" aria-label="Live Teardown Feed">

    <div class="drawer-hd">
        <span class="live-dot" style="flex-shrink:0;"></span>
        <span class="drawer-hd-title">Live Teardown Feed</span>
        <button class="drawer-close" id="close-drawer" aria-label="Close">&times;</button>
    </div>

    <div class="drawer-toolbar">
        <span class="drawer-status" id="drawer-status">Loading…</span>
        <button class="btn-refresh" id="refresh-drawer" type="button">
            <i class="mgc_refresh_1_line"></i>
            Refresh
        </button>
    </div>

    <div class="drawer-body" id="drawer-body">
        <div class="drawer-empty">
            <i class="mgc_loading_3_line"></i>
            Fetching logs…
        </div>
    </div>
</div>

@push('scripts')
<script>
(function () {
    'use strict';

    // ── Routes (Blade-rendered) ─────────────────────────────────────────────
    const FEED_URL  = '{{ route('reports.live-teardown-feed') }}';
    const ALERT_URL = '{{ route('reports.new-submissions-count') }}';

    // ── Helpers ─────────────────────────────────────────────────────────────
    function fmt(dt) {
        if (!dt) return '—';
        const d = new Date(dt);
        return d.toLocaleString('en-PH', { month:'short', day:'numeric', hour:'2-digit', minute:'2-digit' });
    }

    function elapsedLabel(dt) {
        if (!dt) return '';
        const diff = Math.floor((Date.now() - new Date(dt)) / 1000);
        if (diff < 60)  return diff + 's ago';
        if (diff < 3600) return Math.floor(diff/60) + 'm ago';
        if (diff < 86400) return Math.floor(diff/3600) + 'h ago';
        return Math.floor(diff/86400) + 'd ago';
    }

    function buildLogHTML(log, isNew) {
        const from    = log.from_pole || '?';
        const to      = log.to_pole   || '?';
        const spanTxt = log.span_code ? log.span_code : `${from} → ${to}`;
        const nodeTxt = [log.node_id, log.node_name].filter(Boolean).join(' — ');
        const cableTxt = log.cable ? log.cable.toFixed(1) + ' m cable' : '';
        const teamTxt  = log.team || log.submitted_by || '';
        const timeTxt  = elapsedLabel(log.created_at);
        const offline  = log.offline_mode ? '<span class="log-chip offline">Offline</span>' : '';

        return `<div class="log-item${isNew ? ' is-new' : ''}">
            <div class="log-span">${spanTxt}</div>
            <div class="log-node">${nodeTxt}</div>
            <div class="log-meta">
                ${cableTxt ? `<span class="log-chip cable">${cableTxt}</span>` : ''}
                ${teamTxt  ? `<span class="log-chip team">${teamTxt}</span>` : ''}
                ${offline}
                <span class="log-chip time">${timeTxt}</span>
            </div>
        </div>`;
    }

    // ── Drawer state ────────────────────────────────────────────────────────
    let knownIds    = new Set();
    let serverNow   = null;
    let drawerOpen  = false;
    let loading     = false;

    async function fetchFeed(since) {
        let url = FEED_URL;
        if (since) url += '?since=' + encodeURIComponent(since);
        const r = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
        if (!r.ok) throw new Error('HTTP ' + r.status);
        return r.json();
    }

    async function loadDrawer() {
        if (loading) return;
        loading = true;
        document.getElementById('drawer-status').textContent = 'Refreshing…';
        try {
            const data = await fetchFeed(null);
            serverNow = data.server_now;
            const logs = data.logs;

            const body = document.getElementById('drawer-body');
            if (!logs.length) {
                body.innerHTML = '<div class="drawer-empty"><i class="mgc_file_line"></i>No teardown logs yet.</div>';
            } else {
                const html = logs.map(log => {
                    const isNew = !knownIds.has(log.id);
                    knownIds.add(log.id);
                    return buildLogHTML(log, isNew);
                }).join('');
                body.innerHTML = html;
            }
            document.getElementById('drawer-status').textContent =
                'Updated ' + fmt(serverNow) + ' · ' + logs.length + ' log' + (logs.length !== 1 ? 's' : '');
        } catch (e) {
            document.getElementById('drawer-status').textContent = 'Failed to load';
        }
        loading = false;
    }

    // ── Drawer open/close ───────────────────────────────────────────────────
    document.getElementById('open-drawer').addEventListener('click', function () {
        document.getElementById('teardown-drawer').classList.add('open');
        document.getElementById('drawer-overlay').classList.add('open');
        drawerOpen = true;
        loadDrawer();
    });

    function closeDrawer() {
        document.getElementById('teardown-drawer').classList.remove('open');
        document.getElementById('drawer-overlay').classList.remove('open');
        drawerOpen = false;
    }

    document.getElementById('close-drawer').addEventListener('click', closeDrawer);
    document.getElementById('drawer-overlay').addEventListener('click', closeDrawer);
    document.getElementById('refresh-drawer').addEventListener('click', function () {
        knownIds.clear();
        loadDrawer();
    });

    // ── Auto-refresh drawer every 30 s when open ────────────────────────────
    setInterval(function () {
        if (drawerOpen) loadDrawer();
    }, 30000);

    // ── Live alert: poll for new submissions every 45 s ─────────────────────
    let alertSince = new Date().toISOString().replace('T', ' ').slice(0, 19);

    async function pollAlerts() {
        try {
            const url = ALERT_URL + '?since=' + encodeURIComponent(alertSince);
            const r   = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            if (!r.ok) return;
            const data = await r.json();
            if (data.count > 0) {
                const n = data.count;
                document.getElementById('live-alert-msg').textContent =
                    n + ' new daily report' + (n > 1 ? 's' : '') + ' submitted — click to refresh.';
                document.getElementById('live-alert').classList.add('show');
            }
            alertSince = data.server_now || alertSince;
        } catch (_) { /* silent */ }
    }

    setInterval(pollAlerts, 45000);
})();
</script>
@endpush

</x-layout>