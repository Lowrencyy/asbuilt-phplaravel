<x-layout>

@push('title')Nodes — {{ $project->name }}@endpush

@push('styles')
{{-- <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700;9..40,800;9..40,900&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet"/> --}}
<style>
*,*::before,*::after{box-sizing:border-box;}
:root{
  --p:#3b82f6;--p2:#2563eb;--pg:rgba(59,130,246,.12);--pg2:rgba(59,130,246,.06);
  --ok:#22c55e;--err:#ef4444;--s:#8b5cf6;--teal:#14b8a6;--amber:#f59e0b;
  --bg:#f0f4f9;--surf:#fff;--surf2:#f7f9fc;
  --bdr:#e2e8f0;--bdr2:#cbd5e1;
  --txt:#0f172a;--txt2:#475569;--txt3:#64748b;--muted:#94a3b8;
  --r:14px;--r-sm:8px;
  --sh:0 1px 2px rgba(15,23,42,.04),0 4px 16px rgba(15,23,42,.05);
  --sh-md:0 4px 20px rgba(15,23,42,.09);
  --sh-lg:0 12px 48px rgba(15,23,42,.16);
  --ff:'DM Sans',sans-serif;--fm:'DM Mono',monospace;
}
.dark{--bg:#070f1e;--surf:#0f172a;--surf2:#111827;--bdr:#1e2d45;--bdr2:#263954;--txt:#e2e8f0;--txt2:#94a3b8;--txt3:#64748b;--muted:#3f5471;}
body{font-family:var(--ff);background:var(--bg);color:var(--txt);}
.page-content{background:var(--bg);}

.ph{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;margin-bottom:1.25rem;}
.ph h2{font-size:1.15rem;font-weight:900;color:var(--txt);display:flex;align-items:center;gap:.5rem;margin:0;}
.ph p{font-size:.76rem;color:var(--txt3);margin:.14rem 0 0;}
.h-ico{display:inline-flex;align-items:center;justify-content:center;height:34px;width:34px;border-radius:10px;background:var(--pg);color:var(--p);font-size:.95rem;flex-shrink:0;}

.sg{display:grid;grid-template-columns:repeat(auto-fit,minmax(185px,1fr));gap:.85rem;margin:0 0 1.25rem;}
.sc{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);padding:1rem 1.1rem;display:flex;align-items:flex-start;gap:.75rem;transition:box-shadow .18s,transform .18s;}
.sc:hover{box-shadow:var(--sh-md);transform:translateY(-2px);}
.si{height:40px;width:40px;border-radius:10px;flex-shrink:0;display:inline-flex;align-items:center;justify-content:center;font-size:1.05rem;}
.sv{font-size:1.35rem;font-weight:900;color:var(--txt);line-height:1.1;letter-spacing:-.03em;font-family:var(--fm);}
.sl{font-size:.63rem;font-weight:700;color:var(--txt3);text-transform:uppercase;letter-spacing:.07em;margin-top:.2rem;}
.unit{font-size:.66rem;font-weight:700;color:var(--txt3);margin-left:.18rem;}

.fc{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);padding:.85rem 1.1rem;margin-bottom:1rem;}
.frow{display:flex;flex-wrap:wrap;gap:.5rem;align-items:center;}
.fi-wrap{position:relative;}
.fi-ico{position:absolute;left:.7rem;top:50%;transform:translateY(-50%);color:var(--muted);font-size:.82rem;pointer-events:none;}
.fi{height:36px;padding:0 .75rem 0 2.25rem;border:1px solid var(--bdr);border-radius:var(--r-sm);background:var(--surf2);color:var(--txt);font-size:.8rem;font-family:var(--ff);outline:none;transition:border-color .15s,box-shadow .15s;min-width:210px;}
.fi:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(59,130,246,.1);}
.fsel{height:36px;padding:0 2rem 0 .75rem;border:1px solid var(--bdr);border-radius:var(--r-sm);background:var(--surf2);color:var(--txt);font-size:.8rem;font-family:var(--ff);outline:none;cursor:pointer;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right .55rem center;transition:border-color .15s;}
.fsel:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(59,130,246,.1);}
.cpill{display:inline-flex;align-items:center;gap:.3rem;font-size:.72rem;color:var(--txt3);font-weight:600;background:var(--surf2);border:1px solid var(--bdr);padding:.22rem .7rem;border-radius:999px;white-space:nowrap;}
.cpill strong{color:var(--p);font-family:var(--fm);font-weight:900;}
.fgrp{display:flex;flex-wrap:wrap;gap:.5rem;align-items:center;justify-content:flex-end;margin-left:auto;}
.fdate{height:36px;padding:0 .75rem;border:1px solid var(--bdr);border-radius:var(--r-sm);background:var(--surf2);color:var(--txt);font-size:.8rem;font-family:var(--ff);outline:none;transition:border-color .15s,box-shadow .15s;min-width:170px;}
.fdate:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(59,130,246,.1);}

