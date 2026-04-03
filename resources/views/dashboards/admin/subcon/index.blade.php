<x-layout>

@push('styles')
<style>
*,*::before,*::after{box-sizing:border-box;}

:root{
  --accent:#2563eb;
  --accent-2:#1d4ed8;
  --accent-soft:rgba(37,99,235,.10);

  --ok:#16a34a;
  --err:#dc2626;
  --warn:#d97706;

  --bg:#eef3f9;
  --bg-mesh-1:rgba(37,99,235,.08);
  --bg-mesh-2:rgba(15,23,42,.05);

  --surf:#ffffff;
  --surf-2:#f8fbff;
  --surf-3:#f2f6fb;

  --bdr:#dde6f0;
  --bdr-strong:#cfd9e6;

  --txt:#0f172a;
  --txt-2:#475569;
  --muted:#94a3b8;

  --r-xl:24px;
  --r-lg:20px;
  --r:16px;
  --r-sm:12px;

  --sh-sm:0 2px 8px rgba(15,23,42,.04);
  --sh:0 10px 30px rgba(15,23,42,.06);
  --sh-md:0 18px 42px rgba(15,23,42,.10);
  --sh-lg:0 24px 64px rgba(15,23,42,.18);

  --ff:'DM Sans',sans-serif;
  --fm:'DM Mono',monospace;
}

.dark{
  --bg:#07101d;
  --bg-mesh-1:rgba(59,130,246,.12);
  --bg-mesh-2:rgba(148,163,184,.06);

  --surf:#0f172a;
  --surf-2:#111c30;
  --surf-3:#162337;

  --bdr:#22324a;
  --bdr-strong:#30425f;

  --txt:#e2e8f0;
  --txt-2:#9fb0c7;
  --muted:#5f728d;
}

body{
  font-family:var(--ff);
  color:var(--txt);
  background:
    radial-gradient(circle at top left,var(--bg-mesh-1),transparent 28%),
    radial-gradient(circle at top right,var(--bg-mesh-2),transparent 24%),
    var(--bg);
}

.page-content{background:transparent;}

.sub-wrap{
  padding:.25rem 0;
}

/* top header */
.hero{
  display:flex;
  align-items:flex-start;
  justify-content:space-between;
  gap:1rem;
  flex-wrap:wrap;
  margin-bottom:1.1rem;
}

.hero-copy{
  min-width:0;
}

.eyebrow{
  display:inline-flex;
  align-items:center;
  gap:.5rem;
  padding:.42rem .8rem;
  border-radius:999px;
  border:1px solid var(--bdr);
  background:rgba(255,255,255,.72);
  backdrop-filter:blur(8px);
  box-shadow:var(--sh-sm);
  color:var(--txt-2);
  font-size:.66rem;
  letter-spacing:.14em;
  text-transform:uppercase;
  font-weight:900;
  margin-bottom:.75rem;
}
.eyebrow::before{
  content:"";
  width:8px;height:8px;border-radius:50%;
  background:linear-gradient(135deg,var(--accent),var(--accent-2));
  box-shadow:0 0 0 5px rgba(37,99,235,.10);
}

.hero-title{
  margin:0;
  font-size:clamp(1.45rem,2vw,2.25rem);
  line-height:1;
  letter-spacing:-.05em;
  font-weight:1000;
  color:var(--txt);
}

.hero-sub{
  margin:.5rem 0 0;
  max-width:760px;
  color:var(--txt-2);
  font-size:.9rem;
  line-height:1.6;
  font-weight:600;
}

.hero-actions{
  display:flex;
  align-items:center;
  gap:.65rem;
  flex-wrap:wrap;
}

/* buttons */
.btn{
  height:44px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:.5rem;
  border:none;
  border-radius:14px;
  padding:0 1rem;
  font-family:var(--ff);
  font-size:.86rem;
  font-weight:900;
  text-decoration:none;
  cursor:pointer;
  transition:all .18s ease;
  white-space:nowrap;
}
.btn:focus{outline:none;}

.btn-pri{
  color:#fff;
  background:linear-gradient(180deg,var(--accent),var(--accent-2));
  box-shadow:0 12px 26px rgba(37,99,235,.22);
}
.btn-pri:hover{
  transform:translateY(-1px);
  box-shadow:0 16px 32px rgba(37,99,235,.28);
}

