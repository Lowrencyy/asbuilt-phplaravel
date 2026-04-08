<x-layout>

@push('styles')
<style>
*,*::before,*::after{box-sizing:border-box;}
:root{
  --primary:#2563eb;
  --primary-2:#1d4ed8;
  --primary-soft:rgba(37,99,235,.10);
  --success:#16a34a;
  --danger:#ef4444;
  --warning:#f59e0b;
  --bg:#eef4fb;
  --surface:#ffffff;
  --surface-2:#f8fbff;
  --surface-3:#f1f5f9;
  --border:#dbe5f1;
  --text:#0f172a;
  --text-2:#475569;
  --muted:#94a3b8;
  --ring:0 0 0 4px rgba(37,99,235,.12);
  --radius:20px;
  --radius-md:14px;
  --radius-sm:12px;
  --shadow-sm:0 4px 18px rgba(15,23,42,.05);
  --shadow-md:0 14px 34px rgba(15,23,42,.08);
  --shadow-lg:0 22px 60px rgba(15,23,42,.18);
  --font:'DM Sans',sans-serif;
  --mono:'DM Mono',monospace;
}
.dark{
  --bg:#081120;
  --surface:#0f172a;
  --surface-2:#131f35;
  --surface-3:#18243a;
  --border:#22324c;
  --text:#e2e8f0;
  --text-2:#a8b6ca;
  --muted:#64748b;
  --primary-soft:rgba(96,165,250,.16);
}
body,.page-content{background:
  radial-gradient(circle at top left, rgba(37,99,235,.10), transparent 24%),
  radial-gradient(circle at top right, rgba(14,165,233,.08), transparent 18%),
  var(--bg);
  color:var(--text);
  font-family:var(--font);
}
.subcon-shell{display:flex;flex-direction:column;gap:1rem;}
.hero{
  position:relative;
  overflow:hidden;
  background:linear-gradient(135deg,#0f172a 0%, #1e3a8a 52%, #2563eb 100%);
  border-radius:26px;
  padding:1.35rem 1.4rem;
  box-shadow:var(--shadow-lg);
  color:#fff;
}
.hero::before,
.hero::after{
  content:"";
  position:absolute;
  border-radius:999px;
  pointer-events:none;
}
.hero::before{
  width:260px;height:260px;
  right:-70px;top:-100px;
  background:radial-gradient(circle, rgba(255,255,255,.22), transparent 70%);
}
.hero::after{
  width:220px;height:220px;
  left:-80px;bottom:-120px;
  background:radial-gradient(circle, rgba(96,165,250,.18), transparent 72%);
}
.hero-row{position:relative;z-index:1;display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;flex-wrap:wrap;}
.hero-title-wrap{display:flex;align-items:flex-start;gap:1rem;}
.hero-icon{
  width:56px;height:56px;border-radius:18px;
  display:inline-flex;align-items:center;justify-content:center;
  background:rgba(255,255,255,.14);
  border:1px solid rgba(255,255,255,.18);
  box-shadow:inset 0 1px 0 rgba(255,255,255,.18);
  font-size:1.4rem;
}
.hero-title{margin:0;font-size:1.45rem;font-weight:1000;letter-spacing:-.03em;display:flex;align-items:center;gap:.5rem;}
.hero-sub{margin:.3rem 0 0;color:rgba(255,255,255,.78);font-size:.87rem;font-weight:700;max-width:680px;line-height:1.5;}
.hero-cta{display:inline-flex;align-items:center;gap:.55rem;padding:.72rem 1.05rem;border:none;border-radius:14px;background:#fff;color:#0f172a;font-size:.86rem;font-weight:1000;cursor:pointer;box-shadow:0 10px 24px rgba(15,23,42,.18);transition:.18s ease;}
.hero-cta:hover{transform:translateY(-1px);background:#eff6ff;}
.stats{
  position:relative;z-index:1;
  margin-top:1rem;
  display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:.8rem;
}
@media(max-width:820px){.stats{grid-template-columns:1fr;}}
.stat{
  background:rgba(255,255,255,.10);
  border:1px solid rgba(255,255,255,.12);
  border-radius:18px;
  padding:.85rem 1rem;
  backdrop-filter:blur(10px);
}
.stat-k{font-size:1.25rem;font-weight:1000;line-height:1;color:#fff;}
.stat-l{margin-top:.25rem;font-size:.75rem;color:rgba(255,255,255,.72);font-weight:800;text-transform:uppercase;letter-spacing:.08em;}
.toolbar{
  background:var(--surface);
  border:1px solid var(--border);
  border-radius:22px;
  box-shadow:var(--shadow-md);
  padding:1rem;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:.8rem;
  flex-wrap:wrap;
}
.toolbar-left{display:flex;align-items:center;gap:.7rem;flex:1;min-width:260px;flex-wrap:wrap;}
.search-wrap{position:relative;flex:1;min-width:260px;}
.search-wrap i{position:absolute;left:.9rem;top:50%;transform:translateY(-50%);color:var(--muted);font-size:1rem;pointer-events:none;}
.input{
  width:100%;height:44px;padding:0 .95rem 0 2.7rem;
  border:1px solid var(--border);border-radius:14px;
  background:var(--surface-2);color:var(--text);
  font:800 .88rem var(--font);outline:none;transition:.16s ease;
}
.input::placeholder{color:var(--muted);font-weight:700;}
.input:focus{border-color:var(--primary);box-shadow:var(--ring);background:var(--surface);}
.toolbar-right{display:flex;align-items:center;gap:.75rem;flex-wrap:wrap;}
.pill-count{
  display:inline-flex;align-items:center;gap:.45rem;
  padding:.55rem .8rem;border-radius:999px;
  background:var(--surface-2);
  border:1px solid var(--border);
  color:var(--text-2);font-size:.78rem;font-weight:900;
}
.pill-count strong{color:var(--text);font-family:var(--mono);}
.btn-primary{
  display:inline-flex;align-items:center;gap:.5rem;padding:.74rem 1.05rem;
  border:none;border-radius:14px;background:linear-gradient(135deg,var(--primary),var(--primary-2));
  color:#fff;font:900 .86rem var(--font);cursor:pointer;
  box-shadow:0 12px 26px rgba(37,99,235,.25);transition:.18s ease;
}
.btn-primary:hover{transform:translateY(-1px);box-shadow:0 16px 34px rgba(37,99,235,.28);}
.sc-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:1rem;}
@media(max-width:1180px){.sc-grid{grid-template-columns:repeat(2,minmax(0,1fr));}}
@media(max-width:720px){.sc-grid{grid-template-columns:1fr;}}
.card{
  position:relative;
  background:linear-gradient(180deg,var(--surface) 0%, var(--surface-2) 100%);
  border:1px solid var(--border);
  border-radius:22px;
  box-shadow:var(--shadow-sm);
  overflow:hidden;
  transition:transform .18s ease, box-shadow .18s ease, border-color .18s ease;
}
.card::before{
  content:"";
  position:absolute;left:0;top:0;right:0;height:4px;
  background:linear-gradient(90deg,var(--primary),#38bdf8,#8b5cf6);
  opacity:.92;
}
.card:hover{transform:translateY(-4px);box-shadow:var(--shadow-md);border-color:rgba(37,99,235,.22);}
.c-top{
  padding:1.1rem 1.1rem .9rem;
  display:flex;gap:.95rem;align-items:flex-start;
  border-bottom:1px solid var(--border);
}
.logo{
  height:62px;width:62px;border-radius:18px;flex-shrink:0;
  border:1px solid var(--border);
  background:linear-gradient(135deg,rgba(37,99,235,.10),rgba(37,99,235,.02));
  display:flex;align-items:center;justify-content:center;overflow:hidden;
  box-shadow:inset 0 1px 0 rgba(255,255,255,.55);
}
.logo img{width:100%;height:100%;object-fit:contain;padding:.5rem;}
.c-title{flex:1;min-width:0;}
.c-title h3{margin:0;font-size:1.08rem;font-weight:1000;line-height:1.15;letter-spacing:-.02em;}
.c-sub{margin-top:.4rem;display:flex;gap:.45rem;align-items:center;flex-wrap:wrap;}
.badge{
  display:inline-flex;align-items:center;gap:.35rem;
  font-family:var(--mono);font-size:.68rem;font-weight:900;
  padding:.22rem .55rem;border-radius:999px;
  background:var(--primary-soft);color:var(--primary);
  border:1px solid rgba(37,99,235,.16);
}
.badge-muted{background:var(--surface-3);color:var(--text-2);border-color:var(--border);}
.c-body{padding:1rem 1.1rem 1.1rem;}
.desc{
  color:var(--text-2);font-size:.83rem;font-weight:800;line-height:1.5;
  margin:0 0 .85rem;
  display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;
}
.info-grid{display:grid;grid-template-columns:1fr;gap:.55rem;}
.info-chip{
  display:flex;align-items:flex-start;gap:.7rem;
  padding:.68rem .8rem;border-radius:14px;
  background:var(--surface);border:1px solid var(--border);
}
.info-ico{
  width:30px;height:30px;border-radius:10px;flex-shrink:0;
  display:inline-flex;align-items:center;justify-content:center;
  background:var(--surface-3);color:var(--primary);
  border:1px solid var(--border);
}
.info-copy{min-width:0;}
.info-label{font-size:.67rem;font-weight:1000;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);}
.info-value{margin-top:.14rem;color:var(--text);font-size:.82rem;font-weight:800;line-height:1.35;word-break:break-word;}
.line{height:1px;background:var(--border);margin:.9rem 0;}
.meta{display:flex;justify-content:space-between;align-items:center;gap:.7rem;flex-wrap:wrap;}
.idmono{color:var(--muted);font-size:.78rem;font-weight:900;font-family:var(--mono);}
.actions{display:flex;gap:.45rem;align-items:center;}
.ab{
  height:38px;width:38px;border-radius:12px;border:1px solid var(--border);
  background:var(--surface);cursor:pointer;color:var(--text-2);
  display:inline-flex;align-items:center;justify-content:center;transition:.16s ease;
}
.ab:hover{transform:translateY(-1px);box-shadow:0 10px 22px rgba(15,23,42,.08);}
.ab-e:hover{border-color:rgba(37,99,235,.35);background:rgba(37,99,235,.08);color:var(--primary);}
.ab-d:hover{border-color:rgba(239,68,68,.35);background:rgba(239,68,68,.10);color:var(--danger);}
.ab-i:hover{border-color:rgba(14,165,233,.35);background:rgba(14,165,233,.10);color:#0284c7;}
.empty-st{
  background:var(--surface);
  border:1px dashed rgba(148,163,184,.9);
  border-radius:24px;
  padding:2.4rem 1.2rem;
  text-align:center;
  color:var(--muted);
  box-shadow:var(--shadow-sm);
}
.empty-st i{font-size:2.1rem;display:block;margin-bottom:.65rem;color:var(--primary);}
.hidden{display:none!important;}
.mc{
  height:36px;width:36px;border-radius:12px;border:1px solid var(--border);
  background:var(--surface-2);display:inline-flex;align-items:center;justify-content:center;
  color:var(--text-2);font-size:1rem;cursor:pointer;transition:.16s ease;flex-shrink:0;
}
.mc:hover{background:rgba(239,68,68,.10);border-color:rgba(239,68,68,.30);color:var(--danger);}
#subconOverlay,#delOv,#imgOv{
  position:fixed;inset:0;z-index:900;
  background:rgba(7,15,30,.62);
  backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);
  display:flex;align-items:center;justify-content:center;padding:1rem;
  opacity:0;pointer-events:none;transition:opacity .22s;
}
#delOv{z-index:950;}#imgOv{z-index:980;}
#subconOverlay.open,#delOv.open,#imgOv.open{opacity:1;pointer-events:all;}
#smc,#delCard,#imgCard{
  background:var(--surface);border:1px solid var(--border);
  box-shadow:var(--shadow-lg);opacity:0;
  transition:transform .26s cubic-bezier(.34,1.18,.64,1),opacity .2s;
}
#smc{
  border-radius:24px;width:100%;max-width:920px;max-height:calc(100vh - 2rem);
  display:flex;flex-direction:column;transform:translateY(20px) scale(.97);
}
#subconOverlay.open #smc{transform:translateY(0) scale(1);opacity:1;}
#delCard{max-width:410px;width:100%;padding:1.45rem;border-radius:20px;transform:scale(.95);}
#delOv.open #delCard{transform:scale(1);opacity:1;}
#imgCard{width:100%;max-width:860px;border-radius:20px;overflow:hidden;transform:translateY(12px) scale(.98);}
#imgOv.open #imgCard{transform:translateY(0) scale(1);opacity:1;}
.mhd,
#imgHead{
  display:flex;align-items:center;justify-content:space-between;
  padding:1rem 1.2rem;border-bottom:1px solid var(--border);gap:.8rem;
}
.mico{
  height:42px;width:42px;border-radius:14px;flex-shrink:0;
  background:linear-gradient(135deg,rgba(37,99,235,.18),rgba(37,99,235,.05));
  display:inline-flex;align-items:center;justify-content:center;color:var(--primary);font-size:1.05rem;
}
.mt{font-size:1rem;font-weight:1000;color:var(--text);}
.ms{font-size:.73rem;color:var(--text-2);margin-top:.12rem;}
.mb{padding:1.15rem;overflow-y:auto;flex:1;background:linear-gradient(180deg,var(--surface) 0%, var(--surface-2) 100%);}
.fg{display:grid;grid-template-columns:1fr 1fr;gap:.95rem;}
.fg .c2{grid-column:span 2;}
@media(max-width:680px){.fg{grid-template-columns:1fr;}.fg .c2{grid-column:span 1;}}
.lbl{display:block;font-size:.73rem;font-weight:1000;color:var(--text-2);letter-spacing:.02em;margin-bottom:.34rem;}
.lbl span{color:var(--danger);}
.inp{
  width:100%;padding:.7rem .82rem;border:1px solid var(--border);border-radius:14px;
  background:var(--surface);color:var(--text);font-size:.87rem;font-family:var(--font);
  outline:none;transition:.16s ease;font-weight:800;
}
.inp::placeholder{color:var(--muted);font-weight:700;}
.inp:focus{border-color:var(--primary);box-shadow:var(--ring);}
.inp-e{border-color:rgba(239,68,68,.6)!important;box-shadow:0 0 0 3px rgba(239,68,68,.12)!important;}
textarea.inp{min-height:90px;resize:vertical;}
.file{
  width:100%;padding:.7rem .8rem;border:1px dashed rgba(148,163,184,.85);
  border-radius:14px;background:linear-gradient(135deg,rgba(37,99,235,.06),transparent);
  color:var(--text-2);font-size:.83rem;font-weight:800;
}
.file::-webkit-file-upload-button{
  background:linear-gradient(135deg,var(--primary),var(--primary-2));
  color:#fff;border:none;padding:.42rem .75rem;border-radius:10px;font-weight:1000;cursor:pointer;margin-right:.6rem;
}
.help{font-size:.72rem;color:var(--muted);margin-top:.35rem;font-weight:700;}
.dup-e{
  padding:.72rem .9rem;border-radius:14px;border:1px solid rgba(239,68,68,.25);
  background:rgba(239,68,68,.07);color:var(--danger);font-size:.8rem;font-weight:900;
}
.mft{
  padding:1rem 1.2rem;border-top:1px solid var(--border);
  display:flex;align-items:center;justify-content:flex-end;gap:.6rem;background:var(--surface);
}
.btn-c{
  padding:.7rem 1rem;border-radius:14px;border:1px solid var(--border);background:var(--surface-2);
  color:var(--text-2);font-size:.85rem;font-weight:1000;font-family:var(--font);cursor:pointer;transition:.15s ease;
}
.btn-c:hover{background:var(--surface-3);color:var(--text);}
.btn-s{
  padding:.72rem 1.1rem;border-radius:14px;border:none;background:linear-gradient(135deg,var(--primary),var(--primary-2));
  color:#fff;font-size:.85rem;font-weight:1000;font-family:var(--font);cursor:pointer;
  box-shadow:0 12px 26px rgba(37,99,235,.25);transition:.15s ease;display:inline-flex;align-items:center;gap:.4rem;
}
.btn-s:hover{transform:translateY(-1px);}
.btn-s:disabled{opacity:.6;cursor:not-allowed;transform:none;}
.delib{
  height:50px;width:50px;border-radius:14px;background:rgba(239,68,68,.10);
  display:inline-flex;align-items:center;justify-content:center;color:var(--danger);font-size:1.25rem;margin-bottom:.9rem;
}
.btn-del{
  padding:.72rem 1.08rem;border-radius:14px;border:none;background:var(--danger);color:#fff;font-size:.85rem;font-weight:1000;font-family:var(--font);cursor:pointer;box-shadow:0 12px 24px rgba(239,68,68,.22);transition:.15s ease;
}
.btn-del:hover{background:#dc2626;transform:translateY(-1px);}
#imgTitle{font-weight:1000;color:var(--text);font-size:.92rem;}
#imgBody{padding:1rem;background:var(--surface-2);}
#imgBody img{width:100%;max-height:70vh;object-fit:contain;border-radius:14px;border:1px solid var(--border);background:#000;}
#imgEmpty{
  width:100%;min-height:240px;border-radius:14px;border:1px dashed rgba(148,163,184,.9);
  display:flex;flex-direction:column;align-items:center;justify-content:center;color:var(--muted);
  background:linear-gradient(135deg,rgba(37,99,235,.05),transparent);
}
#imgEmpty i{font-size:2.1rem;margin-bottom:.4rem;color:var(--primary);}
.toast{
  position:fixed;bottom:1.5rem;right:1.5rem;z-index:9999;padding:.78rem 1.1rem;border-radius:14px;
  font-size:.85rem;font-weight:1000;color:#fff;box-shadow:var(--shadow-lg);
  transform:translateY(10px);opacity:0;transition:all .22s;pointer-events:none;
}
.toast.show{transform:translateY(0);opacity:1;}
.toast-ok{background:var(--success);}
.toast-err{background:var(--danger);}
</style>
@endpush

