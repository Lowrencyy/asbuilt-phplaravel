<x-layout>

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet"/>
<style>
*,*::before,*::after{box-sizing:border-box;}
:root{
  --p:#2d6ff7;--p2:#1a56d6;--pg:rgba(45,111,247,.1);
  --ok:#16a34a;--ok-bg:rgba(22,163,74,.1);
  --warn:#c07a00;--warn-bg:rgba(245,158,11,.1);
  --done:#2d6ff7;--done-bg:rgba(45,111,247,.1);
  --bg:#f0f4fa;--surf:#ffffff;--surf2:#f7f9fc;
  --bdr:#e2e8f2;--bdr2:#d0d9ea;
  --txt:#0d1526;--txt2:#536380;--muted:#9aaabf;
  --r:16px;
  --sh:0 1px 2px rgba(13,21,38,.04),0 4px 20px rgba(13,21,38,.06);
  --sh-md:0 8px 32px rgba(13,21,38,.12);
  --sh-lg:0 20px 60px rgba(13,21,38,.18);
  --ff:'Sora',sans-serif;--fm:'Space Mono',monospace;
}
.dark{--bg:#08101f;--surf:#0f1c30;--surf2:#152540;--bdr:#1e3050;--bdr2:#26406a;--txt:#dce9ff;--txt2:#7a99c4;--muted:#3d5880;}
body{font-family:var(--ff);background:var(--bg);color:var(--txt);}
.hd{display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.5rem;}
.hd-left{display:flex;flex-direction:column;gap:.2rem;}
.eyebrow{font-size:.68rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--p);display:flex;align-items:center;gap:.4rem;}
.eyebrow::before{content:'';display:inline-block;width:18px;height:2px;background:var(--p);border-radius:2px;}
.hd h2{margin:0;font-size:1.65rem;font-weight:800;color:var(--txt);letter-spacing:-.02em;line-height:1.1;}
.hd p{margin:.25rem 0 0;color:var(--txt2);font-size:.8rem;font-weight:500;}
.btn-p{display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.25rem;background:var(--p);color:#fff;border:none;border-radius:12px;font-size:.83rem;font-weight:700;font-family:var(--ff);cursor:pointer;letter-spacing:.01em;box-shadow:0 2px 12px rgba(45,111,247,.3);transition:all .15s;}
.btn-p:hover{background:var(--p2);transform:translateY(-1px);}
.filters{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);padding:.85rem 1rem;display:flex;align-items:center;justify-content:space-between;gap:.75rem;margin-bottom:1.25rem;flex-wrap:wrap;}
.fleft{display:flex;align-items:center;gap:.6rem;flex:1;min-width:220px;}
.fright{display:flex;align-items:center;gap:.6rem;flex-wrap:wrap;justify-content:flex-end;}
.srch{display:flex;align-items:center;gap:.5rem;padding:0 .85rem;height:38px;border:1px solid var(--bdr);border-radius:12px;background:var(--surf2);transition:border-color .15s,box-shadow .15s;min-width:260px;}
.srch:focus-within{border-color:var(--p);box-shadow:0 0 0 3px rgba(45,111,247,.12);}
.srch i{color:var(--muted);font-size:.9rem;}
.srch input{border:none;outline:none;background:transparent;font-size:.83rem;font-family:var(--ff);color:var(--txt);flex:1;height:100%;}
.srch input::placeholder{color:var(--muted);}
.seg{display:flex;align-items:center;background:var(--surf2);border:1px solid var(--bdr);border-radius:12px;padding:3px;gap:2px;}
.seg-btn{padding:.32rem .75rem;border-radius:9px;font-size:.75rem;font-weight:700;font-family:var(--ff);cursor:pointer;border:none;background:transparent;color:var(--txt2);transition:all .15s;white-space:nowrap;}
.seg-btn.active{background:var(--surf);color:var(--txt);box-shadow:0 1px 4px rgba(13,21,38,.1);}
.count-badge{padding:.3rem .75rem;border-radius:999px;background:var(--pg);color:var(--p);font-size:.73rem;font-weight:700;font-family:var(--fm);white-space:nowrap;}
.proj-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:1rem;}
@media(max-width:1100px){.proj-grid{grid-template-columns:repeat(2,minmax(0,1fr));}}
@media(max-width:640px){.proj-grid{grid-template-columns:1fr;}}
.proj-grid:has(.card-link:hover) .card-link{filter:blur(3px) brightness(.72) saturate(.7);transform:scale(.98);opacity:.65;}
.proj-grid:has(.card-link:hover) .card-link:hover{filter:none;transform:translateY(-4px) scale(1.01);opacity:1;z-index:2;}
.card-link{display:block;text-decoration:none;color:inherit;border-radius:20px;position:relative;height:220px;transition:filter .25s,transform .25s,opacity .25s,box-shadow .25s;will-change:filter,transform,opacity;}
.card-link:hover .card{box-shadow:var(--sh-md);border-color:rgba(45,111,247,.28);}
.card{background:var(--surf);border:1px solid var(--bdr);border-radius:20px;overflow:hidden;box-shadow:var(--sh);transition:box-shadow .25s,border-color .25s;display:flex;flex-direction:column;height:220px;}
.card-strip{height:4px;width:100%;background:linear-gradient(90deg,var(--p),#60a5fa);}
.card-strip.onhold{background:linear-gradient(90deg,#f59e0b,#fcd34d);}
.card-strip.done{background:linear-gradient(90deg,#06b6d4,#a5f3fc);}
.card-strip.ongoing{background:linear-gradient(90deg,#2d6ff7,#60a5fa);}
.card-body{padding:1.1rem;flex:1;display:flex;flex-direction:column;}
.card-head{display:flex;align-items:flex-start;gap:.9rem;margin-bottom:1rem;}
.logo-wrap{width:54px;height:54px;flex-shrink:0;border-radius:14px;border:1px solid var(--bdr);background:var(--surf2);display:flex;align-items:center;justify-content:center;overflow:hidden;}
.logo-wrap img{width:100%;height:100%;object-fit:contain;padding:.45rem;}
.card-name-block{flex:1;min-width:0;}
.card-name{font-size:1rem;font-weight:800;color:var(--txt);line-height:1.2;margin:0 0 .3rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.card-client{font-size:.73rem;font-weight:600;color:var(--txt2);font-family:var(--fm);letter-spacing:.02em;}
.info-grid{display:grid;grid-template-columns:1fr 1fr;gap:.5rem .75rem;margin-bottom:.85rem;}
.info-item{display:flex;flex-direction:column;gap:.15rem;}
.info-lbl{font-size:.63rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);}
.info-val{font-size:.8rem;font-weight:600;color:var(--txt);font-family:var(--fm);}
.status-badge{display:inline-flex;align-items:center;gap:.35rem;padding:.28rem .65rem;border-radius:999px;font-size:.7rem;font-weight:700;letter-spacing:.04em;white-space:nowrap;}
.status-badge::before{content:'';width:6px;height:6px;border-radius:50%;display:inline-block;}
.status-badge.ongoing{background:var(--ok-bg);color:var(--ok);}
.status-badge.ongoing::before{background:var(--ok);box-shadow:0 0 0 2px rgba(22,163,74,.2);}
.status-badge.onhold{background:var(--warn-bg);color:var(--warn);}
.status-badge.onhold::before{background:var(--warn);}
.status-badge.done{background:var(--done-bg);color:var(--done);}
.status-badge.done::before{background:var(--done);}
.card-foot{margin-top:auto;display:flex;align-items:center;justify-content:space-between;padding-top:.75rem;border-top:1px solid var(--bdr);}
.updated-txt{font-size:.72rem;color:var(--muted);font-weight:500;display:flex;align-items:center;gap:.35rem;}
.act-row{display:flex;gap:.35rem;}
.ab{width:32px;height:32px;border-radius:10px;border:1px solid var(--bdr);background:var(--surf2);cursor:pointer;color:var(--txt2);display:inline-flex;align-items:center;justify-content:center;font-size:.85rem;transition:all .15s;}
.ab:hover{transform:translateY(-1px);}
.ab-e:hover{border-color:rgba(45,111,247,.3);background:rgba(45,111,247,.08);color:var(--p);}
.ab-d:hover{border-color:rgba(239,68,68,.3);background:rgba(239,68,68,.08);color:#ef4444;}
#projOverlay{position:fixed;inset:0;z-index:900;background:rgba(8,16,31,.65);backdrop-filter:blur(10px);display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .22s;}
#projOverlay.open{opacity:1;pointer-events:all;}
#pmc{background:var(--surf);border:1px solid var(--bdr);border-radius:22px;box-shadow:var(--sh-lg);width:100%;max-width:480px;transform:translateY(18px) scale(.97);opacity:0;transition:transform .28s cubic-bezier(.34,1.18,.64,1),opacity .22s;overflow:hidden;}
#projOverlay.open #pmc{transform:translateY(0) scale(1);opacity:1;}
.mhd{padding:1.1rem 1.25rem;border-bottom:1px solid var(--bdr);display:flex;align-items:center;gap:.75rem;}
.mhd-icon{width:40px;height:40px;border-radius:12px;flex-shrink:0;background:var(--pg);color:var(--p);display:flex;align-items:center;justify-content:center;font-size:1.1rem;}
.mhd-txt{flex:1;}
.mhd-t{font-size:.95rem;font-weight:800;color:var(--txt);}
.mhd-s{font-size:.72rem;color:var(--txt2);margin-top:.1rem;}
.mc-btn{width:30px;height:30px;border-radius:10px;border:1px solid var(--bdr);background:var(--surf2);display:flex;align-items:center;justify-content:center;color:var(--txt2);cursor:pointer;transition:all .15s;}
.mc-btn:hover{background:rgba(239,68,68,.08);border-color:rgba(239,68,68,.3);color:#ef4444;}
.mb{padding:1.25rem;}
.fg{display:flex;flex-direction:column;gap:.95rem;}
.lbl{display:block;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--txt2);margin-bottom:.35rem;}
.lbl span{color:#ef4444;}
.inp{width:100%;padding:.58rem .85rem;border:1px solid var(--bdr);border-radius:12px;background:var(--surf2);color:var(--txt);font-size:.85rem;font-family:var(--ff);outline:none;transition:border-color .15s,box-shadow .15s;}
.inp:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(45,111,247,.12);}
.inp::placeholder{color:var(--muted);}
.inp-e{border-color:rgba(239,68,68,.6)!important;box-shadow:0 0 0 3px rgba(239,68,68,.1)!important;}
.file-zone{position:relative;border:1.5px dashed var(--bdr2);border-radius:14px;padding:1.2rem;background:var(--surf2);display:flex;flex-direction:column;align-items:center;gap:.5rem;cursor:pointer;transition:border-color .15s,background .15s;}
.file-zone:hover{border-color:var(--p);background:var(--pg);}
.file-zone input[type="file"]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;}
.file-ico{width:40px;height:40px;border-radius:12px;background:var(--pg);color:var(--p);display:flex;align-items:center;justify-content:center;font-size:1.1rem;}
.file-hint{font-size:.78rem;color:var(--txt2);font-weight:600;text-align:center;}
.file-sub{font-size:.68rem;color:var(--muted);}
.file-preview-wrap{display:none;align-items:center;gap:.6rem;}
.file-preview-wrap.show{display:flex;}
.file-preview{width:42px;height:42px;border-radius:10px;border:1px solid var(--bdr);object-fit:contain;padding:.3rem;background:var(--surf);}
.file-name{font-size:.78rem;font-weight:600;color:var(--txt2);}
.file-clear{width:24px;height:24px;border-radius:8px;border:1px solid var(--bdr);background:var(--surf);display:flex;align-items:center;justify-content:center;color:var(--muted);cursor:pointer;font-size:.75rem;transition:all .15s;margin-left:auto;}
.file-clear:hover{color:#ef4444;border-color:rgba(239,68,68,.3);}
.dup-e{padding:.55rem .85rem;border-radius:12px;border:1px solid rgba(239,68,68,.25);background:rgba(239,68,68,.06);color:#ef4444;font-size:.78rem;font-weight:700;display:flex;align-items:center;gap:.4rem;}
.dup-e.hidden{display:none;}
.mft{padding:.9rem 1.25rem;border-top:1px solid var(--bdr);display:flex;align-items:center;justify-content:flex-end;gap:.6rem;}
.btn-c{padding:.52rem .95rem;border-radius:12px;border:1px solid var(--bdr);background:var(--surf2);color:var(--txt2);font-size:.83rem;font-weight:700;font-family:var(--ff);cursor:pointer;transition:all .15s;}
.btn-c:hover{background:var(--bdr);color:var(--txt);}
.btn-p:disabled{opacity:.6;cursor:not-allowed;transform:none;}
#delOv{position:fixed;inset:0;z-index:950;background:rgba(8,16,31,.7);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .2s;}
#delOv.open{opacity:1;pointer-events:all;}
#delCard{background:var(--surf);border:1px solid var(--bdr);border-radius:18px;box-shadow:var(--sh-lg);max-width:380px;width:100%;padding:1.5rem;transform:scale(.95);opacity:0;transition:transform .22s cubic-bezier(.34,1.18,.64,1),opacity .2s;}
#delOv.open #delCard{transform:scale(1);opacity:1;}
.del-ico{width:46px;height:46px;border-radius:14px;background:rgba(239,68,68,.1);color:#ef4444;display:flex;align-items:center;justify-content:center;font-size:1.2rem;margin-bottom:.9rem;}
.del-h{font-size:.95rem;font-weight:800;color:var(--txt);margin-bottom:.3rem;}
.del-p{font-size:.8rem;color:var(--txt2);margin-bottom:1.1rem;line-height:1.5;}
.del-row{display:flex;gap:.5rem;justify-content:flex-end;}
.btn-del{padding:.5rem 1.1rem;border-radius:12px;border:none;background:#ef4444;color:#fff;font-size:.83rem;font-weight:800;font-family:var(--ff);cursor:pointer;box-shadow:0 2px 8px rgba(239,68,68,.3);display:flex;align-items:center;gap:.4rem;transition:all .15s;}
.btn-del:hover{background:#dc2626;}
.empty{grid-column:1/-1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.75rem;padding:4rem 2rem;text-align:center;}
.empty-ico{width:64px;height:64px;border-radius:20px;background:var(--pg);color:var(--p);display:flex;align-items:center;justify-content:center;font-size:1.6rem;margin-bottom:.5rem;}
.empty h3{font-size:1rem;font-weight:700;color:var(--txt);margin:0;}
.empty p{font-size:.82rem;color:var(--muted);margin:0;}
.hidden{display:none!important;}
.toast{position:fixed;bottom:1.5rem;right:1.5rem;z-index:9999;padding:.7rem 1.1rem;border-radius:12px;font-size:.84rem;font-weight:700;color:#fff;box-shadow:var(--sh-lg);transform:translateY(10px);opacity:0;transition:all .22s;pointer-events:none;font-family:var(--ff);}
.toast.show{transform:translateY(0);opacity:1;}
.toast-ok{background:#16a34a;}
.toast-err{background:#ef4444;}
</style>
@endpush

<div class="col-span-full">

  <div class="hd">
    <div class="hd-left">
      <div class="eyebrow">Projects</div>
      <h2>Project Registry</h2>
      <p>Track and manage all active telecom project deployments.</p>
    </div>
    <button class="btn-p" id="btnOpenAdd" type="button"><i class="mgc_add_line"></i> New Project</button>
  </div>

  <div class="filters">
    <div class="fleft">
      <div class="srch">
        <i class="mgc_search_line"></i>
        <input id="q" type="text" placeholder="Search by name, code, or client…"/>
      </div>
    </div>
    <div class="fright">
      <div class="seg">
        <button class="seg-btn active" data-status="ALL" type="button">All</button>
        <button class="seg-btn" data-status="ONGOING" type="button">Ongoing</button>
        <button class="seg-btn" data-status="ON HOLD" type="button">On Hold</button>
        <button class="seg-btn" data-status="COMPLETED" type="button">Completed</button>
      </div>
      <div class="count-badge"><span id="showCount">0</span> projects</div>
    </div>
  </div>

  <div class="proj-grid" id="grid"></div>

</div>{{-- col-span-full --}}

<!-- ADD / EDIT MODAL -->
<div id="projOverlay">
  <div id="pmc">
    <div class="mhd">
      <div class="mhd-icon"><i class="mgc_building_2_line"></i></div>
      <div class="mhd-txt">
        <div class="mhd-t" id="modalTitle">New Project</div>
        <div class="mhd-s">Fields marked <span style="color:#ef4444">*</span> are required.</div>
      </div>
      <button class="mc-btn" id="btnCloseModal" type="button"><i class="mgc_close_line"></i></button>
    </div>

    <div class="mb">
      <div class="fg" id="projForm">
        <input type="hidden" id="editId"/>

        <div>
          <label class="lbl" for="fProjectName">Project Name <span>*</span></label>
          <input id="fProjectName" class="inp" type="text" placeholder="e.g. Metro Fiber Expansion"/>
        </div>

        <div>
          <label class="lbl" for="fProjectCode">Project Code <span>*</span></label>
          <input id="fProjectCode" class="inp" type="text" placeholder="e.g. MFE-101"/>
        </div>

        <div>
          <label class="lbl" for="fClient">Client</label>
          <input id="fClient" class="inp" type="text" placeholder="e.g. PLDT, Globe, Smart"/>
        </div>

        <div>
          <label class="lbl" for="fStatus">Status <span>*</span></label>
          <select id="fStatus" class="inp">
            <option value="ONGOING">ONGOING</option>
            <option value="ON HOLD">ON HOLD</option>
            <option value="COMPLETED">COMPLETED</option>
          </select>
        </div>

        <div>
          <label class="lbl" for="fLogo">Project Logo</label>
          <div class="file-zone" id="fileZone">
            <input id="fLogo" type="file" accept="image/*" title="Upload logo"/>
            <div id="filePrompt" style="display:flex;flex-direction:column;align-items:center;gap:.5rem;">
              <div class="file-ico"><i class="mgc_upload_2_line"></i></div>
              <div class="file-hint">Click or drag to upload a logo</div>
              <div class="file-sub">PNG, JPG, SVG — max 2MB</div>
            </div>
            <div class="file-preview-wrap" id="filePreviewWrap">
              <img class="file-preview" id="filePreviewImg" src="" alt="logo preview"/>
              <span class="file-name" id="filePreviewName"></span>
              <button class="file-clear" id="fileClear" type="button" title="Remove"><i class="mgc_close_line"></i></button>
            </div>
          </div>
        </div>

        <div class="dup-e hidden" id="dupError">
          <i class="mgc_close_circle_line"></i> <span id="dupMsg">A project with this code already exists.</span>
        </div>
      </div>
    </div>

    <div class="mft">
      <button class="btn-c" id="btnCancelModal" type="button">Cancel</button>
      <button class="btn-p" id="btnSave" type="button">
        <i class="mgc_save_line"></i> <span id="btnSaveLbl">Save Project</span>
      </button>
    </div>
  </div>
</div>

<!-- DELETE CONFIRM -->
<div id="delOv">
  <div id="delCard">
    <div class="del-ico"><i class="mgc_delete_2_line"></i></div>
    <div class="del-h">Delete Project?</div>
    <p class="del-p" id="delMsg">This action cannot be undone.</p>
    <div class="del-row">
      <button class="btn-c" id="btnDelCancel" type="button">Cancel</button>
      <button class="btn-del" id="btnDelConfirm" type="button">
        <i class="mgc_delete_2_line"></i> Delete
      </button>
    </div>
  </div>
</div>

<!-- TOAST -->
<div id="toast" class="toast"></div>

@push('scripts')
<script>
(function(){
  const CSRF       = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const BASE       = '{{ auth()->user()->role === "admin" ? route("admin.projects.index") : route("pm.projects.index") }}';
  const NODES_BASE = '{{ auth()->user()->role === "admin" ? url("admin/projects") : url("pm/projects") }}';

  let PROJECTS = @json($projects);
  let statusFilter = 'ALL';
  let pendingDelId = null;
  let pendingLogoFile = null;

  // DOM refs
  const grid        = document.getElementById('grid');
  const qInput      = document.getElementById('q');
  const showCount   = document.getElementById('showCount');
  const segs        = Array.from(document.querySelectorAll('.seg-btn'));
  const projOverlay = document.getElementById('projOverlay');
  const modalTitle  = document.getElementById('modalTitle');
  const editId      = document.getElementById('editId');
  const fName       = document.getElementById('fProjectName');
  const fCode       = document.getElementById('fProjectCode');
  const fClient     = document.getElementById('fClient');
  const fStatus     = document.getElementById('fStatus');
  const fLogo       = document.getElementById('fLogo');
  const dupError    = document.getElementById('dupError');
  const dupMsg      = document.getElementById('dupMsg');
  const btnSaveLbl  = document.getElementById('btnSaveLbl');
  const btnSave     = document.getElementById('btnSave');
  const delOv       = document.getElementById('delOv');
  const delMsg      = document.getElementById('delMsg');
  const filePrompt  = document.getElementById('filePrompt');
  const filePreviewWrap = document.getElementById('filePreviewWrap');
  const filePreviewImg  = document.getElementById('filePreviewImg');
  const filePreviewName = document.getElementById('filePreviewName');
  const fileClear       = document.getElementById('fileClear');
  const toast           = document.getElementById('toast');

  // Toast
  let toastTimer = null;
  function showToast(msg, ok = true){
    toast.textContent = msg;
    toast.className = 'toast show ' + (ok ? 'toast-ok' : 'toast-err');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(()=> toast.classList.remove('show'), 2800);
  }

  function tagClass(s){
    if(s === 'ONGOING')   return 'ongoing';
    if(s === 'ON HOLD')   return 'onhold';
    return 'done';
  }

  function escHtml(str){
    return String(str||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }

  function getRows(){
    const text = (qInput.value||'').trim().toLowerCase();
    return PROJECTS
      .filter(p => statusFilter === 'ALL' ? true : p.status === statusFilter)
      .filter(p => !text ||
        (p.name||'').toLowerCase().includes(text) ||
        (p.code||'').toLowerCase().includes(text) ||
        (p.client||'').toLowerCase().includes(text)
      );
  }

  function render(){
    const rows = getRows();
    showCount.textContent = rows.length;
    if(!rows.length){
      grid.innerHTML = `<div class="empty"><div class="empty-ico"><i class="mgc_building_2_line"></i></div><h3>No projects found</h3><p>Try a different search or add a new project.</p></div>`;
      return;
    }
    grid.innerHTML = rows.map(p => {
      const tc = tagClass(p.status);
      return `
      <a class="card-link" href="${NODES_BASE}/${p.id}/nodes">
        <div class="card">
          <div class="card-strip ${tc}"></div>
          <div class="card-body">
            <div class="card-head">
              <div class="logo-wrap">
                ${p.logo_url
                  ? `<img src="${escHtml(p.logo_url)}" alt="logo" onerror="this.style.display='none'"/>`
                  : `<i class="mgc_building_2_line" style="font-size:1.4rem;color:var(--p)"></i>`}
              </div>
              <div class="card-name-block">
                <div class="card-name" title="${escHtml(p.name)}">${escHtml(p.name)}</div>
                <div class="card-client">${escHtml(p.client||'—')}</div>
              </div>
            </div>
            <div class="info-grid">
              <div class="info-item">
                <span class="info-lbl">Project Code</span>
                <span class="info-val">${escHtml(p.code||'—')}</span>
              </div>
              <div class="info-item">
                <span class="info-lbl">Status</span>
                <span class="status-badge ${tc}">${escHtml(p.status)}</span>
              </div>
            </div>
            <div class="card-foot">
              <div class="updated-txt"><i class="mgc_time_line"></i> ${escHtml(p.updated_human||'—')}</div>
              <div class="act-row">
                <button class="ab ab-e" data-act="edit" data-id="${p.id}" title="Edit" type="button"><i class="mgc_edit_2_line"></i></button>
                <button class="ab ab-d" data-act="del"  data-id="${p.id}" title="Delete" type="button"><i class="mgc_delete_2_line"></i></button>
              </div>
            </div>
          </div>
        </div>
      </a>`;
    }).join('');
  }

  // Modal
  function openModal(){ projOverlay.classList.add('open'); document.body.style.overflow='hidden'; }
  function closeModal(){ projOverlay.classList.remove('open'); document.body.style.overflow=''; }

  function clearFilePreview(){
    fLogo.value='';
    pendingLogoFile = null;
    filePreviewWrap.classList.remove('show');
    filePrompt.style.display='';
    filePreviewImg.src='';
    filePreviewName.textContent='';
  }

  function showFilePreview(src, name){
    filePreviewImg.src = src;
    filePreviewName.textContent = name;
    filePreviewWrap.classList.add('show');
    filePrompt.style.display = 'none';
  }

  function resetForm(){
    fName.value=''; fName.classList.remove('inp-e');
    fCode.value=''; fCode.classList.remove('inp-e');
    fClient.value='';
    fStatus.value='ONGOING';
    editId.value='';
    dupError.classList.add('hidden');
    clearFilePreview();
    modalTitle.textContent = 'New Project';
    btnSaveLbl.textContent = 'Save Project';
  }

  function loadEdit(id){
    const p = PROJECTS.find(x => String(x.id) === String(id));
    if(!p) return;
    resetForm();
    editId.value  = p.id;
    fName.value   = p.name   || '';
    fCode.value   = p.code   || '';
    fClient.value = p.client || '';
    fStatus.value = p.status || 'ONGOING';
    if(p.logo_url) showFilePreview(p.logo_url, 'Current logo');
    modalTitle.textContent = 'Edit Project';
    btnSaveLbl.textContent = 'Update Project';
    openModal();
  }

  // File picker
  fLogo.addEventListener('change', ()=>{
    const file = fLogo.files && fLogo.files[0];
    if(!file){ clearFilePreview(); return; }
    pendingLogoFile = file;
    const reader = new FileReader();
    reader.onload = e => showFilePreview(e.target.result, file.name);
    reader.readAsDataURL(file);
  });

  fileClear.addEventListener('click', e=>{ e.stopPropagation(); clearFilePreview(); });

  // Save (AJAX)
  async function saveProject(){
    dupError.classList.add('hidden');
    fName.classList.remove('inp-e');
    fCode.classList.remove('inp-e');

    let ok = true;
    if(!fName.value.trim()){ fName.classList.add('inp-e'); ok=false; }
    if(!fCode.value.trim()){ fCode.classList.add('inp-e'); ok=false; }
    if(!ok){ if(!fName.value.trim()) fName.focus(); else fCode.focus(); return; }

    const id  = editId.value;
    const url = id ? `${BASE}/${id}` : BASE;

    const fd = new FormData();
    fd.append('name',   fName.value.trim());
    fd.append('code',   fCode.value.trim().toUpperCase());
    fd.append('client', fClient.value.trim());
    fd.append('status', fStatus.value);
    if(pendingLogoFile) fd.append('logo', pendingLogoFile);

    btnSave.disabled = true;
    try {
      const res  = await fetch(url, { method:'POST', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}, body:fd });
      const data = await res.json();

      if(!res.ok){
        if(data.errors){
          const errs = Object.values(data.errors).flat();
          const codeErr = errs.find(e => e.toLowerCase().includes('code') || e.toLowerCase().includes('taken') || e.toLowerCase().includes('already'));
          if(codeErr){ dupMsg.textContent = codeErr; dupError.classList.remove('hidden'); fCode.classList.add('inp-e'); }
          else { showToast(errs[0] || 'Validation error.', false); }
        } else {
          showToast(data.message || 'Something went wrong.', false);
        }
        return;
      }

      const proj = data.project;
      if(id){
        const idx = PROJECTS.findIndex(x => String(x.id) === String(proj.id));
        if(idx >= 0) PROJECTS[idx] = proj;
      } else {
        PROJECTS.unshift(proj);
      }

      closeModal();
      render();
      showToast(id ? 'Project updated.' : 'Project added.');
    } catch(e){
      showToast('Network error. Please try again.', false);
    } finally {
      btnSave.disabled = false;
    }
  }

  // Delete
  function openDel(id){
    const p = PROJECTS.find(x => String(x.id) === String(id));
    if(!p) return;
    pendingDelId = id;
    delMsg.textContent = `"${p.name}" (${p.code}) will be permanently removed.`;
    delOv.classList.add('open'); document.body.style.overflow='hidden';
  }
  function closeDel(){ delOv.classList.remove('open'); document.body.style.overflow=''; pendingDelId=null; }

  async function confirmDel(){
    if(!pendingDelId) return;
    const id  = pendingDelId;
    try {
      const res = await fetch(`${BASE}/${id}`, { method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'} });
      if(!res.ok) throw new Error();
      PROJECTS = PROJECTS.filter(x => String(x.id) !== String(id));
      closeDel(); render();
      showToast('Project deleted.');
    } catch(e){
      showToast('Could not delete. Please try again.', false);
    }
  }

  // Events
  qInput.addEventListener('input', render);

  segs.forEach(btn => btn.addEventListener('click', ()=>{
    segs.forEach(x => x.classList.remove('active'));
    btn.classList.add('active');
    statusFilter = btn.dataset.status;
    render();
  }));

  document.getElementById('btnOpenAdd').addEventListener('click', ()=>{ resetForm(); openModal(); });
  document.getElementById('btnCloseModal').addEventListener('click', closeModal);
  document.getElementById('btnCancelModal').addEventListener('click', closeModal);
  btnSave.addEventListener('click', saveProject);
  projOverlay.addEventListener('click', e=>{ if(e.target===projOverlay) closeModal(); });

  document.getElementById('btnDelCancel').addEventListener('click', closeDel);
  document.getElementById('btnDelConfirm').addEventListener('click', confirmDel);
  delOv.addEventListener('click', e=>{ if(e.target===delOv) closeDel(); });

  grid.addEventListener('click', e=>{
    const btn = e.target.closest('button[data-act]');
    if(!btn) return;
    e.preventDefault(); e.stopPropagation();
    if(btn.dataset.act === 'edit') loadEdit(btn.dataset.id);
    if(btn.dataset.act === 'del')  openDel(btn.dataset.id);
  });

  document.addEventListener('keydown', e=>{
    if(e.key === 'Escape'){
      if(projOverlay.classList.contains('open')) closeModal();
      else if(delOv.classList.contains('open')) closeDel();
    }
  });

  fName.addEventListener('keydown', e=>{ if(e.key==='Enter') saveProject(); });

  render();
})();
</script>
@endpush

</x-layout>