.btn-sec{
  color:var(--txt);
  background:rgba(255,255,255,.78);
  border:1px solid var(--bdr);
  box-shadow:var(--sh-sm);
}
.btn-sec:hover{
  background:var(--surf);
  transform:translateY(-1px);
}

.btn-ghost{
  color:var(--txt-2);
  background:var(--surf-2);
  border:1px solid var(--bdr);
}
.btn-ghost:hover{
  color:var(--txt);
  border-color:var(--bdr-strong);
}

/* stat cards */
.stat-grid{
  display:grid;
  grid-template-columns:repeat(4,minmax(0,1fr));
  gap:.9rem;
  margin-bottom:1rem;
}
@media(max-width:1100px){.stat-grid{grid-template-columns:repeat(2,minmax(0,1fr));}}
@media(max-width:640px){.stat-grid{grid-template-columns:1fr;}}

.stat{
  position:relative;
  overflow:hidden;
  background:linear-gradient(180deg,rgba(255,255,255,.92),rgba(248,251,255,.96));
  border:1px solid var(--bdr);
  border-radius:20px;
  box-shadow:var(--sh);
  padding:1rem 1rem .95rem;
}
.stat::after{
  content:"";
  position:absolute;
  inset:auto -20% -55% auto;
  width:120px;height:120px;
  background:radial-gradient(circle,rgba(37,99,235,.12),transparent 64%);
  pointer-events:none;
}
.stat-l{
  color:var(--muted);
  font-size:.68rem;
  text-transform:uppercase;
  letter-spacing:.12em;
  font-weight:1000;
}
.stat-v{
  margin-top:.45rem;
  font-size:1.5rem;
  line-height:1;
  letter-spacing:-.05em;
  font-weight:1000;
  color:var(--txt);
}
.stat-s{
  margin-top:.4rem;
  color:var(--txt-2);
  font-size:.78rem;
  font-weight:700;
}

/* surfaces */
.panel{
  background:rgba(255,255,255,.90);
  backdrop-filter:blur(10px);
  border:1px solid var(--bdr);
  border-radius:22px;
  box-shadow:var(--sh);
}

/* search bar */
.filters{
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:.9rem;
  padding:.95rem;
  margin-bottom:1rem;
  flex-wrap:wrap;
}
.fleft{
  display:flex;
  align-items:center;
  gap:.7rem;
  flex:1;
  min-width:260px;
}
.search-shell{
  position:relative;
  flex:1;
}
.search-ico{
  position:absolute;
  left:.9rem;
  top:50%;
  transform:translateY(-50%);
  color:var(--muted);
  font-size:1rem;
}
.input{
  width:100%;
  height:46px;
  padding:0 .95rem 0 2.55rem;
  border-radius:14px;
  border:1px solid var(--bdr);
  background:var(--surf);
  color:var(--txt);
  font-family:var(--ff);
  font-size:.88rem;
  font-weight:700;
  outline:none;
  transition:border-color .16s,box-shadow .16s,transform .16s;
}
.input:focus{
  border-color:rgba(37,99,235,.45);
  box-shadow:0 0 0 4px rgba(37,99,235,.10);
}
.count{
  color:var(--txt-2);
  font-size:.8rem;
  font-weight:900;
  white-space:nowrap;
}
@media(max-width:900px){
  .filters{flex-wrap:wrap;}
  .search-shell{width:100%;}
  .count{width:100%;}
}

/* grid */
.sc-grid{
  display:grid;
  grid-template-columns:repeat(3,minmax(0,1fr));
  gap:1rem;
}
@media(max-width:1180px){.sc-grid{grid-template-columns:repeat(2,minmax(0,1fr));}}
@media(max-width:700px){.sc-grid{grid-template-columns:1fr;}}