<div class="col-span-full subcon-shell">

  <section class="hero">
    <div class="hero-row">
      <div class="hero-title-wrap">
        <div class="hero-icon">
          <i class="mgc_user_3_line"></i>
        </div>
        <div>
          <h2 class="hero-title">Subcontractor Directory</h2>
          <p class="hero-sub">Organize and manage all registered subcontractor companies in one polished workspace with fast search, cleaner records, and quick actions.</p>
        </div>
      </div>

      <button class="hero-cta" id="btnOpenAdd" type="button">
        <i class="mgc_add_line"></i>
        Add Subcon
      </button>
    </div>

    <div class="stats">
      <div class="stat">
        <div class="stat-k" id="heroTotal">0</div>
        <div class="stat-l">Total Subcons</div>
      </div>
      <div class="stat">
        <div class="stat-k" id="heroWithEmail">0</div>
        <div class="stat-l">With Email</div>
      </div>
      <div class="stat">
        <div class="stat-k" id="heroWithWarehouse">0</div>
        <div class="stat-l">With Warehouse</div>
      </div>
    </div>
  </section>

  <section class="toolbar">
    <div class="toolbar-left">
      <div class="search-wrap">
        <i class="mgc_search_2_line"></i>
        <input id="searchSubcon" class="input" type="text" placeholder="Search company, email, phone, address, warehouse..." />
      </div>
    </div>

    <div class="toolbar-right">
      <div class="pill-count">
        <i class="mgc_layout_grid_line"></i>
        Showing <strong id="showCount">0</strong> subcon(s)
      </div>
    </div>
  </section>

  <div class="sc-grid" id="grid"></div>

  <div id="emptyWrap" class="hidden">
    <div class="empty-st">
      <i class="mgc_user_x_line"></i>
      <div style="font-weight:1000;color:var(--text);">No subcontractors found</div>
      <div style="font-size:.82rem;margin-top:.2rem;">Try changing your search keywords or add a new subcontractor.</div>
    </div>
  </div>