.tv-card{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;}
.table-wrap{max-height:calc(100vh - 380px);overflow:auto;scrollbar-width:thin;scrollbar-color:var(--bdr2) transparent;}
.table-wrap::-webkit-scrollbar{width:5px;height:5px;}
.table-wrap::-webkit-scrollbar-thumb{background:var(--bdr2);border-radius:99px;}

table{width:100%;border-collapse:separate;border-spacing:0;font-size:.8rem;min-width:1100px;}
thead th{position:sticky;top:0;z-index:5;background:var(--surf2);border-bottom:2px solid var(--bdr);padding:0 13px;height:36px;text-align:center;white-space:nowrap;font-size:.61rem;font-weight:800;color:var(--txt3);letter-spacing:.07em;text-transform:uppercase;}
thead th.thl{text-align:left;}
thead th.col-act{position:sticky;right:0;z-index:6;background:var(--surf2);border-left:1px solid var(--bdr);}
tbody tr:hover td{background:rgba(59,130,246,.03);}
tbody td{padding:0 13px;height:48px;border-bottom:1px solid var(--bdr);vertical-align:middle;text-align:center;white-space:nowrap;}
tbody tr:last-child td{border-bottom:none;}
tbody td.tdl{text-align:left;}
td.col-act,th.col-act{position:sticky;right:0;z-index:4;background:var(--surf);border-left:1px solid var(--bdr);min-width:104px;}
tbody tr:hover td.col-act{background:rgba(59,130,246,.03);}

.c-idx{color:var(--muted);font-size:.67rem;font-family:var(--fm);width:40px;}
.c-nlink a{font-family:var(--fm);font-size:.78rem;font-weight:800;color:var(--p);text-decoration:none;display:inline-flex;align-items:center;gap:.28rem;padding:.24rem .58rem;border-radius:7px;background:var(--pg2);border:1px solid rgba(59,130,246,.15);transition:all .13s;}
.c-nlink a:hover{background:var(--pg);border-color:rgba(59,130,246,.35);transform:translateY(-1px);}
.c-txt{font-size:.76rem;color:var(--txt2);}
.c-num{font-family:var(--fm);font-size:.75rem;font-weight:700;color:var(--txt);}
.cm{font-size:.63rem;color:var(--muted);margin-left:.15rem;}