/* subcon card */
.card{
  position:relative;
  overflow:hidden;
  background:linear-gradient(180deg,#ffffff,#fbfdff);
  border:1px solid var(--bdr);
  border-radius:24px;
  box-shadow:var(--sh);
  transition:transform .18s ease, box-shadow .18s ease, border-color .18s ease;
}
.card:hover{
  transform:translateY(-4px);
  box-shadow:var(--sh-md);
  border-color:rgba(37,99,235,.24);
}
.card::before{
  content:"";
  position:absolute;
  inset:0 0 auto 0;
  height:1px;
  background:linear-gradient(90deg,transparent,rgba(37,99,235,.28),transparent);
  pointer-events:none;
}

.c-top{
  padding:1.05rem 1.05rem .9rem;
  display:flex;
  gap:.95rem;
  align-items:flex-start;
  border-bottom:1px solid var(--bdr);
  background:
    radial-gradient(circle at top right, rgba(37,99,235,.06), transparent 32%),
    linear-gradient(180deg,rgba(248,251,255,.92),rgba(255,255,255,.94));
}

.logo{
  height:64px;width:64px;
  border-radius:18px;
  border:1px solid var(--bdr);
  background:
    linear-gradient(135deg,rgba(37,99,235,.12),rgba(255,255,255,.65));
  display:flex;
  align-items:center;
  justify-content:center;
  overflow:hidden;
  flex-shrink:0;
  box-shadow:inset 0 1px 0 rgba(255,255,255,.9);
}
.logo img{
  width:100%;
  height:100%;
  object-fit:contain;
  padding:.55rem;
}

.c-title{
  flex:1;
  min-width:0;
}
.c-title h3{
  margin:0;
  font-size:1.06rem;
  line-height:1.15;
  font-weight:1000;
  letter-spacing:-.03em;
  color:var(--txt);
}
.c-sub{
  margin-top:.42rem;
  display:flex;
  gap:.45rem;
  align-items:center;
  flex-wrap:wrap;
}

.badge{
  display:inline-flex;
  align-items:center;
  gap:.35rem;
  min-height:28px;
  padding:.16rem .56rem;
  border-radius:999px;
  border:1px solid rgba(37,99,235,.14);
  background:rgba(37,99,235,.08);
  color:var(--accent);
  font-size:.68rem;
  font-weight:900;
  font-family:var(--fm);
  letter-spacing:.01em;
}

.c-body{
  padding:.95rem 1.05rem 1rem;
}

.desc{
  color:var(--txt-2);
  font-size:.83rem;
  line-height:1.5;
  font-weight:700;
  margin:.05rem 0 .8rem;
  display:-webkit-box;
  -webkit-line-clamp:2;
  -webkit-box-orient:vertical;
  overflow:hidden;
  min-height:2.5em;
}

.kv{
  display:grid;
  gap:.55rem;
}
.row{
  display:flex;
  gap:.62rem;
  align-items:flex-start;
  color:var(--txt);
}
.ico{
  width:19px;height:19px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  color:var(--txt-2);
  margin-top:.05rem;
  flex-shrink:0;
}
.small{
  color:var(--txt-2);
  font-size:.82rem;
  font-weight:800;
  line-height:1.4;
  min-width:0;
}

.line{
  height:1px;
  background:linear-gradient(90deg,transparent,var(--bdr),transparent);
  margin:.85rem 0;
}

.meta{
  display:flex;
  justify-content:space-between;
  align-items:center;
  gap:.6rem;
  flex-wrap:wrap;
}
.idmono{
  color:var(--muted);
  font-size:.78rem;
  font-weight:900;
  font-family:var(--fm);
}

.actions{
  display:flex;
  gap:.4rem;
  align-items:center;
}

.ab{
  height:36px;width:36px;
  border-radius:12px;
  border:1px solid var(--bdr);
  background:var(--surf-2);
  cursor:pointer;
  color:var(--txt-2);
  display:inline-flex;
  align-items:center;
  justify-content:center;
  transition:all .16s ease;
}
.ab:hover{
  transform:translateY(-1px);
  box-shadow:0 10px 20px rgba(15,23,42,.08);
}
.ab-e:hover,
.ab-i:hover{
  border-color:rgba(37,99,235,.28);
  background:rgba(37,99,235,.10);
  color:var(--accent);
}
.ab-d:hover{
  border-color:rgba(220,38,38,.28);
  background:rgba(220,38,38,.10);
  color:var(--err);
}

.empty-st{
  background:linear-gradient(180deg,#ffffff,#fbfdff);
  border:1px dashed rgba(148,163,184,.95);
  border-radius:24px;
  padding:2.2rem 1rem;
  text-align:center;
  color:var(--muted);
  box-shadow:var(--sh);
}
.empty-st i{
  font-size:2rem;
  display:block;
  margin-bottom:.55rem;
  color:var(--accent);
}

/* modal common */
.mc{
  height:32px;width:32px;
  border-radius:10px;
  border:1px solid var(--bdr);
  background:var(--surf-2);
  display:inline-flex;
  align-items:center;
  justify-content:center;
  color:var(--txt-2);
  font-size:.95rem;
  cursor:pointer;
  transition:all .16s ease;
  flex-shrink:0;
}
.mc:hover{
  background:rgba(220,38,38,.08);
  border-color:rgba(220,38,38,.22);
  color:var(--err);
}

#subconOverlay{
  position:fixed;
  inset:0;
  z-index:900;
  background:rgba(7,15,30,.62);
  backdrop-filter:blur(8px);
  -webkit-backdrop-filter:blur(8px);
  display:flex;
  align-items:center;
  justify-content:center;
  padding:1rem;
  opacity:0;
  pointer-events:none;
  transition:opacity .22s;
}
#subconOverlay.open{
  opacity:1;
  pointer-events:all;
}
#smc{
  background:linear-gradient(180deg,rgba(255,255,255,.98),rgba(249,251,255,.98));
  border:1px solid var(--bdr);
  border-radius:24px;
  box-shadow:var(--sh-lg);
  width:100%;
  max-width:900px;
  max-height:calc(100vh - 2rem);
  display:flex;
  flex-direction:column;
  transform:translateY(20px) scale(.98);
  opacity:0;
  transition:transform .28s cubic-bezier(.34,1.18,.64,1),opacity .22s;
}
#subconOverlay.open #smc{
  transform:translateY(0) scale(1);
  opacity:1;
}

