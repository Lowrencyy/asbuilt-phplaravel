<x-layout>

@push('title')Spans — {{ $node->node_id }}@endpush

@push('styles')
<link rel="stylesheet" href="/assets/libs/leaflet/leaflet.css"/>
<style>
*,*::before,*::after{box-sizing:border-box;}
:root{
  --p:#3b82f6;--p2:#2563eb;--pg:rgba(59,130,246,.12);
  --ok:#22c55e;--warn:#f59e0b;--err:#ef4444;--s:#8b5cf6;
  --bg:#f0f4f9;--surf:#fff;--surf2:#f7f9fc;--surf3:#eef4fb;
  --bdr:#e2e8f0;--bdr2:#cbd5e1;
  --txt:#0f172a;--txt2:#475569;--txt3:#64748b;--muted:#94a3b8;
  --r:16px;--r-sm:10px;
  --sh:0 1px 2px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.06);
  --sh-lg:0 16px 48px rgba(15,23,42,.16);
  --ff:'DM Sans',sans-serif;--fm:'DM Mono',monospace;
}
.dark{
  --bg:#070f1e;--surf:#0f172a;--surf2:#111827;--surf3:#0b1323;
  --bdr:#1e2d45;--bdr2:#263954;--txt:#e2e8f0;--txt2:#94a3b8;--txt3:#64748b;--muted:#3f5471;
}
body{font-family:var(--ff);background:var(--bg);color:var(--txt);}
.page-content{background:var(--bg);}
.col-span-full{display:flex;flex-direction:column;gap:1.15rem;}

/* header */
.ph{
  display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.9rem;
  margin-bottom:.15rem;
}
.ph h2{
  font-size:1.2rem;font-weight:900;color:var(--txt);
  display:flex;align-items:center;gap:.65rem;margin:0;
}
.ph p{font-size:.78rem;color:var(--txt3);margin:.16rem 0 0;}
.h-ico{
  display:inline-flex;align-items:center;justify-content:center;
  height:38px;width:38px;border-radius:12px;background:var(--pg);color:var(--p);font-size:1rem;flex-shrink:0;
}

/* buttons */
.btn-p{
  display:inline-flex;align-items:center;gap:.45rem;padding:.62rem 1rem;background:var(--p);color:#fff;border:none;
  border-radius:var(--r-sm);font-size:.82rem;font-weight:900;font-family:var(--ff);cursor:pointer;
  box-shadow:0 8px 18px rgba(59,130,246,.22);transition:all .15s;
}
.btn-p:hover{background:var(--p2);transform:translateY(-1px);}
.btn-sm{
  display:inline-flex;align-items:center;gap:.35rem;padding:.42rem .82rem;border-radius:var(--r-sm);
  border:1px solid var(--bdr);background:var(--surf2);color:var(--txt2);font-size:.73rem;font-weight:800;
  font-family:var(--ff);cursor:pointer;transition:all .15s;
}
.btn-sm:hover{background:rgba(239,68,68,.08);border-color:rgba(239,68,68,.3);color:var(--err);}
.btn-sm-ok{background:var(--ok);border-color:var(--ok);color:#fff;}
.btn-sm-ok:hover{background:#16a34a;border-color:#16a34a;}

/* stat cards */
.sg{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:.9rem;margin:0;}
.sc{
  background:linear-gradient(180deg,var(--surf),var(--surf2));
  border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);padding:1rem 1.05rem;
  display:flex;align-items:flex-start;gap:.78rem;min-height:92px;
}
.si{
  height:40px;width:40px;border-radius:12px;flex-shrink:0;
  display:inline-flex;align-items:center;justify-content:center;font-size:1rem;
}
.sv{font-size:1.35rem;font-weight:900;color:var(--txt);line-height:1.05;font-family:var(--fm);}
.sl{font-size:.64rem;font-weight:800;color:var(--txt3);text-transform:uppercase;letter-spacing:.08em;margin-top:.22rem;}

/* cards */
.tv-card,.mc-card{
  background:var(--surf);
  border:1px solid var(--bdr);
  border-radius:18px;
  box-shadow:var(--sh);
  overflow:hidden;
}

/* filters */
.frow{
  display:flex;flex-wrap:wrap;gap:.6rem;align-items:center;
  padding:.9rem 1.05rem;border-bottom:1px solid var(--bdr);
  background:linear-gradient(180deg,var(--surf2),var(--surf));
}
.fi-wrap{position:relative;}
.fi-ico{
  position:absolute;left:.7rem;top:50%;transform:translateY(-50%);
  color:var(--muted);font-size:.8rem;pointer-events:none;
}
.fi{
  height:36px;padding:0 .8rem 0 2.15rem;border:1px solid var(--bdr);border-radius:var(--r-sm);
  background:var(--surf2);color:var(--txt);font-size:.8rem;font-family:var(--ff);outline:none;min-width:220px;
}
.fi:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(59,130,246,.09);}
.cpill{
  display:inline-flex;align-items:center;gap:.3rem;font-size:.72rem;color:var(--txt3);font-weight:700;
  background:var(--surf2);border:1px solid var(--bdr);padding:.26rem .72rem;border-radius:999px;
}
.cpill strong{color:var(--p);font-family:var(--fm);font-weight:900;}

