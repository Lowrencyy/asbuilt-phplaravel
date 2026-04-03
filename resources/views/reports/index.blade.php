<x-layout>

@push('styles')
<style>
*, *::before, *::after { box-sizing: border-box; }

:root{
    --bg:#f3f6fb;
    --surface:#ffffff;
    --surface-2:#f8fafc;
    --surface-3:#eef2f7;

    --line:#e3e8ef;
    --line-strong:#d4dce6;

    --text:#0f172a;
    --text-soft:#5b6474;
    --text-muted:#8b97a8;

    --primary:#0f172a;
    --accent:#1d4ed8;
    --accent-soft:rgba(29,78,216,.08);

    --success:#15803d;
    --success-bg:#ecfdf3;
    --warning:#a16207;
    --warning-bg:#fff7ed;
    --danger:#b42318;
    --danger-bg:#fef2f2;
    --violet:#6d28d9;
    --violet-bg:#f5f3ff;

    --radius-xl:18px;
    --radius-lg:16px;
    --radius-md:12px;
    --radius-sm:10px;

    --shadow-sm:0 1px 3px rgba(15,23,42,.04);
    --shadow-md:0 10px 24px rgba(15,23,42,.05);

    --mono:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
    --sans:"Plus Jakarta Sans","Manrope","Segoe UI",sans-serif;
}

body{
    font-family:var(--sans);
    background:var(--bg);
    color:var(--text);
}

.rpt-wrap{
    padding:1.15rem 1.15rem 2rem;
}