.mhd{
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:1rem 1.2rem;
  border-bottom:1px solid var(--bdr);
  gap:.8rem;
}
.mico{
  height:42px;width:42px;
  border-radius:14px;
  flex-shrink:0;
  background:linear-gradient(135deg,rgba(37,99,235,.18),rgba(37,99,235,.06));
  display:inline-flex;
  align-items:center;
  justify-content:center;
  color:var(--accent);
  font-size:1.05rem;
  box-shadow:inset 0 1px 0 rgba(255,255,255,.7);
}
.mt{
  font-size:1rem;
  font-weight:1000;
  color:var(--txt);
}
.ms{
  font-size:.73rem;
  color:var(--txt-2);
  margin-top:.12rem;
  font-weight:700;
}
.mb{
  padding:1.15rem;
  overflow-y:auto;
  flex:1;
}
.fg{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:.95rem;
}
.fg .c2{grid-column:span 2;}
@media(max-width:640px){
  .fg{grid-template-columns:1fr;}
  .fg .c2{grid-column:span 1;}
}
.lbl{
  display:block;
  font-size:.72rem;
  font-weight:1000;
  color:var(--txt-2);
  letter-spacing:.02em;
  margin-bottom:.32rem;
}
.lbl span{color:var(--err);}
.inp{
  width:100%;
  padding:.72rem .82rem;
  border:1px solid var(--bdr);
  border-radius:14px;
  background:var(--surf);
  color:var(--txt);
  font-size:.86rem;
  font-family:var(--ff);
  outline:none;
  transition:border-color .16s, box-shadow .16s, transform .16s;
}
.inp:focus{
  border-color:rgba(37,99,235,.45);
  box-shadow:0 0 0 4px rgba(37,99,235,.10);
}
.inp::placeholder{color:var(--muted);}
.inp-e{
  border-color:rgba(220,38,38,.55)!important;
  box-shadow:0 0 0 4px rgba(220,38,38,.10)!important;
}
textarea.inp{
  min-height:92px;
  resize:vertical;
}
.file{
  width:100%;
  padding:.75rem .82rem;
  border:1px dashed rgba(148,163,184,.9);
  border-radius:14px;
  background:linear-gradient(135deg,rgba(37,99,235,.05),transparent);
  color:var(--txt-2);
  font-size:.82rem;
}
.file::-webkit-file-upload-button{
  background:linear-gradient(180deg,var(--accent),var(--accent-2));
  color:#fff;
  border:none;
  padding:.4rem .68rem;
  border-radius:10px;
  font-weight:900;
  cursor:pointer;
  margin-right:.65rem;
}
.help{
  font-size:.72rem;
  color:var(--muted);
  margin-top:.35rem;
  font-weight:700;
}
.dup-e{
  padding:.7rem .9rem;
  border-radius:14px;
  border:1px solid rgba(220,38,38,.24);
  background:rgba(220,38,38,.06);
  color:var(--err);
  font-size:.8rem;
  font-weight:900;
}
.mft{
  padding:.92rem 1.2rem;
  border-top:1px solid var(--bdr);
  display:flex;
  align-items:center;
  justify-content:flex-end;
  gap:.6rem;
}
.btn-c{
  padding:.58rem 1rem;
  border-radius:12px;
  border:1px solid var(--bdr);
  background:var(--surf-2);
  color:var(--txt-2);
  font-size:.85rem;
  font-weight:1000;
  font-family:var(--ff);
  cursor:pointer;
  transition:all .16s ease;
}
.btn-c:hover{
  background:var(--surf-3);
  color:var(--txt);
}
.btn-s{
  padding:.58rem 1.08rem;
  border-radius:12px;
  border:none;
  background:linear-gradient(180deg,var(--accent),var(--accent-2));
  color:#fff;
  font-size:.85rem;
  font-weight:1000;
  font-family:var(--ff);
  cursor:pointer;
  box-shadow:0 8px 18px rgba(37,99,235,.22);
  transition:all .16s ease;
  display:inline-flex;
  align-items:center;
  gap:.35rem;
}
.btn-s:hover{transform:translateY(-1px);}
.btn-s:disabled{opacity:.6;cursor:not-allowed;}