/* table */
.table-wrap{
  max-height:calc(100vh - 280px);
  overflow:auto;
  scrollbar-width:thin;
  scrollbar-color:var(--bdr2) transparent;
}
.table-wrap::-webkit-scrollbar{width:6px;height:6px;}
.table-wrap::-webkit-scrollbar-thumb{background:var(--bdr2);border-radius:99px;}
table{width:100%;border-collapse:separate;border-spacing:0;font-size:.79rem;min-width:980px;}
thead th{
  position:sticky;top:0;z-index:5;background:var(--surf2);border-bottom:2px solid var(--bdr);
  padding:0 12px;height:40px;text-align:left;white-space:nowrap;font-size:.61rem;font-weight:900;
  color:var(--txt3);letter-spacing:.08em;text-transform:uppercase;
}
th.tc,td.tc{text-align:center;}
tbody td{padding:0 12px;height:50px;border-bottom:1px solid var(--bdr);vertical-align:middle;}
tbody tr:hover td{background:rgba(59,130,246,.03);}
tbody tr:last-child td{border-bottom:none;}
.pole-pair{display:flex;align-items:center;gap:.38rem;font-family:var(--fm);font-size:.75rem;font-weight:900;color:var(--p);}
.arr{color:var(--muted);font-size:.7rem;}
.c-num{font-family:var(--fm);font-size:.77rem;font-weight:700;color:var(--txt2);}
.sbadge{
  display:inline-flex;align-items:center;gap:.2rem;font-size:.62rem;font-weight:800;padding:.18rem .55rem;border-radius:999px;white-space:nowrap;
}
.s-pending{background:rgba(148,163,184,.12);color:var(--txt3);border:1px solid var(--bdr);}
.s-in_progress{background:rgba(245,158,11,.1);color:#92400e;border:1px solid rgba(245,158,11,.25);}
.s-completed{background:rgba(34,197,94,.1);color:#166534;border:1px solid rgba(34,197,94,.22);}
.s-blocked{background:rgba(239,68,68,.1);color:#991b1b;border:1px solid rgba(239,68,68,.2);}
.ar{display:flex;gap:.3rem;justify-content:center;}
.ab{
  display:inline-flex;align-items:center;justify-content:center;height:30px;width:30px;border-radius:50%;
  border:1px solid var(--bdr);background:var(--surf);cursor:pointer;font-size:.79rem;color:var(--txt2);transition:all .15s;
}
.ab:hover{transform:scale(1.08);}
.ab-e:hover{background:rgba(59,130,246,.1);border-color:rgba(59,130,246,.35);color:var(--p);}
.ab-d:hover{background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.35);color:var(--err);}
.empty-st{text-align:center;padding:3rem 1rem;color:var(--muted);font-size:.83rem;}
.empty-st i{font-size:2rem;display:block;margin-bottom:.6rem;}

/* connector */
.mc-hd{
  display:flex;align-items:center;gap:.75rem;padding:1rem 1.1rem;border-bottom:1px solid var(--bdr);
  background:linear-gradient(180deg,var(--surf2),var(--surf));flex-wrap:wrap;
}
.mc-hd-title{font-size:.84rem;font-weight:900;color:var(--txt);display:flex;align-items:center;gap:.45rem;}
.mc-steps{display:flex;align-items:center;gap:.35rem;flex-wrap:wrap;}
.mc-step{
  display:inline-flex;align-items:center;gap:.25rem;padding:.24rem .6rem;border-radius:999px;font-size:.66rem;font-weight:800;
  background:var(--surf2);border:1px solid var(--bdr);color:var(--muted);white-space:nowrap;
}
.mc-step.active{background:rgba(59,130,246,.1);border-color:rgba(59,130,246,.3);color:var(--p);}
.mc-step.done{background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#16a34a;}
.mc-sel{display:flex;align-items:center;gap:.5rem;margin-left:auto;font-size:.78rem;font-weight:700;color:var(--txt2);}
.mc-dot{width:10px;height:10px;border-radius:50%;flex-shrink:0;}
.mc-dot.from{background:#22c55e;}
.mc-dot.to{background:#f97316;}
.mc-sel-val{font-family:var(--fm);font-weight:900;color:var(--txt);}
.mc-sel-val.empty{color:var(--muted);font-weight:600;font-family:var(--ff);}

.mc-view-tabs{
  display:flex;gap:.18rem;align-items:center;background:var(--surf2);border:1px solid var(--bdr);
  border-radius:10px;padding:.2rem;margin-left:.15rem;
}
.mc-view-tab{
  display:inline-flex;align-items:center;gap:.28rem;padding:.26rem .7rem;border-radius:8px;font-size:.71rem;
  font-weight:800;border:none;background:transparent;color:var(--txt3);cursor:pointer;transition:all .15s;font-family:var(--ff);
}
.mc-view-tab.active{background:var(--p);color:#fff;box-shadow:0 2px 8px rgba(59,130,246,.25);}
.mc-view-tab:not(.active):hover{background:var(--bdr);color:var(--txt);}

/* YouTube-style layout */
.mc-body{
  display:grid;
  grid-template-columns:minmax(0,1fr) 360px;
  align-items:stretch;
  min-height:0;
  position:relative;
}

.mc-stage{
  position:relative;
  min-width:0;
  overflow:hidden;
  border-right:1px solid var(--bdr);
  background:var(--surf3);
}

#mcMap,
#sitemapCanvas{
  width:100%;
  display:block;
  height:clamp(360px, 56.25vw, 720px);
  min-height:360px;
  max-height:720px;
}

#mcMap{
  min-width:0;
  cursor:crosshair;
  background:#eef4fb;
  border-bottom:none;
}

#sitemapCanvas{
  min-width:0;
  display:block;
  background:#eef2f7;
  cursor:grab;
  border-bottom:none;
}
.dark #sitemapCanvas{background:#080f1b;}

.mc-sidebar{
  min-width:0;
  width:360px;
  max-width:360px;
  height:clamp(360px, 56.25vw, 720px);
  overflow-y:auto;
  overflow-x:hidden;
  border-left:none;
  border-top:none;
  background:linear-gradient(180deg,var(--surf),var(--surf2));
  display:flex;
  flex-direction:column;
}

.mc-sb-section{
  padding:1rem;
  border-bottom:1px solid var(--bdr);
  border-right:none;
  min-width:0;
}
.mc-sb-section:last-child{border-bottom:none;}

.mc-sb-label{
  font-size:.64rem;font-weight:900;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);margin-bottom:.65rem;
}
.mc-dist{
  font-size:.72rem;color:var(--txt3);background:var(--surf2);border:1px solid var(--bdr);border-radius:7px;
  padding:.2rem .5rem;display:inline-flex;align-items:center;gap:.3rem;
}
.mc-empty{text-align:center;padding:2rem 1rem;color:var(--muted);font-size:.78rem;}

#mcAllPolesList{
  flex:1;
  overflow-y:auto;
  max-height:260px;
  padding-right:.15rem;
  scrollbar-width:thin;
  scrollbar-color:var(--bdr2) transparent;
}
#mcAllPolesList::-webkit-scrollbar{width:6px;}
#mcAllPolesList::-webkit-scrollbar-thumb{background:var(--bdr2);border-radius:999px;}

.no-gps-item{
  display:flex;align-items:center;gap:.45rem;padding:.5rem .55rem;border:1px solid transparent;border-radius:10px;transition:.15s ease;
}
.no-gps-item:hover{background:rgba(59,130,246,.05);border-color:rgba(59,130,246,.12);}
.no-gps-name{
  font-size:.73rem;color:var(--txt2);flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-weight:700;
}
.btn-set-gps{
  font-size:.59rem;font-weight:800;padding:.16rem .45rem;border-radius:999px;border:1px solid rgba(59,130,246,.28);
  background:rgba(59,130,246,.08);color:var(--p);cursor:pointer;white-space:nowrap;flex-shrink:0;
}
.btn-set-gps:hover{background:rgba(59,130,246,.15);}

.workspace-badge{
  display:inline-flex;align-items:center;gap:.35rem;
  padding:.26rem .58rem;border-radius:999px;border:1px solid var(--bdr);
  background:var(--surf2);font-size:.69rem;font-weight:800;color:var(--txt3);
}

/* gps panel */
#gpsPanel{
  position:absolute;top:14px;left:14px;z-index:500;background:var(--surf);border:1px solid var(--bdr);
  border-radius:14px;box-shadow:var(--sh-lg);width:290px;overflow:hidden;
}
.gps-phd{
  background:linear-gradient(135deg,#3b82f6,#2563eb);color:#fff;padding:.7rem .9rem;
  display:flex;align-items:center;gap:.55rem;font-size:.8rem;font-weight:800;
}
.gps-phd-title{flex:1;line-height:1.2;}
.gps-phd-sub{font-size:.66rem;font-weight:600;opacity:.85;}
.gps-close-btn{
  background:rgba(255,255,255,.15);border:none;border-radius:6px;color:#fff;width:22px;height:22px;cursor:pointer;
  display:flex;align-items:center;justify-content:center;font-size:.8rem;
}
.gps-close-btn:hover{background:rgba(255,255,255,.25);}
.gps-search-wrap{padding:.6rem .75rem;border-bottom:1px solid var(--bdr);position:relative;}
.gps-search-inp{
  width:100%;padding:.4rem .62rem;border:1px solid var(--bdr);border-radius:8px;font-size:.77rem;outline:none;background:var(--surf2);color:var(--txt);font-family:var(--ff);
}
.gps-search-inp:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(59,130,246,.1);}
.gps-results{max-height:140px;overflow-y:auto;}
.gps-result-item{padding:.45rem .75rem;font-size:.72rem;cursor:pointer;border-bottom:1px solid var(--bdr);color:var(--txt2);line-height:1.35;}
.gps-result-item:hover{background:rgba(59,130,246,.07);color:var(--p2);}
.gps-coords{padding:.58rem .75rem;font-size:.71rem;color:var(--txt3);border-bottom:1px solid var(--bdr);}
.gps-coords strong{color:var(--txt);display:block;font-size:.7rem;margin-bottom:.12rem;}
.gps-panel-ft{padding:.6rem .75rem;display:flex;gap:.45rem;}
.btn-gps-save{
  flex:1;padding:.4rem 0;border:none;border-radius:8px;background:var(--p);color:#fff;font-size:.74rem;font-weight:800;font-family:var(--ff);cursor:pointer;
  display:inline-flex;align-items:center;justify-content:center;gap:.3rem;
}
.btn-gps-save:hover{background:var(--p2);}
.btn-gps-save:disabled{opacity:.5;cursor:not-allowed;}
.btn-gps-cancel{
  padding:.4rem .7rem;border:1px solid var(--bdr);border-radius:8px;background:var(--surf2);color:var(--txt2);
  font-size:.74rem;font-weight:700;font-family:var(--ff);cursor:pointer;
}

/* modals */
#spanOv{
  position:fixed;inset:0;z-index:900;background:rgba(7,15,30,.65);backdrop-filter:blur(8px);
  display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .22s;
}
#spanOv.open{opacity:1;pointer-events:all;}
#smc{
  background:var(--surf);border:1px solid var(--bdr);border-radius:20px;box-shadow:var(--sh-lg);width:100%;max-width:680px;
  max-height:calc(100vh - 2rem);display:flex;flex-direction:column;
  transform:translateY(20px) scale(.97);opacity:0;transition:transform .28s cubic-bezier(.34,1.18,.64,1),opacity .22s;
}
#spanOv.open #smc{transform:translateY(0) scale(1);opacity:1;}
.mhd{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.2rem;border-bottom:1px solid var(--bdr);gap:.7rem;}
.mico{
  height:40px;width:40px;border-radius:11px;flex-shrink:0;background:var(--pg);
  display:inline-flex;align-items:center;justify-content:center;color:var(--p);font-size:1rem;
}
.mt{font-size:1rem;font-weight:900;color:var(--txt);}
.ms{font-size:.7rem;color:var(--txt3);margin-top:.1rem;}
.mb{padding:1.15rem;overflow-y:auto;flex:1;display:flex;flex-direction:column;gap:.85rem;}
.mc{
  height:32px;width:32px;border-radius:8px;border:1px solid var(--bdr);background:var(--surf2);display:inline-flex;
  align-items:center;justify-content:center;color:var(--txt2);font-size:.95rem;cursor:pointer;transition:all .15s;
}
.mc:hover{background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.3);color:var(--err);}
.mft{padding:.9rem 1.2rem;border-top:1px solid var(--bdr);display:flex;justify-content:flex-end;gap:.6rem;}
.btn-c{
  padding:.48rem .96rem;border-radius:var(--r-sm);border:1px solid var(--bdr);background:var(--surf2);color:var(--txt2);
  font-size:.8rem;font-weight:800;font-family:var(--ff);cursor:pointer;
}
.btn-s{
  padding:.48rem 1.1rem;border-radius:var(--r-sm);border:none;background:var(--p);color:#fff;font-size:.8rem;font-weight:900;
  font-family:var(--ff);cursor:pointer;box-shadow:0 2px 8px rgba(59,130,246,.3);display:inline-flex;align-items:center;gap:.35rem;
}
.btn-s:hover{background:var(--p2);}
.fg{display:grid;grid-template-columns:1fr 1fr;gap:.8rem;}
.fg .c2{grid-column:span 2;}
.lbl{display:block;font-size:.72rem;font-weight:900;color:var(--txt2);letter-spacing:.02em;margin-bottom:.32rem;}
.lbl span{color:var(--err);}
.inp{
  width:100%;padding:.5rem .7rem;border:1px solid var(--bdr);border-radius:var(--r-sm);
  background:var(--surf);color:var(--txt);font-size:.82rem;font-family:var(--ff);outline:none;
  transition:border-color .15s,box-shadow .15s;
}
.inp:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(59,130,246,.1);}
.inp::placeholder{color:var(--muted);}
.inp-e{border-color:rgba(239,68,68,.6)!important;box-shadow:0 0 0 3px rgba(239,68,68,.1)!important;}
.secdiv{
  font-size:.68rem;font-weight:900;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);
  padding:.12rem 0 .42rem;border-bottom:1px solid var(--bdr);grid-column:span 2;margin-top:.3rem;
}
.hint{font-size:.68rem;color:var(--muted);margin-top:.2rem;}