</div>

<!-- ADD / EDIT MODAL -->
<div id="subconOverlay">
  <div id="smc">
    <div class="mhd">
      <div class="mico"><i class="mgc_user_add_line"></i></div>
      <div style="flex:1;min-width:0;">
        <div class="mt" id="modalTitle">Add Subcon</div>
        <div class="ms">Fields marked <span style="color:var(--danger)">*</span> are required.</div>
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
          <textarea id="fDesc" class="inp" placeholder="Short description of this subcontractor..."></textarea>
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
        <i class="mgc_save_line"></i>
        <span id="btnSaveLbl">Save Subcon</span>
      </button>
    </div>
  </div>
</div>

<!-- DELETE CONFIRM MODAL -->
<div id="delOv">
  <div id="delCard">
    <div class="delib"><i class="mgc_delete_2_line"></i></div>
    <div style="font-size:.98rem;font-weight:1000;color:var(--text);margin-bottom:.3rem;">Delete Subcon?</div>
    <p style="font-size:.82rem;color:var(--text-2);margin-bottom:1.1rem;line-height:1.55;" id="delMsg">This cannot be undone.</p>
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
        <div style="font-weight:1000;color:var(--text);">No image yet</div>
        <div style="font-size:.82rem;margin-top:.2rem;">Upload a logo in the Subcon modal to preview it here.</div>
      </div>
      <img id="imgPreview" class="hidden" src="" alt="Logo Preview" />
    </div>
  </div>