/* delete modal */
#delOv{
  position:fixed;
  inset:0;
  z-index:950;
  background:rgba(7,15,30,.7);
  backdrop-filter:blur(6px);
  -webkit-backdrop-filter:blur(6px);
  display:flex;
  align-items:center;
  justify-content:center;
  padding:1rem;
  opacity:0;
  pointer-events:none;
  transition:opacity .2s;
}
#delOv.open{
  opacity:1;
  pointer-events:all;
}
#delCard{
  background:linear-gradient(180deg,rgba(255,255,255,.98),rgba(249,251,255,.98));
  border:1px solid var(--bdr);
  border-radius:20px;
  box-shadow:var(--sh-lg);
  max-width:410px;
  width:100%;
  padding:1.45rem;
  transform:scale(.96);
  opacity:0;
  transition:transform .22s cubic-bezier(.34,1.18,.64,1),opacity .2s;
}
#delOv.open #delCard{
  transform:scale(1);
  opacity:1;
}
.delib{
  height:48px;width:48px;
  border-radius:14px;
  background:rgba(220,38,38,.10);
  display:inline-flex;
  align-items:center;
  justify-content:center;
  color:var(--err);
  font-size:1.2rem;
  margin-bottom:.9rem;
}
.btn-del{
  padding:.56rem 1.08rem;
  border-radius:12px;
  border:none;
  background:var(--err);
  color:#fff;
  font-size:.85rem;
  font-weight:1000;
  font-family:var(--ff);
  cursor:pointer;
  box-shadow:0 8px 18px rgba(220,38,38,.18);
  transition:all .16s ease;
}
.btn-del:hover{background:#b91c1c;}

/* img viewer */
#imgOv{
  position:fixed;
  inset:0;
  z-index:980;
  background:rgba(7,15,30,.72);
  backdrop-filter:blur(8px);
  -webkit-backdrop-filter:blur(8px);
  display:flex;
  align-items:center;
  justify-content:center;
  padding:1rem;
  opacity:0;
  pointer-events:none;
  transition:opacity .2s;
}
#imgOv.open{
  opacity:1;
  pointer-events:all;
}
#imgCard{
  width:100%;
  max-width:860px;
  background:var(--surf);
  border:1px solid var(--bdr);
  border-radius:20px;
  box-shadow:var(--sh-lg);
  overflow:hidden;
  transform:translateY(12px) scale(.98);
  opacity:0;
  transition:transform .22s cubic-bezier(.34,1.18,.64,1),opacity .18s;
}
#imgOv.open #imgCard{
  transform:translateY(0) scale(1);
  opacity:1;
}
#imgHead{
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:.8rem;
  padding:.95rem 1.1rem;
  border-bottom:1px solid var(--bdr);
}
#imgTitle{
  font-weight:1000;
  color:var(--txt);
  font-size:.93rem;
}
#imgBody{
  padding:1rem;
  background:var(--surf-2);
}
#imgBody img{
  width:100%;
  max-height:70vh;
  object-fit:contain;
  border-radius:14px;
  border:1px solid var(--bdr);
  background:#000;
}
#imgEmpty{
  width:100%;
  min-height:240px;
  border-radius:14px;
  border:1px dashed rgba(148,163,184,.9);
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:center;
  color:var(--muted);
  background:linear-gradient(135deg,rgba(37,99,235,.05),transparent);
}
#imgEmpty i{
  font-size:2.1rem;
  margin-bottom:.4rem;
  color:var(--accent);
}

