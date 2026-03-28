<x-layout>

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet"/>
<style>
*,*::before,*::after{box-sizing:border-box;}
:root{
  --p:#2d6ff7;--p2:#1a56d6;--pg:rgba(45,111,247,.1);
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

/* Page header */
.hd{display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.5rem;}
.hd-left{display:flex;flex-direction:column;gap:.2rem;}
.eyebrow{font-size:.68rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--p);display:flex;align-items:center;gap:.4rem;}
.eyebrow::before{content:'';display:inline-block;width:18px;height:2px;background:var(--p);border-radius:2px;}
.hd h2{margin:0;font-size:1.65rem;font-weight:800;color:var(--txt);letter-spacing:-.02em;line-height:1.1;}
.hd p{margin:.25rem 0 0;color:var(--txt2);font-size:.8rem;font-weight:500;}
.btn-back{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem 1rem;background:var(--surf);color:var(--txt2);border:1px solid var(--bdr);border-radius:12px;font-size:.83rem;font-weight:600;font-family:var(--ff);cursor:pointer;text-decoration:none;transition:all .15s;}
.btn-back:hover{background:var(--surf2);color:var(--txt);}

/* Two-column layout */
.wh-layout{display:grid;grid-template-columns:340px 1fr;gap:1.5rem;align-items:start;}
@media(max-width:900px){.wh-layout{grid-template-columns:1fr;}}

/* Form card */
.form-card{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;}
.form-hd{padding:1rem 1.25rem;border-bottom:1px solid var(--bdr);display:flex;align-items:center;gap:.65rem;}
.form-hd-ico{width:36px;height:36px;border-radius:10px;background:var(--pg);color:var(--p);display:flex;align-items:center;justify-content:center;font-size:1.05rem;flex-shrink:0;}
.form-hd-txt{font-size:.9rem;font-weight:800;color:var(--txt);}
.form-body{padding:1.25rem;display:flex;flex-direction:column;gap:1rem;}

/* Logo preview in form */
.logo-preview-row{display:flex;align-items:center;gap:.85rem;padding:.85rem;background:var(--surf2);border:1px solid var(--bdr);border-radius:12px;}
.logo-preview-box{width:52px;height:52px;border-radius:12px;border:1px solid var(--bdr);background:var(--surf);display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0;}
.logo-preview-box img{width:100%;height:100%;object-fit:contain;padding:.35rem;}
.logo-preview-meta{flex:1;min-width:0;}
.logo-preview-name{font-size:.82rem;font-weight:700;color:var(--txt);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.logo-preview-sub{font-size:.7rem;color:var(--muted);margin-top:.1rem;}

/* Form fields */
.lbl{display:block;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--txt2);margin-bottom:.35rem;}
.lbl span{color:#ef4444;}
.inp{width:100%;padding:.58rem .85rem;border:1px solid var(--bdr);border-radius:12px;background:var(--surf2);color:var(--txt);font-size:.85rem;font-family:var(--ff);outline:none;transition:border-color .15s,box-shadow .15s;}
.inp:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(45,111,247,.12);}
.inp::placeholder{color:var(--muted);}
.btn-p{display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.25rem;background:var(--p);color:#fff;border:none;border-radius:12px;font-size:.83rem;font-weight:700;font-family:var(--ff);cursor:pointer;letter-spacing:.01em;box-shadow:0 2px 12px rgba(45,111,247,.3);transition:all .15s;text-decoration:none;}
.btn-p:hover{background:var(--p2);transform:translateY(-1px);}
.btn-c{display:inline-flex;align-items:center;gap:.5rem;padding:.58rem 1rem;border-radius:12px;border:1px solid var(--bdr);background:var(--surf2);color:var(--txt2);font-size:.83rem;font-weight:700;font-family:var(--ff);cursor:pointer;transition:all .15s;text-decoration:none;}
.btn-c:hover{background:var(--bdr);color:var(--txt);}
.form-foot{padding:.9rem 1.25rem;border-top:1px solid var(--bdr);display:flex;align-items:center;gap:.6rem;}

/* Right panel */
.right-panel{display:flex;flex-direction:column;gap:1rem;}
.panel-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:.1rem;}
.panel-title{font-size:.85rem;font-weight:800;color:var(--txt);display:flex;align-items:center;gap:.5rem;}
.count-badge{padding:.3rem .75rem;border-radius:999px;background:var(--pg);color:var(--p);font-size:.73rem;font-weight:700;font-family:var(--fm);}