</div>

<div id="toast" class="toast"></div>

@push('scripts')
<script>
(function(){
  const CSRF      = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const BASE      = '{{ route("admin.subcons.index") }}';
  const SHOW_BASE = '{{ url("admin/subcons") }}';

  let SUBCONS = @json($subcons);
  let pendingDelId = null;

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
  const heroTotal     = document.getElementById('heroTotal');
  const heroWithEmail = document.getElementById('heroWithEmail');
  const heroWithWarehouse = document.getElementById('heroWithWarehouse');

  let toastTimer = null;
  function showToast(msg, ok = true){
    toast.textContent = msg;
    toast.className = 'toast show ' + (ok ? 'toast-ok' : 'toast-err');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.classList.remove('show'), 2800);
  }

  function escHtml(str){
    return String(str || '')
      .replace(/&/g,'&amp;')
      .replace(/</g,'&lt;')
      .replace(/>/g,'&gt;')
      .replace(/"/g,'&quot;');
  }

  function getRows(){
    const q = (searchSubcon.value || '').trim().toLowerCase();
    if(!q) return SUBCONS.slice();

    return SUBCONS.filter(s =>
      (s.name || '').toLowerCase().includes(q) ||
      (s.email || '').toLowerCase().includes(q) ||
      (s.contact || '').toLowerCase().includes(q) ||
      (s.address || '').toLowerCase().includes(q) ||
      (s.warehouse || '').toLowerCase().includes(q) ||
      (s.description || '').toLowerCase().includes(q)
    );
  }

  function renderStats(){
    heroTotal.textContent = SUBCONS.length;
    heroWithEmail.textContent = SUBCONS.filter(s => (s.email || '').trim()).length;
    heroWithWarehouse.textContent = SUBCONS.filter(s => (s.warehouse || '').trim()).length;
  }

  function render(){
    const rows = getRows();
    showCount.textContent = rows.length;
    emptyWrap.classList.toggle('hidden', rows.length > 0);
    grid.classList.toggle('hidden', rows.length === 0);

    grid.innerHTML = rows.map(s => `
      <article class="card">
        <div class="c-top">
          <div class="logo">
            ${s.logo_url
              ? `<img src="${s.logo_url}" alt="${escHtml(s.name)} logo" />`
              : `<i class="mgc_building_4_line" style="font-size:1.45rem;color:var(--primary)"></i>`}
          </div>

          <div class="c-title">
            <h3>${escHtml(s.name)}</h3>
            <div class="c-sub">
              <span class="badge"><i class="mgc_mail_line"></i> ${s.email ? escHtml(s.email) : 'No email'}</span>
              ${s.contact ? `<span class="badge badge-muted"><i class="mgc_phone_line"></i> ${escHtml(s.contact)}</span>` : ''}
            </div>
          </div>
        </div>

        <div class="c-body">
          <p class="desc">${(s.description || '').trim() ? escHtml(s.description) : 'No description added for this subcontractor yet.'}</p>

          <div class="info-grid">
            <div class="info-chip">
              <span class="info-ico"><i class="mgc_phone_line"></i></span>
              <div class="info-copy">
                <div class="info-label">Contact</div>
                <div class="info-value">${s.contact ? escHtml(s.contact) : '—'}</div>
              </div>
            </div>

            <div class="info-chip">
              <span class="info-ico"><i class="mgc_mail_line"></i></span>
              <div class="info-copy">
                <div class="info-label">Email</div>
                <div class="info-value">${s.email ? escHtml(s.email) : '—'}</div>
              </div>
            </div>

            <div class="info-chip">
              <span class="info-ico"><i class="mgc_location_line"></i></span>
              <div class="info-copy">
                <div class="info-label">Office Address</div>
                <div class="info-value">${s.address ? escHtml(s.address) : '—'}</div>
              </div>
            </div>

            <div class="info-chip">
              <span class="info-ico"><i class="mgc_home_3_line"></i></span>
              <div class="info-copy">
                <div class="info-label">Warehouse</div>
                <div class="info-value">${s.warehouse ? escHtml(s.warehouse) : '—'}</div>
              </div>
            </div>
          </div>

          <div class="line"></div>

          <div class="meta">
            <div class="idmono">SUBCON #${s.id}</div>
            <div class="actions">
              <button class="ab ab-i" type="button" data-act="logo" data-id="${s.id}" title="View logo"><i class="mgc_pic_2_line"></i></button>
              <a class="ab" href="${SHOW_BASE}/${s.id}" title="Manage Members" style="display:inline-flex;align-items:center;justify-content:center;text-decoration:none;color:inherit;"><i class="mgc_group_line"></i></a>
              <button class="ab ab-e" type="button" data-act="edit" data-id="${s.id}" title="Edit Subcon"><i class="mgc_edit_2_line"></i></button>
              <button class="ab ab-d" type="button" data-act="del" data-id="${s.id}" title="Delete Subcon"><i class="mgc_delete_2_line"></i></button>
            </div>
          </div>
        </div>
      </article>
    `).join('');

    renderStats();
  }

  function openModal(){
    subconOverlay.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeModal(){
    subconOverlay.classList.remove('open');
    document.body.style.overflow = '';
  }

  function openDel(id){
    const s = SUBCONS.find(x => String(x.id) === String(id));
    if(!s) return;
    pendingDelId = id;
    delMsg.textContent = `Delete "${s.name}"? This action cannot be undone.`;
    delOv.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeDel(){
    delOv.classList.remove('open');
    document.body.style.overflow = '';
    pendingDelId = null;
  }

  function openImgViewer(title, src){
    imgTitle.textContent = title;
    if(src){
      imgEmpty.classList.add('hidden');
      imgPreview.classList.remove('hidden');
      imgPreview.src = src;
    }else{
      imgPreview.classList.add('hidden');
      imgPreview.src = '';
      imgEmpty.classList.remove('hidden');
    }
    imgOv.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeImgViewer(){
    imgOv.classList.remove('open');
    imgPreview.src = '';
    document.body.style.overflow = '';
  }

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
    editId.value = s.id;
    modalTitle.textContent = 'Edit Subcon';
    btnSaveLbl.textContent = 'Update Subcon';
    fName.value = s.name || '';
    fDesc.value = s.description || '';
    fContact.value = s.contact || '';
    fEmail.value = s.email || '';
    fAddress.value = s.address || '';
    fWarehouse.value = s.warehouse || '';
    openModal();
  }

  async function saveSubcon(){
    dupError.classList.add('hidden');
    [fName, fEmail].forEach(el => el.classList.remove('inp-e'));

    let valid = true;
    if(!fName.value.trim()){
      fName.classList.add('inp-e');
      valid = false;
    }
    if(fEmail.value && !/^\S+@\S+\.\S+$/.test(fEmail.value.trim())){
      fEmail.classList.add('inp-e');
      valid = false;
    }
    if(!valid) return;

    const id = editId.value;
    const url = id ? `${BASE}/${id}` : BASE;

    const fd = new FormData();
    if(id) fd.append('_method', 'POST');
    fd.append('name', fName.value.trim());
    fd.append('description', fDesc.value.trim());
    fd.append('contact', fContact.value.trim());
    fd.append('email', fEmail.value.trim());
    fd.append('address', fAddress.value.trim());
    fd.append('warehouse', fWarehouse.value.trim());
    if(fLogo.files && fLogo.files[0]) fd.append('logo', fLogo.files[0]);

    btnSave.disabled = true;
    try {
      const res = await fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': CSRF,
          'Accept': 'application/json'
        },
        body: fd,
      });

      const data = await res.json();

      if(!res.ok){
        if(data.errors){
          const errs = Object.values(data.errors).flat();
          const nameErr = errs.find(e => e.toLowerCase().includes('name') || e.toLowerCase().includes('taken') || e.toLowerCase().includes('already'));
          if(nameErr){
            dupMsg.textContent = nameErr;
            dupError.classList.remove('hidden');
            fName.classList.add('inp-e');
          }else{
            showToast(errs[0] || 'Validation error.', false);
          }
        }else{
          showToast(data.message || 'Something went wrong.', false);
        }
        return;
      }

      const subcon = data.subcon;
      if(id){
        const idx = SUBCONS.findIndex(x => String(x.id) === String(subcon.id));
        if(idx >= 0) SUBCONS[idx] = subcon;
      }else{
        SUBCONS.unshift(subcon);
      }

      closeModal();
      render();
      showToast(id ? 'Subcontractor updated.' : 'Subcontractor added.');
    } catch (e) {
      showToast('Network error. Please try again.', false);
    } finally {
      btnSave.disabled = false;
    }
  }

  async function confirmDel(){
    if(!pendingDelId) return;
    const id = pendingDelId;
    const url = `${BASE}/${id}`;

    try {
      const res = await fetch(url, {
        method:'DELETE',
        headers:{
          'X-CSRF-TOKEN': CSRF,
          'Accept':'application/json'
        }
      });

      if(!res.ok) throw new Error();

      SUBCONS = SUBCONS.filter(x => String(x.id) !== String(id));
      closeDel();
      render();
      showToast('Subcontractor deleted.');
    } catch(e){
      showToast('Could not delete. Please try again.', false);
    }
  }

  searchSubcon.addEventListener('input', render);

  document.getElementById('btnOpenAdd').addEventListener('click', () => {
    resetForm();
    openModal();
  });

  document.getElementById('btnCloseModal').addEventListener('click', closeModal);
  document.getElementById('btnCancelModal').addEventListener('click', closeModal);
  document.getElementById('btnSave').addEventListener('click', saveSubcon);
  subconOverlay.addEventListener('click', e => { if(e.target === subconOverlay) closeModal(); });

  document.getElementById('btnDelCancel').addEventListener('click', closeDel);
  document.getElementById('btnDelConfirm').addEventListener('click', confirmDel);
  delOv.addEventListener('click', e => { if(e.target === delOv) closeDel(); });

  document.getElementById('btnImgClose').addEventListener('click', closeImgViewer);
  imgOv.addEventListener('click', e => { if(e.target === imgOv) closeImgViewer(); });

  grid.addEventListener('click', e => {
    const btn = e.target.closest('button');
    if(!btn) return;
    const act = btn.dataset.act;
    const id = btn.dataset.id;

    if(act === 'edit') loadEdit(id);
    if(act === 'del') openDel(id);
    if(act === 'logo'){
      const s = SUBCONS.find(x => String(x.id) === String(id));
      if(s) openImgViewer(`${s.name} • Logo`, s.logo_url || '');
    }
  });

  document.addEventListener('keydown', e => {
    if(e.key === 'Escape'){
      if(subconOverlay.classList.contains('open')) closeModal();
      else if(delOv.classList.contains('open')) closeDel();
      else if(imgOv.classList.contains('open')) closeImgViewer();
    }
  });

  render();
})();
</script>
@endpush

</x-layout>