.hidden{display:none!important;}

/* toast */
.toast{
  position:fixed;
  bottom:1.5rem;
  right:1.5rem;
  z-index:9999;
  padding:.78rem 1.1rem;
  border-radius:14px;
  font-size:.85rem;
  font-weight:1000;
  color:#fff;
  box-shadow:var(--sh-lg);
  transform:translateY(10px);
  opacity:0;
  transition:all .22s;
  pointer-events:none;
}
.toast.show{
  transform:translateY(0);
  opacity:1;
}
.toast-ok{background:var(--ok);}
.toast-err{background:var(--err);}
</style>
@endpush

<div class="col-span-full sub-wrap">

  @php
    $totalSubcons = count($subcons ?? []);
    $withEmail = collect($subcons ?? [])->filter(fn($s) => !empty($s['email'] ?? $s->email ?? null))->count();
    $withWarehouse = collect($subcons ?? [])->filter(fn($s) => !empty($s['warehouse'] ?? $s->warehouse ?? null))->count();
    $memberTotal = collect($subcons ?? [])->sum(fn($s) => (int)($s['members_count'] ?? $s->members_count ?? 0));
  @endphp

  <div class="hero">
    <div class="hero-copy">
      <div class="eyebrow">
        <i class="mgc_building_4_line"></i>
        Vendor Network
      </div>
      <h2 class="hero-title">Subcontractor Directory</h2>
      <p class="hero-sub">
        A premium, centralized view of your subcontractor ecosystem — logos, contact channels, warehouse references, and quick management actions in one polished workspace.
      </p>
    </div>

    <div class="hero-actions">
      <button class="btn btn-sec" type="button" onclick="document.getElementById('searchSubcon').focus()">
        <i class="mgc_search_2_line"></i> Search
      </button>
      <button class="btn btn-pri" id="btnOpenAdd" type="button">
        <i class="mgc_add_line"></i> Add Subcon
      </button>
    </div>
  </div>

  <div class="stat-grid">
    <div class="stat">
      <div class="stat-l">Total Companies</div>
      <div class="stat-v">{{ $totalSubcons }}</div>
      <div class="stat-s">Registered subcontractors</div>
    </div>
    <div class="stat">
      <div class="stat-l">With Email</div>
      <div class="stat-v">{{ $withEmail }}</div>
      <div class="stat-s">Has active contact channel</div>
    </div>
    <div class="stat">
      <div class="stat-l">Warehouses Tagged</div>
      <div class="stat-v">{{ $withWarehouse }}</div>
      <div class="stat-s">Linked storage references</div>
    </div>
    <div class="stat">
      <div class="stat-l">Total Members</div>
      <div class="stat-v">{{ $memberTotal }}</div>
      <div class="stat-s">Aggregated linked personnel</div>
    </div>
  </div>

  <div class="filters panel">
    <div class="fleft">
      <div class="search-shell">
        <i class="mgc_search_2_line search-ico"></i>
        <input id="searchSubcon" class="input" type="text" placeholder="Search company name, email, contact, address, warehouse..." />
      </div>
    </div>
    <div class="count">Showing <strong id="showCount">0</strong> subcon(s)</div>
  </div>

  <div class="sc-grid" id="grid"></div>

  <div id="emptyWrap" class="hidden">
    <div class="empty-st">
      <i class="mgc_user_x_line"></i>
      <div style="font-weight:1000;color:var(--txt);">No subcontractors found</div>
      <div style="font-size:.82rem;margin-top:.2rem;">Try a different keyword or add a new subcontractor record.</div>
    </div>
  </div>