/* delete modal */
#delOv{
  position:fixed;inset:0;z-index:950;background:rgba(7,15,30,.7);backdrop-filter:blur(6px);
  display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .2s;
}
#delOv.open{opacity:1;pointer-events:all;}
#delCard{
  background:var(--surf);border:1px solid var(--bdr);border-radius:18px;box-shadow:var(--sh-lg);max-width:380px;width:100%;
  padding:1.4rem;transform:scale(.95);opacity:0;transition:transform .22s cubic-bezier(.34,1.18,.64,1),opacity .2s;
}
#delOv.open #delCard{transform:scale(1);opacity:1;}
.delib{
  height:46px;width:46px;border-radius:12px;background:rgba(239,68,68,.1);
  display:inline-flex;align-items:center;justify-content:center;color:var(--err);font-size:1.15rem;margin-bottom:.8rem;
}
.btn-del{
  padding:.44rem 1rem;border-radius:var(--r-sm);border:none;background:var(--err);color:#fff;
  font-size:.8rem;font-weight:900;font-family:var(--ff);cursor:pointer;
}

/* sheet popup */
#mcSheet{
  position:fixed;inset:0;z-index:1000;background:rgba(7,15,30,.55);backdrop-filter:blur(6px);
  display:flex;align-items:flex-end;justify-content:center;opacity:0;pointer-events:none;transition:opacity .2s;
}
#mcSheet.open{opacity:1;pointer-events:all;}
#mcSheetCard{
  background:var(--surf);border-radius:22px 22px 0 0;width:100%;max-width:580px;padding:0 0 1.5rem;
  box-shadow:0 -8px 40px rgba(15,23,42,.18);transform:translateY(60px);transition:transform .28s cubic-bezier(.34,1.18,.64,1);
}
#mcSheet.open #mcSheetCard{transform:translateY(0);}
.sheet-handle{width:42px;height:4px;border-radius:2px;background:var(--bdr2);margin:12px auto 8px;}
.sheet-hd{padding:.55rem 1.2rem .95rem;border-bottom:1px solid var(--bdr);}
.sheet-title{font-size:.98rem;font-weight:900;color:var(--txt);}
.sheet-poles{display:flex;align-items:center;gap:.5rem;margin-top:.32rem;font-size:.8rem;font-weight:800;font-family:var(--fm);}
.sheet-from{color:#16a34a;}
.sheet-to{color:#ea580c;}
.sheet-dist{font-size:.7rem;color:var(--muted);font-family:var(--ff);font-weight:600;margin-left:.25rem;}
.sheet-body{padding:.95rem 1.2rem;display:grid;grid-template-columns:1fr 1fr;gap:.75rem;}
.sheet-body .c2{grid-column:span 2;}
.sheet-sec{
  font-size:.62rem;font-weight:900;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);
  padding:.4rem 0 0;border-top:1px solid var(--bdr);grid-column:span 2;margin-top:.2rem;
}
.sheet-ft{padding:.5rem 1.2rem 0;display:flex;gap:.6rem;justify-content:flex-end;}

/* leaflet */
.leaflet-popup-content-wrapper{
  border-radius:12px!important;box-shadow:0 4px 16px rgba(15,23,42,.14)!important;border:1px solid var(--bdr)!important;
}
.leaflet-popup-tip{display:none!important;}

/* toast */
.toast-wrap{
  position:fixed;bottom:1.5rem;right:1.5rem;z-index:9999;display:flex;flex-direction:column;gap:.5rem;pointer-events:none;
}
.toast{
  display:flex;align-items:center;gap:.6rem;padding:.7rem 1rem;border-radius:12px;background:var(--surf);border:1px solid var(--bdr);
  box-shadow:var(--sh-lg);font-size:.8rem;font-weight:700;color:var(--txt);min-width:240px;
  transform:translateX(120%);opacity:0;transition:transform .3s cubic-bezier(.34,1.3,.64,1),opacity .25s;pointer-events:all;
}
.toast.show{transform:translateX(0);opacity:1;}
.toast.t-ok{border-color:rgba(34,197,94,.25);background:#f0fdf4;}
.toast.t-err{border-color:rgba(239,68,68,.25);background:#fef2f2;}

/* responsive */
@media(max-width:980px){
  .mc-body{
    grid-template-columns:1fr;
  }

  .mc-stage{
    border-right:none;
    border-bottom:1px solid var(--bdr);
  }

  .mc-sidebar{
    width:100%;
    max-width:none;
    height:auto;
    overflow:visible;
  }

  .mc-sb-section{
    border-bottom:1px solid var(--bdr);
  }

  .mc-sb-section:last-child{
    border-bottom:none;
  }

  #mcMap,
  #sitemapCanvas{
    height:clamp(280px, 56.25vw, 520px);
    min-height:280px;
  }

  #mcAllPolesList{
    max-height:220px;
  }
}
@media(max-width:640px){
  .fg,.sheet-body{grid-template-columns:1fr;}
  .fg .c2,.sheet-body .c2,.secdiv,.sheet-sec{grid-column:span 1;}
  .mc-sel{width:100%;margin-left:0;}
  .fi{min-width:100%;}
}
</style>
@endpush

<div class="col-span-full">

  <div class="ph">
    <div>
      <h2><div class="h-ico"><i class="mgc_git_branch_line"></i></div> Pole Spans</h2>
      <p>
        Node: <strong>{{ $node->node_id }}</strong>
        <span style="margin:0 .4rem;color:var(--bdr2)">·</span>
        Project: <strong>{{ $project->name }}</strong>
        <span style="margin:0 .4rem;color:var(--bdr2)">·</span>
        <a href="{{ route('admin.projects.nodes.poles.index', [$project, $node]) }}" style="color:var(--p);font-size:.76rem;">← Back to Poles</a>
      </p>
    </div>
    <button class="btn-p" id="btnOpenAdd"><i class="mgc_add_line"></i> Declare Span</button>
  </div>

  <div class="sg">
    <div class="sc">
      <div class="si" style="background:rgba(59,130,246,.1);color:var(--p);"><i class="mgc_git_branch_line"></i></div>
      <div><div class="sv" id="statTotal">0</div><div class="sl">Total Spans</div></div>
    </div>
    <div class="sc">
      <div class="si" style="background:rgba(148,163,184,.1);color:var(--txt3);"><i class="mgc_time_line"></i></div>
      <div><div class="sv" id="statPending">0</div><div class="sl">Pending</div></div>
    </div>
    <div class="sc">
      <div class="si" style="background:rgba(245,158,11,.1);color:#b45309;"><i class="mgc_loading_4_line"></i></div>
      <div><div class="sv" id="statInProgress">0</div><div class="sl">In Progress</div></div>
    </div>
    <div class="sc">
      <div class="si" style="background:rgba(34,197,94,.1);color:#16a34a;"><i class="mgc_check_circle_line"></i></div>
      <div><div class="sv" id="statDone">0</div><div class="sl">Completed</div></div>
    </div>
    <div class="sc">
      <div class="si" style="background:rgba(20,184,166,.1);color:#0d9488;"><i class="mgc_cable_line"></i></div>
      <div><div class="sv" id="statCable">0</div><div class="sl">Exp. Cable (m)</div></div>
    </div>
  </div>

  <div class="mc-card">
    <div class="mc-hd">
      <span class="mc-hd-title"><i class="mgc_git_branch_line" style="color:var(--p)"></i> Span Connector</span>

      <div class="mc-view-tabs">
        <button class="mc-view-tab active" id="tabSitemap"><i class="mgc_layout_grid_line"></i> Sitemap</button>
        <button class="mc-view-tab" id="tabGps"><i class="mgc_map_2_line"></i> GPS Map</button>
      </div>

      <div class="mc-steps">
        <span class="mc-step active" id="mcStep1">① Click FROM pole</span>
        <span class="mc-step" id="mcStep2">② Click TO pole</span>
        <span class="mc-step" id="mcStep3">③ Fill details</span>
      </div>

      <div class="mc-sel" id="mcSelDisplay">
        <span class="mc-dot from"></span><span class="mc-sel-val empty" id="mcFromLabel">Not selected</span>
        <span style="color:var(--muted);font-size:.75rem;">→</span>
        <span class="mc-dot to"></span><span class="mc-sel-val empty" id="mcToLabel">Not selected</span>
      </div>

      <button class="btn-sm" id="mcClearBtn" onclick="mcClear()" style="display:none;"><i class="mgc_close_line"></i> Clear</button>
      <button class="btn-p" style="font-size:.74rem;padding:.38rem .85rem;" onclick="resetForm();openModal()"><i class="mgc_edit_line"></i> Manual</button>
    </div>

    <div class="mc-body">
      <div class="mc-stage">
        <canvas id="sitemapCanvas"></canvas>
        <div id="mcMap" style="display:none;"></div>

        <div id="gpsPanel" style="display:none;">
          <div class="gps-phd">
            <i class="mgc_location_line" style="font-size:1rem;"></i>
            <div class="gps-phd-title">
              Set GPS
              <div class="gps-phd-sub" id="gpsPoleLabel">—</div>
            </div>
            <button class="gps-close-btn" id="gpsCancelBtn"><i class="mgc_close_line"></i></button>
          </div>
          <div class="gps-search-wrap">
            <input id="gpsSearchInp" class="gps-search-inp" placeholder="Search location (e.g. Taytay, Rizal)…" autocomplete="off"/>
          </div>
          <div class="gps-results" id="gpsResults"></div>
          <div class="gps-coords" id="gpsCoords">
            <strong>Pinned Location</strong>
            Click on the map to pin coordinates.
          </div>
          <div class="gps-panel-ft">
            <button class="btn-gps-cancel" id="gpsCancelBtn2">Cancel</button>
            <button class="btn-gps-save" id="gpsSaveBtn" disabled>
              <i class="mgc_save_line"></i> Save GPS
            </button>
          </div>
        </div>
      </div>

      <div class="mc-sidebar">
        <div class="mc-sb-section">
          <div class="mc-sb-label">Workspace Guide</div>
          <div style="display:flex;flex-wrap:wrap;gap:.45rem;">
            <span class="workspace-badge"><span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:#22c55e;"></span> Pole with GPS</span>
            <span class="workspace-badge"><span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:#f59e0b;"></span> Sitemap only</span>
            <span class="workspace-badge"><span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:#2563eb;"></span> FROM</span>
            <span class="workspace-badge"><span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:#f97316;"></span> TO</span>
          </div>
          <div style="margin-top:.7rem;font-size:.68rem;color:var(--muted);line-height:1.45;">
            Sitemap: drag to pan, scroll to zoom. Select two poles to create a new span.
          </div>
        </div>

        <div class="mc-sb-section">
          <div class="mc-sb-label">Map Summary</div>
          <div style="display:flex;flex-direction:column;gap:.55rem;">
            <div style="display:flex;align-items:center;justify-content:space-between;font-size:.74rem;color:var(--txt2);">
              <span>Existing Spans</span>
              <span class="mc-dist"><i class="mgc_git_branch_line"></i> <strong id="mcSpanCount">0</strong></span>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;font-size:.74rem;color:var(--txt2);">
              <span>Total Poles</span>
              <span class="mc-dist"><i class="mgc_pin_line"></i> <strong id="mcPoleCount"></strong></span>
            </div>
          </div>
        </div>

        <div class="mc-sb-section" style="display:flex;flex-direction:column;min-height:0;">
          <div class="mc-sb-label">Poles Directory</div>
          <div style="margin-bottom:.55rem;position:relative;">
            <i class="mgc_search_line" style="position:absolute;left:.55rem;top:50%;transform:translateY(-50%);color:var(--muted);font-size:.75rem;pointer-events:none;"></i>
            <input id="mcPoleSearch" placeholder="Search pole…" style="width:100%;padding:.38rem .55rem .38rem 1.8rem;border:1px solid var(--bdr);border-radius:8px;font-size:.73rem;background:var(--surf2);color:var(--txt);outline:none;font-family:var(--ff);"/>
          </div>
          <div id="mcAllPolesList"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="tv-card">
    <div class="frow">
      <div class="fi-wrap">
        <i class="mgc_search_line fi-ico"></i>
        <input id="fSearch" type="text" placeholder="Search pole code…" class="fi" />
      </div>
      <div class="cpill" style="margin-left:auto;"><strong id="showCount">0</strong>&nbsp;span(s)</div>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th style="width:40px;">#</th>
            <th>From → To Pole</th>
            <th class="tc">Length (m)</th>
            <th class="tc">Runs</th>
            <th class="tc">Exp. Cable (m)</th>
            <th class="tc">Node</th>
            <th class="tc">Amp</th>
            <th class="tc">Ext</th>
            <th class="tc">TSC</th>
            <th class="tc">Status</th>
            <th class="tc">Actions</th>
          </tr>
        </thead>
        <tbody id="spanTbody"></tbody>
      </table>
    </div>
  </div>

</div>

<div id="spanOv">
  <div id="smc">
    <div class="mhd">
      <div class="mico"><i class="mgc_git_branch_line"></i></div>
      <div style="flex:1;"><div class="mt" id="modalTitle">Declare Span</div><div class="ms">Fields marked <span style="color:var(--err)">*</span> are required.</div></div>
      <button class="mc" id="btnClose"><i class="mgc_close_line"></i></button>
    </div>
    <div class="mb">
      <input type="hidden" id="editId"/>
      <div class="fg">
        <div class="secdiv">Pole Connection</div>
        <div>
          <label class="lbl" for="fFromPole">From Pole <span>*</span></label>
          <select id="fFromPole" class="inp">
            @foreach($poles as $pole)
              @php
                $untagged = ['NPT','NT'];
                $label = $pole->pole_name ?: $pole->pole_code;
                if (in_array(strtoupper($pole->pole_code), $untagged)) { $label .= ' (#'.$pole->id.')'; }
              @endphp
              <option value="{{ $pole->id }}">{{ $label }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="lbl" for="fToPole">To Pole <span>*</span></label>
          <select id="fToPole" class="inp">
            @foreach($poles as $pole)
              @php
                $label = $pole->pole_name ?: $pole->pole_code;
                if (in_array(strtoupper($pole->pole_code), $untagged)) { $label .= ' (#'.$pole->id.')'; }
              @endphp
              <option value="{{ $pole->id }}">{{ $label }}</option>
            @endforeach
          </select>
        </div>

        <div class="secdiv">Cable Details</div>
        <div>
          <label class="lbl" for="fLength">Length (m) <span>*</span></label>
          <input id="fLength" class="inp" type="number" step="0.01" min="0" placeholder="0.00"/>
        </div>
        <div>
          <label class="lbl" for="fRuns">Runs <span>*</span></label>
          <input id="fRuns" class="inp" type="number" min="1" placeholder="1"/>
        </div>
        <div class="c2">
          <label class="lbl" for="fExpCable">Expected Cable (m)</label>
          <input id="fExpCable" class="inp" type="number" step="0.01" min="0" placeholder="Auto-calculated"/>
          <div class="hint">Auto-filled as Length × Runs. You can override it.</div>
        </div>

        <div class="secdiv">Expected Collectibles</div>
        <div>
          <label class="lbl" for="fNode">Expected Node</label>
          <input id="fNode" class="inp" type="number" min="0" placeholder="0"/>
        </div>
        <div>
          <label class="lbl" for="fAmp">Expected Amplifier</label>
          <input id="fAmp" class="inp" type="number" min="0" placeholder="0"/>
        </div>
        <div>
          <label class="lbl" for="fExt">Expected Extender</label>
          <input id="fExt" class="inp" type="number" min="0" placeholder="0"/>
        </div>
        <div>
          <label class="lbl" for="fTsc">Expected TSC</label>
          <input id="fTsc" class="inp" type="number" min="0" placeholder="0"/>
        </div>

        <div class="secdiv">Status</div>
        <div class="c2">
          <label class="lbl" for="fStatus">Status <span>*</span></label>
          <select id="fStatus" class="inp">
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
            <option value="blocked">Blocked</option>
          </select>
        </div>
      </div>
    </div>
    <div class="mft">
      <button class="btn-c" id="btnCancel" type="button">Cancel</button>
      <button class="btn-s" id="btnSave" type="button"><i class="mgc_save_line"></i> <span id="saveLbl">Save Span</span></button>
    </div>
  </div>
</div>

<div id="delOv">
  <div id="delCard">
    <div class="delib"><i class="mgc_delete_2_line"></i></div>
    <div style="font-size:.9rem;font-weight:900;color:var(--txt);margin-bottom:.3rem;">Delete Span?</div>
    <p style="font-size:.79rem;color:var(--txt2);margin-bottom:1.1rem;" id="delMsg">This cannot be undone.</p>
    <div style="display:flex;gap:.5rem;justify-content:flex-end;">
      <button class="btn-c" id="btnDelCancel">Cancel</button>
      <button class="btn-del" id="btnDelConfirm"><i class="mgc_delete_2_line"></i> Delete</button>
    </div>
  </div>
</div>

<div class="toast-wrap" id="toastWrap"></div>

<div id="mcSheet">
  <div id="mcSheetCard">
    <div class="sheet-handle"></div>
    <div class="sheet-hd">
      <div class="sheet-title">Span Details</div>
      <div class="sheet-poles">
        <span class="sheet-from" id="shFromLabel">—</span>
        <span style="color:var(--muted)">→</span>
        <span class="sheet-to" id="shToLabel">—</span>
        <span class="sheet-dist" id="shDist"></span>
      </div>
    </div>
    <div class="sheet-body">
      <div>
        <label class="lbl">Length (m) <span>*</span></label>
        <input id="shLength" class="inp" type="number" step="0.01" min="0" placeholder="0.00"/>
      </div>
      <div>
        <label class="lbl">Runs <span>*</span></label>
        <input id="shRuns" class="inp" type="number" min="1" value="1"/>
      </div>
      <div class="c2">
        <label class="lbl">Expected Cable (m)</label>
        <input id="shCable" class="inp" type="number" step="0.01" min="0" placeholder="Auto: Length × Runs"/>
      </div>
      <div class="sheet-sec">Expected Collectibles</div>
      <div>
        <label class="lbl">Node</label>
        <input id="shNode" class="inp" type="number" min="0" value="0"/>
      </div>
      <div>
        <label class="lbl">Amplifier</label>
        <input id="shAmp" class="inp" type="number" min="0" value="0"/>
      </div>
      <div>
        <label class="lbl">Extender</label>
        <input id="shExt" class="inp" type="number" min="0" value="0"/>
      </div>
      <div>
        <label class="lbl">TSC</label>
        <input id="shTsc" class="inp" type="number" min="0" value="0"/>
      </div>
    </div>
    <div class="sheet-ft">
      <button class="btn-c" onclick="mcCloseSheet()">Cancel</button>
      <button class="btn-s" id="shSaveBtn" onclick="mcSaveSpan()"><i class="mgc_save_line"></i> Save Span</button>
    </div>
  </div>
</div>

@push('scripts')
<script>
(function(){
  const SPANS    = @json($spans);
  const BASE_URL = "{{ url('admin/projects/'.$project->id.'/nodes/'.$node->id.'/spans') }}";
  const CSRF     = document.querySelector('meta[name="csrf-token"]').content;

  let rows = JSON.parse(JSON.stringify(SPANS));
  let pendingDelId = null;
  let cableUserEdited = false;
  const $ = id => document.getElementById(id);

  const STATUS_LABELS = {pending:'Pending',in_progress:'In Progress',completed:'Completed',blocked:'Blocked'};
  const STATUS_CLASS  = {pending:'s-pending',in_progress:'s-in_progress',completed:'s-completed',blocked:'s-blocked'};

  function toast(msg,type='ok'){
    const w=$('toastWrap'),el=document.createElement('div');
    el.className=`toast t-${type}`;
    el.innerHTML=`<i class="mgc_${type==='ok'?'check_circle_line':'close_circle_line'}" style="color:${type==='ok'?'#16a34a':'var(--err)'}"></i><span>${msg}</span>`;
    w.appendChild(el);
    requestAnimationFrame(()=>requestAnimationFrame(()=>el.classList.add('show')));
    setTimeout(()=>{el.classList.remove('show');setTimeout(()=>el.remove(),350);},3200);
  }

  function renderStats(list){
    $('statTotal').textContent      = list.length;
    $('statPending').textContent    = list.filter(s=>s.status==='pending').length;
    $('statInProgress').textContent = list.filter(s=>s.status==='in_progress').length;
    $('statDone').textContent       = list.filter(s=>s.status==='completed').length;
    const totalCable = list.reduce((a,s)=>a+(+s.expected_cable||0),0);
    $('statCable').textContent      = totalCable.toFixed(2);
  }

  function statusBadge(s){
    return `<span class="sbadge ${STATUS_CLASS[s]||'s-pending'}">${STATUS_LABELS[s]||s}</span>`;
  }

  function renderTable(){
    const q=($('fSearch').value||'').toLowerCase();
    const list=rows.filter(s=>!q||s.from_pole_name.toLowerCase().includes(q)||s.to_pole_name.toLowerCase().includes(q));
    renderStats(list);
    $('showCount').textContent=list.length;

    if(!list.length){
      $('spanTbody').innerHTML=`<tr><td colspan="11"><div class="empty-st"><i class="mgc_git_branch_line"></i>No spans declared yet. Click "Declare Span" to get started.</div></td></tr>`;
      return;
    }

    $('spanTbody').innerHTML=list.map((s,i)=>`<tr>
      <td style="color:var(--muted);font-size:.67rem;font-family:var(--fm)">${i+1}</td>
      <td><div class="pole-pair"><span>${s.from_pole_name}</span><span class="arr">→</span><span>${s.to_pole_name}</span></div></td>
      <td class="tc c-num">${(+s.length_meters).toFixed(2)}</td>
      <td class="tc c-num">${s.runs}</td>
      <td class="tc c-num">${(+s.expected_cable).toFixed(2)}</td>
      <td class="tc c-num">${s.expected_node}</td>
      <td class="tc c-num">${s.expected_amplifier}</td>
      <td class="tc c-num">${s.expected_extender}</td>
      <td class="tc c-num">${s.expected_tsc}</td>
      <td class="tc">${statusBadge(s.status)}</td>
      <td class="tc"><div class="ar">
        <button class="ab ab-e" data-act="edit" data-id="${s.id}" title="Edit"><i class="mgc_edit_2_line"></i></button>
        <button class="ab ab-d" data-act="del"  data-id="${s.id}" title="Delete"><i class="mgc_delete_2_line"></i></button>
      </div></td>
    </tr>`).join('');
  }

  function recalcCable(){
    if(cableUserEdited) return;
    const l=parseFloat($('fLength').value)||0;
    const r=parseInt($('fRuns').value)||0;
    const total=l*r;
    $('fExpCable').value=total>0?total.toFixed(2):'';
  }

  window.openModal=function(){$('spanOv').classList.add('open');document.body.style.overflow='hidden';}
  window.closeModal=function(){$('spanOv').classList.remove('open');document.body.style.overflow='';cableUserEdited=false;}
  function openDel(id){
    const s=rows.find(x=>x.id==id);if(!s)return;
    pendingDelId=id;
    $('delMsg').textContent=`Delete span "${s.from_pole_name} → ${s.to_pole_name}"? This cannot be undone.`;
    $('delOv').classList.add('open');document.body.style.overflow='hidden';
  }
  function closeDel(){$('delOv').classList.remove('open');document.body.style.overflow='';pendingDelId=null;}

  window.resetForm=function(){
    $('editId').value='';
    $('fFromPole').value=$('fFromPole').options[0]?.value||'';
    $('fToPole').value=$('fToPole').options[1]?.value||$('fToPole').options[0]?.value||'';
    $('fLength').value='';$('fRuns').value='';$('fExpCable').value='';
    $('fNode').value='';$('fAmp').value='';$('fExt').value='';$('fTsc').value='';
    $('fStatus').value='pending';
    $('modalTitle').textContent='Declare Span';$('saveLbl').textContent='Save Span';
    [$('fFromPole'),$('fToPole'),$('fLength'),$('fRuns')].forEach(el=>el.classList.remove('inp-e'));
    cableUserEdited=false;
  }

  function loadEdit(id){
    const s=rows.find(x=>x.id==id);if(!s)return;
    resetForm();
    $('editId').value=s.id;
    $('fFromPole').value=s.from_pole_id;
    $('fToPole').value=s.to_pole_id;
    $('fLength').value=s.length_meters;
    $('fRuns').value=s.runs;
    $('fExpCable').value=s.expected_cable;
    $('fNode').value=s.expected_node;
    $('fAmp').value=s.expected_amplifier;
    $('fExt').value=s.expected_extender;
    $('fTsc').value=s.expected_tsc;
    $('fStatus').value=s.status;
    $('modalTitle').textContent='Edit Span';$('saveLbl').textContent='Update Span';
    cableUserEdited=true;
    openModal();
  }

  async function saveSpan(){
    const fromId=$('fFromPole').value, toId=$('fToPole').value;
    const length=$('fLength').value.trim(), runs=$('fRuns').value.trim();
    let valid=true;
    [$('fFromPole'),$('fToPole'),$('fLength'),$('fRuns')].forEach(el=>el.classList.remove('inp-e'));
    if(!fromId||!toId||fromId===toId){
      $('fFromPole').classList.add('inp-e');$('fToPole').classList.add('inp-e');valid=false;
      if(fromId===toId)toast('From and To pole must be different.','err');
    }
    if(!length){$('fLength').classList.add('inp-e');valid=false;}
    if(!runs){$('fRuns').classList.add('inp-e');valid=false;}
    if(!valid)return;

    const editId=$('editId').value;
    const fd=new FormData();
    fd.append('from_pole_id',fromId);fd.append('to_pole_id',toId);
    fd.append('length_meters',length);fd.append('runs',runs);
    fd.append('expected_cable',$('fExpCable').value||0);
    fd.append('expected_node',$('fNode').value||0);
    fd.append('expected_amplifier',$('fAmp').value||0);
    fd.append('expected_extender',$('fExt').value||0);
    fd.append('expected_tsc',$('fTsc').value||0);
    fd.append('status',$('fStatus').value);

    const btn=$('btnSave');
    btn.disabled=true;btn.innerHTML='<i class="mgc_loading_4_line"></i> Saving…';
    try{
      const url=editId?`${BASE_URL}/${editId}`:BASE_URL;
      const res=await fetch(url,{method:'POST',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'},body:fd});
      const ct=res.headers.get('content-type')||'';
      let data={};
      if(ct.includes('application/json')){data=await res.json();}
      else{const txt=await res.text();toast(`Server error (${res.status}) — check logs.`,'err');console.error('Non-JSON:',res.status,txt.substring(0,500));return;}
      if(!res.ok||!data.success){toast(data.message||data.error||'Something went wrong.','err');return;}
      if(editId){const idx=rows.findIndex(x=>x.id==editId);if(idx>=0)rows[idx]=data.span;}
      else rows.unshift(data.span);
      closeModal();renderTable();toast(editId?'Span updated.':'Span declared.');
    }catch(e){toast('Network error: '+e.message,'err');console.error('saveSpan error:',e);}
    finally{btn.disabled=false;btn.innerHTML='<i class="mgc_save_line"></i> <span id="saveLbl">Save Span</span>';}
  }

  async function confirmDel(){
    if(!pendingDelId)return;
    const btn=$('btnDelConfirm');
    btn.disabled=true;btn.innerHTML='<i class="mgc_loading_4_line"></i> Deleting…';
    try{
      const res=await fetch(`${BASE_URL}/${pendingDelId}`,{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}});
      const data=await res.json();
      if(!res.ok||!data.success){toast(data.message||'Delete failed.','err');return;}
      rows=rows.filter(x=>x.id!=pendingDelId);closeDel();renderTable();toast('Span deleted.');
    }catch(e){toast('Network error.','err');}
    finally{btn.disabled=false;btn.innerHTML='<i class="mgc_delete_2_line"></i> Delete';}
  }

  $('fLength').addEventListener('input',recalcCable);
  $('fRuns').addEventListener('input',recalcCable);
  $('fExpCable').addEventListener('input',()=>{cableUserEdited=true;});
  $('btnOpenAdd').addEventListener('click',()=>{resetForm();openModal();});
  $('btnClose').addEventListener('click',closeModal);
  $('btnCancel').addEventListener('click',closeModal);
  $('btnSave').addEventListener('click',saveSpan);
  $('spanOv').addEventListener('click',e=>{if(e.target===$('spanOv'))closeModal();});
  $('btnDelConfirm').addEventListener('click',confirmDel);
  $('btnDelCancel').addEventListener('click',closeDel);
  $('delOv').addEventListener('click',e=>{if(e.target===$('delOv'))closeDel();});
  $('fSearch').addEventListener('input',renderTable);
  $('spanTbody').addEventListener('click',e=>{
    const btn=e.target.closest('button');if(!btn)return;
    if(btn.dataset.act==='edit')loadEdit(btn.dataset.id);
    if(btn.dataset.act==='del')openDel(btn.dataset.id);
  });
  document.addEventListener('keydown',e=>{
    if(e.key==='Escape'){
      if($('spanOv').classList.contains('open'))closeModal();
      if($('delOv').classList.contains('open'))closeDel();
    }
  });

  renderTable();
  window._addSpanRow = function(span) { rows.unshift(span); renderTable(); };
})();
</script>

@php
  $mapPolesData = $poles->map(fn($p) => [
    'id'      => $p->id,
    'code'    => $p->pole_name ?: $p->pole_code,
    'raw_code'=> $p->pole_code,
    'has_gps' => !!(float)($p->map_latitude ?? 0) && !!(float)($p->map_longitude ?? 0),
    'lat'     => (float)($p->map_latitude ?? 0),
    'lng'     => (float)($p->map_longitude ?? 0),
    'sx'      => (float)($p->sitemap_x ?? 0),
    'sy'      => (float)($p->sitemap_y ?? 0),
  ]);
  $mapSpansData = collect($spans)->map(fn($s) => [
    'from_pole_id' => is_array($s) ? $s['from_pole_id'] : $s->from_pole_id,
    'to_pole_id'   => is_array($s) ? $s['to_pole_id']   : $s->to_pole_id,
  ]);
@endphp
<script src="/assets/libs/leaflet/leaflet.js"></script>
<script>
(function(){
  const MAP_POLES = @json($mapPolesData);
  const MAP_SPANS = @json($mapSpansData);
  const BASE_URL = "{{ url('admin/projects/'.$project->id.'/nodes/'.$node->id.'/spans') }}";
  const CSRF     = document.querySelector('meta[name="csrf-token"]').content;

  const $ = id => document.getElementById(id);

  const map = L.map('mcMap', { zoomControl: true }).setView([14.5995, 120.9842], 14);
  window._leafletMap = map;
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors', maxZoom: 20
  }).addTo(map);

  let mcFrom = null, mcTo = null, previewLine = null;
  const poleMarkers = {};

  const withGps = MAP_POLES.filter(p => p.has_gps);

  withGps.forEach(p => {
    const m = L.circleMarker([p.lat, p.lng], {
      radius: 9, fillColor: '#22c55e', fillOpacity: .9, color: '#fff', weight: 2.5
    }).addTo(map);
    m.bindTooltip(`<b>${p.code}</b>`, { direction: 'top', className: '' });
    m.on('click', () => { if (gpsMode) return; mcSelectPole(p, m); });
    poleMarkers[p.id] = { marker: m, pole: p };
  });

  if (withGps.length) {
    map.fitBounds(L.latLngBounds(withGps.map(p => [p.lat, p.lng])), { padding: [40, 40] });
  }

  MAP_SPANS.forEach(s => {
    const f = MAP_POLES.find(p => p.id === s.from_pole_id);
    const t = MAP_POLES.find(p => p.id === s.to_pole_id);
    if (f?.has_gps && t?.has_gps) {
      L.polyline([[f.lat, f.lng],[t.lat, t.lng]], {
        color: '#94a3b8', weight: 2.5, opacity: .7, dashArray: '4 3'
      }).addTo(map).bindTooltip(`${f.code} → ${t.code}`, { sticky: true });
    }
  });
  $('mcSpanCount').textContent = MAP_SPANS.length;

  function renderPoleList(filter) {
    const q = (filter || '').toLowerCase();
    const list = q ? MAP_POLES.filter(p => p.code.toLowerCase().includes(q)) : MAP_POLES;
    $('mcPoleCount').textContent = `${list.length}/${MAP_POLES.length}`;
    $('mcAllPolesList').innerHTML = list.map(p =>
      `<div class="no-gps-item" data-pole-id="${p.id}">
        <span style="display:inline-block;width:9px;height:9px;border-radius:50%;background:${p.has_gps ? '#22c55e' : '#f59e0b'};flex-shrink:0;" id="gpsDot_${p.id}"></span>
        <span class="no-gps-name">${p.code}</span>
        <button class="btn-set-gps" data-id="${p.id}">${p.has_gps ? 'Edit GPS' : 'Set GPS'}</button>
      </div>`
    ).join('') || `<div style="font-size:.71rem;color:var(--muted);padding:.3rem 0;">No poles found.</div>`;
  }

  renderPoleList('');

  window._leafletBridge = {
    setMcFrom: function(pole) {
      mcFrom = pole;
      $('mcFromLabel').textContent = pole.code;
      $('mcFromLabel').classList.remove('empty');
      $('mcClearBtn').style.display = '';
      setStep(2);
    },
    setMcTo: function(pole) {
      mcTo = pole;
      $('mcToLabel').textContent = pole.code;
      $('mcToLabel').classList.remove('empty');
      setStep(3);
    },
  };

  $('mcPoleSearch').addEventListener('input', function() { renderPoleList(this.value); });

  $('mcAllPolesList').addEventListener('click', e => {
    const btn = e.target.closest('.btn-set-gps');
    if (!btn) return;
    const pole = MAP_POLES.find(p => p.id === parseInt(btn.dataset.id));
    if (pole) enterGpsMode(pole);
  });

  function setStep(n) {
    [1,2,3].forEach(i => {
      const el = $('mcStep'+i);
      el.className = 'mc-step' + (i < n ? ' done' : i === n ? ' active' : '');
    });
  }

  function haversine(lat1,lon1,lat2,lon2) {
    const R=6371000, dL=(lat2-lat1)*Math.PI/180, dO=(lon2-lon1)*Math.PI/180;
    const a=Math.sin(dL/2)**2+Math.cos(lat1*Math.PI/180)*Math.cos(lat2*Math.PI/180)*Math.sin(dO/2)**2;
    return R*2*Math.atan2(Math.sqrt(a),Math.sqrt(1-a));
  }

  function mcSelectPole(pole, marker) {
    if (!mcFrom) {
      mcFrom = pole;
      marker.setStyle({ fillColor: '#2563eb', color: '#2563eb', weight: 3 });
      $('mcFromLabel').textContent = pole.code;
      $('mcFromLabel').classList.remove('empty');
      $('mcClearBtn').style.display = '';
      setStep(2);
    } else if (!mcTo && pole.id !== mcFrom.id) {
      mcTo = pole;
      marker.setStyle({ fillColor: '#f97316', color: '#f97316', weight: 3 });
      $('mcToLabel').textContent = pole.code;
      $('mcToLabel').classList.remove('empty');
      setStep(3);

      if (previewLine) map.removeLayer(previewLine);
      previewLine = L.polyline([[mcFrom.lat,mcFrom.lng],[mcTo.lat,mcTo.lng]], {
        color: '#facc15', weight: 2.5, dashArray: '6 4', opacity: .9
      }).addTo(map);

      const dist = haversine(mcFrom.lat, mcFrom.lng, mcTo.lat, mcTo.lng);

      $('shFromLabel').textContent = mcFrom.code;
      $('shToLabel').textContent   = mcTo.code;
      $('shDist').textContent      = `~${Math.round(dist)} m`;
      $('shLength').value          = Math.round(dist);
      $('shRuns').value            = 1;
      $('shCable').value           = '';
      $('shNode').value=$('shAmp').value=$('shExt').value=$('shTsc').value=0;
      $('mcSheet').classList.add('open');
    }
  }

  window.mcClear = function() {
    mcFrom = null; mcTo = null;
    if (previewLine) { map.removeLayer(previewLine); previewLine = null; }
    Object.values(poleMarkers).forEach(({marker}) => {
      marker.setStyle({ fillColor: '#22c55e', color: '#fff', weight: 2.5 });
    });
    $('mcFromLabel').textContent = 'Not selected'; $('mcFromLabel').classList.add('empty');
    $('mcToLabel').textContent   = 'Not selected'; $('mcToLabel').classList.add('empty');
    $('mcClearBtn').style.display = 'none';
    setStep(1);
    mcCloseSheet();
    if (window._sitemapClear) window._sitemapClear();
  };

  window.mcCloseSheet = function() {
    $('mcSheet').classList.remove('open');
  };

  window.mcSaveSpan = async function() {
    if (!mcFrom || !mcTo) return;
    const length = $('shLength').value.trim();
    const runs   = $('shRuns').value.trim();
    if (!length || !runs) {
      if (!length) $('shLength').classList.add('inp-e');
      if (!runs)   $('shRuns').classList.add('inp-e');
      return;
    }
    $('shLength').classList.remove('inp-e');
    $('shRuns').classList.remove('inp-e');
    const cable = $('shCable').value || (parseFloat(length) * parseInt(runs)).toFixed(2);

    const btn = $('shSaveBtn');
    btn.disabled = true; btn.innerHTML = '<i class="mgc_loading_4_line"></i> Saving…';

    const fd = new FormData();
    fd.append('from_pole_id', mcFrom.id);
    fd.append('to_pole_id',   mcTo.id);
    fd.append('length_meters', length);
    fd.append('runs',          runs);
    fd.append('expected_cable', cable);
    fd.append('expected_node',      $('shNode').value || 0);
    fd.append('expected_amplifier', $('shAmp').value  || 0);
    fd.append('expected_extender',  $('shExt').value  || 0);
    fd.append('expected_tsc',       $('shTsc').value  || 0);
    fd.append('status', 'pending');

    const showToast = (msg, type) => {
      const w = document.getElementById('toastWrap'), el = document.createElement('div');
      el.className = `toast t-${type}`;
      el.innerHTML = `<i class="mgc_${type==='ok'?'check_circle_line':'close_circle_line'}" style="color:${type==='ok'?'#16a34a':'var(--err)'}"></i><span>${msg}</span>`;
      w.appendChild(el);
      requestAnimationFrame(()=>requestAnimationFrame(()=>el.classList.add('show')));
      setTimeout(()=>{ el.classList.remove('show'); setTimeout(()=>el.remove(),350); }, 3500);
    };
    try {
      const res  = await fetch(BASE_URL, { method:'POST', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}, body:fd });
      let data = {};
      const ct = res.headers.get('content-type') || '';
      if (ct.includes('application/json')) {
        data = await res.json();
      } else {
        const txt = await res.text();
        showToast(`Server error (${res.status}) — check Laravel logs.`, 'err');
        console.error('Non-JSON response:', res.status, txt.substring(0, 500));
        return;
      }
      if (!res.ok || !data.success) {
        showToast(data.message || data.error || 'Something went wrong.', 'err');
        return;
      }
      if (mcFrom.has_gps && mcTo.has_gps) {
        L.polyline([[mcFrom.lat,mcFrom.lng],[mcTo.lat,mcTo.lng]], {
          color: '#3b82f6', weight: 3, opacity: .85
        }).addTo(map).bindTooltip(`${mcFrom.code} → ${mcTo.code}`, { sticky: true });
      }
      if (window._sitemapSpanSaved) window._sitemapSpanSaved(mcFrom.id, mcTo.id);
      $('mcSpanCount').textContent = parseInt($('mcSpanCount').textContent) + 1;

      if (window._addSpanRow) window._addSpanRow(data.span);
      mcCloseSheet();
      mcClear();
      showToast(`Span saved: ${mcFrom.code} → ${mcTo.code}`, 'ok');
    } catch(e) {
      showToast('Network error: ' + e.message, 'err');
      console.error('mcSaveSpan error:', e);
    } finally {
      btn.disabled = false; btn.innerHTML = '<i class="mgc_save_line"></i> Save Span';
    }
  };

  ['shLength','shRuns'].forEach(id => {
    $(id).addEventListener('input', () => {
      const l = parseFloat($('shLength').value)||0, r = parseInt($('shRuns').value)||0;
      if (!$('shCable').value) $('shCable').placeholder = `Auto: ${(l*r).toFixed(2)} m`;
    });
  });

  $('mcSheet').addEventListener('click', e => { if(e.target===$('mcSheet')) mcCloseSheet(); });

  let gpsMode = false;
  let gpsPole = null;
  let gpsPin  = null;
  let gpsPinnedLat = null, gpsPinnedLng = null;
  let gpsSearchTimer = null;

  const GPS_URL = '{{ url("/planner/poles") }}';

  function gpsToast(msg, type) {
    const w = document.getElementById('toastWrap'), el = document.createElement('div');
    el.className = `toast t-${type}`;
    el.innerHTML = `<i class="mgc_${type==='ok'?'check_circle_line':'close_circle_line'}" style="color:${type==='ok'?'#16a34a':'var(--err)'}"></i><span>${msg}</span>`;
    w.appendChild(el);
    requestAnimationFrame(() => requestAnimationFrame(() => el.classList.add('show')));
    setTimeout(() => { el.classList.remove('show'); setTimeout(() => el.remove(), 350); }, 3500);
  }

  window.enterGpsMode = function(pole) {
    gpsMode = true;
    gpsPole = pole;
    gpsPinnedLat = null;
    gpsPinnedLng = null;
    if (gpsPin) { map.removeLayer(gpsPin); gpsPin = null; }
    $('gpsPoleLabel').textContent = pole.code;
    $('gpsCoords').innerHTML = '<strong>Pinned Location</strong>Click on the map to pin coordinates.';
    $('gpsSaveBtn').disabled = true;
    $('gpsResults').innerHTML = '';
    $('gpsSearchInp').value = '';
    $('gpsPanel').style.display = '';
    mcCloseSheet();
  };

  window.exitGpsMode = function() {
    gpsMode = false;
    gpsPole = null;
    if (gpsPin) { map.removeLayer(gpsPin); gpsPin = null; }
    gpsPinnedLat = null;
    gpsPinnedLng = null;
    $('gpsPanel').style.display = 'none';
    $('gpsResults').innerHTML = '';
  };

  function setGpsPin(lat, lng) {
    if (gpsPin) map.removeLayer(gpsPin);
    gpsPinnedLat = lat;
    gpsPinnedLng = lng;
    gpsPin = L.marker([lat, lng], {
      icon: L.divIcon({
        className: '',
        html: `<div style="width:14px;height:14px;border-radius:50%;background:#3b82f6;border:2.5px solid #fff;box-shadow:0 2px 8px rgba(59,130,246,.45);"></div>`,
        iconSize: [14, 14],
        iconAnchor: [7, 7],
      })
    }).addTo(map);
    $('gpsCoords').innerHTML = `<strong>Pinned Location</strong>Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`;
    $('gpsSaveBtn').disabled = false;
  }

  map.on('click', e => {
    if (!gpsMode) return;
    setGpsPin(e.latlng.lat, e.latlng.lng);
  });

  $('gpsSearchInp').addEventListener('input', function() {
    clearTimeout(gpsSearchTimer);
    const q = this.value.trim();
    if (q.length < 3) { $('gpsResults').innerHTML = ''; return; }
    gpsSearchTimer = setTimeout(async () => {
      try {
        const res = await fetch(
          `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(q)}&limit=5`,
          { headers: { 'Accept-Language': 'en' } }
        );
        const data = await res.json();
        $('gpsResults').innerHTML = data.length
          ? data.map(r => `<div class="gps-result-item" data-lat="${r.lat}" data-lng="${r.lon}">${r.display_name}</div>`).join('')
          : `<div class="gps-result-item" style="cursor:default;color:var(--muted);">No results found.</div>`;
      } catch { $('gpsResults').innerHTML = ''; }
    }, 500);
  });

  $('gpsResults').addEventListener('click', e => {
    const item = e.target.closest('.gps-result-item');
    if (!item || !item.dataset.lat) return;
    const lat = parseFloat(item.dataset.lat), lng = parseFloat(item.dataset.lng);
    map.setView([lat, lng], 17);
    setGpsPin(lat, lng);
    $('gpsResults').innerHTML = '';
    $('gpsSearchInp').value = '';
  });

  $('gpsSaveBtn').addEventListener('click', async function() {
    if (!gpsPole || gpsPinnedLat === null) return;
    this.disabled = true;
    this.innerHTML = '<i class="mgc_loading_4_line"></i> Saving…';
    const fd = new FormData();
    fd.append('map_latitude',  gpsPinnedLat);
    fd.append('map_longitude', gpsPinnedLng);
    try {
      const res = await fetch(`${GPS_URL}/${gpsPole.id}/gps`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
        body: fd,
      });
      const data = await res.json();
      if (!res.ok || !data.success) { gpsToast(data.message || 'Failed to save GPS.', 'err'); return; }

      const savedPole = gpsPole;
      const m = L.circleMarker([gpsPinnedLat, gpsPinnedLng], {
        radius: 9, fillColor: '#22c55e', fillOpacity: .9, color: '#fff', weight: 2.5
      }).addTo(map);
      m.bindTooltip(`<b>${savedPole.code}</b>`, { direction: 'top' });
      m.on('click', () => { if (gpsMode) return; mcSelectPole(savedPole, m); });
      poleMarkers[savedPole.id] = { marker: m, pole: savedPole };

      savedPole.lat     = gpsPinnedLat;
      savedPole.lng     = gpsPinnedLng;
      savedPole.has_gps = true;

      const dot = document.getElementById(`gpsDot_${savedPole.id}`);
      if (dot) dot.style.background = '#22c55e';
      const setBtn = $('mcAllPolesList').querySelector(`.btn-set-gps[data-id="${savedPole.id}"]`);
      if (setBtn) setBtn.textContent = 'Edit GPS';

      gpsToast(`GPS saved for ${savedPole.code} ✓`, 'ok');
      exitGpsMode();
    } catch(e) {
      gpsToast('Network error: ' + e.message, 'err');
    } finally {
      this.disabled = false;
      this.innerHTML = '<i class="mgc_save_line"></i> Save GPS';
    }
  });

  $('gpsCancelBtn').addEventListener('click', exitGpsMode);
  $('gpsCancelBtn2').addEventListener('click', exitGpsMode);
})();
</script>

