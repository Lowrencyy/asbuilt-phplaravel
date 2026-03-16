<x-layout>

@push('title')Spans — {{ $node->node_id }}@endpush

@push('styles')
<style>
*,*::before,*::after{box-sizing:border-box;}
:root{
  --p:#3b82f6;--p2:#2563eb;--pg:rgba(59,130,246,.12);
  --ok:#22c55e;--warn:#f59e0b;--err:#ef4444;--s:#8b5cf6;
  --bg:#f0f4f9;--surf:#fff;--surf2:#f7f9fc;
  --bdr:#e2e8f0;--bdr2:#cbd5e1;
  --txt:#0f172a;--txt2:#475569;--txt3:#64748b;--muted:#94a3b8;
  --r:14px;--r-sm:8px;
  --sh:0 1px 2px rgba(15,23,42,.04),0 4px 16px rgba(15,23,42,.05);
  --sh-lg:0 12px 48px rgba(15,23,42,.16);
  --ff:'DM Sans',sans-serif;--fm:'DM Mono',monospace;
}
.dark{--bg:#070f1e;--surf:#0f172a;--surf2:#111827;--bdr:#1e2d45;--bdr2:#263954;--txt:#e2e8f0;--txt2:#94a3b8;--txt3:#64748b;--muted:#3f5471;}
body{font-family:var(--ff);background:var(--bg);color:var(--txt);}
.page-content{background:var(--bg);}
/* header */
.ph{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;margin-bottom:1.25rem;}
.ph h2{font-size:1.15rem;font-weight:900;color:var(--txt);display:flex;align-items:center;gap:.5rem;margin:0;}
.ph p{font-size:.76rem;color:var(--txt3);margin:.14rem 0 0;}
.h-ico{display:inline-flex;align-items:center;justify-content:center;height:34px;width:34px;border-radius:10px;background:var(--pg);color:var(--p);font-size:.95rem;flex-shrink:0;}
/* stat cards */
.sg{display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:.85rem;margin:0 0 1.25rem;}
.sc{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);padding:1rem 1.1rem;display:flex;align-items:flex-start;gap:.75rem;}
.si{height:38px;width:38px;border-radius:10px;flex-shrink:0;display:inline-flex;align-items:center;justify-content:center;font-size:1rem;}
.sv{font-size:1.3rem;font-weight:900;color:var(--txt);line-height:1.1;font-family:var(--fm);}
.sl{font-size:.63rem;font-weight:700;color:var(--txt3);text-transform:uppercase;letter-spacing:.07em;margin-top:.2rem;}
/* table card */
.tv-card{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;}
.frow{display:flex;flex-wrap:wrap;gap:.5rem;align-items:center;padding:.85rem 1.1rem;border-bottom:1px solid var(--bdr);}
.fi-wrap{position:relative;}
.fi-ico{position:absolute;left:.65rem;top:50%;transform:translateY(-50%);color:var(--muted);font-size:.8rem;pointer-events:none;}
.fi{height:34px;padding:0 .7rem 0 2.1rem;border:1px solid var(--bdr);border-radius:var(--r-sm);background:var(--surf2);color:var(--txt);font-size:.8rem;font-family:var(--ff);outline:none;min-width:200px;}
.fi:focus{border-color:var(--p);}
.cpill{display:inline-flex;align-items:center;gap:.3rem;font-size:.72rem;color:var(--txt3);font-weight:600;background:var(--surf2);border:1px solid var(--bdr);padding:.22rem .7rem;border-radius:999px;}
.cpill strong{color:var(--p);font-family:var(--fm);font-weight:900;}
.table-wrap{max-height:calc(100vh - 360px);overflow:auto;scrollbar-width:thin;scrollbar-color:var(--bdr2) transparent;}
.table-wrap::-webkit-scrollbar{width:5px;height:5px;}
.table-wrap::-webkit-scrollbar-thumb{background:var(--bdr2);border-radius:99px;}
table{width:100%;border-collapse:separate;border-spacing:0;font-size:.79rem;min-width:900px;}
thead th{position:sticky;top:0;z-index:5;background:var(--surf2);border-bottom:2px solid var(--bdr);padding:0 12px;height:36px;text-align:left;white-space:nowrap;font-size:.6rem;font-weight:800;color:var(--txt3);letter-spacing:.07em;text-transform:uppercase;}
th.tc,td.tc{text-align:center;}
tbody tr:hover td{background:rgba(59,130,246,.03);}
tbody td{padding:0 12px;height:46px;border-bottom:1px solid var(--bdr);vertical-align:middle;}
tbody tr:last-child td{border-bottom:none;}
.pole-pair{display:flex;align-items:center;gap:.35rem;font-family:var(--fm);font-size:.75rem;font-weight:900;color:var(--p);}
.arr{color:var(--muted);font-size:.7rem;}
.c-num{font-family:var(--fm);font-size:.77rem;font-weight:700;color:var(--txt2);}
.coll-cell{font-size:.72rem;color:var(--txt3);}
.coll-item{display:inline-flex;align-items:center;gap:.18rem;margin-right:.3rem;}
.sbadge{display:inline-flex;align-items:center;gap:.2rem;font-size:.62rem;font-weight:800;padding:.16rem .5rem;border-radius:999px;white-space:nowrap;}
.s-pending{background:rgba(148,163,184,.12);color:var(--txt3);border:1px solid var(--bdr);}
.s-in_progress{background:rgba(245,158,11,.1);color:#92400e;border:1px solid rgba(245,158,11,.25);}
.s-completed{background:rgba(34,197,94,.1);color:#166534;border:1px solid rgba(34,197,94,.22);}
.s-blocked{background:rgba(239,68,68,.1);color:#991b1b;border:1px solid rgba(239,68,68,.2);}
.ar{display:flex;gap:.3rem;justify-content:center;}
.ab{display:inline-flex;align-items:center;justify-content:center;height:28px;width:28px;border-radius:50%;border:1px solid var(--bdr);background:var(--surf);cursor:pointer;font-size:.78rem;color:var(--txt2);transition:all .15s;}
.ab:hover{transform:scale(1.1);}
.ab-e:hover{background:rgba(59,130,246,.1);border-color:rgba(59,130,246,.35);color:var(--p);}
.ab-d:hover{background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.35);color:var(--err);}
.empty-st{text-align:center;padding:3rem 1rem;color:var(--muted);font-size:.83rem;}
.empty-st i{font-size:2rem;display:block;margin-bottom:.6rem;}
/* buttons */
.btn-p{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1rem;background:var(--p);color:#fff;border:none;border-radius:var(--r-sm);font-size:.81rem;font-weight:900;font-family:var(--ff);cursor:pointer;box-shadow:0 2px 8px rgba(59,130,246,.28);transition:all .15s;}
.btn-p:hover{background:var(--p2);transform:translateY(-1px);}
/* modal overlay */
#spanOv{position:fixed;inset:0;z-index:900;background:rgba(7,15,30,.65);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .22s;}
#spanOv.open{opacity:1;pointer-events:all;}
#smc{background:var(--surf);border:1px solid var(--bdr);border-radius:18px;box-shadow:var(--sh-lg);width:100%;max-width:640px;max-height:calc(100vh - 2rem);display:flex;flex-direction:column;transform:translateY(20px) scale(.97);opacity:0;transition:transform .28s cubic-bezier(.34,1.18,.64,1),opacity .22s;}
#spanOv.open #smc{transform:translateY(0) scale(1);opacity:1;}
.mhd{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.2rem;border-bottom:1px solid var(--bdr);gap:.7rem;}
.mico{height:38px;width:38px;border-radius:9px;flex-shrink:0;background:var(--pg);display:inline-flex;align-items:center;justify-content:center;color:var(--p);font-size:1rem;}
.mt{font-size:.98rem;font-weight:900;color:var(--txt);}
.ms{font-size:.7rem;color:var(--txt3);margin-top:.1rem;}
.mb{padding:1.15rem;overflow-y:auto;flex:1;display:flex;flex-direction:column;gap:.85rem;}
.mc{height:30px;width:30px;border-radius:7px;border:1px solid var(--bdr);background:var(--surf2);display:inline-flex;align-items:center;justify-content:center;color:var(--txt2);font-size:.95rem;cursor:pointer;transition:all .15s;}
.mc:hover{background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.3);color:var(--err);}
.mft{padding:.85rem 1.2rem;border-top:1px solid var(--bdr);display:flex;justify-content:flex-end;gap:.6rem;}
.btn-c{padding:.42rem .9rem;border-radius:var(--r-sm);border:1px solid var(--bdr);background:var(--surf2);color:var(--txt2);font-size:.8rem;font-weight:800;font-family:var(--ff);cursor:pointer;}
.btn-s{padding:.42rem 1.1rem;border-radius:var(--r-sm);border:none;background:var(--p);color:#fff;font-size:.8rem;font-weight:900;font-family:var(--ff);cursor:pointer;box-shadow:0 2px 8px rgba(59,130,246,.3);display:inline-flex;align-items:center;gap:.35rem;}
.btn-s:hover{background:var(--p2);}
.fg{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;}
.fg .c2{grid-column:span 2;}
@media(max-width:520px){.fg{grid-template-columns:1fr;}.fg .c2{grid-column:span 1;}}
.lbl{display:block;font-size:.72rem;font-weight:900;color:var(--txt2);letter-spacing:.02em;margin-bottom:.3rem;}
.lbl span{color:var(--err);}
.inp{width:100%;padding:.45rem .68rem;border:1px solid var(--bdr);border-radius:var(--r-sm);background:var(--surf);color:var(--txt);font-size:.82rem;font-family:var(--ff);outline:none;transition:border-color .15s,box-shadow .15s;}
.inp:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(59,130,246,.1);}
.inp::placeholder{color:var(--muted);}
.inp-e{border-color:rgba(239,68,68,.6)!important;box-shadow:0 0 0 3px rgba(239,68,68,.1)!important;}
.secdiv{font-size:.68rem;font-weight:900;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);padding:.1rem 0 .4rem;border-bottom:1px solid var(--bdr);grid-column:span 2;margin-top:.3rem;}
.hint{font-size:.68rem;color:var(--muted);margin-top:.2rem;}
/* delete modal */
#delOv{position:fixed;inset:0;z-index:950;background:rgba(7,15,30,.7);backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .2s;}
#delOv.open{opacity:1;pointer-events:all;}
#delCard{background:var(--surf);border:1px solid var(--bdr);border-radius:16px;box-shadow:var(--sh-lg);max-width:360px;width:100%;padding:1.4rem;transform:scale(.95);opacity:0;transition:transform .22s cubic-bezier(.34,1.18,.64,1),opacity .2s;}
#delOv.open #delCard{transform:scale(1);opacity:1;}
.delib{height:44px;width:44px;border-radius:10px;background:rgba(239,68,68,.1);display:inline-flex;align-items:center;justify-content:center;color:var(--err);font-size:1.15rem;margin-bottom:.8rem;}
.btn-del{padding:.42rem 1rem;border-radius:var(--r-sm);border:none;background:var(--err);color:#fff;font-size:.8rem;font-weight:900;font-family:var(--ff);cursor:pointer;}
/* toast */
.toast-wrap{position:fixed;bottom:1.5rem;right:1.5rem;z-index:9999;display:flex;flex-direction:column;gap:.5rem;pointer-events:none;}
.toast{display:flex;align-items:center;gap:.6rem;padding:.65rem 1rem;border-radius:10px;background:var(--surf);border:1px solid var(--bdr);box-shadow:var(--sh-lg);font-size:.8rem;font-weight:700;color:var(--txt);min-width:240px;transform:translateX(120%);opacity:0;transition:transform .3s cubic-bezier(.34,1.3,.64,1),opacity .25s;pointer-events:all;}
.toast.show{transform:translateX(0);opacity:1;}
.toast.t-ok{border-color:rgba(34,197,94,.25);background:#f0fdf4;}
.toast.t-err{border-color:rgba(239,68,68,.25);background:#fef2f2;}
</style>
@endpush

<div class="col-span-full">

  {{-- PAGE HEADER --}}
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

  {{-- STAT CARDS --}}
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

  {{-- TABLE --}}
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

{{-- ADD / EDIT MODAL --}}
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
        {{-- Pole pair --}}
        <div class="secdiv">Pole Connection</div>
        <div>
          <label class="lbl" for="fFromPole">From Pole <span>*</span></label>
          <select id="fFromPole" class="inp">
            @foreach($poles as $pole)
              <option value="{{ $pole->id }}">{{ $pole->pole_code }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="lbl" for="fToPole">To Pole <span>*</span></label>
          <select id="fToPole" class="inp">
            @foreach($poles as $pole)
              <option value="{{ $pole->id }}">{{ $pole->pole_code }}</option>
            @endforeach
          </select>
        </div>
        {{-- Cable --}}
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
        {{-- Collectibles --}}
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
        {{-- Status --}}
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

{{-- DELETE MODAL --}}
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
    const list=rows.filter(s=>!q||s.from_pole_code.toLowerCase().includes(q)||s.to_pole_code.toLowerCase().includes(q));
    renderStats(list);
    $('showCount').textContent=list.length;

    if(!list.length){
      $('spanTbody').innerHTML=`<tr><td colspan="11"><div class="empty-st"><i class="mgc_git_branch_line"></i>No spans declared yet. Click "Declare Span" to get started.</div></td></tr>`;
      return;
    }

    $('spanTbody').innerHTML=list.map((s,i)=>`<tr>
      <td style="color:var(--muted);font-size:.67rem;font-family:var(--fm)">${i+1}</td>
      <td><div class="pole-pair"><span>${s.from_pole_code}</span><span class="arr">→</span><span>${s.to_pole_code}</span></div></td>
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

  // Auto-calc expected cable
  function recalcCable(){
    if(cableUserEdited) return;
    const l=parseFloat($('fLength').value)||0;
    const r=parseInt($('fRuns').value)||0;
    const total=l*r;
    $('fExpCable').value=total>0?total.toFixed(2):'';
  }

  function openModal(){$('spanOv').classList.add('open');document.body.style.overflow='hidden';}
  function closeModal(){$('spanOv').classList.remove('open');document.body.style.overflow='';cableUserEdited=false;}
  function openDel(id){
    const s=rows.find(x=>x.id==id);if(!s)return;
    pendingDelId=id;
    $('delMsg').textContent=`Delete span "${s.from_pole_code} → ${s.to_pole_code}"? This cannot be undone.`;
    $('delOv').classList.add('open');document.body.style.overflow='hidden';
  }
  function closeDel(){$('delOv').classList.remove('open');document.body.style.overflow='';pendingDelId=null;}

  function resetForm(){
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
    cableUserEdited=true; // don't override user's existing value
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
      const data=await res.json();
      if(!res.ok||!data.success){toast(data.message||'Something went wrong.','err');return;}
      if(editId){const idx=rows.findIndex(x=>x.id==editId);if(idx>=0)rows[idx]=data.span;}
      else rows.unshift(data.span);
      closeModal();renderTable();toast(editId?'Span updated.':'Span declared.');
    }catch(e){toast('Network error.','err');}
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
})();
</script>
@endpush

</x-layout>