</div>

<!-- ADD / EDIT MODAL -->
<div id="subconOverlay">
  <div id="smc">
    <div class="mhd">
      <div class="mico"><i class="mgc_user_add_line"></i></div>
      <div style="flex:1;">
        <div class="mt" id="modalTitle">Add Subcon</div>
        <div class="ms">Fill in the company profile details below. Required fields are marked in red.</div>
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
          <textarea id="fDesc" class="inp" placeholder="Short overview of the subcontractor company, service scope, or specialization..."></textarea>
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
          <textarea id="fAddress" class="inp" placeholder="e.g. 2F ABC Building, Quezon City, Metro Manila"></textarea>
        </div>

        <div class="c2">
          <label class="lbl" for="fWarehouse">Warehouse Name</label>
          <input id="fWarehouse" class="inp" type="text" placeholder="e.g. QC Central Warehouse" />
        </div>

        <div class="c2">
          <label class="lbl" for="fLogo">Subcon Logo</label>
          <input id="fLogo" class="file" type="file" accept="image/*" />
          <div class="help">Max 2 MB. Leave empty to keep the current logo while editing.</div>
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
    <div style="font-size:.96rem;font-weight:1000;color:var(--txt);margin-bottom:.3rem;">Delete subcontractor?</div>
    <p style="font-size:.82rem;color:var(--txt-2);margin-bottom:1.1rem;" id="delMsg">This action cannot be undone.</p>
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
        <div style="font-weight:1000;color:var(--txt);">No image available</div>
        <div style="font-size:.82rem;margin-top:.2rem;">Upload a company logo in the form to preview it here.</div>
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
  const CSRF     = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const BASE     = '{{ route("admin.subcons.index") }}';
  const SHOW_URL = '{{ route("admin.subcons.show", ":id") }}';

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

  let toastTimer = null;
  function showToast(msg, ok = true){
    toast.textContent = msg;
    toast.className = 'toast show ' + (ok ? 'toast-ok' : 'toast-err');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => { toast.classList.remove('show'); }, 2800);
  }

  function escHtml(str){
    return String(str||'')
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

  function render(){
    const rows = getRows();
    showCount.textContent = rows.length;
    emptyWrap.classList.toggle('hidden', rows.length > 0);
    grid.classList.toggle('hidden', rows.length === 0);

    grid.innerHTML = rows.map(s => `
      <div class="card" style="cursor:pointer;" data-act="view" data-id="${s.id}">
        <div class="c-top">
          <div class="logo">
            ${s.logo_url
              ? `<img src="${s.logo_url}" alt="${escHtml(s.name)} logo" />`
              : `<i class="mgc_building_4_line" style="font-size:1.45rem;color:var(--accent)"></i>`}
          </div>

          <div class="c-title">
            <h3>${escHtml(s.name)}</h3>
            <div class="c-sub">
              <span class="badge">${s.email ? escHtml(s.email) : 'No email'}</span>
              ${s.contact ? `<span class="badge">${escHtml(s.contact)}</span>` : ''}
              <span class="badge"><i class="mgc_user_3_line"></i> ${s.members_count ?? 0} members</span>
            </div>
          </div>
        </div>

        <div class="c-body">
          <div class="desc">${(s.description || '').trim() ? escHtml(s.description) : 'No company description provided yet.'}</div>

          <div class="kv">
            <div class="row">
              <span class="ico"><i class="mgc_phone_line"></i></span>
              <span class="small">${s.contact ? escHtml(s.contact) : '—'}</span>
            </div>

            <div class="row">
              <span class="ico"><i class="mgc_mail_line"></i></span>
              <span class="small">${s.email ? escHtml(s.email) : '—'}</span>
            </div>

            <div class="row">
              <span class="ico"><i class="mgc_location_line"></i></span>
              <span class="small">${s.address ? escHtml(s.address) : '—'}</span>
            </div>

            <div class="row">
              <span class="ico"><i class="mgc_home_3_line"></i></span>
              <span class="small">${s.warehouse ? escHtml(s.warehouse) : '—'}</span>
            </div>
          </div>

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

  function openModal(){ subconOverlay.classList.add('open'); document.body.style.overflow='hidden'; }
  function closeModal(){ subconOverlay.classList.remove('open'); document.body.style.overflow=''; }

  function openDel(id){
    const s = SUBCONS.find(x => String(x.id) === String(id));
    if(!s) return;
    pendingDelId = id;
    delMsg.textContent = `Delete "${s.name}"? This action cannot be undone.`;
    delOv.classList.add('open');
    document.body.style.overflow='hidden';
  }
  function closeDel(){
    delOv.classList.remove('open');
    document.body.style.overflow='';
    pendingDelId = null;
  }

  function openImgViewer(title, src){
    imgTitle.textContent = title;
    if(src){
      imgEmpty.classList.add('hidden');
      imgPreview.classList.remove('hidden');
      imgPreview.src = src;
    } else {
      imgPreview.classList.add('hidden');
      imgPreview.src = '';
      imgEmpty.classList.remove('hidden');
    }
    imgOv.classList.add('open');
    document.body.style.overflow='hidden';
  }
  function closeImgViewer(){
    imgOv.classList.remove('open');
    imgPreview.src = '';
    document.body.style.overflow='';
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

    let ok = true;
    if(!fName.value.trim()){ fName.classList.add('inp-e'); ok = false; }
    if(fEmail.value && !/^\S+@\S+\.\S+$/.test(fEmail.value.trim())){ fEmail.classList.add('inp-e'); ok = false; }
    if(!ok) return;

    const id = editId.value;
    const url = id ? `${BASE}/${id}` : BASE;

    const fd = new FormData();
    if(id) fd.append('_method', 'PUT');
    fd.append('name',        fName.value.trim());
    fd.append('description', fDesc.value.trim());
    fd.append('contact',     fContact.value.trim());
    fd.append('email',       fEmail.value.trim());
    fd.append('address',     fAddress.value.trim());
    fd.append('warehouse',   fWarehouse.value.trim());
    if(fLogo.files && fLogo.files[0]) fd.append('logo', fLogo.files[0]);

    btnSave.disabled = true;

    try {
      const res = await fetch(url, {
        method:'POST',
        headers:{ 'X-CSRF-TOKEN': CSRF, 'Accept':'application/json' },
        body: fd
      });

      const data = await res.json();

      if(!res.ok){
        if(data.errors){
          const errs = Object.values(data.errors).flat();
          const nameErr = errs.find(e =>
            e.toLowerCase().includes('name') ||
            e.toLowerCase().includes('taken') ||
            e.toLowerCase().includes('already')
          );

          if(nameErr){
            dupMsg.textContent = nameErr;
            dupError.classList.remove('hidden');
            fName.classList.add('inp-e');
          } else {
            showToast(errs[0] || 'Validation error.', false);
          }
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
      showToast(id ? 'Subcontractor updated.' : 'Subcontractor added.');
    } catch(e){
      showToast('Network error. Please try again.', false);
    } finally {
      btnSave.disabled = false;
    }
  }

  async function confirmDel(){
    if(!pendingDelId) return;
    const id  = pendingDelId;
    const url = `${BASE}/${id}`;

    try {
      const res = await fetch(url, {
        method:'DELETE',
        headers:{ 'X-CSRF-TOKEN': CSRF, 'Accept':'application/json' }
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

  document.getElementById('btnOpenAdd').addEventListener('click', () => { resetForm(); openModal(); });
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
    if(btn){
      e.stopPropagation();
      const act = btn.dataset.act;
      const id  = btn.dataset.id;

      if(act === 'edit') loadEdit(id);
      if(act === 'del')  openDel(id);
      if(act === 'logo'){
        const s = SUBCONS.find(x => String(x.id) === String(id));
        if(s) openImgViewer(`${s.name} • Logo`, s.logo_url || '');
      }
      return;
    }

    const card = e.target.closest('[data-act="view"]');
    if(card){
      window.location.href = SHOW_URL.replace(':id', card.dataset.id);
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