<x-layout>

@push('title')Poles — {{ $node->node_id }}@endpush

@push('styles')
<style>
*,*::before,*::after{box-sizing:border-box;}
:root{
  --p:#3b82f6;--p2:#2563eb;--pg:rgba(59,130,246,.12);--pg2:rgba(59,130,246,.06);
  --ok:#22c55e;--err:#ef4444;
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
.ph{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;margin-bottom:1.25rem;}
.ph h2{font-size:1.15rem;font-weight:900;color:var(--txt);display:flex;align-items:center;gap:.5rem;margin:0;}
.ph p{font-size:.76rem;color:var(--txt3);margin:.14rem 0 0;}
.h-ico{display:inline-flex;align-items:center;justify-content:center;height:34px;width:34px;border-radius:10px;background:var(--pg);color:var(--p);font-size:.95rem;flex-shrink:0;}
.sg{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:.85rem;margin:0 0 1.25rem;}
.sc{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);padding:1rem 1.1rem;display:flex;align-items:flex-start;gap:.75rem;}
.si{height:38px;width:38px;border-radius:10px;flex-shrink:0;display:inline-flex;align-items:center;justify-content:center;font-size:1rem;}
.sv{font-size:1.3rem;font-weight:900;color:var(--txt);line-height:1.1;font-family:var(--fm);}
.sl{font-size:.63rem;font-weight:700;color:var(--txt3);text-transform:uppercase;letter-spacing:.07em;margin-top:.2rem;}
.tv-card{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;}
.frow{display:flex;flex-wrap:wrap;gap:.5rem;align-items:center;padding:.85rem 1.1rem;border-bottom:1px solid var(--bdr);}
.fi-wrap{position:relative;}
.fi-ico{position:absolute;left:.65rem;top:50%;transform:translateY(-50%);color:var(--muted);font-size:.8rem;pointer-events:none;}
.fi{height:34px;padding:0 .7rem 0 2.1rem;border:1px solid var(--bdr);border-radius:var(--r-sm);background:var(--surf2);color:var(--txt);font-size:.8rem;font-family:var(--ff);outline:none;min-width:210px;}
.fi:focus{border-color:var(--p);}
.cpill{display:inline-flex;align-items:center;gap:.3rem;font-size:.72rem;color:var(--txt3);font-weight:600;background:var(--surf2);border:1px solid var(--bdr);padding:.22rem .7rem;border-radius:999px;}
.cpill strong{color:var(--p);font-family:var(--fm);font-weight:900;}
.table-wrap{max-height:calc(100vh - 370px);overflow:auto;scrollbar-width:thin;scrollbar-color:var(--bdr2) transparent;}
table{width:100%;border-collapse:separate;border-spacing:0;font-size:.8rem;min-width:680px;}
thead th{position:sticky;top:0;z-index:5;background:var(--surf2);border-bottom:2px solid var(--bdr);padding:0 13px;height:36px;text-align:left;white-space:nowrap;font-size:.61rem;font-weight:800;color:var(--txt3);letter-spacing:.07em;text-transform:uppercase;}
th.tc,td.tc{text-align:center;}
tbody tr:hover td{background:rgba(59,130,246,.03);}
tbody td{padding:0 13px;height:46px;border-bottom:1px solid var(--bdr);vertical-align:middle;}
tbody tr:last-child td{border-bottom:none;}
.pole-code{font-family:var(--fm);font-size:.78rem;font-weight:900;color:var(--p);}
.c-muted{font-size:.75rem;color:var(--txt2);}
.c-mono{font-family:var(--fm);font-size:.71rem;color:var(--txt3);}
.remarks-cell{max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-size:.75rem;color:var(--txt2);}
.sbadge{display:inline-flex;align-items:center;gap:.2rem;font-size:.62rem;font-weight:800;padding:.16rem .5rem;border-radius:999px;white-space:nowrap;}
.s-pending{background:rgba(148,163,184,.12);color:var(--txt3);border:1px solid var(--bdr);}
.s-completed{background:rgba(34,197,94,.1);color:#166534;border:1px solid rgba(34,197,94,.22);}
.ar{display:flex;gap:.3rem;justify-content:center;}
.ab{display:inline-flex;align-items:center;justify-content:center;height:28px;width:28px;border-radius:50%;border:1px solid var(--bdr);background:var(--surf);cursor:pointer;font-size:.78rem;color:var(--txt2);transition:all .15s;}
.ab:hover{transform:scale(1.1);}
.ab-e:hover{background:rgba(59,130,246,.1);border-color:rgba(59,130,246,.35);color:var(--p);}
.ab-d:hover{background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.35);color:var(--err);}
.empty-st{text-align:center;padding:3rem 1rem;color:var(--muted);font-size:.83rem;}
.empty-st i{font-size:2rem;display:block;margin-bottom:.6rem;}
.btn-p{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1rem;background:var(--p);color:#fff;border:none;border-radius:var(--r-sm);font-size:.81rem;font-weight:900;font-family:var(--ff);cursor:pointer;box-shadow:0 2px 8px rgba(59,130,246,.28);transition:all .15s;}
.btn-p:hover{background:var(--p2);transform:translateY(-1px);}
#poleOv{position:fixed;inset:0;z-index:900;background:rgba(7,15,30,.65);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .22s;}
#poleOv.open{opacity:1;pointer-events:all;}
#pmc{background:var(--surf);border:1px solid var(--bdr);border-radius:18px;box-shadow:var(--sh-lg);width:100%;max-width:460px;display:flex;flex-direction:column;transform:translateY(20px) scale(.97);opacity:0;transition:transform .28s cubic-bezier(.34,1.18,.64,1),opacity .22s;}
#poleOv.open #pmc{transform:translateY(0) scale(1);opacity:1;}
.mhd{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.2rem;border-bottom:1px solid var(--bdr);gap:.7rem;}
.mico{height:38px;width:38px;border-radius:9px;flex-shrink:0;background:var(--pg);display:inline-flex;align-items:center;justify-content:center;color:var(--p);font-size:1rem;}
.mt{font-size:.98rem;font-weight:900;color:var(--txt);}
.ms{font-size:.7rem;color:var(--txt3);margin-top:.1rem;}
.mb{padding:1.15rem;display:flex;flex-direction:column;gap:.9rem;}
.mc{height:30px;width:30px;border-radius:7px;border:1px solid var(--bdr);background:var(--surf2);display:inline-flex;align-items:center;justify-content:center;color:var(--txt2);font-size:.95rem;cursor:pointer;transition:all .15s;}
.mc:hover{background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.3);color:var(--err);}
.mft{padding:.85rem 1.2rem;border-top:1px solid var(--bdr);display:flex;justify-content:flex-end;gap:.6rem;}
.btn-c{padding:.42rem .9rem;border-radius:var(--r-sm);border:1px solid var(--bdr);background:var(--surf2);color:var(--txt2);font-size:.8rem;font-weight:800;font-family:var(--ff);cursor:pointer;}
.btn-s{padding:.42rem 1.1rem;border-radius:var(--r-sm);border:none;background:var(--p);color:#fff;font-size:.8rem;font-weight:900;font-family:var(--ff);cursor:pointer;box-shadow:0 2px 8px rgba(59,130,246,.3);display:inline-flex;align-items:center;gap:.35rem;}
.btn-s:hover{background:var(--p2);}
.lbl{display:block;font-size:.72rem;font-weight:900;color:var(--txt2);letter-spacing:.02em;margin-bottom:.3rem;}
.lbl span{color:var(--err);}
.inp{width:100%;padding:.45rem .68rem;border:1px solid var(--bdr);border-radius:var(--r-sm);background:var(--surf);color:var(--txt);font-size:.82rem;font-family:var(--ff);outline:none;transition:border-color .15s,box-shadow .15s;}
.inp:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(59,130,246,.1);}
.inp::placeholder{color:var(--muted);}
.inp-e{border-color:rgba(239,68,68,.6)!important;box-shadow:0 0 0 3px rgba(239,68,68,.1)!important;}
#delOv{position:fixed;inset:0;z-index:950;background:rgba(7,15,30,.7);backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .2s;}
#delOv.open{opacity:1;pointer-events:all;}
#delCard{background:var(--surf);border:1px solid var(--bdr);border-radius:16px;box-shadow:var(--sh-lg);max-width:360px;width:100%;padding:1.4rem;transform:scale(.95);opacity:0;transition:transform .22s cubic-bezier(.34,1.18,.64,1),opacity .2s;}
#delOv.open #delCard{transform:scale(1);opacity:1;}
.delib{height:44px;width:44px;border-radius:10px;background:rgba(239,68,68,.1);display:inline-flex;align-items:center;justify-content:center;color:var(--err);font-size:1.15rem;margin-bottom:.8rem;}
.btn-del{padding:.42rem 1rem;border-radius:var(--r-sm);border:none;background:var(--err);color:#fff;font-size:.8rem;font-weight:900;font-family:var(--ff);cursor:pointer;}
.toast-wrap{position:fixed;bottom:1.5rem;right:1.5rem;z-index:9999;display:flex;flex-direction:column;gap:.5rem;pointer-events:none;}
.toast{display:flex;align-items:center;gap:.6rem;padding:.65rem 1rem;border-radius:10px;background:var(--surf);border:1px solid var(--bdr);box-shadow:var(--sh-lg);font-size:.8rem;font-weight:700;color:var(--txt);min-width:240px;transform:translateX(120%);opacity:0;transition:transform .3s cubic-bezier(.34,1.3,.64,1),opacity .25s;pointer-events:all;}
.toast.show{transform:translateX(0);opacity:1;}
.toast.t-ok{border-color:rgba(34,197,94,.25);background:#f0fdf4;}
.toast.t-err{border-color:rgba(239,68,68,.25);background:#fef2f2;}
</style>
@endpush

<div class="col-span-full">

  <div class="ph">
    <div>
      <h2><div class="h-ico"><i class="mgc_map_pin_line"></i></div> Poles</h2>
      <p>
        Node: <strong>{{ $node->node_id }}</strong>
        <span style="margin:0 .4rem;color:var(--bdr2)">·</span>
        Project: <strong>{{ $project->name }}</strong>
        <span style="margin:0 .4rem;color:var(--bdr2)">·</span>
        <a href="{{ route('admin.projects.nodes.index', $project) }}" style="color:var(--p);font-size:.76rem;">← Back to Nodes</a>
      </p>
    </div>
    <button class="btn-p" id="btnOpenAdd"><i class="mgc_add_line"></i> Add Pole</button>

    <button class="btn-p" id="btnAddSpan" style="margin-left:0.5rem;"
        onclick="window.location='{{ route('admin.projects.nodes.spans.create', [$project, $node]) }}'">
    <i class="mgc_add_line"></i> Add Span
</button>

  </div>

  <div class="sg">
    <div class="sc">
      <div class="si" style="background:rgba(59,130,246,.1);color:var(--p);"><i class="mgc_map_pin_line"></i></div>
      <div><div class="sv" id="statTotal">0</div><div class="sl">Total Poles</div></div>
    </div>
    <div class="sc">
      <div class="si" style="background:rgba(148,163,184,.1);color:var(--txt3);"><i class="mgc_time_line"></i></div>
      <div><div class="sv" id="statPending">0</div><div class="sl">Pending</div></div>
    </div>
    <div class="sc">
      <div class="si" style="background:rgba(34,197,94,.1);color:#16a34a;"><i class="mgc_check_circle_line"></i></div>
      <div><div class="sv" id="statDone">0</div><div class="sl">Completed</div></div>
    </div>
    <div class="sc">
      <div class="si" style="background:rgba(20,184,166,.1);color:#0d9488;"><i class="mgc_location_line"></i></div>
      <div><div class="sv" id="statGps">0</div><div class="sl">With GPS</div></div>
    </div>
  </div>

  <div class="tv-card">
    <div class="frow">
      <div class="fi-wrap">
        <i class="mgc_search_line fi-ico"></i>
        <input id="fSearch" type="text" placeholder="Search by name or code…" class="fi" />
      </div>
      <div class="cpill" style="margin-left:auto;"><strong id="showCount">0</strong>&nbsp;pole(s)</div>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th style="width:40px;">#</th>
            <th>Pole Name</th>
            <th class="tc">Status</th>
            <th>Remarks</th>
            <th class="tc">GPS</th>
            <th class="tc">Completed At</th>
            <th class="tc">Actions</th>
          </tr>
        </thead>
        <tbody id="poleTbody"></tbody>
      </table>
    </div>
  </div>

</div>

<div id="poleOv">
  <div id="pmc">
    <div class="mhd">
      <div class="mico"><i class="mgc_map_pin_line"></i></div>
      <div style="flex:1;"><div class="mt" id="modalTitle">Add Pole</div><div class="ms">Fields marked <span style="color:var(--err)">*</span> are required.</div></div>
      <button class="mc" id="btnClose"><i class="mgc_close_line"></i></button>
    </div>
    <div class="mb">
      <input type="hidden" id="editId"/>
      <div>
        <label class="lbl" for="fPoleName">Pole Name <span>*</span></label>
        <input id="fPoleName" class="inp" type="text" placeholder="e.g. BGC-001 or NPT" autocomplete="off" style="text-transform:uppercase;"/>
      </div>
      <div>
        <label class="lbl" for="fStatus">Status</label>
        <select id="fStatus" class="inp">
          <option value="pending">Pending</option>
          <option value="completed">Completed</option>
        </select>
      </div>
      <div>
        <label class="lbl" for="fRemarks">Remarks</label>
        <textarea id="fRemarks" class="inp" rows="3" placeholder="Optional notes…" style="resize:vertical;"></textarea>
      </div>
    </div>
    <div class="mft">
      <button class="btn-c" id="btnCancel" type="button">Cancel</button>
      <button class="btn-s" id="btnSave" type="button"><i class="mgc_save_line"></i> <span id="saveLbl">Save Pole</span></button>
    </div>
  </div>
</div>

<div id="delOv">
  <div id="delCard">
    <div class="delib"><i class="mgc_delete_2_line"></i></div>
    <div style="font-size:.9rem;font-weight:900;color:var(--txt);margin-bottom:.3rem;">Delete Pole?</div>
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
  const POLES    = @json($poles);
  const BASE_URL = "{{ url('admin/projects/'.$project->id.'/nodes/'.$node->id.'/poles') }}";
  const CSRF     = document.querySelector('meta[name="csrf-token"]').content;
  let rows = JSON.parse(JSON.stringify(POLES));
  let pendingDelId = null;
  const $ = id => document.getElementById(id);

  function toast(msg,type='ok'){
    const w=$('toastWrap'),el=document.createElement('div');
    el.className=`toast t-${type}`;
    el.innerHTML=`<i class="mgc_${type==='ok'?'check_circle_line':'close_circle_line'}" style="color:${type==='ok'?'#16a34a':'var(--err)'}"></i><span>${msg}</span>`;
    w.appendChild(el);
    requestAnimationFrame(()=>requestAnimationFrame(()=>el.classList.add('show')));
    setTimeout(()=>{el.classList.remove('show');setTimeout(()=>el.remove(),350);},3200);
  }

  function renderStats(list){
    $('statTotal').textContent   = list.length;
    $('statPending').textContent = list.filter(p=>p.status==='pending').length;
    $('statDone').textContent    = list.filter(p=>p.status==='completed').length;
    $('statGps').textContent     = list.filter(p=>p.map_latitude!=null).length;
  }

  function statusBadge(s){
    return s==='completed'
      ?`<span class="sbadge s-completed"><i class="mgc_check_circle_line"></i> Completed</span>`
      :`<span class="sbadge s-pending">Pending</span>`;
  }

  function renderTable(){
    const q=($('fSearch').value||'').toLowerCase();
    const list=rows.filter(p=>!q||[(p.pole_name||''),(p.pole_code||'')].some(v=>v.toLowerCase().includes(q)));
    renderStats(list);
    $('showCount').textContent=list.length;
    if(!list.length){
      $('poleTbody').innerHTML=`<tr><td colspan="7"><div class="empty-st"><i class="mgc_map_pin_line"></i>No poles yet. Click "Add Pole" to get started.</div></td></tr>`;
      return;
    }
    $('poleTbody').innerHTML=list.map((p,i)=>{
      const gps=p.map_latitude!=null
        ?`<span class="c-mono">${(+p.map_latitude).toFixed(5)},${(+p.map_longitude).toFixed(5)}</span>`
        :`<span style="color:var(--muted)">—</span>`;
      const cat=p.completed_at?`<span class="c-muted">${p.completed_at.slice(0,10)}</span>`:`<span style="color:var(--muted)">—</span>`;
      return `<tr>
        <td style="color:var(--muted);font-size:.67rem;font-family:var(--fm)">${i+1}</td>
        <td class="c-muted">${p.pole_name||'<span style="color:var(--muted)">—</span>'}</td>
        <td class="tc">${statusBadge(p.status)}</td>
        <td class="remarks-cell" title="${(p.remarks||'').replace(/"/g,'&quot;')}">${p.remarks||'<span style="color:var(--muted)">—</span>'}</td>
        <td class="tc">${gps}</td>
        <td class="tc">${cat}</td>
        <td class="tc"><div class="ar">
          <button class="ab ab-e" data-act="edit" data-id="${p.id}" title="Edit"><i class="mgc_edit_2_line"></i></button>
          <button class="ab ab-d" data-act="del"  data-id="${p.id}" title="Delete"><i class="mgc_delete_2_line"></i></button>
        </div></td>
      </tr>`;
    }).join('');
  }

  function openModal(){$('poleOv').classList.add('open');document.body.style.overflow='hidden';}
  function closeModal(){$('poleOv').classList.remove('open');document.body.style.overflow='';}
  function openDel(id){
    const p=rows.find(x=>x.id==id);if(!p)return;
    pendingDelId=id;
    $('delMsg').textContent=`Delete pole "${p.pole_name||p.pole_code}"? This cannot be undone.`;
    $('delOv').classList.add('open');document.body.style.overflow='hidden';
  }
  function closeDel(){$('delOv').classList.remove('open');document.body.style.overflow='';pendingDelId=null;}

  function resetForm(){
    $('editId').value='';$('fPoleName').value='';$('fStatus').value='pending';$('fRemarks').value='';
    $('modalTitle').textContent='Add Pole';$('saveLbl').textContent='Save Pole';
    $('fPoleName').classList.remove('inp-e');
  }
  function loadEdit(id){
    const p=rows.find(x=>x.id==id);if(!p)return;
    resetForm();
    $('editId').value=p.id;$('fPoleName').value=p.pole_name||p.pole_code||'';
    $('fStatus').value=p.status;$('fRemarks').value=p.remarks||'';
    $('modalTitle').textContent='Edit Pole';$('saveLbl').textContent='Update Pole';
    openModal();
  }

  async function savePole(){
    const name=$('fPoleName').value.trim();
    if(!name){$('fPoleName').classList.add('inp-e');return;}
    $('fPoleName').classList.remove('inp-e');
    const editId=$('editId').value;
    const fd=new FormData();
    fd.append('pole_name',name);fd.append('status',$('fStatus').value);fd.append('remarks',$('fRemarks').value.trim());
    const btn=$('btnSave');
    btn.disabled=true;btn.innerHTML='<i class="mgc_loading_4_line"></i> Saving…';
    try{
      const res=await fetch(editId?`${BASE_URL}/${editId}`:BASE_URL,{method:'POST',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'},body:fd});
      const data=await res.json();
      if(!res.ok||!data.success){toast(data.message||'Something went wrong.','err');return;}
      if(editId){const idx=rows.findIndex(x=>x.id==editId);if(idx>=0)rows[idx]=data.pole;}
      else rows.unshift(data.pole);
      closeModal();renderTable();toast(editId?'Pole updated.':'Pole added.');
    }catch(e){toast('Network error.','err');}
    finally{btn.disabled=false;btn.innerHTML='<i class="mgc_save_line"></i> <span id="saveLbl">Save Pole</span>';}
  }

  async function confirmDel(){
    if(!pendingDelId)return;
    const btn=$('btnDelConfirm');
    btn.disabled=true;btn.innerHTML='<i class="mgc_loading_4_line"></i> Deleting…';
    try{
      const res=await fetch(`${BASE_URL}/${pendingDelId}`,{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}});
      const data=await res.json();
      if(!res.ok||!data.success){toast(data.message||'Delete failed.','err');return;}
      rows=rows.filter(x=>x.id!=pendingDelId);closeDel();renderTable();toast('Pole deleted.');
    }catch(e){toast('Network error.','err');}
    finally{btn.disabled=false;btn.innerHTML='<i class="mgc_delete_2_line"></i> Delete';}
  }

  $('fPoleName').addEventListener('input',function(){
    const pos=this.selectionStart;
    this.value=this.value.toUpperCase();
    this.setSelectionRange(pos,pos);
  });
  $('btnOpenAdd').addEventListener('click',()=>{resetForm();openModal();});
  $('btnClose').addEventListener('click',closeModal);
  $('btnCancel').addEventListener('click',closeModal);
  $('btnSave').addEventListener('click',savePole);
  $('poleOv').addEventListener('click',e=>{if(e.target===$('poleOv'))closeModal();});
  $('btnDelConfirm').addEventListener('click',confirmDel);
  $('btnDelCancel').addEventListener('click',closeDel);
  $('delOv').addEventListener('click',e=>{if(e.target===$('delOv'))closeDel();});
  $('fSearch').addEventListener('input',renderTable);
  $('poleTbody').addEventListener('click',e=>{
    const btn=e.target.closest('button');if(!btn)return;
    if(btn.dataset.act==='edit')loadEdit(btn.dataset.id);
    if(btn.dataset.act==='del')openDel(btn.dataset.id);
  });
  document.addEventListener('keydown',e=>{
    if(e.key==='Escape'){
      if($('poleOv').classList.contains('open'))closeModal();
      if($('delOv').classList.contains('open'))closeDel();
    }
  });
  renderTable();
})();
</script>
@endpush

</x-layout>
