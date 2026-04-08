```blade
<x-layout>

@push('title')Nodes — {{ $project->name }}@endpush

@push('styles')
<style>
*,*::before,*::after{box-sizing:border-box;}
:root{
  --bg:#f5f7fb;
  --surface:#ffffff;
  --surface-soft:#f8fafc;
  --line:#e2e8f0;
  --line-strong:#cbd5e1;
  --text:#0f172a;
  --text-soft:#475569;
  --text-muted:#64748b;
  --primary:#2563eb;
  --primary-soft:rgba(37,99,235,.08);
  --success:#16a34a;
  --warning:#d97706;
  --danger:#dc2626;
  --shadow:0 1px 2px rgba(15,23,42,.04), 0 10px 28px rgba(15,23,42,.06);
  --radius:18px;
  --radius-sm:12px;
}
.dark{
  --bg:#0b1220;
  --surface:#0f172a;
  --surface-soft:#111c31;
  --line:#22324d;
  --line-strong:#30415f;
  --text:#e2e8f0;
  --text-soft:#cbd5e1;
  --text-muted:#94a3b8;
  --primary:#60a5fa;
  --primary-soft:rgba(96,165,250,.12);
  --shadow:0 1px 2px rgba(0,0,0,.22), 0 16px 38px rgba(0,0,0,.30);
}
body,.page-content{background:var(--bg);color:var(--text);}

a{text-decoration:none;}
button,input,select{font:inherit;}

.nodes-shell{display:grid;gap:1rem;}

.page-header{
  display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;
}
.page-title{display:flex;align-items:flex-start;gap:.9rem;}
.page-title-badge{
  width:42px;height:42px;border-radius:14px;background:linear-gradient(180deg,var(--primary-soft),transparent);
  border:1px solid rgba(37,99,235,.16);display:grid;place-items:center;color:var(--primary);font-size:1rem;flex:none;
}
.page-title h2{margin:0;font-size:1.15rem;font-weight:800;letter-spacing:-.02em;}
.page-title p{margin:.25rem 0 0;font-size:.82rem;color:var(--text-muted);}
.page-title p a{color:var(--primary);font-weight:700;}

.btn-primary{
  height:42px;padding:0 1rem;border:none;border-radius:12px;background:var(--text);color:#fff;
  display:inline-flex;align-items:center;gap:.55rem;font-weight:700;box-shadow:var(--shadow);cursor:pointer;
  transition:transform .18s ease,opacity .18s ease,background .18s ease;
}
.btn-primary:hover{transform:translateY(-1px);opacity:.95;}
.dark .btn-primary{background:var(--primary);color:#081120;}

.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:.9rem;}
.stat-card{
  background:var(--surface);border:1px solid var(--line);border-radius:var(--radius);padding:1rem 1.05rem;
  box-shadow:var(--shadow);display:flex;align-items:center;gap:.85rem;
}
.stat-icon{
  width:42px;height:42px;border-radius:14px;background:var(--surface-soft);border:1px solid var(--line);
  display:grid;place-items:center;color:var(--text-soft);font-size:1rem;flex:none;
}
.stat-value{font-size:1.4rem;font-weight:800;letter-spacing:-.03em;line-height:1;}
.stat-label{margin-top:.2rem;font-size:.72rem;letter-spacing:.08em;text-transform:uppercase;color:var(--text-muted);font-weight:700;}
.stat-unit{font-size:.78rem;color:var(--text-muted);margin-left:.2rem;}

.toolbar{
  background:var(--surface);border:1px solid var(--line);border-radius:var(--radius);box-shadow:var(--shadow);
  padding:1rem;display:grid;gap:.8rem;
}
.toolbar-row{display:flex;gap:.75rem;flex-wrap:wrap;align-items:center;}
.field-wrap{position:relative;}
.field-icon{position:absolute;left:.85rem;top:50%;transform:translateY(-50%);color:var(--text-muted);pointer-events:none;}
.input,.select,.date-input{
  height:42px;background:var(--surface-soft);border:1px solid var(--line);border-radius:12px;color:var(--text);
  padding:0 .9rem;font-size:.86rem;outline:none;transition:border-color .18s ease, box-shadow .18s ease, background .18s ease;
}
.input{padding-left:2.45rem;min-width:240px;}
.select,.date-input{min-width:170px;}
.input:focus,.select:focus,.date-input:focus,.form-input:focus{
  border-color:rgba(37,99,235,.5);box-shadow:0 0 0 4px rgba(37,99,235,.10);
}
.pill-count{
  margin-left:auto;display:inline-flex;align-items:center;gap:.45rem;height:42px;padding:0 .95rem;border-radius:999px;
  background:var(--surface-soft);border:1px solid var(--line);font-size:.82rem;color:var(--text-muted);font-weight:700;
}
.pill-count strong{color:var(--text);font-size:.92rem;}

.nodes-board{
  background:var(--surface);border:1px solid var(--line);border-radius:calc(var(--radius) + 2px);box-shadow:var(--shadow);
  overflow:hidden;
}
.table-scroll{overflow:auto;padding:.35rem;}

table{width:100%;border-collapse:separate;border-spacing:0 .42rem;min-width:980px;}
thead th{
  background:transparent;border:none;padding:0 .7rem .1rem;font-size:.62rem;font-weight:800;letter-spacing:.08em;
  color:var(--text-muted);text-transform:uppercase;text-align:left;white-space:nowrap;
}
thead th.center{text-align:center;}

tbody td{
  background:var(--surface-soft);border-top:1px solid var(--line);border-bottom:1px solid var(--line);
  padding:.62rem .7rem;vertical-align:middle;font-size:.76rem;color:var(--text-soft);white-space:nowrap;
  transition:background .18s ease,border-color .18s ease,transform .18s ease, box-shadow .18s ease;
}
tbody tr td:first-child{border-left:1px solid var(--line);border-top-left-radius:12px;border-bottom-left-radius:12px;}
tbody tr td:last-child{border-right:1px solid var(--line);border-top-right-radius:12px;border-bottom-right-radius:12px;}
tbody tr.row-card{cursor:pointer;}
tbody tr.row-card:hover td{
  background:#ffffff;border-color:rgba(37,99,235,.18);box-shadow:0 8px 20px rgba(15,23,42,.05);
}
.dark tbody tr.row-card:hover td{background:#13203a;}

.index-badge{
  width:26px;height:26px;border-radius:8px;border:1px solid var(--line);display:grid;place-items:center;
  color:var(--text-muted);font-weight:700;background:var(--surface);font-size:.7rem;
}
.node-anchor{
  display:inline-flex;align-items:center;gap:.42rem;padding:.32rem .56rem;border-radius:10px;
  background:var(--primary-soft);border:1px solid rgba(37,99,235,.16);color:var(--primary);font-weight:800;font-size:.73rem;
}
.node-sub{display:block;margin-top:.2rem;font-size:.66rem;color:var(--text-muted);font-weight:600;}

.text-main{color:var(--text);font-weight:700;}
.text-soft{color:var(--text-soft);}
.text-muted{color:var(--text-muted);}
.ellipsis{max-width:130px;overflow:hidden;text-overflow:ellipsis;}
.center{text-align:center;}
.mono{font-variant-numeric:tabular-nums;}

.status-pill{
  display:inline-flex;align-items:center;justify-content:center;min-width:88px;padding:.3rem .52rem;border-radius:999px;
  font-size:.64rem;font-weight:800;letter-spacing:.03em;border:1px solid transparent;
}
.status-ongoing{background:rgba(217,119,6,.08);color:var(--warning);border-color:rgba(217,119,6,.14);}
.status-completed{background:rgba(22,163,74,.08);color:var(--success);border-color:rgba(22,163,74,.14);}
.status-billing{background:rgba(37,99,235,.08);color:var(--primary);border-color:rgba(37,99,235,.14);}
.status-pending{background:rgba(220,38,38,.08);color:var(--danger);border-color:rgba(220,38,38,.14);}
.status-default{background:rgba(148,163,184,.10);color:var(--text-muted);border-color:var(--line);}

.progress-stack{display:flex;align-items:center;gap:.45rem;justify-content:center;}
.progress-track{
  width:64px;height:7px;border-radius:999px;background:rgba(148,163,184,.18);overflow:hidden;
}
.progress-fill{height:100%;border-radius:999px;background:linear-gradient(90deg,var(--primary),#93c5fd);}
.progress-value{min-width:28px;font-weight:800;color:var(--text);font-size:.7rem;}

.action-group{display:flex;align-items:center;justify-content:flex-end;gap:.3rem;position:relative;z-index:2;}
.icon-btn{
  width:28px;height:28px;border-radius:8px;border:1px solid var(--line);background:var(--surface);color:var(--text-soft);
  display:grid;place-items:center;cursor:pointer;transition:all .18s ease;font-size:.76rem;
}
.icon-btn:hover{transform:translateY(-1px);}
.icon-btn.edit:hover{color:var(--primary);border-color:rgba(37,99,235,.26);background:var(--primary-soft);}
.icon-btn.delete:hover{color:var(--danger);border-color:rgba(220,38,38,.22);background:rgba(220,38,38,.06);}
.icon-btn.map:hover{color:var(--success);border-color:rgba(22,163,74,.22);background:rgba(22,163,74,.06);}

.empty-state{padding:4rem 1rem;text-align:center;color:var(--text-muted);}
.empty-state i{font-size:2rem;display:block;margin-bottom:.7rem;color:var(--primary);}

#nodeOv,#delOv{position:fixed;inset:0;z-index:1000;background:rgba(15,23,42,.55);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .2s ease;}
#nodeOv.open,#delOv.open{opacity:1;pointer-events:auto;}

.modal-card,.confirm-card{
  width:100%;background:var(--surface);border:1px solid var(--line);box-shadow:0 24px 60px rgba(15,23,42,.16);
  border-radius:24px;transform:translateY(10px) scale(.98);opacity:0;transition:all .22s ease;
}
#nodeOv.open .modal-card,#delOv.open .confirm-card{transform:translateY(0) scale(1);opacity:1;}
.modal-card{max-width:900px;max-height:calc(100vh - 2rem);display:flex;flex-direction:column;overflow:hidden;}
.confirm-card{max-width:400px;padding:1.35rem;}
.modal-head,.modal-foot{padding:1rem 1.15rem;border-color:var(--line);}
.modal-head{display:flex;align-items:center;justify-content:space-between;gap:.8rem;border-bottom:1px solid var(--line);}
.modal-foot{display:flex;align-items:center;justify-content:flex-end;gap:.65rem;border-top:1px solid var(--line);}
.modal-body{padding:1.15rem;overflow:auto;}
.modal-title{font-size:1rem;font-weight:800;margin:0;color:var(--text);}
.modal-note{font-size:.78rem;color:var(--text-muted);margin-top:.25rem;}
.close-btn,.btn-secondary,.btn-danger,.btn-save{
  height:40px;border-radius:12px;cursor:pointer;font-weight:700;transition:all .18s ease;
}
.close-btn{
  width:40px;border:1px solid var(--line);background:var(--surface-soft);color:var(--text-soft);
}
.btn-secondary{border:1px solid var(--line);background:var(--surface-soft);color:var(--text-soft);padding:0 1rem;}
.btn-danger{border:none;background:var(--danger);color:#fff;padding:0 1rem;}
.btn-save{border:none;background:var(--text);color:#fff;padding:0 1.1rem;display:inline-flex;align-items:center;gap:.55rem;}
.dark .btn-save{background:var(--primary);color:#081120;}

.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:.95rem;}
.form-full{grid-column:1 / -1;}
.form-section{
  grid-column:1 / -1;display:flex;align-items:center;gap:.8rem;margin:.2rem 0 -.1rem;
}
.form-section span{
  white-space:nowrap;font-size:.72rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:var(--text-muted);
}
.form-section::after{content:"";height:1px;background:var(--line);flex:1;}
.form-label{display:block;margin-bottom:.4rem;font-size:.75rem;font-weight:800;color:var(--text-soft);}
.form-input{
  width:100%;height:42px;padding:0 .9rem;border:1px solid var(--line);border-radius:12px;background:var(--surface-soft);color:var(--text);
}
.form-input.error{border-color:rgba(220,38,38,.5);box-shadow:0 0 0 4px rgba(220,38,38,.08);}
.unit-field{position:relative;}
.unit-field .form-input{padding-right:3rem;}
.unit-tag{position:absolute;right:.85rem;top:50%;transform:translateY(-50%);font-size:.72rem;font-weight:700;color:var(--text-muted);pointer-events:none;}
.progress-readonly{display:flex;align-items:center;gap:.8rem;padding-top:.2rem;}
.progress-readonly .progress-track{flex:1;width:auto;height:10px;}
.progress-readonly .progress-value{text-align:right;min-width:42px;}

.toast-wrap{position:fixed;right:1.25rem;bottom:1.25rem;display:flex;flex-direction:column;gap:.6rem;z-index:1200;}
.toast{
  min-width:240px;padding:.8rem .95rem;border-radius:14px;background:var(--surface);border:1px solid var(--line);
  box-shadow:var(--shadow);display:flex;align-items:center;gap:.65rem;font-size:.84rem;font-weight:700;
  transform:translateX(120%);opacity:0;transition:all .24s ease;
}
.toast.show{transform:translateX(0);opacity:1;}
.toast.t-ok{border-color:rgba(22,163,74,.18);}
.toast.t-err{border-color:rgba(220,38,38,.18);}

@media (max-width: 900px){
  .toolbar-row{align-items:stretch;}
  .pill-count{margin-left:0;}
}
@media (max-width: 720px){
  .form-grid{grid-template-columns:1fr;}
}
</style>
@endpush

<div class="col-span-full">
  <div class="nodes-shell">

    <div class="page-header">
      <div class="page-title">
        <div class="page-title-badge"><i class="mgc_router_line"></i></div>
        <div>
          <h2>Nodes</h2>
          <p>
            Project: <strong>{{ $project->name }}</strong>
            <span style="margin:0 .45rem;">·</span>
            <a href="{{ auth()->user()->role === 'admin' ? route('admin.projects.index') : route('pm.projects.index') }}">Back to Projects</a>
          </p>
        </div>
      </div>
      <button class="btn-primary" id="btnOpenAdd"><i class="mgc_add_line"></i> Add Node ID</button>
    </div>

    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon"><i class="mgc_router_line"></i></div>
        <div><div class="stat-value" id="statTotal">0</div><div class="stat-label">Total Nodes</div></div>
      </div>
      <div class="stat-card">
        <div class="stat-icon"><i class="mgc_calendar_line"></i></div>
        <div><div class="stat-value" id="statOngoing">0</div><div class="stat-label">Ongoing</div></div>
      </div>
      <div class="stat-card">
        <div class="stat-icon"><i class="mgc_check_circle_line"></i></div>
        <div><div class="stat-value" id="statDone">0</div><div class="stat-label">Completed</div></div>
      </div>
      <div class="stat-card">
        <div class="stat-icon"><i class="mgc_pause_circle_line"></i></div>
        <div><div class="stat-value" id="statHold">0</div><div class="stat-label">Billing in Process</div></div>
      </div>
      <div class="stat-card">
        <div class="stat-icon"><i class="mgc_cable_line"></i></div>
        <div><div class="stat-value"><span id="statStrand">0</span><span class="stat-unit">m</span></div><div class="stat-label">Total Strand</div></div>
      </div>
    </div>

    <div class="toolbar">
      <div class="toolbar-row">
        <div class="field-wrap">
          <i class="mgc_search_line field-icon"></i>
          <input id="fSearch" type="text" placeholder="Search node, city, province..." class="input" />
        </div>
        <select id="fRegion" class="select">
          <option value="">All Provinces</option>
          <option>SOUTH LUZON</option>
          <option>NORTH LUZON</option>
          <option>NCR</option>
          <option>VISAYAS</option>
          <option>MINDANAO</option>
        </select>
        <select id="fStatusF" class="select">
          <option value="">All Status</option>
          <option value="ON GOING">On Going</option>
          <option value="PENDING">Pending</option>
          <option value="COMPLETED">Completed</option>
          <option value="BILLING">Billing in Process</option>
        </select>
        <select id="fSubconF" class="select">
          <option value="">All Subcon</option>
          @foreach($subcontractors as $sc)
            <option value="{{ $sc->id }}">{{ $sc->name }}</option>
          @endforeach
        </select>
        <input id="fDueFilter" type="date" class="date-input" title="Filter by due date" />
        <div class="pill-count"><strong id="showCount">0</strong> visible</div>
      </div>
    </div>

    <div class="nodes-board">
      <div class="table-scroll">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Node</th>
              <th>Name</th>
              <th>Province</th>
              <th>City / District</th>
              <th>Sites</th>
              <th>Subcon</th>
              <th>Team</th>
              <th class="center">Status</th>
              <th class="center">Strand</th>
              <th class="center">Expected</th>
              <th class="center">Actual</th>
              <th class="center">Extender</th>
              <th class="center">TSC</th>
              <th class="center">Node</th>
              <th class="center">Amp</th>
              <th class="center">Due</th>
              <th class="center">Progress</th>
              <th class="center">Actions</th>
            </tr>
          </thead>
          <tbody id="nodeTbody"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="nodeOv">
  <div class="modal-card">
    <div class="modal-head">
      <div>
        <div class="modal-title" id="modalTitle">Add Node ID</div>
        <div class="modal-note">Fields marked with * are required.</div>
      </div>
      <button class="close-btn" id="btnClose"><i class="mgc_close_line"></i></button>
    </div>
    <div class="modal-body">
      <form id="nodeForm" class="form-grid" novalidate>
        <input type="hidden" id="editId"/>

        <div class="form-section"><span>Basic Information</span></div>

        <div>
          <label class="form-label" for="fNodeId">Node ID *</label>
          <input id="fNodeId" class="form-input" type="text" placeholder="e.g. QC-1104" required/>
        </div>
        <div>
          <label class="form-label" for="fNodeName">Node Name</label>
          <input id="fNodeName" class="form-input" type="text" placeholder="e.g. Bagong Silang Exchange"/>
        </div>
        <div>
          <label class="form-label" for="fRegion2">Province</label>
          <input id="fRegion2" class="form-input" type="text" placeholder="e.g. Metro Manila"/>
        </div>
        <div>
          <label class="form-label" for="fCity">City / District</label>
          <input id="fCity" class="form-input" type="text" placeholder="e.g. Quezon City, District 2"/>
        </div>
        <div class="form-full">
          <label class="form-label" for="fSites">Sites *</label>
          <select id="fSites" class="form-input">
            <option value="">— Select Site —</option>
            <option>South Luzon</option>
            <option>North Luzon</option>
            <option>NCR</option>
            <option>Visayas</option>
            <option>Mindanao</option>
          </select>
        </div>
        <div>
          <label class="form-label" for="fSubcon2">Subcontractor</label>
          <select id="fSubcon2" class="form-input">
            <option value="">— None —</option>
            @foreach($subcontractors as $sc)
              <option value="{{ $sc->id }}">{{ $sc->name }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="form-label" for="fTeam">Assigned Team</label>
          <select id="fTeam" class="form-input">
            <option value="">— No Team —</option>
          </select>
        </div>
        <div>
          <label class="form-label" for="fStatus">Status *</label>
          <select id="fStatus" class="form-input">
            <option value="ON GOING">On Going</option>
            <option value="PENDING">Pending</option>
            <option value="COMPLETED">Completed</option>
            <option value="BILLING ON PROCESS">Billing in Process</option>
          </select>
        </div>
        <div>
          <label class="form-label" for="fApprovedBy">Approved By</label>
          <input id="fApprovedBy" class="form-input" type="text" placeholder="Name / Client / Team"/>
        </div>

        <div class="form-section"><span>Dates</span></div>
        <div>
          <label class="form-label" for="fDueDate">Due Date</label>
          <input id="fDueDate" class="form-input" type="date"/>
        </div>
        <div>
          <label class="form-label" for="fDateStart">Date Start</label>
          <input id="fDateStart" class="form-input" type="date"/>
        </div>
        <div>
          <label class="form-label" for="fDateFinished">Date Finished</label>
          <input id="fDateFinished" class="form-input" type="date"/>
        </div>

        <div class="form-section"><span>Node Totals</span></div>
        <div class="unit-field">
          <label class="form-label" for="fTotStrand">Total Strand Length</label>
          <input id="fTotStrand" class="form-input" type="number" step="0.1" min="0" placeholder="0.0"/>
          <span class="unit-tag">m</span>
        </div>
        <div class="unit-field">
          <label class="form-label" for="fTotActual">Expected Cable</label>
          <input id="fTotActual" class="form-input" type="number" step="0.1" min="0" placeholder="0.0"/>
          <span class="unit-tag">m</span>
        </div>
        <div class="unit-field">
          <label class="form-label" for="fActualCable">Actual Cable</label>
          <input id="fActualCable" class="form-input" type="number" step="0.1" min="0" placeholder="0.0"/>
          <span class="unit-tag">m</span>
        </div>
        <div class="unit-field">
          <label class="form-label" for="fTotExt">Extender</label>
          <input id="fTotExt" class="form-input" type="number" step="1" min="0" placeholder="0"/>
          <span class="unit-tag">pcs</span>
        </div>
        <div class="unit-field">
          <label class="form-label" for="fTotTsc">TSC</label>
          <input id="fTotTsc" class="form-input" type="number" step="1" min="0" placeholder="0"/>
          <span class="unit-tag">pcs</span>
        </div>
        <div class="unit-field">
          <label class="form-label" for="fTotNode">Node Devices</label>
          <input id="fTotNode" class="form-input" type="number" step="1" min="0" placeholder="0"/>
          <span class="unit-tag">pcs</span>
        </div>
        <div class="unit-field">
          <label class="form-label" for="fTotAmp">Amplifier</label>
          <input id="fTotAmp" class="form-input" type="number" step="1" min="0" placeholder="0"/>
          <span class="unit-tag">pcs</span>
        </div>

        <div class="form-section"><span>Progress</span></div>
        <div class="form-full">
          <label class="form-label">Progress Bar (Read Only)</label>
          <input type="hidden" id="fProgress" value="0"/>
          <div class="progress-readonly">
            <div class="progress-track"><div class="progress-fill" id="fPfill" style="width:0%"></div></div>
            <div class="progress-value" id="fPpct">0%</div>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-foot">
      <button class="btn-secondary" id="btnCancel" type="button">Cancel</button>
      <button class="btn-save" id="btnSave" type="button"><i class="mgc_save_line"></i> <span id="saveLbl">Save Node</span></button>
    </div>
  </div>
</div>

<div id="delOv">
  <div class="confirm-card">
    <div style="width:48px;height:48px;border-radius:14px;background:rgba(220,38,38,.08);color:var(--danger);display:grid;place-items:center;font-size:1.2rem;margin-bottom:1rem;">
      <i class="mgc_delete_2_line"></i>
    </div>
    <div style="font-size:1rem;font-weight:800;color:var(--text);margin-bottom:.3rem;">Delete Node?</div>
    <p style="font-size:.84rem;color:var(--text-muted);margin:0 0 1.1rem;" id="delMsg">This cannot be undone.</p>
    <div style="display:flex;justify-content:flex-end;gap:.65rem;">
      <button class="btn-secondary" id="btnDelCancel">Cancel</button>
      <button class="btn-danger" id="btnDelConfirm"><i class="mgc_delete_2_line"></i> Delete</button>
    </div>
  </div>
</div>

<div class="toast-wrap" id="toastWrap"></div>

@push('scripts')
<script>
(function(){
  const NODES = @json($nodes);
  const TEAMS_BY_SUBCON = @json($teams);
  const STORE_URL = "{{ auth()->user()->role === 'admin' ? route('admin.projects.nodes.store', $project) : route('pm.projects.nodes.store', $project) }}";
  const BASE_URL = "{{ auth()->user()->role === 'admin' ? url('admin/projects/' . $project->id . '/nodes') : url('pm/projects/' . $project->id . '/nodes') }}";
  const CSRF = document.querySelector('meta[name="csrf-token"]').content;

  let rows = JSON.parse(JSON.stringify(NODES));
  let pendingDelId = null;
  const $ = id => document.getElementById(id);

  function populateTeams(subconId, selectedTeam) {
    const sel = $('fTeam');
    const teams = subconId ? (TEAMS_BY_SUBCON[subconId] || []) : [];
    sel.innerHTML = '<option value="">— No Team —</option>';
    teams.forEach(t => {
      const opt = document.createElement('option');
      opt.value = t.team_name;
      opt.textContent = t.team_name;
      if (selectedTeam && t.team_name === selectedTeam) opt.selected = true;
      sel.appendChild(opt);
    });
  }

  function toast(msg, type='ok'){
    const wrap = $('toastWrap');
    const el = document.createElement('div');
    el.className = `toast t-${type}`;
    el.innerHTML = `<i class="mgc_${type==='ok'?'check_circle_line':'close_circle_line'}" style="font-size:1rem;color:${type==='ok'?'#16a34a':'#dc2626'}"></i><span>${msg}</span>`;
    wrap.appendChild(el);
    requestAnimationFrame(() => requestAnimationFrame(() => el.classList.add('show')));
    setTimeout(() => {
      el.classList.remove('show');
      setTimeout(() => el.remove(), 260);
    }, 2800);
  }

  function renderStats(list){
    $('statTotal').textContent = list.length;
    $('statOngoing').textContent = list.filter(n => /on going/i.test(n.status)).length;
    $('statDone').textContent = list.filter(n => /complete/i.test(n.status)).length;
    $('statHold').textContent = list.filter(n => /billing/i.test(n.status)).length;
    $('statStrand').textContent = list.reduce((sum, n) => sum + (parseFloat(n.strand_m) || 0), 0).toFixed(1);
  }

  function statusBadge(status){
    const value = status || '—';
    if (/on going/i.test(value)) return `<span class="status-pill status-ongoing">${value}</span>`;
    if (/complete/i.test(value)) return `<span class="status-pill status-completed">${value}</span>`;
    if (/billing/i.test(value)) return `<span class="status-pill status-billing">${value}</span>`;
    if (/pending/i.test(value)) return `<span class="status-pill status-pending">${value}</span>`;
    return `<span class="status-pill status-default">${value}</span>`;
  }

  function getFiltered(){
    const q = ($('fSearch').value || '').toLowerCase();
    const reg = $('fRegion').value.toLowerCase();
    const st = $('fStatusF').value.toLowerCase();
    const sc = $('fSubconF').value;
    const due = $('fDueFilter').value;

    return rows.filter(n => {
      if (q && ![(n.node_code||''),(n.node_name||''),(n.region||''),(n.city||''),(n.sites||'')].join(' ').toLowerCase().includes(q)) return false;
      if (reg && !(n.region || '').toLowerCase().includes(reg)) return false;
      if (st && !(n.status || '').toLowerCase().includes(st)) return false;
      if (sc && String(n.subcon_id) !== sc) return false;
      if (due && n.due_date && n.due_date.slice(0,10) !== due) return false;
      return true;
    });
  }

  function renderTable(){
    const list = getFiltered();
    renderStats(list);
    $('showCount').textContent = list.length;

    if (!list.length){
      $('nodeTbody').innerHTML = `
        <tr>
          <td colspan="19">
            <div class="empty-state">
              <i class="mgc_router_line"></i>
              No nodes found. Click “Add Node ID” to create your first record.
            </div>
          </td>
        </tr>`;
      return;
    }

    $('nodeTbody').innerHTML = list.map((n, i) => {
      const subName = n.subcontractor ? n.subcontractor.name : '—';
      const prog = Number(n.progress || 0);
      const due = n.due_date ? n.due_date.slice(0,10) : '—';
      const polesUrl = `${BASE_URL}/${n.id}/poles`;
      const mapUrl = `${BASE_URL}/${n.id}/vicinity-map`;

      return `
        <tr class="row-card" data-row-link="${polesUrl}">
          <td><div class="index-badge">${i + 1}</div></td>
          <td>
            <a class="node-anchor" href="${polesUrl}">
              <i class="mgc_router_line"></i>
              <span>${n.node_code || '—'}</span>
            </a>
            
          </td>
          <td><div class="text-main ellipsis" title="${n.node_name || ''}">${n.node_name || '—'}</div></td>
          <td><div class="text-soft">${n.region || '—'}</div></td>
          <td><div class="text-soft ellipsis" title="${n.city || ''}">${n.city || '—'}</div></td>
          <td><div class="text-soft ellipsis" title="${n.sites || ''}">${n.sites || '—'}</div></td>
          <td><div class="text-soft">${subName}</div></td>
          <td><div class="text-soft">${n.team || '—'}</div></td>
          <td class="center">${statusBadge(n.status)}</td>
          <td class="center mono">${(+n.strand_m || 0).toFixed(1)} m</td>
          <td class="center mono">${(+n.cable_m || 0).toFixed(1)} m</td>
          <td class="center mono">${(+n.actual_cable_m || 0).toFixed(1)} m</td>
          <td class="center mono">${n.extender_count || 0}</td>
          <td class="center mono">${n.tsc_count || 0}</td>
          <td class="center mono">${n.node_device_count || 0}</td>
          <td class="center mono">${n.amp_count || 0}</td>
          <td class="center text-soft">${due}</td>
          <td class="center">
            <div class="progress-stack">
              <div class="progress-track"><div class="progress-fill" style="width:${prog}%"></div></div>
              <div class="progress-value">${prog}%</div>
            </div>
          </td>
          <td>
            <div class="action-group">
              <a class="icon-btn map no-row-link" href="${mapUrl}" target="_blank" title="Vicinity Map"><i class="mgc_map_line"></i></a>
              <button class="icon-btn edit no-row-link" data-act="edit" data-id="${n.id}" type="button" title="Edit"><i class="mgc_edit_2_line"></i></button>
              <button class="icon-btn delete no-row-link" data-act="del" data-id="${n.id}" type="button" title="Delete"><i class="mgc_delete_2_line"></i></button>
            </div>
          </td>
        </tr>`;
    }).join('');
  }

  function openModal(){ $('nodeOv').classList.add('open'); document.body.style.overflow='hidden'; }
  function closeModal(){ $('nodeOv').classList.remove('open'); document.body.style.overflow=''; }
  function openDel(id){
    const node = rows.find(x => x.id == id);
    if (!node) return;
    pendingDelId = id;
    $('delMsg').textContent = `Delete node "${node.node_code}"? All poles in this node will also be deleted.`;
    $('delOv').classList.add('open');
    document.body.style.overflow='hidden';
  }
  function closeDel(){ $('delOv').classList.remove('open'); document.body.style.overflow=''; pendingDelId = null; }

  function resetForm(){
    $('nodeForm').reset();
    $('editId').value = '';
    $('modalTitle').textContent = 'Add Node ID';
    $('saveLbl').textContent = 'Save Node';
    $('fPfill').style.width = '0%';
    $('fPpct').textContent = '0%';
    $('fNodeId').classList.remove('error');
    populateTeams('', '');
  }

  function loadEdit(id){
    const n = rows.find(x => x.id == id);
    if (!n) return;
    resetForm();

    $('editId').value = n.id;
    $('modalTitle').textContent = 'Edit Node ID';
    $('saveLbl').textContent = 'Update Node';
    $('fNodeId').value = n.node_code || '';
    $('fNodeName').value = n.node_name || '';
    $('fSites').value = n.sites || '';
    $('fRegion2').value = n.region || '';
    $('fCity').value = n.city || '';
    $('fSubcon2').value = n.subcon_id || '';
    populateTeams(n.subcon_id, n.team || '');
    $('fStatus').value = n.status || 'ON GOING';
    $('fApprovedBy').value = n.approved_by || '';
    $('fDueDate').value = (n.due_date || '').slice(0,10);
    $('fDateStart').value = (n.start_date || '').slice(0,10);
    $('fDateFinished').value = (n.completed_date || '').slice(0,10);
    $('fTotStrand').value = n.strand_m || 0;
    $('fTotActual').value = n.cable_m || 0;
    $('fActualCable').value = n.actual_cable_m || 0;
    $('fTotExt').value = n.extender_count || 0;
    $('fTotTsc').value = n.tsc_count || 0;
    $('fTotNode').value = n.node_device_count || 0;
    $('fTotAmp').value = n.amp_count || 0;

    const prog = Number(n.progress || 0);
    $('fProgress').value = prog;
    $('fPfill').style.width = `${prog}%`;
    $('fPpct').textContent = `${prog}%`;
    openModal();
  }

  async function saveNode(){
    const code = $('fNodeId').value.trim();
    if (!code){
      $('fNodeId').classList.add('error');
      return;
    }

    $('fNodeId').classList.remove('error');
    const editId = $('editId').value;
    const url = editId ? `${BASE_URL}/${editId}` : STORE_URL;
    const fd = new FormData();

    fd.append('_token', CSRF);
    fd.append('node_code', code);
    fd.append('node_name', $('fNodeName').value.trim());
    fd.append('sites', $('fSites').value.trim());
    fd.append('region', $('fRegion2').value.trim());
    fd.append('city', $('fCity').value.trim());
    fd.append('subcon_id', $('fSubcon2').value);
    fd.append('team', $('fTeam').value);
    fd.append('status', $('fStatus').value);
    fd.append('approved_by', $('fApprovedBy').value.trim());
    fd.append('due_date', $('fDueDate').value);
    fd.append('start_date', $('fDateStart').value);
    fd.append('completed_date', $('fDateFinished').value);
    fd.append('strand_m', $('fTotStrand').value || 0);
    fd.append('cable_m', $('fTotActual').value || 0);
    fd.append('actual_cable_m', $('fActualCable').value || 0);
    fd.append('extender_count', $('fTotExt').value || 0);
    fd.append('tsc_count', $('fTotTsc').value || 0);
    fd.append('node_device_count', $('fTotNode').value || 0);
    fd.append('amp_count', $('fTotAmp').value || 0);

    const btn = $('btnSave');
    btn.disabled = true;
    btn.innerHTML = '<i class="mgc_loading_4_line"></i> Saving...';

    try{
      const res = await fetch(url, {
        method:'POST',
        headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
        body:fd
      });
      const data = await res.json();
      if (!res.ok || !data.success){
        toast(data.message || 'Something went wrong.', 'err');
        return;
      }

      if (editId){
        const idx = rows.findIndex(x => String(x.id) === String(editId));
        if (idx >= 0) rows[idx] = data.node;
      } else {
        rows.unshift(data.node);
      }

      closeModal();
      renderTable();
      toast(editId ? 'Node updated.' : 'Node added.');
    } catch (e){
      toast('Network error.', 'err');
    } finally {
      btn.disabled = false;
      btn.innerHTML = '<i class="mgc_save_line"></i> <span id="saveLbl">Save Node</span>';
    }
  }

  async function confirmDel(){
    if (!pendingDelId) return;
    const btn = $('btnDelConfirm');
    btn.disabled = true;
    btn.innerHTML = '<i class="mgc_loading_4_line"></i> Deleting...';

    try{
      const res = await fetch(`${BASE_URL}/${pendingDelId}`, {
        method:'DELETE',
        headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}
      });
      const data = await res.json();
      if (!res.ok || !data.success){
        toast(data.message || 'Delete failed.', 'err');
        return;
      }
      rows = rows.filter(x => x.id != pendingDelId);
      closeDel();
      renderTable();
      toast('Node deleted.');
    } catch (e){
      toast('Network error.', 'err');
    } finally {
      btn.disabled = false;
      btn.innerHTML = '<i class="mgc_delete_2_line"></i> Delete';
    }
  }

  $('btnOpenAdd').addEventListener('click', () => { resetForm(); openModal(); });
  $('btnClose').addEventListener('click', closeModal);
  $('btnCancel').addEventListener('click', closeModal);
  $('btnSave').addEventListener('click', saveNode);
  $('btnDelCancel').addEventListener('click', closeDel);
  $('btnDelConfirm').addEventListener('click', confirmDel);

  $('nodeOv').addEventListener('click', e => { if (e.target === $('nodeOv')) closeModal(); });
  $('delOv').addEventListener('click', e => { if (e.target === $('delOv')) closeDel(); });

  $('fSubcon2').addEventListener('change', function(){ populateTeams(this.value, ''); });

  $('nodeTbody').addEventListener('click', e => {
    const actionBtn = e.target.closest('[data-act]');
    if (actionBtn){
      if (actionBtn.dataset.act === 'edit') loadEdit(actionBtn.dataset.id);
      if (actionBtn.dataset.act === 'del') openDel(actionBtn.dataset.id);
      return;
    }

    const skip = e.target.closest('.no-row-link, a, button');
    if (skip) return;

    const row = e.target.closest('tr[data-row-link]');
    if (row) window.location.href = row.dataset.rowLink;
  });

  ['fSearch','fRegion','fStatusF','fSubconF','fDueFilter'].forEach(id => {
    $(id).addEventListener('input', renderTable);
    $(id).addEventListener('change', renderTable);
  });

  document.addEventListener('keydown', e => {
    if (e.key === 'Escape'){
      if ($('nodeOv').classList.contains('open')) closeModal();
      if ($('delOv').classList.contains('open')) closeDel();
    }
  });

  renderTable();
})();
</script>
@endpush

</x-layout>
```