.sbadge{display:inline-flex;align-items:center;gap:.28rem;font-size:.62rem;font-weight:800;padding:.18rem .5rem;border-radius:999px;white-space:nowrap;letter-spacing:.02em;}
.s-ongoing{background:rgba(245,158,11,.1);color:#92400e;border:1px solid rgba(245,158,11,.22);}
.s-completed{background:rgba(34,197,94,.1);color:#166534;border:1px solid rgba(34,197,94,.22);}
.s-review{background:rgba(59,130,246,.1);color:var(--p2);border:1px solid rgba(59,130,246,.22);}
.s-pending{background:rgba(239,68,68,.08);color:#991b1b;border:1px solid rgba(239,68,68,.18);}
.s-hold{background:rgba(148,163,184,.12);color:var(--txt3);border:1px solid var(--bdr);}
.dark .s-ongoing{color:#fcd34d;}.dark .s-completed{color:#86efac;}.dark .s-review{color:#93c5fd;}.dark .s-pending{color:#fca5a5;}

.pwrap{display:flex;align-items:center;gap:.5rem;justify-content:center;}
.pbar{height:7px;width:76px;border-radius:999px;background:rgba(148,163,184,.2);overflow:hidden;}
.pbf{height:100%;border-radius:999px;background:linear-gradient(90deg,var(--p),#60a5fa);transition:width .4s;}
.pct{font-family:var(--fm);font-size:.68rem;font-weight:900;color:var(--txt2);min-width:28px;}

.ar{display:flex;gap:.3rem;justify-content:center;align-items:center;}
.ab{display:inline-flex;align-items:center;justify-content:center;height:28px;width:28px;border-radius:50%;border:1px solid var(--bdr);background:var(--surf);cursor:pointer;font-size:.8rem;color:var(--txt2);transition:all .15s;flex-shrink:0;}
.ab:hover{transform:scale(1.1);}
.ab-e:hover{background:rgba(59,130,246,.1);border-color:rgba(59,130,246,.35);color:var(--p);}
.ab-d:hover{background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.35);color:var(--err);}
.empty-st{text-align:center;padding:3rem 1rem;color:var(--muted);font-size:.83rem;}
.empty-st i{font-size:2rem;display:block;margin-bottom:.6rem;}

.btn-p{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1rem;background:var(--p);color:#fff;border:none;border-radius:var(--r-sm);font-size:.81rem;font-weight:900;font-family:var(--ff);cursor:pointer;box-shadow:0 2px 8px rgba(59,130,246,.28);transition:all .15s;}
.btn-p:hover{background:var(--p2);transform:translateY(-1px);}

#nodeOv{position:fixed;inset:0;z-index:900;background:rgba(7,15,30,.65);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .22s;}
#nodeOv.open{opacity:1;pointer-events:all;}
#nmc{background:var(--surf);border:1px solid var(--bdr);border-radius:18px;box-shadow:var(--sh-lg);width:100%;max-width:860px;max-height:calc(100vh - 2rem);display:flex;flex-direction:column;transform:translateY(20px) scale(.97);opacity:0;transition:transform .28s cubic-bezier(.34,1.18,.64,1),opacity .22s;}
#nodeOv.open #nmc{transform:translateY(0) scale(1);opacity:1;}
.mhd{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.2rem;border-bottom:1px solid var(--bdr);gap:.7rem;}
.mico{height:40px;width:40px;border-radius:10px;flex-shrink:0;background:var(--pg);display:inline-flex;align-items:center;justify-content:center;color:var(--p);font-size:1.1rem;}
.mt{font-size:1rem;font-weight:900;color:var(--txt);}
.ms{font-size:.7rem;color:var(--txt3);margin-top:.1rem;}
.mb{padding:1.2rem;overflow-y:auto;flex:1;}
.mc{height:30px;width:30px;border-radius:7px;border:1px solid var(--bdr);background:var(--surf2);display:inline-flex;align-items:center;justify-content:center;color:var(--txt2);font-size:.95rem;cursor:pointer;transition:all .15s;}
.mc:hover{background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.3);color:var(--err);}
.mft{padding:.85rem 1.2rem;border-top:1px solid var(--bdr);display:flex;align-items:center;justify-content:flex-end;gap:.6rem;}
.btn-c{padding:.42rem .9rem;border-radius:var(--r-sm);border:1px solid var(--bdr);background:var(--surf2);color:var(--txt2);font-size:.8rem;font-weight:800;font-family:var(--ff);cursor:pointer;transition:all .15s;}
.btn-c:hover{background:var(--bdr);}
.btn-s{padding:.42rem 1.1rem;border-radius:var(--r-sm);border:none;background:var(--p);color:#fff;font-size:.8rem;font-weight:900;font-family:var(--ff);cursor:pointer;box-shadow:0 2px 8px rgba(59,130,246,.3);transition:all .15s;display:inline-flex;align-items:center;gap:.35rem;}
.btn-s:hover{background:var(--p2);}

.fg{display:grid;grid-template-columns:1fr 1fr;gap:.9rem;}
.c3{grid-column:span 2;}
@media(max-width:580px){.fg{grid-template-columns:1fr;}.c3{grid-column:span 1;}}
.lbl{display:block;font-size:.72rem;font-weight:900;color:var(--txt2);letter-spacing:.02em;margin-bottom:.3rem;}
.lbl span{color:var(--err);}
.inp{width:100%;padding:.45rem .68rem;border:1px solid var(--bdr);border-radius:var(--r-sm);background:var(--surf);color:var(--txt);font-size:.82rem;font-family:var(--ff);outline:none;transition:border-color .15s,box-shadow .15s;}
.inp:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(59,130,246,.1);}
.inp::placeholder{color:var(--muted);}
.inp-e{border-color:rgba(239,68,68,.6)!important;box-shadow:0 0 0 3px rgba(239,68,68,.1)!important;}

.sdiv{grid-column:span 2;display:flex;align-items:center;gap:.6rem;margin:.2rem 0 -.1rem;}
.sdiv .t{font-size:.73rem;font-weight:900;color:var(--txt2);text-transform:uppercase;letter-spacing:.08em;white-space:nowrap;}
.sdiv .line{flex:1;height:1px;background:var(--bdr);}
.sdiv .sub{font-size:.68rem;color:var(--muted);white-space:nowrap;}

.totinp{grid-column:span 2;display:grid;grid-template-columns:repeat(3,1fr);gap:.65rem;}
@media(max-width:580px){.totinp{grid-template-columns:1fr 1fr;}}
.inpwrap{position:relative;}
.pad-unit{padding-right:2.5rem!important;}
.unitr{position:absolute;right:.65rem;top:50%;transform:translateY(-50%);font-size:.68rem;font-weight:700;color:var(--muted);pointer-events:none;}


.prog-field{display:flex;align-items:center;gap:.75rem;margin-top:.4rem;}
.pb{height:10px;flex:1;border-radius:999px;background:rgba(148,163,184,.2);overflow:hidden;}
.pbf{height:100%;border-radius:999px;background:linear-gradient(90deg,var(--p),#60a5fa);transition:width .35s;}
.pct{font-family:var(--fm);font-size:.82rem;font-weight:900;color:var(--txt2);min-width:36px;text-align:right;}

#delOv{position:fixed;inset:0;z-index:950;background:rgba(7,15,30,.7);backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .2s;}
#delOv.open{opacity:1;pointer-events:all;}
#delCard{background:var(--surf);border:1px solid var(--bdr);border-radius:16px;box-shadow:var(--sh-lg);max-width:370px;width:100%;padding:1.4rem;transform:scale(.95);opacity:0;transition:transform .22s cubic-bezier(.34,1.18,.64,1),opacity .2s;}
#delOv.open #delCard{transform:scale(1);opacity:1;}
.delib{height:46px;width:46px;border-radius:11px;background:rgba(239,68,68,.1);display:inline-flex;align-items:center;justify-content:center;color:var(--err);font-size:1.2rem;margin-bottom:.85rem;}
.btn-del{padding:.42rem 1rem;border-radius:var(--r-sm);border:none;background:var(--err);color:#fff;font-size:.8rem;font-weight:900;font-family:var(--ff);cursor:pointer;box-shadow:0 2px 8px rgba(239,68,68,.3);transition:all .15s;}
.btn-del:hover{background:#dc2626;}

.toast-wrap{position:fixed;bottom:1.5rem;right:1.5rem;z-index:9999;display:flex;flex-direction:column;gap:.5rem;pointer-events:none;}
.toast{display:flex;align-items:center;gap:.6rem;padding:.65rem 1rem;border-radius:10px;background:var(--surf);border:1px solid var(--bdr);box-shadow:var(--sh-lg);font-size:.8rem;font-weight:700;color:var(--txt);min-width:240px;transform:translateX(120%);opacity:0;transition:transform .3s cubic-bezier(.34,1.3,.64,1),opacity .25s;pointer-events:all;}
.toast.show{transform:translateX(0);opacity:1;}
.toast.t-ok{border-color:rgba(34,197,94,.25);background:rgba(240,253,244,1);}
.toast.t-err{border-color:rgba(239,68,68,.25);background:rgba(254,242,242,1);}
.dark .toast.t-ok{background:#0f2918;}.dark .toast.t-err{background:#2d0909;}
</style>
@endpush

<div class="col-span-full">

  {{-- PAGE HEADER --}}
  <div class="ph">
    <div>
      <h2>
        <div class="h-ico"><i class="mgc_router_line"></i></div>
        Nodes
      </h2>
      <p>
        Project: <strong>{{ $project->name }}</strong>
        <span style="margin:0 .4rem;color:var(--bdr2)">·</span>
        <a href="{{ route('admin.projects.index') }}" style="color:var(--p);font-size:.76rem;">← Back to Projects</a>
      </p>
    </div>
    <button class="btn-p" id="btnOpenAdd"><i class="mgc_add_line"></i> Add Node ID</button>
  </div>

  {{-- STATS --}}
  <div class="sg">
    <div class="sc">
      <div class="si" style="background:rgba(59,130,246,.1);color:var(--p);"><i class="mgc_router_line"></i></div>
      <div><div class="sv" id="statTotal">0</div><div class="sl">Total Nodes</div></div>
    </div>
    <div class="sc">
      <div class="si" style="background:rgba(245,158,11,.1);color:#b45309;"><i class="mgc_calendar_line"></i></div>
      <div><div class="sv" id="statOngoing">0</div><div class="sl">Ongoing</div></div>
    </div>
    <div class="sc">
      <div class="si" style="background:rgba(34,197,94,.1);color:#16a34a;"><i class="mgc_check_circle_line"></i></div>
      <div><div class="sv" id="statDone">0</div><div class="sl">Completed</div></div>
    </div>
    <div class="sc">
      <div class="si" style="background:rgba(148,163,184,.1);color:var(--txt3);"><i class="mgc_pause_circle_line"></i></div>
      <div><div class="sv" id="statHold">0</div><div class="sl">On Hold</div></div>
    </div>
    <div class="sc">
      <div class="si" style="background:rgba(139,92,246,.1);color:#7c3aed;"><i class="mgc_cable_line"></i></div>
      <div><div class="sv"><span id="statStrand">0</span><span class="unit">m</span></div><div class="sl">Total Strand</div></div>
    </div>
  </div>

  {{-- FILTERS --}}
  <div class="fc">
    <div class="frow">
      <div class="fi-wrap">
        <i class="mgc_search_line fi-ico"></i>
        <input id="fSearch" type="text" placeholder="Search Node ID, region, city…" class="fi" />
      </div>
      <div class="fgrp">
        <select id="fRegion" class="fsel">
          <option value="">All Regions</option>
          <option>NCR</option><option>Luzon</option><option>Visayas</option><option>Mindanao</option>
        </select>
        <select id="fStatusF" class="fsel">
          <option value="">All Status</option>
          <option value="GOING">Ongoing</option>
          <option value="COMPLETED">Completed</option>
          <option value="HOLD">On Hold</option>
          <option value="REVIEW">Under Review</option>
          <option value="PENDING">Pending</option>
        </select>
        <select id="fSubconF" class="fsel">
          <option value="">All Subcon</option>
          @foreach($subcontractors as $sc)
            <option value="{{ $sc->id }}">{{ $sc->name }}</option>
          @endforeach
        </select>
        <input id="fDueFilter" type="date" class="fdate" title="Filter by due date" />
        <div class="cpill"><strong id="showCount">0</strong>&nbsp;node(s)</div>
      </div>
    </div>
  </div>

  {{-- TABLE --}}
  <div class="tv-card">
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th class="thl" style="width:40px;">#</th>
            <th class="thl">Node ID</th>
            <th>Region</th>
            <th>City / District</th>
            <th>Subcon</th>
            <th>Status</th>
            <th>Total Strand</th>
            <th>Exp. Cable</th>
            <th>Actual Cable</th>
            <th>Extender</th>
            <th>TSC</th>
            <th>Node</th>
            <th>Amplifier</th>
            <th>Due Date</th>
            <th>Progress</th>
            <th class="col-act">Actions</th>
          </tr>
        </thead>
        <tbody id="nodeTbody"></tbody>
      </table>
    </div>
  </div>

</div><!-- end col-span-full -->

{{-- ADD / EDIT MODAL --}}
<div id="nodeOv">
  <div id="nmc">
    <div class="mhd">
      <div class="mico"><i class="mgc_router_line"></i></div>
      <div style="flex:1;"><div class="mt" id="modalTitle">Add Node ID</div><div class="ms">Fields marked <span style="color:var(--err)">*</span> are required.</div></div>
      <button class="mc" id="btnClose"><i class="mgc_close_line"></i></button>
    </div>
    <div class="mb">
      <form id="nodeForm" class="fg" novalidate>
        <input type="hidden" id="editId"/>

        <div class="sdiv"><div class="t">Basic Information</div><div class="line"></div></div>
        <div>
          <label class="lbl" for="fNodeId">Node ID <span>*</span></label>
          <input id="fNodeId" class="inp" type="text" placeholder="e.g. QC-1104" required/>
        </div>
        <div>
          <label class="lbl" for="fRegion2">Region</label>
          <input id="fRegion2" class="inp" type="text" placeholder="e.g. NCR"/>
        </div>
        <div>
          <label class="lbl" for="fCity">City / District</label>
          <input id="fCity" class="inp" type="text" placeholder="e.g. Quezon City, District 2"/>
        </div>
        <div>
          <label class="lbl" for="fSubcon2">Subcontractor</label>
          <select id="fSubcon2" class="inp">
            <option value="">— None —</option>
            @foreach($subcontractors as $sc)
              <option value="{{ $sc->id }}">{{ $sc->name }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="lbl" for="fStatus">Status <span>*</span></label>
          <select id="fStatus" class="inp">
            <option>ON GOING IMPLEMENTATION</option>
            <option>ON GOING DOCUMENTATION</option>
            <option>UNDER REVIEW BY CLIENT</option>
            <option>UNDER REVIEW TELCOVANTAGE</option>
            <option>PENDING DOCUMENTS</option>
            <option>COMPLETED</option>
            <option>ON HOLD</option>
          </select>
        </div>
        <div>
          <label class="lbl" for="fApprovedBy">Approved By</label>
          <input id="fApprovedBy" class="inp" type="text" placeholder="Name / Client / Team"/>
        </div>

        <div class="sdiv"><div class="t">Dates</div><div class="line"></div></div>
        <div>
          <label class="lbl" for="fDueDate">Due Date</label>
          <input id="fDueDate" class="inp" type="date"/>
        </div>
        <div>
          <label class="lbl" for="fDateStart">Date Start</label>
          <input id="fDateStart" class="inp" type="date"/>
        </div>
        <div>
          <label class="lbl" for="fDateFinished">Date Finished</label>
          <input id="fDateFinished" class="inp" type="date"/>
        </div>

        <div class="sdiv c3"><div class="t">Node Totals</div><div class="line"></div><span class="sub">manual entry</span></div>
        <div class="totinp" id="totalsInputWrap">
          <div class="inpwrap">
            <label class="lbl" for="fTotStrand">Total Strand Length</label>
            <input id="fTotStrand" class="inp pad-unit" type="number" step="0.1" min="0" placeholder="0.0"/>
            <span class="unitr">m</span>
          </div>
          <div class="inpwrap">
            <label class="lbl" for="fTotActual">Expected Cable</label>
            <input id="fTotActual" class="inp pad-unit" type="number" step="0.1" min="0" placeholder="0.0"/>
            <span class="unitr">m</span>
          </div>
          <div class="inpwrap">
            <label class="lbl" for="fActualCable">Actual Cable</label>
            <input id="fActualCable" class="inp pad-unit" type="number" step="0.1" min="0" placeholder="0.0"/>
            <span class="unitr">m</span>
          </div>
          <div class="inpwrap">
            <label class="lbl" for="fTotExt">Extender</label>
            <input id="fTotExt" class="inp pad-unit" type="number" step="1" min="0" placeholder="0"/>
            <span class="unitr">pcs</span>
          </div>
          <div class="inpwrap">
            <label class="lbl" for="fTotTsc">TSC</label>
            <input id="fTotTsc" class="inp pad-unit" type="number" step="1" min="0" placeholder="0"/>
            <span class="unitr">pcs</span>
          </div>
          <div class="inpwrap">
            <label class="lbl" for="fTotNode">Node Devices</label>
            <input id="fTotNode" class="inp pad-unit" type="number" step="1" min="0" placeholder="0"/>
            <span class="unitr">pcs</span>
          </div>
          <div class="inpwrap">
            <label class="lbl" for="fTotAmp">Amplifier</label>
            <input id="fTotAmp" class="inp pad-unit" type="number" step="1" min="0" placeholder="0"/>
            <span class="unitr">pcs</span>
          </div>
        </div>

        <div class="sdiv c3"><div class="t">Progress</div><div class="line"></div><span class="sub">from daily reports</span></div>
        <div class="c3">
          <label class="lbl">Progress Bar (Read Only)</label>
          <input type="hidden" id="fProgress" value="0"/>
          <div class="prog-field">
            <div class="pb"><div class="pbf" id="fPfill" style="width:0%"></div></div>
            <div class="pct" id="fPpct">0%</div>
          </div>
        </div>

      </form>
    </div>
    <div class="mft">
      <button class="btn-c" id="btnCancel" type="button">Cancel</button>
      <button class="btn-s" id="btnSave" type="button"><i class="mgc_save_line"></i> <span id="saveLbl">Save Node</span></button>
    </div>
  </div>
</div>

{{-- DELETE MODAL --}}
<div id="delOv">
  <div id="delCard">
    <div class="delib"><i class="mgc_delete_2_line"></i></div>
    <div style="font-size:.9rem;font-weight:900;color:var(--txt);margin-bottom:.3rem;">Delete Node?</div>
    <p style="font-size:.79rem;color:var(--txt2);margin-bottom:1.1rem;" id="delMsg">This cannot be undone.</p>
    <div style="display:flex;gap:.5rem;justify-content:flex-end;">
      <button class="btn-c" id="btnDelCancel">Cancel</button>
      <button class="btn-del" id="btnDelConfirm"><i class="mgc_delete_2_line"></i> Delete</button>
    </div>
  </div>
</div>

{{-- TOAST --}}
<div class="toast-wrap" id="toastWrap"></div>

@push('scripts')
<script>
(function(){
  const NODES     = @json($nodes);
  const STORE_URL = "{{ route('admin.projects.nodes.store', $project) }}";
  const BASE_URL  = "{{ url('admin/projects/' . $project->id . '/nodes') }}";
  const CSRF      = document.querySelector('meta[name="csrf-token"]').content;

  let rows = JSON.parse(JSON.stringify(NODES));
  let pendingDelId = null;
  const $ = id => document.getElementById(id);

  function toast(msg, type='ok'){
    const w=$('toastWrap');
    const el=document.createElement('div');
    el.className=`toast t-${type}`;
    el.innerHTML=`<i class="mgc_${type==='ok'?'check_circle_line':'close_circle_line'}" style="font-size:1rem;color:${type==='ok'?'#16a34a':'var(--err)'}"></i><span>${msg}</span>`;
    w.appendChild(el);
    requestAnimationFrame(()=>requestAnimationFrame(()=>el.classList.add('show')));
    setTimeout(()=>{el.classList.remove('show');setTimeout(()=>el.remove(),350);},3200);
  }

  function renderStats(list){
    $('statTotal').textContent   = list.length;
    $('statOngoing').textContent = list.filter(n=>/going|implementation|documentation/i.test(n.status)).length;
    $('statDone').textContent    = list.filter(n=>/completed/i.test(n.status)).length;
    $('statHold').textContent    = list.filter(n=>/hold/i.test(n.status)).length;
    $('statStrand').textContent  = list.reduce((s,n)=>s+(parseFloat(n.strand_m)||0),0).toFixed(1);
  }

  function statusBadge(s){
    let cls='s-hold';
    if(/going|implement|documentation/i.test(s)) cls='s-ongoing';
    else if(/completed/i.test(s)) cls='s-completed';
    else if(/review/i.test(s)) cls='s-review';
    else if(/pending/i.test(s)) cls='s-pending';
    return `<span class="sbadge ${cls}">${s||'—'}</span>`;
  }

  function getFiltered(){
    const q  =($('fSearch').value||'').toLowerCase();
    const reg=$('fRegion').value.toLowerCase();
    const st =$('fStatusF').value.toLowerCase();
    const sc =$('fSubconF').value;
    const due=$('fDueFilter').value;
    return rows.filter(n=>{
      if(q  && ![(n.node_code||''),(n.region||''),(n.city||'')].join(' ').toLowerCase().includes(q)) return false;
      if(reg && !(n.region||'').toLowerCase().includes(reg)) return false;
      if(st  && !(n.status||'').toLowerCase().includes(st)) return false;
      if(sc  && String(n.subcon_id)!==sc) return false;
      if(due && n.due_date && n.due_date.slice(0,10)!==due) return false;
      return true;
    });
  }

  function renderTable(){
    const list=getFiltered();
    renderStats(list);
    $('showCount').textContent=list.length;

    if(!list.length){
      $('nodeTbody').innerHTML=`<tr><td colspan="16"><div class="empty-st"><i class="mgc_router_line"></i>No nodes found. Click "Add Node ID" to get started.</div></td></tr>`;
      return;
    }

    $('nodeTbody').innerHTML=list.map((n,i)=>{
      const subName=n.subcontractor?n.subcontractor.name:'—';
      const prog=n.progress||0;
      const due=n.due_date?n.due_date.slice(0,10):'—';
      const polesUrl=`${BASE_URL}/${n.id}/poles`;
      return `<tr>
        <td class="c-idx tdl">${i+1}</td>
        <td class="c-nlink tdl"><a href="${polesUrl}"><i class="mgc_router_line" style="font-size:.7rem"></i> ${n.node_code}</a></td>
        <td class="c-txt">${n.region||'—'}</td>
        <td class="c-txt" style="max-width:160px;overflow:hidden;text-overflow:ellipsis;" title="${n.city||''}">${n.city||'—'}</td>
        <td class="c-txt">${subName}</td>
        <td>${statusBadge(n.status)}</td>
        <td class="c-num">${(+n.strand_m||0).toFixed(1)}<span class="cm">m</span></td>
        <td class="c-num">${(+n.cable_m||0).toFixed(1)}<span class="cm">m</span></td>
        <td class="c-num">${(+n.actual_cable_m||0).toFixed(1)}<span class="cm">m</span></td>
        <td class="c-num">${n.extender_count||0}</td>
        <td class="c-num">${n.tsc_count||0}</td>
        <td class="c-num">${n.node_device_count||0}</td>
        <td class="c-num">${n.amp_count||0}</td>
        <td class="c-txt">${due}</td>
        <td><div class="pwrap"><div class="pbar"><div class="pbf" style="width:${prog}%"></div></div><div class="pct">${prog}%</div></div></td>
        <td class="col-act"><div class="ar">
          <button class="ab ab-e" data-act="edit" data-id="${n.id}" type="button" title="Edit"><i class="mgc_edit_2_line"></i></button>
          <button class="ab ab-d" data-act="del"  data-id="${n.id}" type="button" title="Delete"><i class="mgc_delete_2_line"></i></button>
        </div></td>
      </tr>`;
    }).join('');
  }

  function openModal(){ $('nodeOv').classList.add('open'); document.body.style.overflow='hidden'; }
  function closeModal(){ $('nodeOv').classList.remove('open'); document.body.style.overflow=''; }
  function openDel(id){
    const n=rows.find(x=>x.id==id); if(!n) return;
    pendingDelId=id;
    $('delMsg').textContent=`Delete node "${n.node_code}"? All poles in this node will also be deleted.`;
    $('delOv').classList.add('open'); document.body.style.overflow='hidden';
  }
  function closeDel(){ $('delOv').classList.remove('open'); document.body.style.overflow=''; pendingDelId=null; }

  function resetForm(){
    $('nodeForm').reset();$('editId').value='';
    $('modalTitle').textContent='Add Node ID';$('saveLbl').textContent='Save Node';
    $('fPfill').style.width='0%';$('fPpct').textContent='0%';
    $('fNodeId').classList.remove('inp-e');
  }
  function loadEdit(id){
    const n=rows.find(x=>x.id==id); if(!n) return;
    resetForm();
    $('editId').value=n.id;
    $('modalTitle').textContent='Edit Node ID';$('saveLbl').textContent='Update Node';
    $('fNodeId').value=n.node_code||'';
    $('fRegion2').value=n.region||'';
    $('fCity').value=n.city||'';
    $('fSubcon2').value=n.subcon_id||'';
    $('fStatus').value=n.status||'ON GOING IMPLEMENTATION';
    $('fApprovedBy').value=n.approved_by||'';
    $('fDueDate').value=(n.due_date||'').slice(0,10);
    $('fDateStart').value=(n.start_date||'').slice(0,10);
    $('fDateFinished').value=(n.completed_date||'').slice(0,10);
    $('fTotStrand').value=n.strand_m||0;
    $('fTotActual').value=n.cable_m||0;
    $('fActualCable').value=n.actual_cable_m||0;
    $('fTotExt').value=n.extender_count||0;
    $('fTotTsc').value=n.tsc_count||0;
    $('fTotNode').value=n.node_device_count||0;
    $('fTotAmp').value=n.amp_count||0;
    const prog=n.progress||0;
    $('fProgress').value=prog;$('fPfill').style.width=prog+'%';$('fPpct').textContent=prog+'%';
    openModal();
  }

  async function saveNode(){
    const code=$('fNodeId').value.trim();
    if(!code){$('fNodeId').classList.add('inp-e');return;}
    $('fNodeId').classList.remove('inp-e');
    const editId=$('editId').value;
    const url=editId?`${BASE_URL}/${editId}`:STORE_URL;
    const fd=new FormData();
    fd.append('node_code',code);
    fd.append('region',$('fRegion2').value.trim());
    fd.append('city',$('fCity').value.trim());
    fd.append('subcon_id',$('fSubcon2').value);
    fd.append('status',$('fStatus').value);
    fd.append('approved_by',$('fApprovedBy').value.trim());
    fd.append('due_date',$('fDueDate').value);
    fd.append('start_date',$('fDateStart').value);
    fd.append('completed_date',$('fDateFinished').value);
    fd.append('strand_m',$('fTotStrand').value||0);
    fd.append('cable_m',$('fTotActual').value||0);
    fd.append('actual_cable_m',$('fActualCable').value||0);
    fd.append('extender_count',$('fTotExt').value||0);
    fd.append('tsc_count',$('fTotTsc').value||0);
    fd.append('node_device_count',$('fTotNode').value||0);
    fd.append('amp_count',$('fTotAmp').value||0);
    const btn=$('btnSave');
    btn.disabled=true;btn.innerHTML='<i class="mgc_loading_4_line"></i> Saving…';
    try{
      const res=await fetch(url,{method:'POST',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'},body:fd});
      const data=await res.json();
      if(!res.ok||!data.success){toast(data.message||'Something went wrong.','err');return;}
      if(editId){const idx=rows.findIndex(x=>x.id==editId);if(idx>=0)rows[idx]=data.node;}
      else rows.unshift(data.node);
      closeModal();renderTable();toast(editId?'Node updated.':'Node added.');
    }catch(e){toast('Network error.','err');}
    finally{btn.disabled=false;btn.innerHTML='<i class="mgc_save_line"></i> <span id="saveLbl">Save Node</span>';}
  }

  async function confirmDel(){
    if(!pendingDelId) return;
    const btn=$('btnDelConfirm');
    btn.disabled=true;btn.innerHTML='<i class="mgc_loading_4_line"></i> Deleting…';
    try{
      const res=await fetch(`${BASE_URL}/${pendingDelId}`,{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}});
      const data=await res.json();
      if(!res.ok||!data.success){toast(data.message||'Delete failed.','err');return;}
      rows=rows.filter(x=>x.id!=pendingDelId);
      closeDel();renderTable();toast('Node deleted.');
    }catch(e){toast('Network error.','err');}
    finally{btn.disabled=false;btn.innerHTML='<i class="mgc_delete_2_line"></i> Delete';}
  }

  $('btnOpenAdd').addEventListener('click',()=>{resetForm();openModal();});
  $('btnClose').addEventListener('click',closeModal);
  $('btnCancel').addEventListener('click',closeModal);
  $('btnSave').addEventListener('click',saveNode);
  $('nodeOv').addEventListener('click',e=>{if(e.target===$('nodeOv'))closeModal();});
  $('btnDelConfirm').addEventListener('click',confirmDel);
  $('btnDelCancel').addEventListener('click',closeDel);
  $('delOv').addEventListener('click',e=>{if(e.target===$('delOv'))closeDel();});
  $('nodeTbody').addEventListener('click',e=>{
    const btn=e.target.closest('button');if(!btn)return;
    if(btn.dataset.act==='edit')loadEdit(btn.dataset.id);
    if(btn.dataset.act==='del') openDel(btn.dataset.id);
  });
  ['fSearch','fRegion','fStatusF','fSubconF','fDueFilter'].forEach(id=>{
    $(id).addEventListener('input',renderTable);
    $(id).addEventListener('change',renderTable);
  });
  document.addEventListener('keydown',e=>{
    if(e.key==='Escape'){
      if($('nodeOv').classList.contains('open'))closeModal();
      if($('delOv').classList.contains('open'))closeDel();
    }
  });

  renderTable();
})();
</script>
@endpush

</x-layout>