/* flash */
.flash{
    display:flex;
    align-items:center;
    gap:.6rem;
    padding:.9rem 1rem;
    border-radius:14px;
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

/* live alert */
#live-alert{
    display:none;
    align-items:center;
    gap:.65rem;
    padding:.85rem 1rem;
    border-radius:14px;
    margin-bottom:1rem;
    font-size:.85rem;
    font-weight:700;
    background:linear-gradient(135deg,#ecfdf3,#f0fdf4);
    border:1px solid rgba(21,128,61,.18);
    color:#15803d;
    box-shadow:0 4px 16px rgba(21,128,61,.08);
    cursor:pointer;
    animation:slideIn .25s ease;
}
#live-alert.show{ display:flex; }
#live-alert .dot{
    width:9px;
    height:9px;
    border-radius:50%;
    background:#22c55e;
    box-shadow:0 0 0 0 rgba(34,197,94,.45);
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

/* page hero */
.page-hero{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:1rem;
    margin-bottom:1rem;
}

.hero-copy{
    min-width:0;
}

.eyebrow{
    display:inline-flex;
    align-items:center;
    gap:.45rem;
    padding:.38rem .72rem;
    border:1px solid var(--line);
    border-radius:999px;
    background:#fff;
    box-shadow:var(--shadow-sm);
    font-size:.65rem;
    font-weight:900;
    letter-spacing:.13em;
    text-transform:uppercase;
    color:var(--text-soft);
    margin-bottom:.8rem;
}
.eyebrow::before{
    content:"";
    width:8px;
    height:8px;
    border-radius:999px;
    background:var(--accent);
    box-shadow:0 0 0 4px rgba(29,78,216,.08);
}

.page-title{
    margin:0;
    font-size:clamp(1.6rem,2vw,2.2rem);
    line-height:1.05;
    font-weight:900;
    letter-spacing:-.04em;
    color:var(--text);
}

.page-sub{
    margin:.45rem 0 0;
    color:var(--text-soft);
    font-size:.93rem;
    line-height:1.6;
    max-width:760px;
}

.hero-actions{
    display:flex;
    align-items:center;
    gap:.65rem;
    flex-wrap:wrap;
    flex-shrink:0;
}

/* buttons */
.btn{
    height:42px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:.45rem;
    padding:0 1rem;
    border-radius:12px;
    border:1px solid transparent;
    text-decoration:none;
    font-size:.86rem;
    font-weight:800;
    font-family:var(--sans);
    white-space:nowrap;
    cursor:pointer;
    transition:.18s ease;
}
.btn:focus{ outline:none; }

.btn-primary{
    background:#0f172a;
    color:#fff;
    box-shadow:0 10px 20px rgba(15,23,42,.12);
}
.btn-primary:hover{
    transform:translateY(-1px);
}

.btn-soft{
    background:#fff;
    color:var(--text-soft);
    border-color:var(--line);
}
.btn-soft:hover{
    background:var(--surface-2);
    color:var(--text);
}

.btn-export{
    background:#fff;
    border:1px solid var(--line);
    color:var(--text);
}
.btn-export:hover{
    background:var(--surface-2);
    border-color:var(--line-strong);
}

.btn-live{
    background:linear-gradient(180deg,#1d4ed8,#1e3a8a);
    color:#fff;
    border:none;
    box-shadow:0 8px 18px rgba(29,78,216,.18);
}
.btn-live:hover{
    transform:translateY(-1px);
}
.btn-live .live-dot{
    width:8px;
    height:8px;
    border-radius:50%;
    background:#4ade80;
    box-shadow:0 0 0 0 rgba(74,222,128,.5);
    animation:pulse 1.4s infinite;
    display:inline-block;
}

/* stat cards */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(4, minmax(0,1fr));
    gap:.85rem;
    margin-bottom:1rem;
}
.stat-card{
    background:var(--surface);
    border:1px solid var(--line);
    border-radius:16px;
    box-shadow:var(--shadow-sm);
    padding:1rem 1rem .9rem;
}
.stat-label{
    font-size:.68rem;
    font-weight:900;
    letter-spacing:.12em;
    text-transform:uppercase;
    color:var(--text-muted);
    margin-bottom:.45rem;
}
.stat-value{
    font-size:1.45rem;
    line-height:1;
    font-weight:900;
    letter-spacing:-.04em;
    color:var(--text);
}
.stat-sub{
    margin-top:.35rem;
    font-size:.78rem;
    color:var(--text-soft);
    font-weight:700;
}

/* card */
.card{
    background:var(--surface);
    border:1px solid var(--line);
    border-radius:var(--radius-xl);
    box-shadow:var(--shadow-md);
}

/* filters */
.filter-card{
    padding:1rem;
    margin-bottom:1rem;
}
.filter-grid{
    display:grid;
    grid-template-columns:2fr 2fr 1fr 1fr auto auto;
    gap:.8rem;
    align-items:end;
}
.fgroup label{
    display:block;
    margin-bottom:.45rem;
    font-size:.66rem;
    font-weight:900;
    text-transform:uppercase;
    letter-spacing:.12em;
    color:var(--text-muted);
}
.fgroup select,
.fgroup input[type="date"]{
    width:100%;
    height:44px;
    padding:0 .9rem;
    border:1px solid var(--line);
    border-radius:12px;
    background:#fff;
    color:var(--text);
    font-size:.9rem;
    font-family:var(--sans);
    outline:none;
    transition:.18s ease;
}
.fgroup select:hover,
.fgroup input[type="date"]:hover{
    border-color:var(--line-strong);
}
.fgroup select:focus,
.fgroup input[type="date"]:focus{
    border-color:rgba(29,78,216,.35);
    box-shadow:0 0 0 4px rgba(29,78,216,.08);
}

/* table panel */
.tpanel{
    overflow:hidden;
}
.tpanel-hd{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    padding:.95rem 1rem;
    border-bottom:1px solid var(--line);
    background:var(--surface);
}
.tpanel-title{
    display:flex;
    align-items:center;
    gap:.65rem;
    font-size:.95rem;
    font-weight:900;
    color:var(--text);
}
.tpanel-count{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:30px;
    height:30px;
    padding:0 .65rem;
    border-radius:999px;
    background:#eef2ff;
    color:#3730a3;
    font-size:.76rem;
    font-weight:900;
    border:1px solid #dbe4ff;
}

.table-wrap{
    overflow:auto;
    background:#fff;
    position:relative;
}

.rtable{
    width:100%;
    min-width:1720px;
    border-collapse:separate;
    border-spacing:0;
    table-layout:fixed;
}

.rtable col.date      { width:130px; }
.rtable col.nodeid    { width:120px; }
.rtable col.nodename  { width:190px; }
.rtable col.city      { width:140px; }
.rtable col.province  { width:130px; }
.rtable col.area      { width:130px; }
.rtable col.project   { width:180px; }
.rtable col.numcol    { width:95px; }
.rtable col.item      { width:145px; }
.rtable col.user      { width:155px; }
.rtable col.action    { width:140px; }

.rtable thead th{
    position:sticky;
    top:0;
    z-index:6;
    padding:.9rem .85rem;
    text-align:left;
    font-size:.66rem;
    font-weight:900;
    text-transform:uppercase;
    letter-spacing:.12em;
    color:var(--text-muted);
    background:#f8fafc;
    border-bottom:1px solid var(--line-strong);
    white-space:nowrap;
}
.rtable thead th.num{ text-align:right; }

.rtable tbody tr{
    transition:background .14s ease;
}
.rtable tbody tr:nth-child(even){
    background:#fbfcfe;
}
.rtable tbody tr:hover{
    background:#f7faff;
}
.rtable tbody td{
    padding:.95rem .85rem;
    border-bottom:1px solid #eef2f7;
    vertical-align:middle;
    font-size:.87rem;
    color:var(--text);
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
    background:#fff;
}
.rtable tbody tr:nth-child(even) td{
    background:#fbfcfe;
}
.rtable tbody tr:hover td{
    background:#f7faff;
}
.rtable tbody tr:last-child td{
    border-bottom:none;
}
.rtable tbody td.num{
    text-align:right;
    font-family:var(--mono);
    font-weight:900;
    color:var(--text);
    font-size:.82rem;
    font-variant-numeric:tabular-nums;
}
.rtable tbody td.num-zero{
    text-align:right;
    font-family:var(--mono);
    color:#b0b8c4;
    font-size:.82rem;
    font-variant-numeric:tabular-nums;
}

/* sticky cols */
.rtable th.sticky-1,
.rtable td.sticky-1{
    position:sticky;
    left:0;
}
.rtable th.sticky-2,
.rtable td.sticky-2{
    position:sticky;
    left:130px;
}
.rtable th.sticky-3,
.rtable td.sticky-3{
    position:sticky;
    left:250px;
}

.rtable thead th.sticky-1,
.rtable thead th.sticky-2,
.rtable thead th.sticky-3{
    z-index:7;
    background:#f8fafc;
}

.rtable tbody td.sticky-1,
.rtable tbody td.sticky-2,
.rtable tbody td.sticky-3{
    z-index:3;
}

.rtable tbody tr:nth-child(odd) td.sticky-1,
.rtable tbody tr:nth-child(odd) td.sticky-2,
.rtable tbody tr:nth-child(odd) td.sticky-3{
    background:#fff;
}
.rtable tbody tr:nth-child(even) td.sticky-1,
.rtable tbody tr:nth-child(even) td.sticky-2,
.rtable tbody tr:nth-child(even) td.sticky-3{
    background:#fbfcfe;
}
.rtable tbody tr:hover td.sticky-1,
.rtable tbody tr:hover td.sticky-2,
.rtable tbody tr:hover td.sticky-3{
    background:#f7faff;
}

.rtable th.sticky-1,
.rtable td.sticky-1,
.rtable th.sticky-2,
.rtable td.sticky-2,
.rtable th.sticky-3,
.rtable td.sticky-3{
    box-shadow:1px 0 0 #eef2f7;
}

/* cells */
.date-main{
    font-family:var(--mono);
    font-size:.79rem;
    font-weight:900;
    color:var(--text);
}
.date-sub{
    margin-top:.14rem;
    font-size:.71rem;
    color:var(--text-muted);
}
.node-id{
    font-family:var(--mono);
    font-weight:900;
    color:var(--text);
}
.node-name{
    color:var(--text);
    font-weight:800;
    transition:.16s ease;
}
.node-name:hover{
    color:var(--accent);
    text-decoration:underline;
}
.cell-strong{
    color:var(--text);
    font-weight:800;
    transition:.16s ease;
}
.cell-strong:hover{
    color:var(--accent);
    text-decoration:underline;
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
    max-width:100%;
    min-height:32px;
    padding:.34rem .72rem;
    border-radius:999px;
    background:#f8fafc;
    border:1px solid var(--line);
    color:var(--text);
    font-size:.73rem;
    font-weight:800;
    letter-spacing:.02em;
    overflow:hidden;
    text-overflow:ellipsis;
}
.by-empty{
    color:var(--text-muted);
    font-size:.78rem;
}

/* approve */
.btn-approve{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:.35rem;
    min-height:36px;
    padding:0 .9rem;
    border-radius:10px;
    border:1px solid rgba(21,128,61,.18);
    background:linear-gradient(180deg,#f5fff8,#ecfdf3);
    color:var(--success);
    font-size:.76rem;
    font-weight:900;
    font-family:var(--sans);
    cursor:pointer;
    transition:.16s ease;
    box-shadow:0 4px 14px rgba(21,128,61,.08);
}
.btn-approve:hover{
    transform:translateY(-1px);
    border-color:rgba(21,128,61,.28);
}

/* empty */
.empty-state{
    text-align:center;
    padding:3.5rem 1rem;
    color:var(--text-muted);
    font-size:.92rem;
}
.empty-state i{
    font-size:2rem;
    display:block;
    margin-bottom:.6rem;
    color:#c0c8d4;
}

/* pagination */
.pag{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    padding:.95rem 1rem;
    border-top:1px solid var(--line);
    background:#fff;
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
    border-radius:10px;
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
    border-color:rgba(29,78,216,.18);
}
.pag-links .active{
    background:#0f172a;
    color:#fff;
    border-color:#0f172a;
}

/* drawer */
.drawer-overlay{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(15,23,42,.35);
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
    box-shadow:-18px 0 50px rgba(15,23,42,.12);
}
.drawer.open{ transform:translateX(0); }

.drawer-hd{
    display:flex;
    align-items:center;
    gap:.65rem;
    padding:1rem 1.1rem;
    border-bottom:1px solid var(--line);
    background:#fff;
    flex-shrink:0;
}
.drawer-hd-title{
    font-size:.94rem;
    font-weight:900;
    color:var(--text);
    flex:1;
}
.drawer-close{
    background:none;
    border:none;
    cursor:pointer;
    font-size:1.15rem;
    color:var(--text-soft);
    line-height:1;
    padding:.25rem;
    border-radius:8px;
}
.drawer-close:hover{
    background:var(--surface-3);
    color:var(--text);
}

.drawer-toolbar{
    display:flex;
    align-items:center;
    gap:.6rem;
    padding:.65rem 1.1rem;
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
}
.btn-refresh:hover{
    background:var(--surface-3);
    color:var(--text);
}

.drawer-body{
    flex:1;
    overflow-y:auto;
    padding:.5rem 0;
}
.log-item{
    padding:.85rem 1.1rem;
    border-bottom:1px solid #f1f4f8;
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
    background:var(--surface-3);
    border-radius:6px;
    padding:.18rem .55rem;
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
.drawer-empty i{
    font-size:2rem;
    display:block;
    margin-bottom:.5rem;
    color:#d0d7e0;
}

@keyframes pulse{
    0%   { box-shadow:0 0 0 0 rgba(74,222,128,.6); }
    70%  { box-shadow:0 0 0 7px rgba(74,222,128,0); }
    100% { box-shadow:0 0 0 0 rgba(74,222,128,0); }
}
@keyframes slideIn{
    from{ opacity:0; transform:translateY(-8px); }
    to{ opacity:1; transform:translateY(0); }
}

@media (max-width: 1200px){
    .filter-grid{
        grid-template-columns:1fr 1fr 1fr 1fr;
    }
}
@media (max-width: 900px){
    .page-hero{
        flex-direction:column;
        align-items:flex-start;
    }
    .hero-actions{
        width:100%;
    }
    .stats-grid{
        grid-template-columns:1fr 1fr;
    }
    .filter-grid{
        grid-template-columns:1fr;
    }
    .pag{
        flex-direction:column;
        align-items:flex-start;
    }
}

/* ── Live Map button ───────────────────────────────────────── */
.btn-livemap{
    height:42px;
    display:inline-flex;align-items:center;gap:.45rem;
    padding:0 1rem;border-radius:12px;
    background:#111827;color:#fff;border:none;
    font-size:.86rem;font-weight:800;font-family:var(--sans);
    cursor:pointer;box-shadow:0 4px 14px rgba(17,24,39,.18);
    transition:background .14s,transform .14s;
    white-space:nowrap;
}
.btn-livemap:hover{ background:#1f2937;transform:translateY(-1px); }
.btn-livemap .lm-dot{
    width:8px;height:8px;border-radius:50%;background:#22c55e;
    box-shadow:0 0 0 0 rgba(34,197,94,.5);
    animation:livepulse 1.4s infinite;flex-shrink:0;
}
@keyframes livepulse{
    0%  { box-shadow:0 0 0 0 rgba(34,197,94,.6); }
    70% { box-shadow:0 0 0 8px rgba(34,197,94,0); }
    100%{ box-shadow:0 0 0 0 rgba(34,197,94,0); }
}

/* ── Live Map full-screen overlay ──────────────────────────── */
#liveMapOverlay{
    position:fixed;inset:0;z-index:1200;
    background:#0f172a;
    display:flex;flex-direction:column;
    opacity:0;pointer-events:none;
    transition:opacity .22s;
}
#liveMapOverlay.open{ opacity:1;pointer-events:all; }

.lmo-hd{
    display:flex;align-items:center;gap:.75rem;
    padding:.75rem 1.1rem;
    background:#111827;border-bottom:1px solid #1e293b;
    flex-shrink:0;
}
.lmo-title{
    font-size:.92rem;font-weight:900;color:#f1f5f9;
    display:flex;align-items:center;gap:.5rem;
}
.lmo-count{
    font-size:.72rem;font-weight:800;
    background:#1e293b;border:1px solid #334155;color:#94a3b8;
    padding:.2rem .55rem;border-radius:999px;
}
.lmo-last-sync{ font-size:.69rem;color:#475569;margin-left:.5rem;font-weight:600; }
.lmo-close{
    margin-left:auto;width:34px;height:34px;border-radius:10px;
    background:#1e293b;border:1px solid #334155;color:#94a3b8;
    display:inline-flex;align-items:center;justify-content:center;
    cursor:pointer;font-size:1rem;transition:all .14s;
}
.lmo-close:hover{ background:#dc2626;border-color:#dc2626;color:#fff; }

.lmo-legend{
    display:flex;align-items:center;gap:1rem;
    padding:.5rem 1.1rem;background:#0f172a;border-bottom:1px solid #1e293b;
    flex-shrink:0;flex-wrap:wrap;
}
.legend-item{
    display:inline-flex;align-items:center;gap:.35rem;
    font-size:.68rem;font-weight:700;color:#64748b;
}
.legend-dot{ width:10px;height:10px;border-radius:50%;flex-shrink:0; }

.lmo-body{ flex:1;min-height:0;display:flex; }
.lmo-sidebar{
    width:260px;flex-shrink:0;
    background:#0f172a;border-right:1px solid #1e293b;
    display:flex;flex-direction:column;overflow:hidden;
}
.lmo-sb-search-wrap{ padding:.6rem .75rem;border-bottom:1px solid #1e293b;flex-shrink:0; }
.lmo-sb-search{
    width:100%;box-sizing:border-box;
    background:#1e293b;border:1px solid #334155;border-radius:8px;
    color:#f1f5f9;font-size:.78rem;padding:.42rem .65rem;outline:none;
    font-family:var(--sans);
}
.lmo-sb-search::placeholder{ color:#475569; }
.lmo-sb-search:focus{ border-color:#3b82f6; }
.lmo-sb-list{ flex:1;overflow-y:auto;padding:.4rem; }
.lmo-sb-list::-webkit-scrollbar{ width:4px; }
.lmo-sb-list::-webkit-scrollbar-thumb{ background:#1e293b;border-radius:4px; }
.lmo-sb-item{
    display:flex;align-items:center;gap:.6rem;
    padding:.55rem .65rem;border-radius:10px;
    cursor:pointer;transition:background .13s;
    border:1px solid transparent;margin-bottom:.25rem;
}
.lmo-sb-item:hover{ background:#1e293b;border-color:#334155; }
.lmo-sb-item.active{ background:#1e3a5f;border-color:#2563eb; }
.lmo-sb-avatar{
    width:34px;height:34px;border-radius:50%;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;
    font-size:.66rem;font-weight:900;color:#fff;border:2px solid transparent;
}
.lmo-sb-info{ flex:1;min-width:0; }
.lmo-sb-name{ font-size:.78rem;font-weight:800;color:#f1f5f9;white-space:nowrap;overflow:hidden;text-overflow:ellipsis; }
.lmo-sb-meta{ font-size:.65rem;color:#64748b;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis; }
.lmo-sb-status{ width:8px;height:8px;border-radius:50%;flex-shrink:0; }
.lmo-sb-empty{ color:#475569;font-size:.76rem;text-align:center;padding:2rem 1rem;font-weight:600; }

#rpt-liveMapEl{ flex:1;min-height:0; }

.lm-avatar-wrap{ display:flex;flex-direction:column;align-items:center;gap:2px;cursor:pointer; }
.lm-avatar{
    width:38px;height:38px;border-radius:50%;border:3px solid #fff;
    display:flex;align-items:center;justify-content:center;
    font-size:.7rem;font-weight:900;color:#fff;
    box-shadow:0 3px 12px rgba(0,0,0,.35);overflow:hidden;position:relative;
}
.lm-avatar img{ width:100%;height:100%;object-fit:cover; }
.lm-avatar-initials{ font-size:.72rem;font-weight:900;letter-spacing:-.02em; }
.lm-avatar-pulse{
    position:absolute;inset:-3px;border-radius:50%;
    border:3px solid currentColor;animation:avatarpulse 2s infinite;opacity:.5;
}
@keyframes avatarpulse{
    0%  {transform:scale(1);opacity:.5;}
    70% {transform:scale(1.35);opacity:0;}
    100%{transform:scale(1);opacity:0;}
}
.lm-name-tag{
    background:rgba(15,23,42,.82);color:#f1f5f9;
    padding:.15rem .45rem;border-radius:6px;
    font-size:.62rem;font-weight:800;white-space:nowrap;
    backdrop-filter:blur(4px);
    max-width:120px;overflow:hidden;text-overflow:ellipsis;
}
</style>
<link rel="stylesheet" href="/assets/libs/leaflet/leaflet.css"/>
@endpush

@php
    $itemStatusMeta = [
        'onfield'            => ['label' => 'On Field',     'cls' => 's-pending'],
        'ready_for_delivery' => ['label' => 'For Delivery', 'cls' => 's-delivery'],
        'ongoing_delivery'   => ['label' => 'In Transit',   'cls' => 's-transit'],
        'delivered'          => ['label' => 'Delivered',    'cls' => 's-delivered'],
        'delivery_onhold'    => ['label' => 'On Hold',      'cls' => 's-onhold'],
    ];

    $statusPending  = ['submitted_to_pm','pm_for_rework','pm_approved','submitted_to_telcovantage','telcovantage_for_rework'];
    $statusApproved = ['telcovantage_approved','ready_for_delivery','delivered','closed'];

    $pendingCount = $submissions->getCollection()->filter(fn($s) => in_array($s->status, $statusPending))->count();
    $approvedCount = $submissions->getCollection()->filter(fn($s) => in_array($s->status, $statusApproved))->count();
    $deliveredCount = $submissions->getCollection()->filter(fn($s) => $s->item_status === 'delivered')->count();
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

    <div id="live-alert" role="alert" onclick="window.location.reload()">
        <span class="dot"></span>
        <span id="live-alert-msg">New daily report submitted — click to refresh.</span>
        <button class="close-alert" onclick="event.stopPropagation(); document.getElementById('live-alert').classList.remove('show');" aria-label="Dismiss">&times;</button>
    </div>

    <div class="page-hero">
        <div class="hero-copy">
            <div class="eyebrow">
                <i class="mgc_file_line"></i>
                Field Reports
            </div>
            <h2 class="page-title">Daily Reports Overview</h2>
            <p class="page-sub">
                Track teardown collection reports submitted by linemen across nodes, projects, and delivery stages.
            </p>
        </div>

        <div class="hero-actions">
            <button class="btn-livemap" id="openLiveMap">
                <span class="lm-dot"></span>
                <i class="mgc_map_line"></i> Live Map
            </button>

            <a class="btn btn-live" href="{{ route('reports.teardown-logs.index') }}" title="Live teardown logs from linemen">
                <span class="live-dot"></span>
                Live Teardown
            </a>

            <a
                href="{{ route('reports.export') }}?{{ http_build_query(request()->only(['status','project_id','date_from','date_to'])) }}"
                class="btn btn-export"
            >
                <i class="mgc_download_2_line"></i>
                Export Excel
            </a>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Reports</div>
            <div class="stat-value">{{ $submissions->total() }}</div>
            <div class="stat-sub">Current results shown</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Pending</div>
            <div class="stat-value">{{ $pendingCount }}</div>
            <div class="stat-sub">Needs review or action</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Approved</div>
            <div class="stat-value">{{ $approvedCount }}</div>
            <div class="stat-sub">Approved workflow items</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Delivered</div>
            <div class="stat-value">{{ $deliveredCount }}</div>
            <div class="stat-sub">Completed delivery status</div>
        </div>
    </div>

    <form method="GET" action="{{ route('reports.index') }}">
        <div class="card filter-card">
            <div class="filter-grid">
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

                <div class="fgroup">
                    <label>Date From</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}">
                </div>

                <div class="fgroup">
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
        </div>
    </form>

    <div class="card tpanel">
        <div class="tpanel-hd">
            <span class="tpanel-title">
                <i class="mgc_list_check_line"></i>
                Reports
                <span class="tpanel-count">{{ $submissions->total() }}</span>
            </span>
        </div>

        <div class="table-wrap">
            <table class="rtable">
                <colgroup>
                    <col class="date">
                    <col class="nodeid">
                    <col class="nodename">
                    <col class="city">
                    <col class="province">
                    <col class="area">
                    <col class="project">
                    <col class="numcol">
                    <col class="numcol">
                    <col class="numcol">
                    <col class="numcol">
                    <col class="numcol">
                    <col class="numcol">
                    <col class="item">
                    <col class="user">
                    <col class="user">
                    <col class="action">
                </colgroup>

                <thead>
                    <tr>
                        <th class="sticky-1">Date</th>
                        <th class="sticky-2">Node ID</th>
                        <th class="sticky-3">Node Name</th>
                        <th>City</th>
                        <th>Province</th>
                        <th>Area</th>
                        <th>Project</th>
                        <th class="num">Strand</th>
                        <th class="num">Cable</th>
                        <th class="num">Amplifiers</th>
                        <th class="num">Extenders</th>
                        <th class="num">Nodes</th>
                        <th class="num">TSC</th>
                        <th>Item Status</th>
                        <th>Submitted By</th>
                        <th>Approved By</th>
                        <th style="text-align:center;">Status</th>
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
                            <td class="sticky-1">
                                <div class="date-main">
                                    {{ \Carbon\Carbon::parse($sub->report_date)->format('M d, Y') }}
                                </div>
                                <div class="date-sub">
                                    {{ \Carbon\Carbon::parse($sub->report_date)->format('l') }}
                                </div>
                            </td>

                            <td class="sticky-2">
                                <div class="node-id">
                                    {{ $node?->node_id ?? '—' }}
                                </div>
                            </td>

                            <td class="sticky-3 node-name">
                                {{ $node?->node_name ?? '—' }}
                            </td>

                            <td class="cell-strong">
                                {{ $node?->city ?: '—' }}
                            </td>

                            <td class="cell-soft">
                                {{ $node?->province ?: '—' }}
                            </td>

                            <td class="cell-soft">
                                {{ $node?->area ?? $node?->sites ?? $node?->region ?? '—' }}
                            </td>

                            <td class="cell-soft">
                                {{ $proj?->project_name ?? '—' }}
                            </td>

                            @if($totalStrand > 0)
                                <td class="num">{{ $numFmt($totalStrand) }}</td>
                            @else
                                <td class="num-zero">—</td>
                            @endif

                            @if($numFmt($sub->total_cable))
                                <td class="num">{{ $numFmt($sub->total_cable) }}</td>
                            @else
                                <td class="num-zero">—</td>
                            @endif

                            @if($sub->total_amplifier > 0)
                                <td class="num">{{ $sub->total_amplifier }}</td>
                            @else
                                <td class="num-zero">—</td>
                            @endif

                            @if($sub->total_extender > 0)
                                <td class="num">{{ $sub->total_extender }}</td>
                            @else
                                <td class="num-zero">—</td>
                            @endif

                            @if($sub->total_node > 0)
                                <td class="num">{{ $sub->total_node }}</td>
                            @else
                                <td class="num-zero">—</td>
                            @endif

                            @if($sub->total_tsc > 0)
                                <td class="num">{{ $sub->total_tsc }}</td>
                            @else
                                <td class="num-zero">—</td>
                            @endif

                            <td>
                                @if($ism)
                                    <span class="badge {{ $ism['cls'] }}">{{ strtoupper($ism['label']) }}</span>
                                @else
                                    <span class="by-empty">—</span>
                                @endif
                            </td>

                            <td>
                                @if($submittedBy)
                                    <span class="by-pill">{{ strtoupper($submittedBy) }}</span>
                                @else
                                    <span class="by-empty">—</span>
                                @endif
                            </td>

                            <td>
                                @if($approvedBy)
                                    <span class="by-pill">{{ strtoupper($approvedBy) }}</span>
                                @else
                                    <span class="by-empty">—</span>
                                @endif
                            </td>

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

{{-- ── Live Field Map Overlay ──────────────────────────────────── --}}
<div id="liveMapOverlay">
    <div class="lmo-hd">
        <span class="lm-dot" style="flex-shrink:0;width:10px;height:10px;border-radius:50%;background:#22c55e;animation:livepulse 1.4s infinite;"></span>
        <span class="lmo-title">
            <i class="mgc_map_line"></i> Live Field Map
        </span>
        <span class="lmo-count" id="lmoCount">0 online</span>
        <span class="lmo-last-sync" id="lmoSync"></span>
        <button class="lmo-close" id="closeLiveMap" title="Close"><i class="mgc_close_line"></i></button>
    </div>
    <div class="lmo-legend">
        <span class="legend-item"><span class="legend-dot" style="background:#22c55e;box-shadow:0 0 0 3px rgba(34,197,94,.2);"></span> Active &lt; 5 min</span>
        <span class="legend-item"><span class="legend-dot" style="background:#f59e0b;"></span> Recent 5–30 min</span>
        <span class="legend-item"><span class="legend-dot" style="background:#64748b;"></span> Idle &gt; 30 min</span>
        <span class="legend-item" style="margin-left:auto;font-size:.67rem;color:#334155;">
            <i class="mgc_refresh_2_line"></i>&nbsp;Auto-refresh every 60s
        </span>
    </div>
    <div class="lmo-body">
        <div class="lmo-sidebar" id="lmoSidebar">
            <div class="lmo-sb-search-wrap">
                <input class="lmo-sb-search" id="lmoSearch" type="text" placeholder="Search lineman…" autocomplete="off">
            </div>
            <div class="lmo-sb-list" id="lmoList">
                <div class="lmo-sb-empty">No linemen online</div>
            </div>
        </div>
        <div id="rpt-liveMapEl"></div>
    </div>
</div>

@push('scripts')
<script src="/assets/libs/leaflet/leaflet.js"></script>
<script>
/* ── Live Field Map ── */
(function () {
    const LIVE_URL = '{{ route("reports.lineman-locations") }}';
    const CSRF     = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    let lmap = null, pollTimer = null, firstLoad = true;
    const markers = {};

    const PALETTE = ['#2563eb','#7c3aed','#dc2626','#059669','#d97706','#0891b2','#db2777','#65a30d'];
    function avatarColor(id) { return PALETTE[id % PALETTE.length]; }

    function minsAgo(iso) { return (Date.now() - new Date(iso).getTime()) / 60000; }
    function statusColor(m) { return m < 5 ? '#22c55e' : m < 30 ? '#f59e0b' : '#64748b'; }
    function statusLabel(m) {
        if (m < 1)  return 'Just now';
        if (m < 60) return Math.round(m) + ' min ago';
        return Math.round(m / 60) + 'h ago';
    }

    function buildIcon(u, mins) {
        const bg   = avatarColor(u.user_id);
        const sc   = statusColor(mins);
        const init = (u.name || '?').split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
        const pulse = mins < 5 ? `<div class="lm-avatar-pulse" style="color:${sc};"></div>` : '';
        const photo = u.photo_url
            ? `<img src="${u.photo_url}" alt="${u.name}"/>`
            : `<span class="lm-avatar-initials">${init}</span>`;
        return L.divIcon({
            className: '',
            html: `<div class="lm-avatar-wrap">
                     <div class="lm-avatar" style="background:${bg};border-color:${sc};">
                       ${pulse}${photo}
                     </div>
                     <div class="lm-name-tag">${(u.name||'Lineman').split(' ')[0]}</div>
                   </div>`,
            iconSize: [44, 58], iconAnchor: [22, 58], popupAnchor: [0, -60],
        });
    }

    function buildPopup(u, mins) {
        const sc   = statusColor(mins);
        const init = (u.name||'?').split(' ').map(w=>w[0]).join('').substring(0,2).toUpperCase();
        const rows = [
            u.subcon ? ['🏢 Subcon', u.subcon] : null,
            u.team   ? ['👥 Team',   u.team]   : null,
            u.role   ? ['🎖 Role',   u.role.replace(/_/g,' ').replace(/\b\w/g,c=>c.toUpperCase())] : null,
                       ['📍 Coords', `${(+u.latitude).toFixed(5)}, ${(+u.longitude).toFixed(5)}`],
        ].filter(Boolean);
        return `<div style="font-family:system-ui,-apple-system,sans-serif;min-width:210px;padding:2px 0;">
            <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:.7rem;">
                <div style="width:42px;height:42px;border-radius:50%;flex-shrink:0;
                            background:${avatarColor(u.user_id)};border:2.5px solid ${sc};
                            display:flex;align-items:center;justify-content:center;
                            color:#fff;font-size:.78rem;font-weight:900;">${init}</div>
                <div>
                    <div style="font-weight:900;font-size:.92rem;color:#0f172a;">${u.name||'Lineman'}</div>
                    <div style="display:flex;align-items:center;gap:.3rem;margin-top:.18rem;">
                        <span style="width:7px;height:7px;border-radius:50%;background:${sc};display:inline-block;"></span>
                        <span style="font-size:.68rem;font-weight:800;color:${sc};">${statusLabel(mins)}</span>
                    </div>
                </div>
            </div>
            <div style="background:#f8fafc;border-radius:10px;padding:.55rem .65rem;display:flex;flex-direction:column;gap:.32rem;">
                ${rows.map(([label, val]) => `<div style="display:flex;gap:.4rem;align-items:baseline;">
                    <span style="font-size:.62rem;font-weight:800;color:#94a3b8;min-width:58px;">${label}</span>
                    <span style="font-size:.74rem;font-weight:700;color:#1e293b;">${val}</span>
                </div>`).join('')}
            </div>
        </div>`;
    }

    function initMap() {
        if (lmap) return;
        lmap = L.map('rpt-liveMapEl', { center:[12.3,122.5], zoom:6, zoomControl:true });
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution:'© OpenStreetMap', maxZoom:20
        }).addTo(lmap);
        setTimeout(() => lmap.invalidateSize(), 80);
        setTimeout(() => lmap.invalidateSize(), 350);
    }

    let _lastList = [];

    function renderSidebar(list, query) {
        const q = (query || '').toLowerCase().trim();
        const filtered = q ? list.filter(u =>
            (u.name||'').toLowerCase().includes(q) ||
            (u.subcon||'').toLowerCase().includes(q) ||
            (u.team||'').toLowerCase().includes(q)
        ) : list;

        const el = document.getElementById('lmoList');
        if (!filtered.length) {
            el.innerHTML = '<div class="lmo-sb-empty">' + (q ? 'No match' : 'No linemen online') + '</div>';
            return;
        }
        el.innerHTML = filtered.map(u => {
            const mins = minsAgo(u.last_seen_at);
            const sc   = statusColor(mins);
            const bg   = avatarColor(u.user_id);
            const init = (u.name||'?').split(' ').map(w=>w[0]).join('').substring(0,2).toUpperCase();
            const meta = [u.subcon, u.team].filter(Boolean).join(' · ') || statusLabel(mins);
            return `<div class="lmo-sb-item" data-uid="${u.user_id}" data-lat="${u.latitude}" data-lng="${u.longitude}">
                <div class="lmo-sb-avatar" style="background:${bg};border-color:${sc};">${init}</div>
                <div class="lmo-sb-info">
                    <div class="lmo-sb-name">${u.name||'Lineman'}</div>
                    <div class="lmo-sb-meta">${meta}</div>
                </div>
                <div class="lmo-sb-status" style="background:${sc};"></div>
            </div>`;
        }).join('');

        el.querySelectorAll('.lmo-sb-item').forEach(row => {
            row.addEventListener('click', function() {
                const lat = +this.dataset.lat, lng = +this.dataset.lng, uid = +this.dataset.uid;
                lmap.setView([lat, lng], 16, { animate:true });
                if (markers[uid]) markers[uid].openPopup();
                el.querySelectorAll('.lmo-sb-item').forEach(r => r.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }

    document.getElementById('lmoSearch').addEventListener('input', function() {
        renderSidebar(_lastList, this.value);
    });

    async function fetchLocations() {
        try {
            const r    = await fetch(LIVE_URL, { headers:{ 'Accept':'application/json', 'X-CSRF-TOKEN':CSRF } });
            const data = await r.json();
            const list = Array.isArray(data) ? data : (data.data ?? []);
            _lastList  = list;

            const seen = new Set();
            list.forEach(u => {
                if (!u.latitude || !u.longitude) return;
                const mins = minsAgo(u.last_seen_at);
                seen.add(u.user_id);
                if (markers[u.user_id]) {
                    markers[u.user_id].setLatLng([+u.latitude, +u.longitude]);
                    markers[u.user_id].setIcon(buildIcon(u, mins));
                    markers[u.user_id].setPopupContent(buildPopup(u, mins));
                } else {
                    markers[u.user_id] = L.marker([+u.latitude, +u.longitude], { icon: buildIcon(u, mins) })
                        .addTo(lmap)
                        .bindPopup(buildPopup(u, mins), { maxWidth:220 });
                }
            });

            Object.keys(markers).forEach(id => {
                if (!seen.has(+id)) { lmap.removeLayer(markers[id]); delete markers[id]; }
            });

            if (firstLoad && Object.keys(markers).length) {
                firstLoad = false;
                const pts = list.filter(u => u.latitude && u.longitude).map(u => [+u.latitude, +u.longitude]);
                if (pts.length === 1) lmap.setView(pts[0], 14);
                else if (pts.length > 1) lmap.fitBounds(L.latLngBounds(pts), { padding:[60,60], maxZoom:14 });
            }

            const onlineCount = list.filter(u => minsAgo(u.last_seen_at) < 30).length;
            document.getElementById('lmoCount').textContent = onlineCount + ' online';
            const t = new Date();
            document.getElementById('lmoSync').textContent =
                'Synced ' + t.toLocaleTimeString('en-PH', { hour:'2-digit', minute:'2-digit', second:'2-digit' });
            renderSidebar(list, document.getElementById('lmoSearch').value);
        } catch(e) {
            document.getElementById('lmoSync').textContent = 'Sync failed — ' + new Date().toLocaleTimeString();
        }
    }

    document.getElementById('openLiveMap').addEventListener('click', function() {
        document.getElementById('liveMapOverlay').classList.add('open');
        document.body.style.overflow = 'hidden';
        firstLoad = true;
        initMap();
        setTimeout(fetchLocations, 400);
        if (pollTimer) clearInterval(pollTimer);
        pollTimer = setInterval(fetchLocations, 60000);
    });

    function closeMap() {
        document.getElementById('liveMapOverlay').classList.remove('open');
        document.body.style.overflow = '';
        clearInterval(pollTimer);
        pollTimer = null;
    }

    document.getElementById('closeLiveMap').addEventListener('click', closeMap);
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMap(); });
})();
</script>

<script>
(function () {
    'use strict';

    const FEED_URL  = '{{ route('reports.live-teardown-feed') }}';
    const ALERT_URL = '{{ route('reports.new-submissions-count') }}';

    function fmt(dt) {
        if (!dt) return '—';
        const d = new Date(dt);
        return d.toLocaleString('en-PH', { month:'short', day:'numeric', hour:'2-digit', minute:'2-digit' });
    }

    function elapsedLabel(dt) {
        if (!dt) return '';
        const diff = Math.floor((Date.now() - new Date(dt)) / 1000);
        if (diff < 60) return diff + 's ago';
        if (diff < 3600) return Math.floor(diff / 60) + 'm ago';
        if (diff < 86400) return Math.floor(diff / 3600) + 'h ago';
        return Math.floor(diff / 86400) + 'd ago';
    }

    function buildLogHTML(log, isNew) {
        const from = log.from_pole || '?';
        const to = log.to_pole || '?';
        const spanTxt = (log.from_pole && log.to_pole) ? `${from} → ${to}` : (log.span_code || `${from} → ${to}`);
        const nodeTxt = [log.node_id, log.node_name].filter(Boolean).join(' — ');
        const cableTxt = log.cable ? log.cable.toFixed(1) + ' m cable' : '';
        const teamTxt = log.team || log.submitted_by || '';
        const timeTxt = elapsedLabel(log.created_at);
        const offline = log.offline_mode ? '<span class="log-chip offline">Offline</span>' : '';

        return `<div class="log-item${isNew ? ' is-new' : ''}">
            <div class="log-span">${spanTxt}</div>
            <div class="log-node">${nodeTxt}</div>
            <div class="log-meta">
                ${cableTxt ? `<span class="log-chip cable">${cableTxt}</span>` : ''}
                ${teamTxt ? `<span class="log-chip team">${teamTxt}</span>` : ''}
                ${offline}
                <span class="log-chip time">${timeTxt}</span>
            </div>
        </div>`;
    }

    let knownIds = new Set();
    let serverNow = null;
    let drawerOpen = false;
    let loading = false;

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

    setInterval(function () {
        if (drawerOpen) loadDrawer();
    }, 30000);

    let alertSince = new Date().toISOString().replace('T', ' ').slice(0, 19);

    async function pollAlerts() {
        try {
            const url = ALERT_URL + '?since=' + encodeURIComponent(alertSince);
            const r = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            if (!r.ok) return;

            const data = await r.json();
            if (data.count > 0) {
                const n = data.count;
                document.getElementById('live-alert-msg').textContent =
                    n + ' new daily report' + (n > 1 ? 's' : '') + ' submitted — click to refresh.';
                document.getElementById('live-alert').classList.add('show');
            }

            alertSince = data.server_now || alertSince;
        } catch (_) {}
    }

    setInterval(pollAlerts, 45000);
})();
</script>
@endpush

</x-layout>