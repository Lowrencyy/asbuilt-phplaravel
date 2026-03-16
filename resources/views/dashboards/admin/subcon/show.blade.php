<x-layout>

@push('styles')
<style>
*,*::before,*::after{box-sizing:border-box;}
:root{
  --p:#3b82f6;--p2:#2563eb;--pg:rgba(59,130,246,.14);
  --ok:#22c55e;--err:#ef4444;--warn:#f59e0b;
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
/* Breadcrumb */
.bc{display:flex;align-items:center;gap:.45rem;font-size:.82rem;color:var(--txt2);margin-bottom:1rem;font-weight:800;flex-wrap:wrap;}
.bc a{color:var(--p);text-decoration:none;font-weight:900;}.bc a:hover{text-decoration:underline;}
.bc-sep{color:var(--muted);}
/* Header */
.phd{display:flex;align-items:flex-start;gap:1rem;flex-wrap:wrap;margin-bottom:1.25rem;}
.plogo{height:72px;width:72px;border-radius:16px;border:1px solid var(--bdr);background:linear-gradient(135deg,rgba(59,130,246,.10),transparent);display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0;}
.plogo img{width:100%;height:100%;object-fit:contain;padding:.5rem;}
.pinfo{flex:1;min-width:0;}
.pinfo h1{margin:0;font-size:1.4rem;font-weight:950;line-height:1.2;}
.pmeta{display:flex;gap:.5rem;flex-wrap:wrap;margin-top:.45rem;}
.badge{display:inline-flex;align-items:center;gap:.3rem;font-family:var(--fm);font-size:.7rem;font-weight:900;padding:.12rem .5rem;border-radius:999px;background:var(--pg);color:var(--p);border:1px solid rgba(59,130,246,.18);}
.badge-pm{background:rgba(234,179,8,.12);color:#854d0e;border-color:rgba(234,179,8,.25);}
.badge-ln{background:rgba(16,185,129,.12);color:#065f46;border-color:rgba(16,185,129,.25);}
.dark .badge-pm{background:rgba(234,179,8,.18);color:#fde047;}
.dark .badge-ln{background:rgba(16,185,129,.18);color:#6ee7b7;}
/* Info card */
.info-card{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);padding:1rem;margin-bottom:1.25rem;}
.info-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:.85rem;}
@media(max-width:900px){.info-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:580px){.info-grid{grid-template-columns:1fr;}}
.ig-item label{display:block;font-size:.7rem;font-weight:950;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:.2rem;}
.ig-item span{font-size:.87rem;font-weight:800;color:var(--txt);word-break:break-word;}
/* Section header */
.shd{display:flex;align-items:center;justify-content:space-between;gap:.8rem;flex-wrap:wrap;margin-bottom:.8rem;}
.shd h2{margin:0;font-size:1.05rem;font-weight:950;display:flex;align-items:center;gap:.5rem;}
.shd p{margin:.05rem 0 0;font-size:.8rem;color:var(--txt2);}
.btn-p{display:inline-flex;align-items:center;gap:.45rem;padding:.5rem 1rem;background:var(--p);color:#fff;border:none;border-radius:var(--r-sm);font-size:.84rem;font-weight:900;font-family:var(--ff);cursor:pointer;box-shadow:0 2px 10px rgba(59,130,246,.30);transition:all .15s;}
.btn-p:hover{background:var(--p2);transform:translateY(-1px);}
/* Members table */
.tbl-wrap{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;}
table{width:100%;border-collapse:collapse;}
thead tr{background:var(--surf2);border-bottom:1px solid var(--bdr);}
thead th{text-align:left;padding:.65rem 1rem;font-size:.72rem;font-weight:950;color:var(--txt2);text-transform:uppercase;letter-spacing:.04em;white-space:nowrap;}
tbody tr{border-bottom:1px solid var(--bdr);transition:background .12s;}
tbody tr:last-child{border-bottom:none;}
tbody tr:hover{background:var(--surf2);}
td{padding:.7rem 1rem;font-size:.84rem;color:var(--txt);vertical-align:middle;}
.av{height:34px;width:34px;border-radius:10px;background:linear-gradient(135deg,var(--p),var(--p2));display:inline-flex;align-items:center;justify-content:center;color:#fff;font-size:.78rem;font-weight:950;flex-shrink:0;}
.uname{font-weight:900;}
.uemail{font-size:.78rem;color:var(--txt2);font-family:var(--fm);}
.empty-st{padding:2.5rem 1rem;text-align:center;color:var(--muted);}
.empty-st i{font-size:2rem;display:block;margin-bottom:.55rem;color:var(--p);}
/* Delete btn */
.del-btn{height:32px;width:32px;border-radius:10px;border:1px solid var(--bdr);background:var(--surf2);cursor:pointer;color:var(--txt2);display:inline-flex;align-items:center;justify-content:center;transition:all .15s;font-size:.9rem;}
.del-btn:hover{border-color:rgba(239,68,68,.4);background:rgba(239,68,68,.1);color:var(--err);}
/* Add Member Modal */
#addOv{position:fixed;inset:0;z-index:900;background:rgba(7,15,30,.65);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .22s;}
#addOv.open{opacity:1;pointer-events:all;}
#addCard{background:var(--surf);border:1px solid var(--bdr);border-radius:18px;box-shadow:var(--sh-lg);width:100%;max-width:520px;transform:translateY(20px) scale(.97);opacity:0;transition:transform .28s cubic-bezier(.34,1.18,.64,1),opacity .22s;}
#addOv.open #addCard{transform:translateY(0) scale(1);opacity:1;}
.mhd{display:flex;align-items:center;justify-content:space-between;padding:.95rem 1.2rem;border-bottom:1px solid var(--bdr);gap:.7rem;}
.mico{height:38px;width:38px;border-radius:12px;flex-shrink:0;background:linear-gradient(135deg,rgba(59,130,246,.18),rgba(59,130,246,.05));display:inline-flex;align-items:center;justify-content:center;color:var(--p);font-size:1.05rem;}
.mt{font-size:1rem;font-weight:950;}
.ms{font-size:.72rem;color:var(--txt2);margin-top:.05rem;}
.mb{padding:1.15rem;}
.mc{height:30px;width:30px;border-radius:10px;border:1px solid var(--bdr);background:var(--surf2);display:inline-flex;align-items:center;justify-content:center;color:var(--txt2);font-size:.95rem;cursor:pointer;transition:all .15s;flex-shrink:0;}
.mc:hover{background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.3);color:var(--err);}
.fg{display:flex;flex-direction:column;gap:.85rem;}
.lbl{display:block;font-size:.72rem;font-weight:950;color:var(--txt2);letter-spacing:.02em;margin-bottom:.28rem;}
.lbl span{color:var(--err);}
.inp{width:100%;padding:.52rem .75rem;border:1px solid var(--bdr);border-radius:12px;background:var(--surf);color:var(--txt);font-size:.86rem;font-family:var(--ff);outline:none;transition:border-color .15s,box-shadow .15s;}
.inp:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(59,130,246,.12);}
select.inp{cursor:pointer;}
.mft{padding:.85rem 1.2rem;border-top:1px solid var(--bdr);display:flex;align-items:center;justify-content:flex-end;gap:.6rem;}
.btn-c{padding:.48rem .95rem;border-radius:12px;border:1px solid var(--bdr);background:var(--surf2);color:var(--txt2);font-size:.85rem;font-weight:950;font-family:var(--ff);cursor:pointer;transition:all .15s;}
.btn-c:hover{background:var(--bdr);color:var(--txt);}
.btn-s{padding:.48rem 1.05rem;border-radius:12px;border:none;background:var(--p);color:#fff;font-size:.85rem;font-weight:950;font-family:var(--ff);cursor:pointer;box-shadow:0 2px 10px rgba(59,130,246,.30);transition:all .15s;}
.btn-s:hover{background:var(--p2);}
/* Delete confirm */
#delOv{position:fixed;inset:0;z-index:950;background:rgba(7,15,30,.7);backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .2s;}
#delOv.open{opacity:1;pointer-events:all;}
#delCard{background:var(--surf);border:1px solid var(--bdr);border-radius:16px;box-shadow:var(--sh-lg);max-width:380px;width:100%;padding:1.4rem;transform:scale(.95);opacity:0;transition:transform .22s cubic-bezier(.34,1.18,.64,1),opacity .2s;}
#delOv.open #delCard{transform:scale(1);opacity:1;}
.delib{height:46px;width:46px;border-radius:12px;background:rgba(239,68,68,.1);display:inline-flex;align-items:center;justify-content:center;color:var(--err);font-size:1.2rem;margin-bottom:.85rem;}
.btn-del{padding:.48rem 1.05rem;border-radius:12px;border:none;background:var(--err);color:#fff;font-size:.85rem;font-weight:950;font-family:var(--ff);cursor:pointer;box-shadow:0 2px 8px rgba(239,68,68,.28);transition:all .15s;}
.btn-del:hover{background:#dc2626;}
/* Toast */
.toast{position:fixed;bottom:1.5rem;right:1.5rem;z-index:9999;padding:.7rem 1.1rem;border-radius:12px;font-size:.85rem;font-weight:900;color:#fff;box-shadow:var(--sh-lg);transform:translateY(10px);opacity:0;transition:all .22s;pointer-events:none;}
.toast.show{transform:translateY(0);opacity:1;}
.toast-ok{background:var(--ok);}
.toast-err{background:var(--err);}
/* Err msg */
.err-msg{font-size:.78rem;color:var(--err);margin-top:.3rem;font-weight:800;}
</style>
@endpush

<div class="col-span-full">

<!-- Breadcrumb -->
<div class="bc">
  <a href="{{ route('admin.subcons.index') }}"><i class="mgc_user_3_line"></i> Subcontractors</a>
  <span class="bc-sep">/</span>
  <span>{{ $subcon->name }}</span>
</div>

<!-- Profile header -->
<div class="phd">
  <div class="plogo">
    @if($subcon->logo_url)
      <img src="{{ $subcon->logo_url }}" alt="{{ $subcon->name }} logo" />
    @else
      <i class="mgc_user_3_line" style="font-size:1.8rem;color:var(--p)"></i>
    @endif
  </div>
  <div class="pinfo">
    <h1>{{ $subcon->name }}</h1>
    <div class="pmeta">
      @if($subcon->email) <span class="badge"><i class="mgc_mail_line"></i> {{ $subcon->email }}</span> @endif
      @if($subcon->contact) <span class="badge"><i class="mgc_phone_line"></i> {{ $subcon->contact }}</span> @endif
      <span class="badge"><i class="mgc_user_3_line"></i> {{ $members->count() }} member{{ $members->count() !== 1 ? 's' : '' }}</span>
    </div>
  </div>
</div>

<!-- Company info -->
<div class="info-card">
  <div class="info-grid">
    <div class="ig-item">
      <label>Address</label>
      <span>{{ $subcon->address ?: '—' }}</span>
    </div>
    <div class="ig-item">
      <label>Warehouse</label>
      <span>{{ $subcon->warehouse ?: '—' }}</span>
    </div>
    <div class="ig-item">
      <label>Description</label>
      <span>{{ $subcon->description ?: '—' }}</span>
    </div>
  </div>
</div>

<!-- Members section -->
<div class="shd">
  <div>
    <h2><i class="mgc_group_line" style="color:var(--p)"></i> Members</h2>
    <p>All assigned PM and Lineman accounts for this subcontractor.</p>
  </div>
  <button class="btn-p" id="btnAddMember" type="button">
    <i class="mgc_user_add_line"></i> Add Member
  </button>
</div>

<div class="tbl-wrap">
  <table id="membersTable">
    <thead>
      <tr>
        <th>Member</th>
        <th>Role</th>
        <th>Email</th>
        <th>Joined</th>
        <th></th>
      </tr>
    </thead>
    <tbody id="membersBody">
      @forelse($members as $member)
      <tr id="row-{{ $member->id }}">
        <td>
          <div style="display:flex;align-items:center;gap:.65rem;">
            <div class="av">{{ strtoupper(substr($member->name, 0, 2)) }}</div>
            <div>
              <div class="uname">{{ $member->name }}</div>
            </div>
          </div>
        </td>
        <td>
          @if($member->subcon_role === 'pm')
            <span class="badge badge-pm"><i class="mgc_briefcase_line"></i> Project Manager</span>
          @else
            <span class="badge badge-ln"><i class="mgc_tool_line"></i> Lineman</span>
          @endif
        </td>
        <td><span class="uemail">{{ $member->email }}</span></td>
        <td><span style="font-size:.8rem;color:var(--txt2);">{{ $member->created_at->format('M d, Y') }}</span></td>
        <td style="text-align:right;">
          <button class="del-btn remove-member" type="button"
            data-id="{{ $member->id }}"
            data-name="{{ $member->name }}"
            title="Remove member">
            <i class="mgc_delete_2_line"></i>
          </button>
        </td>
      </tr>
      @empty
      <tr id="emptyRow">
        <td colspan="5">
          <div class="empty-st">
            <i class="mgc_user_x_line"></i>
            <div style="font-weight:950;color:var(--txt);">No members yet</div>
            <div style="font-size:.82rem;margin-top:.2rem;">Add a PM or Lineman to get started.</div>
          </div>
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

</div>{{-- col-span-full --}}

<!-- ADD MEMBER MODAL -->
<div id="addOv">
  <div id="addCard">
    <div class="mhd">
      <div class="mico"><i class="mgc_user_add_line"></i></div>
      <div style="flex:1;">
        <div class="mt">Add Member</div>
        <div class="ms">Assign a new PM or Lineman to <strong>{{ $subcon->name }}</strong></div>
      </div>
      <button class="mc" id="btnCloseAdd" type="button"><i class="mgc_close_line"></i></button>
    </div>
    <div class="mb">
      <form id="addForm" method="POST"
            action="{{ route('admin.subcons.members.store', $subcon) }}"
            class="fg" novalidate>
        @csrf
        <div>
          <label class="lbl" for="mName">Full Name <span>*</span></label>
          <input id="mName" name="name" class="inp" type="text" placeholder="e.g. Juan dela Cruz" required value="{{ old('name') }}" />
          @error('name') <div class="err-msg">{{ $message }}</div> @enderror
        </div>
        <div>
          <label class="lbl" for="mEmail">Email <span>*</span></label>
          <input id="mEmail" name="email" class="inp" type="email" placeholder="e.g. juan@subcon.com" required value="{{ old('email') }}" />
          @error('email') <div class="err-msg">{{ $message }}</div> @enderror
        </div>
        <div>
          <label class="lbl" for="mRole">Role <span>*</span></label>
          <select id="mRole" name="subcon_role" class="inp" required>
            <option value="" disabled {{ old('subcon_role') ? '' : 'selected' }}>Select role…</option>
            <option value="pm"      {{ old('subcon_role') === 'pm'      ? 'selected' : '' }}>Project Manager</option>
            <option value="lineman" {{ old('subcon_role') === 'lineman' ? 'selected' : '' }}>Lineman</option>
          </select>
          @error('subcon_role') <div class="err-msg">{{ $message }}</div> @enderror
        </div>
        <div>
          <label class="lbl" for="mPassword">Password <span>*</span></label>
          <input id="mPassword" name="password" class="inp" type="password" placeholder="Min. 8 characters" required />
          @error('password') <div class="err-msg">{{ $message }}</div> @enderror
        </div>
      </form>
    </div>
    <div class="mft">
      <button class="btn-c" id="btnCancelAdd" type="button">Cancel</button>
      <button class="btn-s" id="btnSaveMember" type="button">
        <i class="mgc_user_add_line"></i> Add Member
      </button>
    </div>
  </div>
</div>

<!-- REMOVE MEMBER CONFIRM -->
<div id="delOv">
  <div id="delCard">
    <div class="delib"><i class="mgc_delete_2_line"></i></div>
    <div style="font-size:.95rem;font-weight:950;color:var(--txt);margin-bottom:.3rem;">Remove Member?</div>
    <p style="font-size:.82rem;color:var(--txt2);margin-bottom:1.1rem;" id="delMsg">This will remove the member from this subcon.</p>
    <div style="display:flex;gap:.55rem;justify-content:flex-end;">
      <button class="btn-c" id="btnDelCancel" type="button">Cancel</button>
      <button class="btn-del" id="btnDelConfirm" type="button"><i class="mgc_delete_2_line"></i> Remove</button>
    </div>
  </div>
</div>

<!-- TOAST -->
<div id="toast" class="toast"></div>

@push('scripts')
<script>
(function(){
  const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // ---- Toast ----
  const toast = document.getElementById('toast');
  let toastTimer;
  function showToast(msg, ok = true){
    toast.textContent = msg;
    toast.className = 'toast show ' + (ok ? 'toast-ok' : 'toast-err');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.classList.remove('show'), 2800);
  }

  // ---- Add Member modal ----
  const addOv   = document.getElementById('addOv');
  const addForm = document.getElementById('addForm');
  function openAdd(){ addOv.classList.add('open'); document.body.style.overflow='hidden'; }
  function closeAdd(){ addOv.classList.remove('open'); document.body.style.overflow=''; }

  document.getElementById('btnAddMember').addEventListener('click', openAdd);
  document.getElementById('btnCloseAdd').addEventListener('click', closeAdd);
  document.getElementById('btnCancelAdd').addEventListener('click', closeAdd);
  addOv.addEventListener('click', e=>{ if(e.target===addOv) closeAdd(); });
  document.getElementById('btnSaveMember').addEventListener('click', () => addForm.submit());

  @if($errors->any())
    openAdd();
  @endif

  // ---- Remove Member ----
  const delOv  = document.getElementById('delOv');
  const delMsg = document.getElementById('delMsg');
  let pendingDelId  = null;
  let pendingDelUrl = null;

  function openDel(id, name, url){
    pendingDelId  = id;
    pendingDelUrl = url;
    delMsg.textContent = `Remove "${name}" from this subcontractor?`;
    delOv.classList.add('open'); document.body.style.overflow='hidden';
  }
  function closeDel(){ delOv.classList.remove('open'); document.body.style.overflow=''; pendingDelId=null; }

  document.getElementById('btnDelCancel').addEventListener('click', closeDel);
  delOv.addEventListener('click', e=>{ if(e.target===delOv) closeDel(); });

  document.getElementById('btnDelConfirm').addEventListener('click', async ()=>{
    if(!pendingDelUrl) return;
    try {
      const res = await fetch(pendingDelUrl, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
      });
      if(!res.ok) throw new Error();
      const row = document.getElementById('row-' + pendingDelId);
      if(row) row.remove();
      closeDel();
      showToast('Member removed.');
      // Show empty row if no members left
      const tbody = document.getElementById('membersBody');
      if(tbody && tbody.querySelectorAll('tr[id^="row-"]').length === 0){
        tbody.innerHTML = `<tr id="emptyRow"><td colspan="5">
          <div class="empty-st">
            <i class="mgc_user_x_line"></i>
            <div style="font-weight:950;color:var(--txt);">No members yet</div>
            <div style="font-size:.82rem;margin-top:.2rem;">Add a PM or Lineman to get started.</div>
          </div>
        </td></tr>`;
      }
    } catch(e){
      showToast('Could not remove member. Please try again.', false);
      closeDel();
    }
  });

  document.querySelectorAll('.remove-member').forEach(btn => {
    btn.addEventListener('click', ()=>{
      const id   = btn.dataset.id;
      const name = btn.dataset.name;
      const url  = `{{ url('admin/subcons/members') }}/${id}`;
      openDel(id, name, url);
    });
  });

  document.addEventListener('keydown', e=>{
    if(e.key === 'Escape'){
      if(addOv.classList.contains('open')) closeAdd();
      else if(delOv.classList.contains('open')) closeDel();
    }
  });

  @if(session('success'))
    showToast('{{ session('success') }}');
  @endif
})();
</script>
@endpush

</x-layout>
