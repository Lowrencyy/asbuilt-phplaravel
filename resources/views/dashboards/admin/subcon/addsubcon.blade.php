<x-layout>

@push('styles')
<style>
*,*::before,*::after{box-sizing:border-box;}
:root{
  --p:#3b82f6;--p2:#2563eb;--pg:rgba(59,130,246,.14);
  --ok:#22c55e;--err:#ef4444;
  --bg:#f1f5f9;--surf:#ffffff;--surf2:#f8fafc;
  --bdr:rgba(226,232,240,1);--txt:#0f172a;--txt2:#475569;--muted:#94a3b8;
  --r:14px;--r-sm:10px;
  --sh:0 1px 3px rgba(15,23,42,.06),0 4px 16px rgba(15,23,42,.06);
  --sh-md:0 6px 26px rgba(15,23,42,.10);
  --sh-lg:0 14px 52px rgba(15,23,42,.18);
  --ff:'DM Sans',sans-serif;--fm:'DM Mono',monospace;
}
.dark{--bg:#070f1e;--surf:#0f172a;--surf2:#162033;--bdr:#1e2d45;--txt:#e2e8f0;--txt2:#94a3b8;--muted:#475569;}
body{font-family:var(--ff);background:var(--bg);color:var(--txt);}
.page-content{background:var(--bg);}
.shd{display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1rem;}
.shd h2{margin:0;font-size:1.2rem;font-weight:950;display:flex;align-items:center;gap:.55rem;}
.shd p{margin:.1rem 0 0;color:var(--txt2);font-size:.82rem;}
.btn-p{display:inline-flex;align-items:center;gap:.45rem;padding:.52rem 1rem;background:var(--p);color:#fff;border:none;border-radius:var(--r-sm);font-size:.85rem;font-weight:900;font-family:var(--ff);cursor:pointer;box-shadow:0 2px 10px rgba(59,130,246,.32);transition:all .15s;}
.btn-p:hover{background:var(--p2);transform:translateY(-1px);}
.filters{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);padding:.85rem;display:flex;align-items:center;justify-content:space-between;gap:.8rem;margin-bottom:1rem;}
.fleft{display:flex;align-items:center;gap:.6rem;flex:1;min-width:220px;}
.input{height:36px;padding:0 .75rem;border:1px solid var(--bdr);border-radius:12px;background:var(--surf);color:var(--txt);font-size:.85rem;outline:none;transition:border-color .15s,box-shadow .15s;min-width:260px;}
.input:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(59,130,246,.12);}
.count{font-size:.78rem;color:var(--muted);font-weight:900;white-space:nowrap;}
@media(max-width:900px){.filters{flex-wrap:wrap;}.input{min-width:100%;width:100%;}}
.sc-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:1rem;}
@media(max-width:1100px){.sc-grid{grid-template-columns:repeat(2,minmax(0,1fr));}}
@media(max-width:640px){.sc-grid{grid-template-columns:1fr;}}
.card{background:var(--surf);border:1px solid var(--bdr);border-radius:18px;box-shadow:var(--sh);overflow:hidden;transition:transform .15s,box-shadow .15s,border-color .15s;}
.card:hover{transform:translateY(-2px);box-shadow:var(--sh-md);border-color:rgba(59,130,246,.22);}
.c-top{padding:1rem 1rem .85rem;display:flex;gap:.85rem;align-items:flex-start;border-bottom:1px solid var(--bdr);}
.logo{height:56px;width:56px;border-radius:14px;border:1px solid var(--bdr);background:linear-gradient(135deg,rgba(59,130,246,.08),transparent);display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0;}
.logo img{width:100%;height:100%;object-fit:contain;padding:.5rem;}
.c-title{flex:1;min-width:0;}
.c-title h3{margin:0;font-size:1.05rem;font-weight:950;line-height:1.15;}
.c-sub{margin-top:.25rem;display:flex;gap:.45rem;align-items:center;flex-wrap:wrap;color:var(--txt2);font-weight:800;}
.badge{display:inline-flex;align-items:center;gap:.35rem;font-family:var(--fm);font-size:.7rem;font-weight:900;padding:.12rem .5rem;border-radius:999px;background:var(--pg);color:var(--p);border:1px solid rgba(59,130,246,.18);}
.c-body{padding:.85rem 1rem 1rem;}
.desc{color:var(--txt2);font-size:.82rem;font-weight:800;line-height:1.35;margin:.15rem 0 .75rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.row{display:flex;gap:.6rem;align-items:flex-start;color:var(--txt);margin:.45rem 0;}
.ico{width:18px;height:18px;display:inline-flex;align-items:center;justify-content:center;color:var(--txt2);margin-top:.05rem;}
.small{color:var(--txt2);font-size:.82rem;font-weight:800;line-height:1.35;}
.line{height:1px;background:var(--bdr);margin:.75rem 0;}
.meta{display:flex;justify-content:space-between;align-items:center;gap:.6rem;flex-wrap:wrap;}
.idmono{color:var(--muted);font-size:.78rem;font-weight:900;font-family:var(--fm);}
.actions{display:flex;gap:.35rem;align-items:center;}
.ab{height:34px;width:34px;border-radius:12px;border:1px solid var(--bdr);background:var(--surf2);cursor:pointer;color:var(--txt2);display:inline-flex;align-items:center;justify-content:center;transition:all .15s;}
.ab:hover{transform:translateY(-1px);box-shadow:0 10px 20px rgba(15,23,42,.08);}
.ab-e:hover{border-color:rgba(59,130,246,.35);background:rgba(59,130,246,.10);color:var(--p);}
.ab-d:hover{border-color:rgba(239,68,68,.35);background:rgba(239,68,68,.10);color:var(--err);}
.ab-i:hover{border-color:rgba(59,130,246,.35);background:rgba(59,130,246,.10);color:var(--p);}
.empty-st{background:var(--surf);border:1px dashed rgba(148,163,184,.9);border-radius:18px;padding:2rem 1rem;text-align:center;color:var(--muted);box-shadow:var(--sh);}
.empty-st i{font-size:2rem;display:block;margin-bottom:.55rem;color:var(--p);}
.mc{height:30px;width:30px;border-radius:10px;border:1px solid var(--bdr);background:var(--surf2);display:inline-flex;align-items:center;justify-content:center;color:var(--txt2);font-size:.95rem;cursor:pointer;transition:all .15s;flex-shrink:0;}
.mc:hover{background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.3);color:var(--err);}
#subconOverlay{position:fixed;inset:0;z-index:900;background:rgba(7,15,30,.65);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .22s;}
#subconOverlay.open{opacity:1;pointer-events:all;}
#smc{background:var(--surf);border:1px solid var(--bdr);border-radius:18px;box-shadow:var(--sh-lg);width:100%;max-width:860px;max-height:calc(100vh - 2rem);display:flex;flex-direction:column;transform:translateY(20px) scale(.97);opacity:0;transition:transform .28s cubic-bezier(.34,1.18,.64,1),opacity .22s;}
#subconOverlay.open #smc{transform:translateY(0) scale(1);opacity:1;}
.mhd{display:flex;align-items:center;justify-content:space-between;padding:.95rem 1.2rem;border-bottom:1px solid var(--bdr);gap:.7rem;}
.mico{height:38px;width:38px;border-radius:12px;flex-shrink:0;background:linear-gradient(135deg,rgba(59,130,246,.18),rgba(59,130,246,.05));display:inline-flex;align-items:center;justify-content:center;color:var(--p);font-size:1.05rem;}
.mt{font-size:1rem;font-weight:950;color:var(--txt);}
.ms{font-size:.72rem;color:var(--txt2);margin-top:.1rem;}
.mb{padding:1.15rem;overflow-y:auto;flex:1;}
.fg{display:grid;grid-template-columns:1fr 1fr;gap:.9rem;}
.fg .c2{grid-column:span 2;}
@media(max-width:640px){.fg{grid-template-columns:1fr;}.fg .c2{grid-column:span 1;}}
.lbl{display:block;font-size:.72rem;font-weight:950;color:var(--txt2);letter-spacing:.02em;margin-bottom:.28rem;}
.lbl span{color:var(--err);}
.inp{width:100%;padding:.52rem .75rem;border:1px solid var(--bdr);border-radius:12px;background:var(--surf);color:var(--txt);font-size:.86rem;font-family:var(--ff);outline:none;transition:border-color .15s,box-shadow .15s;}
.inp:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(59,130,246,.12);}
.inp::placeholder{color:var(--muted);}
.inp-e{border-color:rgba(239,68,68,.6)!important;box-shadow:0 0 0 3px rgba(239,68,68,.12)!important;}
textarea.inp{min-height:80px;resize:vertical;}
.file{width:100%;padding:.55rem .75rem;border:1px dashed rgba(148,163,184,.85);border-radius:12px;background:linear-gradient(135deg,rgba(59,130,246,.06),transparent);color:var(--txt2);font-size:.82rem;}
.file::-webkit-file-upload-button{background:var(--p);color:#fff;border:none;padding:.35rem .6rem;border-radius:10px;font-weight:900;cursor:pointer;margin-right:.6rem;}
.help{font-size:.72rem;color:var(--muted);margin-top:.35rem;}
.dup-e{padding:.55rem .85rem;border-radius:12px;border:1px solid rgba(239,68,68,.3);background:rgba(239,68,68,.06);color:var(--err);font-size:.8rem;font-weight:900;}
.mft{padding:.85rem 1.2rem;border-top:1px solid var(--bdr);display:flex;align-items:center;justify-content:flex-end;gap:.6rem;}
.btn-c{padding:.48rem .95rem;border-radius:12px;border:1px solid var(--bdr);background:var(--surf2);color:var(--txt2);font-size:.85rem;font-weight:950;font-family:var(--ff);cursor:pointer;transition:all .15s;}
.btn-c:hover{background:var(--bdr);color:var(--txt);}
.btn-s{padding:.48rem 1.05rem;border-radius:12px;border:none;background:var(--p);color:#fff;font-size:.85rem;font-weight:950;font-family:var(--ff);cursor:pointer;box-shadow:0 2px 10px rgba(59,130,246,.32);transition:all .15s;display:inline-flex;align-items:center;gap:.35rem;}
.btn-s:hover{background:var(--p2);}
.btn-s:disabled{opacity:.6;cursor:not-allowed;}
#delOv{position:fixed;inset:0;z-index:950;background:rgba(7,15,30,.7);backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .2s;}
#delOv.open{opacity:1;pointer-events:all;}
#delCard{background:var(--surf);border:1px solid var(--bdr);border-radius:16px;box-shadow:var(--sh-lg);max-width:390px;width:100%;padding:1.4rem;transform:scale(.95);opacity:0;transition:transform .22s cubic-bezier(.34,1.18,.64,1),opacity .2s;}
#delOv.open #delCard{transform:scale(1);opacity:1;}
.delib{height:46px;width:46px;border-radius:12px;background:rgba(239,68,68,.1);display:inline-flex;align-items:center;justify-content:center;color:var(--err);font-size:1.2rem;margin-bottom:.85rem;}
.btn-del{padding:.48rem 1.05rem;border-radius:12px;border:none;background:var(--err);color:#fff;font-size:.85rem;font-weight:950;font-family:var(--ff);cursor:pointer;box-shadow:0 2px 8px rgba(239,68,68,.3);transition:all .15s;}
.btn-del:hover{background:#dc2626;}
#imgOv{position:fixed;inset:0;z-index:980;background:rgba(7,15,30,.72);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .2s;}
#imgOv.open{opacity:1;pointer-events:all;}
#imgCard{width:100%;max-width:820px;background:var(--surf);border:1px solid var(--bdr);border-radius:16px;box-shadow:var(--sh-lg);overflow:hidden;transform:translateY(12px) scale(.98);opacity:0;transition:transform .22s cubic-bezier(.34,1.18,.64,1),opacity .18s;}
#imgOv.open #imgCard{transform:translateY(0) scale(1);opacity:1;}
#imgHead{display:flex;align-items:center;justify-content:space-between;gap:.8rem;padding:.9rem 1.1rem;border-bottom:1px solid var(--bdr);}
#imgTitle{font-weight:950;color:var(--txt);font-size:.92rem;}
#imgBody{padding:1rem;background:var(--surf2);}
#imgBody img{width:100%;max-height:70vh;object-fit:contain;border-radius:12px;border:1px solid var(--bdr);background:#000;}
#imgEmpty{width:100%;min-height:240px;border-radius:12px;border:1px dashed rgba(148,163,184,.9);display:flex;flex-direction:column;align-items:center;justify-content:center;color:var(--muted);background:linear-gradient(135deg,rgba(59,130,246,.05),transparent);}
#imgEmpty i{font-size:2.1rem;margin-bottom:.4rem;color:var(--p);}
.hidden{display:none!important;}
.toast{position:fixed;bottom:1.5rem;right:1.5rem;z-index:9999;padding:.7rem 1.1rem;border-radius:12px;font-size:.85rem;font-weight:900;color:#fff;box-shadow:var(--sh-lg);transform:translateY(10px);opacity:0;transition:all .22s;pointer-events:none;}
.toast.show{transform:translateY(0);opacity:1;}
.toast-ok{background:var(--ok);}
.toast-err{background:var(--err);}
</style>
@endpush

<div class="col-span-full">

<div class="shd">
  <div>
    <h2><i class="mgc_user_3_line" style="color:var(--p)"></i> Subcontractors</h2>
    <p>Manage all registered subcontractor companies.</p>
  </div>
  <button class="btn-p" id="btnOpenAdd" type="button">
    <i class="mgc_add_line"></i> Add Subcon
  </button>
</div>

<div class="filters">
  <div class="fleft">
    <input id="searchSubcon" class="input" type="text" placeholder="Search name / email / contact / address / warehouse…" />
  </div>
  <div class="count">Showing <strong id="showCount">0</strong> subcon(s)</div>
</div>

<div class="sc-grid" id="grid"></div>

<div id="emptyWrap" class="hidden">
  <div class="empty-st">
    <i class="mgc_user_x_line"></i>
    <div style="font-weight:950;color:var(--txt);">No subcons found</div>
    <div style="font-size:.82rem;margin-top:.2rem;">Try changing your search keywords.</div>
  </div>
</div>

</div>{{-- col-span-full --}}

<!-- ADD / EDIT MODAL -->
<div id="subconOverlay">
  <div id="smc">
    <div class="mhd">
      <div class="mico"><i class="mgc_user_add_line"></i></div>
      <div style="flex:1;">
        <div class="mt" id="modalTitle">Add Subcon</div>
        <div class="ms">Fields marked <span style="color:var(--err)">*</span> are required.</div>
      </div>
      <button class="mc" id="btnCloseModal" type="button"><i class="mgc_close_line"></i></button>
    </div>

    <div class="mb">
      <form id="subconForm" class="fg" novalidate enctype="multipart/form-data">
        <input type="hidden" id="editId" />

        <div class="c2">
          <label class="lbl" for="fName">Company Name <span>*</span></label>
          <input id="fName" class="inp" type="text" placeholder="e.g. InnoVerge" required />
        </div>

        <div class="c2">
          <label class="lbl" for="fDesc">Description</label>
          <textarea id="fDesc" class="inp" placeholder="Short description of this subcontractor…"></textarea>
        </div>

        <div>
          <label class="lbl" for="fContact">Contact Number</label>
          <input id="fContact" class="inp" type="text" placeholder="e.g. 0917-xxx-xxxx" />
        </div>

        <div>
          <label class="lbl" for="fEmail">Email</label>
          <input id="fEmail" class="inp" type="email" placeholder="e.g. admin@subcon.com" />
        </div>

        <div class="c2">
          <label class="lbl" for="fAddress">Office Address</label>
          <textarea id="fAddress" class="inp" placeholder="e.g. 2F ABC Building, QC, Metro Manila"></textarea>
        </div>

        <div class="c2">
          <label class="lbl" for="fWarehouse">Warehouse Name</label>
          <input id="fWarehouse" class="inp" type="text" placeholder="e.g. QC Central Warehouse" />
        </div>

        <div class="c2">
          <label class="lbl" for="fLogo">Subcon Logo</label>
          <input id="fLogo" class="file" type="file" accept="image/*" />
          <div class="help">Max 2 MB. Leave empty to keep current logo when editing.</div>
        </div>

        <div class="c2 hidden" id="dupError">
          <div class="dup-e"><i class="mgc_close_circle_line"></i> <span id="dupMsg">That name already exists.</span></div>
        </div>
      </form>
    </div>

    <div class="mft">
      <button class="btn-c" id="btnCancelModal" type="button">Cancel</button>
      <button class="btn-s" id="btnSave" type="button">
        <i class="mgc_save_line"></i> <span id="btnSaveLbl">Save Subcon</span>
      </button>
    </div>
  </div>
</div>

<!-- DELETE CONFIRM MODAL -->
<div id="delOv">
  <div id="delCard">
    <div class="delib"><i class="mgc_delete_2_line"></i></div>
    <div style="font-size:.95rem;font-weight:950;color:var(--txt);margin-bottom:.3rem;">Delete Subcon?</div>
    <p style="font-size:.82rem;color:var(--txt2);margin-bottom:1.1rem;" id="delMsg">This cannot be undone.</p>
    <div style="display:flex;gap:.55rem;justify-content:flex-end;">
      <button class="btn-c" id="btnDelCancel" type="button">Cancel</button>
      <button class="btn-del" id="btnDelConfirm" type="button"><i class="mgc_delete_2_line"></i> Delete</button>
    </div>
  </div>
</div>

<!-- LOGO VIEWER MODAL -->
<div id="imgOv">
  <div id="imgCard">
    <div id="imgHead">
      <div id="imgTitle">Logo</div>
      <button class="mc" id="btnImgClose" type="button"><i class="mgc_close_line"></i></button>
    </div>
    <div id="imgBody">
      <div id="imgEmpty" class="hidden">
        <i class="mgc_pic_2_line"></i>
        <div style="font-weight:950;color:var(--txt);">No image yet</div>
        <div style="font-size:.82rem;margin-top:.2rem;">Upload a logo in the Subcon modal to preview it here.</div>
      </div>
      <img id="imgPreview" class="hidden" src="" alt="Logo Preview" />
    </div>
  </div>
</div>

<!-- TOAST -->
<div id="toast" class="toast"></div>

@push('scripts')
<script>
(function(){
  const CSRF  = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const BASE  = '{{ route("admin.subcons.index") }}';

  let SUBCONS = @json($subcons);
  let pendingDelId = null;

  // ---- DOM refs ----
  const searchSubcon  = document.getElementById('searchSubcon');
  const showCount     = document.getElementById('showCount');
  const grid          = document.getElementById('grid');
  const emptyWrap     = document.getElementById('emptyWrap');
  const subconOverlay = document.getElementById('subconOverlay');
  const modalTitle    = document.getElementById('modalTitle');
  const editId        = document.getElementById('editId');
  const fName         = document.getElementById('fName');
  const fDesc         = document.getElementById('fDesc');
  const fContact      = document.getElementById('fContact');
  const fEmail        = document.getElementById('fEmail');
  const fAddress      = document.getElementById('fAddress');
  const fWarehouse    = document.getElementById('fWarehouse');
  const fLogo         = document.getElementById('fLogo');
  const dupError      = document.getElementById('dupError');
  const dupMsg        = document.getElementById('dupMsg');
  const btnSaveLbl    = document.getElementById('btnSaveLbl');
  const btnSave       = document.getElementById('btnSave');
  const delOv         = document.getElementById('delOv');
  const delMsg        = document.getElementById('delMsg');
  const imgOv         = document.getElementById('imgOv');
  const imgTitle      = document.getElementById('imgTitle');
  const imgPreview    = document.getElementById('imgPreview');
  const imgEmpty      = document.getElementById('imgEmpty');
  const toast         = document.getElementById('toast');

  // ---- Toast ----
  let toastTimer = null;
  function showToast(msg, ok = true){
    toast.textContent = msg;
    toast.className = 'toast show ' + (ok ? 'toast-ok' : 'toast-err');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => { toast.classList.remove('show'); }, 2800);
  }

  // ---- Render ----
  function getRows(){
    const q = (searchSubcon.value || '').trim().toLowerCase();
    if(!q) return SUBCONS.slice();
    return SUBCONS.filter(s =>
      (s.name      || '').toLowerCase().includes(q) ||
      (s.email     || '').toLowerCase().includes(q) ||
      (s.contact   || '').toLowerCase().includes(q) ||
      (s.address   || '').toLowerCase().includes(q) ||
      (s.warehouse || '').toLowerCase().includes(q) ||
      (s.description|| '').toLowerCase().includes(q)
    );
  }

  function render(){
    const rows = getRows();
    showCount.textContent = rows.length;
    emptyWrap.classList.toggle('hidden', rows.length > 0);
    grid.classList.toggle('hidden', rows.length === 0);

    grid.innerHTML = rows.map(s => `
      <div class="card">
        <div class="c-top">
          <div class="logo">
            ${s.logo_url
              ? `<img src="${s.logo_url}" alt="${escHtml(s.name)} logo" />`
              : `<i class="mgc_user_3_line" style="font-size:1.4rem;color:var(--p)"></i>`}
          </div>
          <div class="c-title">
            <h3>${escHtml(s.name)}</h3>
            <div class="c-sub">
              <span class="badge">${s.email ? escHtml(s.email) : 'No email'}</span>
              ${s.contact ? `<span class="badge">${escHtml(s.contact)}</span>` : ''}
            </div>
          </div>
        </div>
        <div class="c-body">
          <div class="desc">${(s.description||'').trim() ? escHtml(s.description) : '— No description —'}</div>
          <div class="row"><span class="ico"><i class="mgc_phone_line"></i></span><span class="small">${s.contact ? escHtml(s.contact) : '—'}</span></div>
          <div class="row"><span class="ico"><i class="mgc_mail_line"></i></span><span class="small">${s.email ? escHtml(s.email) : '—'}</span></div>
          <div class="row"><span class="ico"><i class="mgc_location_line"></i></span><span class="small">${s.address ? escHtml(s.address) : '—'}</span></div>
          <div class="row"><span class="ico"><i class="mgc_home_3_line"></i></span><span class="small">${s.warehouse ? escHtml(s.warehouse) : '—'}</span></div>
          <div class="line"></div>
          <div class="meta">
            <div class="idmono">#${s.id}</div>
            <div class="actions">
              <button class="ab ab-i" type="button" data-act="logo" data-id="${s.id}" title="View logo"><i class="mgc_pic_2_line"></i></button>
              <button class="ab ab-e" type="button" data-act="edit" data-id="${s.id}" title="Edit"><i class="mgc_edit_2_line"></i></button>
              <button class="ab ab-d" type="button" data-act="del"  data-id="${s.id}" title="Delete"><i class="mgc_delete_2_line"></i></button>
            </div>
          </div>
        </div>
      </div>
    `).join('');
  }

  function escHtml(str){
    return String(str||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }

  // ---- Modal helpers ----
  function openModal(){ subconOverlay.classList.add('open'); document.body.style.overflow='hidden'; }
  function closeModal(){ subconOverlay.classList.remove('open'); document.body.style.overflow=''; }

  function openDel(id){
    const s = SUBCONS.find(x => String(x.id) === String(id));
    if(!s) return;
    pendingDelId = id;
    delMsg.textContent = `Delete "${s.name}"? This cannot be undone.`;
    delOv.classList.add('open'); document.body.style.overflow='hidden';
  }
  function closeDel(){ delOv.classList.remove('open'); document.body.style.overflow=''; pendingDelId=null; }

  function openImgViewer(title, src){
    imgTitle.textContent = title;
    if(src){ imgEmpty.classList.add('hidden'); imgPreview.classList.remove('hidden'); imgPreview.src = src; }
    else   { imgPreview.classList.add('hidden'); imgPreview.src=''; imgEmpty.classList.remove('hidden'); }
    imgOv.classList.add('open'); document.body.style.overflow='hidden';
  }
  function closeImgViewer(){ imgOv.classList.remove('open'); imgPreview.src=''; document.body.style.overflow=''; }

  function resetForm(){
    document.getElementById('subconForm').reset();
    editId.value = '';
    modalTitle.textContent = 'Add Subcon';
    btnSaveLbl.textContent = 'Save Subcon';
    dupError.classList.add('hidden');
    [fName, fEmail].forEach(el => el.classList.remove('inp-e'));
  }

  function loadEdit(id){
    const s = SUBCONS.find(x => String(x.id) === String(id));
    if(!s) return;
    resetForm();
    editId.value    = s.id;
    modalTitle.textContent = 'Edit Subcon';
    btnSaveLbl.textContent = 'Update Subcon';
    fName.value     = s.name        || '';
    fDesc.value     = s.description || '';
    fContact.value  = s.contact     || '';
    fEmail.value    = s.email       || '';
    fAddress.value  = s.address     || '';
    fWarehouse.value= s.warehouse   || '';
    openModal();
  }

  // ---- Save (AJAX) ----
  async function saveSubcon(){
    dupError.classList.add('hidden');
    [fName, fEmail].forEach(el => el.classList.remove('inp-e'));

    let ok = true;
    if(!fName.value.trim()){ fName.classList.add('inp-e'); ok=false; }
    if(fEmail.value && !/^\S+@\S+\.\S+$/.test(fEmail.value.trim())){ fEmail.classList.add('inp-e'); ok=false; }
    if(!ok) return;

    const id = editId.value;
    const url = id ? `${BASE}/${id}` : BASE;

    const fd = new FormData();
    if(id) fd.append('_method', 'POST');
    fd.append('name',        fName.value.trim());
    fd.append('description', fDesc.value.trim());
    fd.append('contact',     fContact.value.trim());
    fd.append('email',       fEmail.value.trim());
    fd.append('address',     fAddress.value.trim());
    fd.append('warehouse',   fWarehouse.value.trim());
    if(fLogo.files && fLogo.files[0]) fd.append('logo', fLogo.files[0]);

    btnSave.disabled = true;
    try {
      const res  = await fetch(url, { method:'POST', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}, body:fd });
      const data = await res.json();

      if(!res.ok){
        if(data.errors){
          const errs = Object.values(data.errors).flat();
          const nameErr = errs.find(e => e.toLowerCase().includes('name') || e.toLowerCase().includes('taken') || e.toLowerCase().includes('already'));
          if(nameErr){ dupMsg.textContent = nameErr; dupError.classList.remove('hidden'); fName.classList.add('inp-e'); }
          else { showToast(errs[0] || 'Validation error.', false); }
        } else {
          showToast(data.message || 'Something went wrong.', false);
        }
        return;
      }

      const subcon = data.subcon;
      if(id){
        const idx = SUBCONS.findIndex(x => String(x.id) === String(subcon.id));
        if(idx >= 0) SUBCONS[idx] = subcon;
      } else {
        SUBCONS.unshift(subcon);
      }

      closeModal();
      render();
      showToast(id ? 'Subcon updated.' : 'Subcon added.');
    } catch(e){
      showToast('Network error. Please try again.', false);
    } finally {
      btnSave.disabled = false;
    }
  }

  // ---- Delete (AJAX) ----
  async function confirmDel(){
    if(!pendingDelId) return;
    const id  = pendingDelId;
    const url = `${BASE}/${id}`;
    try {
      const res = await fetch(url, { method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'} });
      if(!res.ok) throw new Error();
      SUBCONS = SUBCONS.filter(x => String(x.id) !== String(id));
      closeDel();
      render();
      showToast('Subcon deleted.');
    } catch(e){
      showToast('Could not delete. Please try again.', false);
    }
  }

  // ---- Events ----
  searchSubcon.addEventListener('input', render);

  document.getElementById('btnOpenAdd').addEventListener('click', ()=>{ resetForm(); openModal(); });
  document.getElementById('btnCloseModal').addEventListener('click', closeModal);
  document.getElementById('btnCancelModal').addEventListener('click', closeModal);
  document.getElementById('btnSave').addEventListener('click', saveSubcon);
  subconOverlay.addEventListener('click', e=>{ if(e.target===subconOverlay) closeModal(); });

  document.getElementById('btnDelCancel').addEventListener('click', closeDel);
  document.getElementById('btnDelConfirm').addEventListener('click', confirmDel);
  delOv.addEventListener('click', e=>{ if(e.target===delOv) closeDel(); });

  document.getElementById('btnImgClose').addEventListener('click', closeImgViewer);
  imgOv.addEventListener('click', e=>{ if(e.target===imgOv) closeImgViewer(); });

  grid.addEventListener('click', e=>{
    const btn = e.target.closest('button');
    if(!btn) return;
    const act = btn.dataset.act;
    const id  = btn.dataset.id;
    if(act==='edit') loadEdit(id);
    if(act==='del')  openDel(id);
    if(act==='logo'){
      const s = SUBCONS.find(x => String(x.id)===String(id));
      if(s) openImgViewer(`${s.name} • Logo`, s.logo_url||'');
    }
  });

  document.addEventListener('keydown', e=>{
    if(e.key==='Escape'){
      if(subconOverlay.classList.contains('open')) closeModal();
      else if(delOv.classList.contains('open')) closeDel();
      else if(imgOv.classList.contains('open'))  closeImgViewer();
    }
  });

  render();
})();
</script>
@endpush

</x-layout>