/* Warehouse cards */
.wh-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:1rem;}
.wh-card{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;transition:box-shadow .2s,transform .2s;}
.wh-card:hover{box-shadow:var(--sh-md);transform:translateY(-2px);}
.card-strip{height:4px;width:100%;background:linear-gradient(90deg,var(--p),#60a5fa);}
.card-body{padding:1rem;}
.card-head{display:flex;align-items:center;gap:.75rem;margin-bottom:.85rem;}
.logo-wrap{width:46px;height:46px;flex-shrink:0;border-radius:12px;border:1px solid var(--bdr);background:var(--surf2);display:flex;align-items:center;justify-content:center;overflow:hidden;}
.logo-wrap img{width:100%;height:100%;object-fit:contain;padding:.35rem;}
.logo-wrap i{font-size:1.3rem;color:var(--p);}
.card-name{font-size:.9rem;font-weight:800;color:var(--txt);line-height:1.2;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.card-sub{font-size:.7rem;font-weight:600;color:var(--txt2);font-family:var(--fm);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.info-row{display:flex;flex-direction:column;gap:.35rem;margin-bottom:.85rem;}
.info-item{display:flex;align-items:center;gap:.4rem;font-size:.75rem;color:var(--txt2);}
.info-item i{color:var(--muted);font-size:.8rem;width:14px;}
.card-foot{display:flex;align-items:center;justify-content:space-between;padding-top:.75rem;border-top:1px solid var(--bdr);}
.status-dot{display:inline-flex;align-items:center;gap:.35rem;font-size:.7rem;font-weight:700;}
.status-dot::before{content:'';width:6px;height:6px;border-radius:50%;}
.status-active::before{background:#16a34a;box-shadow:0 0 0 2px rgba(22,163,74,.2);}
.status-active{color:#16a34a;}
.status-inactive::before{background:var(--muted);}
.status-inactive{color:var(--muted);}
.manage-link{display:inline-flex;align-items:center;gap:.3rem;font-size:.75rem;font-weight:700;color:var(--p);text-decoration:none;transition:opacity .15s;}
.manage-link:hover{opacity:.75;}

/* Empty state */
.empty{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.75rem;padding:4rem 2rem;text-align:center;background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);}
.empty-ico{width:56px;height:56px;border-radius:16px;background:var(--pg);color:var(--p);display:flex;align-items:center;justify-content:center;font-size:1.5rem;margin-bottom:.25rem;}
.empty h3{font-size:.95rem;font-weight:700;color:var(--txt);margin:0;}
.empty p{font-size:.8rem;color:var(--muted);margin:0;}

/* Flash */
.flash{display:flex;align-items:center;gap:.65rem;padding:.75rem 1rem;border-radius:12px;font-size:.83rem;font-weight:600;margin-bottom:1.25rem;}
.flash-ok{background:rgba(22,163,74,.08);border:1px solid rgba(22,163,74,.2);color:#15803d;}
.flash-err{background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);color:#dc2626;}
</style>
@endpush

<div class="col-span-full">

    {{-- Flash --}}
    @if (session('success'))
        <div class="flash flash-ok">
            <i class="mgc_check_circle_line"></i> {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="flash flash-err">
            <i class="mgc_close_circle_line"></i> {{ session('error') }}
        </div>
    @endif

    {{-- Page header --}}
    <div class="hd">
        <div class="hd-left">
            <div class="eyebrow">Warehouses</div>
            <h2>Add Warehouse</h2>
            <p>Create and manage depot warehouses per subcontractor.</p>
        </div>
        <a href="{{ route('warehouse.inventory.index') }}" class="btn-back">
            <i class="mgc_inventory_line"></i> View Inventory
        </a>
    </div>

    <div class="wh-layout">

        {{-- ── CREATE FORM ── --}}
        <div class="form-card">
            <div class="form-hd">
                <div class="form-hd-ico"><i class="mgc_building_2_line"></i></div>
                <div class="form-hd-txt">New Warehouse</div>
            </div>

            <form method="POST" action="{{ route('warehouse.warehouses.store') }}">
                @csrf

                <div class="form-body">

                    {{-- Subcontractor selector with live logo preview --}}
                    <div>
                        <label class="lbl" for="subcontractor_id">Subcontractor</label>
                        <select name="subcontractor_id" id="subcontractor_id" class="inp" onchange="onSubconChange(this)">
                            <option value="">— None / Internal —</option>
                            @foreach ($subcons as $sc)
                                <option value="{{ $sc->id }}"
                                    data-logo="{{ $sc->logo_url ?? '' }}"
                                    data-name="{{ $sc->name }}"
                                    @selected(old('subcontractor_id') == $sc->id)>
                                    {{ $sc->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Logo preview row --}}
                    <div class="logo-preview-row" id="logoPreviewRow" style="display:none;">
                        <div class="logo-preview-box">
                            <img id="logoPreviewImg" src="" alt="logo"/>
                        </div>
                        <div class="logo-preview-meta">
                            <div class="logo-preview-name" id="logoPreviewName"></div>
                            <div class="logo-preview-sub">Selected subcontractor</div>
                        </div>
                    </div>

                    <div>
                        <label class="lbl" for="name">Warehouse Name <span>*</span></label>
                        <input type="text" name="name" id="name" class="inp" required
                            value="{{ old('name') }}" placeholder="e.g. Main Depot Warehouse">
                        @error('name')<p style="color:#ef4444;font-size:.72rem;margin-top:.3rem;">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="lbl" for="extension">Extension <span style="color:var(--muted);text-transform:none;font-weight:500;">(A, B, C…)</span></label>
                        <input type="text" name="extension" id="extension" class="inp" maxlength="10"
                            value="{{ old('extension') }}" placeholder="e.g. A">
                    </div>

                    <div>
                        <label class="lbl" for="location">Location / Address</label>
                        <input type="text" name="location" id="location" class="inp"
                            value="{{ old('location') }}" placeholder="e.g. Brgy. Bagong Silang, Caloocan">
                    </div>

                </div>

                <div class="form-foot">
                    <button type="submit" class="btn-p">
                        <i class="mgc_add_line"></i> Create Warehouse
                    </button>
                    <a href="{{ route('warehouse.inventory.index') }}" class="btn-c">Cancel</a>
                </div>
            </form>
        </div>

        {{-- ── EXISTING WAREHOUSES ── --}}
        <div class="right-panel">
            <div class="panel-hd">
                <div class="panel-title">
                    <i class="mgc_warehouse_line" style="color:var(--p);font-size:1rem;"></i>
                    Existing Warehouses
                </div>
                <span class="count-badge">{{ $warehouses->count() }}</span>
            </div>

            @if ($warehouses->isEmpty())
                <div class="empty">
                    <div class="empty-ico"><i class="mgc_building_2_line"></i></div>
                    <h3>No warehouses yet</h3>
                    <p>Create the first warehouse using the form.</p>
                </div>
            @else
                <div class="wh-grid">
                    @foreach ($warehouses as $wh)
                        <div class="wh-card">
                            <div class="card-strip"></div>
                            <div class="card-body">
                                <div class="card-head">
                                    <div class="logo-wrap">
                                        @if ($wh->subcontractor?->logo_url)
                                            <img src="{{ $wh->subcontractor->logo_url }}" alt="{{ $wh->subcontractor->name }}"
                                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                            <i class="mgc_building_2_line" style="display:none;"></i>
                                        @else
                                            <i class="mgc_building_2_line"></i>
                                        @endif
                                    </div>
                                    <div style="flex:1;min-width:0;">
                                        <div class="card-name" title="{{ $wh->display_name }}">{{ $wh->display_name }}</div>
                                        <div class="card-sub">{{ $wh->subcontractor?->name ?? 'Internal' }}</div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    @if ($wh->location)
                                        <div class="info-item">
                                            <i class="mgc_location_line"></i>
                                            <span>{{ Str::limit($wh->location, 40) }}</span>
                                        </div>
                                    @endif
                                    <div class="info-item">
                                        <i class="mgc_inventory_line"></i>
                                        <span>{{ $wh->stocks->count() }} item type{{ $wh->stocks->count() !== 1 ? 's' : '' }}</span>
                                    </div>
                                </div>

                                <div class="card-foot">
                                    <span class="status-dot {{ $wh->status === 'active' ? 'status-active' : 'status-inactive' }}">
                                        {{ ucfirst($wh->status) }}
                                    </span>
                                    <a href="{{ route('warehouse.inventory.show', $wh) }}" class="manage-link">
                                        <i class="mgc_settings_4_line"></i> Manage
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

</div>

@push('scripts')
<script>
@php
    $subconMap = $subcons->keyBy('id')->map(function ($s) {
        return ['name' => $s->name, 'logo' => $s->logo_url, 'warehouse' => $s->warehouse];
    });
@endphp
const subconData = @json($subconMap);

function onSubconChange(sel) {
    const id       = sel.value;
    const row      = document.getElementById('logoPreviewRow');
    const img      = document.getElementById('logoPreviewImg');
    const label    = document.getElementById('logoPreviewName');
    const nameInp  = document.getElementById('name');

    if (!id || !subconData[id]) {
        row.style.display = 'none';
        return;
    }

    const sc = subconData[id];
    label.textContent = sc.name;

    // Auto-fill warehouse name only if field is empty or was auto-filled before
    if (sc.warehouse && (!nameInp.value || nameInp.dataset.autofilled === '1')) {
        nameInp.value = sc.warehouse;
        nameInp.dataset.autofilled = '1';
    }

    // Mark as manual if user edits it
    nameInp.addEventListener('input', () => { nameInp.dataset.autofilled = '0'; }, { once: true });

    if (sc.logo) {
        img.src = sc.logo;
        img.style.display = '';
        row.style.display = 'flex';
    } else {
        row.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const sel = document.getElementById('subcontractor_id');
    if (sel.value) onSubconChange(sel);
});
</script>
@endpush

</x-layout>