<script>
(function(){
  const MAP_POLES = @json($mapPolesData);
  const MAP_SPANS = @json($mapSpansData);
  const $ = id => document.getElementById(id);

  const canvas = $('sitemapCanvas');
  const ctx    = canvas.getContext('2d');

  const sPoles = MAP_POLES.filter(p => p.sx || p.sy);

  function activateTab(tab) {
    const isSitemap = tab === 'sitemap';
    $('tabSitemap').classList.toggle('active', isSitemap);
    $('tabGps').classList.toggle('active', !isSitemap);
    canvas.style.display = isSitemap ? 'block' : 'none';
    $('mcMap').style.display = isSitemap ? 'none' : '';
    if (!isSitemap) {
      setTimeout(() => { if (window._leafletMap) window._leafletMap.invalidateSize(); }, 80);
    } else {
      resize();
    }
  }
  $('tabSitemap').addEventListener('click', () => activateTab('sitemap'));
  $('tabGps').addEventListener('click',     () => activateTab('gps'));

  let _t = { scale: 1, originX: 0, originY: 0 };

  function computeFit() {
    if (!sPoles.length) return;
    const W = canvas.width, H = canvas.height;
    const xs = sPoles.map(p => p.sx), ys = sPoles.map(p => p.sy);
    const minX = Math.min(...xs), maxX = Math.max(...xs);
    const minY = Math.min(...ys), maxY = Math.max(...ys);
    const dW = (maxX - minX) || 1, dH = (maxY - minY) || 1;
    const pad = 72;
    const scale = Math.min((W - pad * 2) / dW, (H - pad * 2) / dH);
    const cX = (minX + maxX) / 2, cY = (minY + maxY) / 2;
    _t = { scale, originX: W / 2 - cX * scale, originY: H / 2 + cY * scale };
  }

  function toC(sx, sy) {
    return { x: _t.originX + sx * _t.scale, y: _t.originY - sy * _t.scale };
  }

  let hovId = null, fromId = null, toId = null;
  let savedSpanLines = [];

  function draw() {
    const W = canvas.width, H = canvas.height;
    ctx.clearRect(0, 0, W, H);

    const isDark = document.documentElement.classList.contains('dark');
    ctx.fillStyle = isDark ? '#080f1b' : '#eef2f7';
    ctx.fillRect(0, 0, W, H);

    if (!sPoles.length) {
      ctx.fillStyle = '#94a3b8';
      ctx.font = '600 13px DM Sans,sans-serif';
      ctx.textAlign = 'center';
      ctx.textBaseline = 'middle';
      ctx.fillText('No sitemap (X/Y) coordinates assigned to poles.', W / 2, H / 2 - 11);
      ctx.font = '500 11px DM Sans,sans-serif';
      ctx.fillStyle = '#cbd5e1';
      ctx.fillText('Upload a DXF via the Site Map Reader to set sitemap_x / sitemap_y.', W / 2, H / 2 + 13);
      return;
    }

    ctx.save();
    ctx.setLineDash([5, 3]);
    ctx.strokeStyle = '#94a3b8';
    ctx.lineWidth = 1.5;
    MAP_SPANS.forEach(s => {
      const fp = MAP_POLES.find(p => p.id === s.from_pole_id);
      const tp = MAP_POLES.find(p => p.id === s.to_pole_id);
      if (!fp || !tp || !(fp.sx || fp.sy) || !(tp.sx || tp.sy)) return;
      const fc = toC(fp.sx, fp.sy), tc = toC(tp.sx, tp.sy);
      ctx.beginPath(); ctx.moveTo(fc.x, fc.y); ctx.lineTo(tc.x, tc.y); ctx.stroke();
    });
    ctx.restore();

    ctx.save();
    ctx.setLineDash([]);
    ctx.strokeStyle = '#3b82f6';
    ctx.lineWidth = 2.5;
    savedSpanLines.forEach(s => {
      const fp = MAP_POLES.find(p => p.id === s.from);
      const tp = MAP_POLES.find(p => p.id === s.to);
      if (!fp || !tp) return;
      const fc = toC(fp.sx, fp.sy), tc = toC(tp.sx, tp.sy);
      ctx.beginPath(); ctx.moveTo(fc.x, fc.y); ctx.lineTo(tc.x, tc.y); ctx.stroke();
    });
    ctx.restore();

    if (fromId && toId) {
      const fp = MAP_POLES.find(p => p.id === fromId), tp = MAP_POLES.find(p => p.id === toId);
      if (fp && tp) {
        ctx.save();
        ctx.setLineDash([6, 4]);
        ctx.strokeStyle = '#facc15'; ctx.lineWidth = 2;
        const fc = toC(fp.sx, fp.sy), tc = toC(tp.sx, tp.sy);
        ctx.beginPath(); ctx.moveTo(fc.x, fc.y); ctx.lineTo(tc.x, tc.y); ctx.stroke();
        ctx.restore();
      }
    }

    sPoles.forEach(p => {
      const { x, y } = toC(p.sx, p.sy);
      const r = Math.max(4.5, Math.min(9.5, _t.scale * 0.9));
      let fill = p.has_gps ? '#22c55e' : '#f59e0b';
      if      (p.id === fromId) fill = '#2563eb';
      else if (p.id === toId)   fill = '#f97316';
      else if (p.id === hovId)  fill = '#8b5cf6';

      ctx.save();
      if (p.id === hovId || p.id === fromId || p.id === toId) {
        ctx.shadowColor = fill; ctx.shadowBlur = 10;
      }
      ctx.beginPath(); ctx.arc(x, y, r, 0, Math.PI * 2);
      ctx.fillStyle = fill; ctx.fill();
      ctx.strokeStyle = '#fff'; ctx.lineWidth = 1.8; ctx.stroke();
      ctx.restore();

      if (_t.scale > 0.25) {
        const fs = Math.min(11, Math.max(7, _t.scale * 1.4));
        ctx.font = `700 ${fs}px DM Mono,monospace`;
        ctx.fillStyle = isDark ? '#e2e8f0' : '#0f172a';
        ctx.textAlign = 'center'; ctx.textBaseline = 'bottom';
        ctx.fillText(p.code, x, y - r - 3);
      }
    });
  }

  function nearestPole(mx, my) {
    let nearest = null, best = Infinity;
    sPoles.forEach(p => {
      const { x, y } = toC(p.sx, p.sy);
      const d = Math.hypot(mx - x, my - y);
      if (d < best) { best = d; nearest = p; }
    });
    return best < 18 ? nearest : null;
  }

  let panStart = null, panOrigin = null, isDragging = false;

  canvas.addEventListener('mousedown', e => {
    if (e.button !== 0) return;
    panStart  = { x: e.clientX, y: e.clientY };
    panOrigin = { originX: _t.originX, originY: _t.originY };
    isDragging = false;
    canvas.style.cursor = 'grabbing';
  });

  canvas.addEventListener('mousemove', e => {
    const rect = canvas.getBoundingClientRect();
    const mx = e.clientX - rect.left, my = e.clientY - rect.top;

    if (panStart) {
      const dx = e.clientX - panStart.x, dy = e.clientY - panStart.y;
      if (!isDragging && (Math.abs(dx) > 3 || Math.abs(dy) > 3)) isDragging = true;
      if (isDragging) {
        _t.originX = panOrigin.originX + dx;
        _t.originY = panOrigin.originY + dy;
        draw(); return;
      }
    }

    const hov = nearestPole(mx, my);
    const newHovId = hov ? hov.id : null;
    if (newHovId !== hovId) {
      hovId = newHovId;
      canvas.style.cursor = hovId ? 'pointer' : 'grab';
      draw();
    }
  });

  canvas.addEventListener('mouseup', e => {
    const wasDrag = isDragging;
    panStart = null; isDragging = false;
    canvas.style.cursor = hovId ? 'pointer' : 'grab';
    if (e.button !== 0 || wasDrag) return;

    const pole = sPoles.find(p => p.id === hovId);
    if (!pole) return;

    if (!fromId) {
      fromId = pole.id;
      if (window._leafletBridge) window._leafletBridge.setMcFrom(pole);
      draw();
    } else if (!toId && pole.id !== fromId) {
      toId = pole.id;
      if (window._leafletBridge) window._leafletBridge.setMcTo(pole);
      draw();
      openSheet(fromId, toId);
    }
  });

  canvas.addEventListener('wheel', e => {
    e.preventDefault();
    const rect = canvas.getBoundingClientRect();
    const mx = e.clientX - rect.left, my = e.clientY - rect.top;
    const f = e.deltaY < 0 ? 1.13 : 1 / 1.13;
    _t.originX = mx - (mx - _t.originX) * f;
    _t.originY = my + (_t.originY - my) * f;
    _t.scale  *= f;
    draw();
  }, { passive: false });

  canvas.addEventListener('mouseleave', () => {
    panStart = null; isDragging = false;
    if (hovId !== null) { hovId = null; draw(); }
  });

  function openSheet(fid, tid) {
    const fp = MAP_POLES.find(p => p.id === fid), tp = MAP_POLES.find(p => p.id === tid);
    if (!fp || !tp) return;
    const dx = fp.sx - tp.sx, dy = fp.sy - tp.sy;
    const dist = Math.round(Math.sqrt(dx * dx + dy * dy));
    $('shFromLabel').textContent = fp.code;
    $('shToLabel').textContent   = tp.code;
    $('shDist').textContent      = `~${dist} units`;
    $('shLength').value          = '';
    $('shRuns').value            = 1;
    $('shCable').value           = '';
    ['shNode','shAmp','shExt','shTsc'].forEach(id => $(id).value = 0);
    $('mcSheet').classList.add('open');
  }

  window._sitemapSpanSaved = function(fromPoleId, toPoleId) {
    savedSpanLines.push({ from: fromPoleId, to: toPoleId });
    draw();
  };

  window._sitemapClear = function() {
    fromId = null; toId = null;
    draw();
  };

  function resize() {
    const rect = canvas.getBoundingClientRect();
    if (!rect.width || !rect.height) return;
    canvas.width  = rect.width;
    canvas.height = rect.height;
    computeFit();
    draw();
  }

  const ro = new ResizeObserver(() => { if (canvas.style.display !== 'none') resize(); });
  ro.observe(canvas.parentElement || canvas);
  setTimeout(resize, 60);
})();
</script>
@endpush

</x-layout>