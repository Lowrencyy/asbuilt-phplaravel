<x-layout>

@push('styles')
<link rel="stylesheet" href="/assets/libs/leaflet/leaflet.css"/>
<style>
:root{ --sans:"Instrument Sans","Plus Jakarta Sans","Manrope","Segoe UI",sans-serif;--violet:#7c3aed; }
body{ font-family:var(--sans); }

.planner-shell{
    display:grid;
    grid-template-columns:340px 1fr;
    grid-template-rows:auto 1fr;
    height:calc(100vh - 60px);
    gap:0;
    overflow:hidden;
}

/* ── Header bar ─────────────────────────────────────────────────── */
.pl-header{
    grid-column:1/-1;
    display:flex;align-items:center;gap:.85rem;
    padding:.7rem 1.15rem;
    background:#fff;border-bottom:1px solid #eef2f6;
    box-shadow:0 1px 6px rgba(17,24,39,.06);
    flex-wrap:wrap;
}
.pl-back{ display:inline-flex;align-items:center;gap:.4rem;padding:.36rem .72rem;border-radius:999px;border:1px solid #e5e7eb;background:#f9fafb;color:#374151;font-size:.76rem;font-weight:800;text-decoration:none;transition:.14s; }
.pl-back:hover{ background:#eef4ff;border-color:#bfdbfe;color:#1d4ed8; }
.pl-node-id{ font-size:.72rem;font-weight:900;color:var(--violet);letter-spacing:.08em;text-transform:uppercase;font-family:ui-monospace,monospace; }
.pl-node-name{ font-size:1rem;font-weight:900;color:#111827;letter-spacing:-.02em; }
.pl-node-loc{ font-size:.72rem;color:#9ca3af;font-weight:600; }
.pl-date-wrap{ margin-left:auto;display:flex;align-items:center;gap:.6rem;flex-wrap:wrap; }
.pl-date-label{ font-size:.74rem;font-weight:700;color:#6b7280; }
.pl-date-input{ border:1.5px solid #e5e7eb;border-radius:10px;padding:.38rem .7rem;font-size:.82rem;font-weight:700;color:#111827;outline:none;font-family:var(--sans);cursor:pointer;transition:border-color .14s; }
.pl-date-input:focus{ border-color:var(--violet); }
.btn-save{ display:inline-flex;align-items:center;gap:.4rem;padding:.42rem 1rem;border-radius:999px;background:var(--violet);color:#fff;border:none;font-size:.78rem;font-weight:800;font-family:var(--sans);cursor:pointer;box-shadow:0 4px 12px rgba(124,58,237,.28);transition:background .14s,transform .14s; }
.btn-save:hover{ background:#6d28d9;transform:translateY(-1px); }
.btn-save:disabled{ background:#c4b5fd;cursor:not-allowed;transform:none;box-shadow:none; }
.btn-clear{ display:inline-flex;align-items:center;gap:.4rem;padding:.42rem .85rem;border-radius:999px;background:#fff;color:#ef4444;border:1.5px solid #fecaca;font-size:.78rem;font-weight:800;font-family:var(--sans);cursor:pointer;transition:all .14s; }
.btn-clear:hover{ background:#fef2f2; }

/* ── Sidebar ─────────────────────────────────────────────────────── */
.pl-sidebar{
    background:#f9fafb;border-right:1px solid #eef2f6;
    display:flex;flex-direction:column;overflow:hidden;
    grid-row:2;grid-column:1;
}
.pl-sb-top{
    padding:.75rem .9rem .6rem;
    border-bottom:1px solid #eef2f6;flex-shrink:0;
}
.pl-sb-top-row{ display:flex;align-items:center;justify-content:space-between;margin-bottom:.5rem; }
.pl-sb-title{ font-size:.78rem;font-weight:900;color:#111827; }
.pl-sb-hint{ font-size:.67rem;color:#9ca3af;font-weight:600; }
.pl-sb-count{ font-size:.7rem;font-weight:800;background:#f0ebff;color:var(--violet);padding:.18rem .55rem;border-radius:999px; }
.pl-sb-list{ flex:1;overflow-y:auto;padding:.5rem .55rem; }
.pl-sb-list::-webkit-scrollbar{ width:4px; }
.pl-sb-list::-webkit-scrollbar-thumb{ background:#e5e7eb;border-radius:4px; }

.pl-sb-item{
    display:flex;align-items:center;gap:.55rem;
    padding:.48rem .65rem;border-radius:10px;
    background:#fff;border:1px solid #f1f4f8;
    margin-bottom:.3rem;
    font-size:.78rem;font-weight:700;color:#374151;
    cursor:grab;user-select:none;
    transition:box-shadow .13s,border-color .13s;
}
.pl-sb-item:hover{ border-color:#ddd6fe;box-shadow:0 2px 8px rgba(124,58,237,.1); }
.pl-sb-item.dragging{ opacity:.45;box-shadow:0 8px 24px rgba(124,58,237,.2);cursor:grabbing; }
.pl-seq-badge{
    width:24px;height:24px;border-radius:50%;
    background:var(--violet);color:#fff;
    display:flex;align-items:center;justify-content:center;
    font-size:.68rem;font-weight:900;flex-shrink:0;
}
.pl-sb-code{ font-family:ui-monospace,monospace;font-size:.72rem;font-weight:800;color:#111827; }
.pl-sb-status{ font-size:.62rem;font-weight:700;padding:.15rem .42rem;border-radius:6px; }
.status-completed{ background:#ecfdf3;color:#15803d; }
.status-active   { background:#fff7ed;color:#b45309; }
.status-pending  { background:#fff7ed;color:#b45309; }
.status-not_started{ background:#f4f4f5;color:#52525b; }
.pl-sb-drag{ color:#d1d5db;font-size:.8rem;cursor:grab; }
.pl-sb-remove{ margin-left:auto;color:#d1d5db;cursor:pointer;font-size:.8rem;transition:color .13s;flex-shrink:0;border:none;background:none;padding:0; }
.pl-sb-remove:hover{ color:#ef4444; }

.pl-sb-empty{ text-align:center;padding:2.5rem 1rem;color:#9ca3af;font-size:.78rem;font-weight:600; }
.pl-sb-empty i{ display:block;font-size:1.5rem;margin-bottom:.5rem;color:#e5e7eb; }

/* ── All poles list (bottom of sidebar) ─────────────────────────── */
.pl-all-poles{
    border-top:1px solid #eef2f6;padding:.55rem .55rem;
    flex-shrink:0;max-height:220px;overflow-y:auto;background:#fff;
}
.pl-all-title{ font-size:.68rem;font-weight:800;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;padding:.3rem .1rem .4rem; }
.pl-all-item{
    display:flex;align-items:center;gap:.5rem;
    padding:.38rem .55rem;border-radius:8px;font-size:.75rem;font-weight:700;
    color:#374151;cursor:pointer;border:1px solid transparent;
    transition:background .12s,border-color .12s;
}
.pl-all-item:hover{ background:#f5f3ff;border-color:#ddd6fe; }
.pl-all-item.in-plan{ color:#a78bfa;cursor:default; }
.pl-all-item.in-plan:hover{ background:#f9f8ff;border-color:#ede9fe; }
.pl-all-dot{ width:8px;height:8px;border-radius:50%;flex-shrink:0; }
.pl-all-code{ font-family:ui-monospace,monospace;font-size:.7rem; }

/* ── Map ─────────────────────────────────────────────────────────── */
#planMap{ grid-row:2;grid-column:2;width:100%;height:100%; }

/* ── Flash ───────────────────────────────────────────────────────── */
.pl-flash{
    position:fixed;bottom:1.4rem;right:1.4rem;z-index:9999;
    padding:.65rem 1.1rem;border-radius:12px;
    font-size:.82rem;font-weight:800;
    box-shadow:0 8px 24px rgba(0,0,0,.18);
    animation:flashin .2s ease;
}
.pl-flash.ok{ background:#ecfdf3;color:#15803d;border:1px solid #b7ebcb; }
.pl-flash.err{ background:#fef2f2;color:#b91c1c;border:1px solid #fecaca; }
@keyframes flashin{ from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:none} }

.leaflet-div-icon{ background:none!important;border:none!important; }
</style>
@endpush

<div class="col-span-full" style="padding:0;margin:0;">
<div class="planner-shell">

    {{-- Header --}}
    <div class="pl-header">
        <a href="{{ route('admin.pole-planner.index') }}" class="pl-back"><i class="mgc_arrow_left_line"></i> Nodes</a>
        <div>
            <div class="pl-node-id">{{ $node->node_id }}</div>
            <div class="pl-node-name">{{ $node->node_name ?: $node->node_id }}</div>
            <div class="pl-node-loc">{{ implode(' · ', array_filter([$node->city, $node->province])) }}</div>
        </div>
        <div class="pl-date-wrap">
            <span class="pl-date-label">Date:</span>
            <input type="date" class="pl-date-input" id="planDate" value="{{ $date }}">
            <form id="clearForm" method="POST" action="{{ route('admin.pole-planner.clear', $node->id) }}">
                @csrf @method('DELETE')
                <input type="hidden" name="date" id="clearDate" value="{{ $date }}">
                <button type="submit" class="btn-clear" onclick="return confirm('Clear the sequence for this date?')">
                    <i class="mgc_delete_2_line"></i> Clear
                </button>
            </form>
            <button class="btn-save" id="btnSave" disabled>
                <i class="mgc_save_line"></i> Save Plan
            </button>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="pl-sidebar">
        <div class="pl-sb-top">
            <div class="pl-sb-top-row">
                <span class="pl-sb-title">Today's Sequence</span>
                <span class="pl-sb-count" id="seqCount">0 poles</span>
            </div>
            <div class="pl-sb-hint">Click poles on map to add · Drag to reorder</div>
        </div>

        <div class="pl-sb-list" id="seqList">
            <div class="pl-sb-empty" id="seqEmpty">
                <i class="mgc_map_pin_line"></i>
                Click poles on the map to build the sequence
            </div>
        </div>

        {{-- All poles quick-add --}}
        <div class="pl-all-poles">
            <div class="pl-all-title">All Poles — click to add</div>
            <div id="allPolesList">
                @foreach($poles as $pole)
                    @php
                        $s = $pole->status ?? 'not_started';
                        $dotC = match($s) {
                            'completed'  => '#10b981',
                            'active','pending' => '#f59e0b',
                            default      => '#94a3b8',
                        };
                    @endphp
                    <div class="pl-all-item {{ in_array($pole->id, $sequences) ? 'in-plan' : '' }}"
                         data-pole-id="{{ $pole->id }}"
                         data-pole-code="{{ $pole->pole_code }}"
                         data-pole-name="{{ $pole->pole_name ?: $pole->pole_code }}"
                         data-pole-status="{{ $s }}"
                         data-pole-lat="{{ (float)($pole->map_latitude ?? 0) }}"
                         data-pole-lng="{{ (float)($pole->map_longitude ?? 0) }}"
                         data-dot="{{ $dotC }}">
                        <span class="pl-all-dot" style="background:{{ $dotC }};"></span>
                        <span class="pl-all-code">{{ $pole->pole_code }}</span>
                        <span style="font-size:.68rem;color:#9ca3af;">{{ $pole->pole_name ?: '' }}</span>
                        @if(in_array($pole->id, $sequences))
                            <span style="margin-left:auto;font-size:.62rem;color:#a78bfa;font-weight:800;">✓ in plan</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Map --}}
    <div id="planMap"></div>

</div>
</div>

{{-- Hidden save form --}}
<form id="saveForm" method="POST" action="{{ route('admin.pole-planner.save', $node->id) }}" style="display:none;">
    @csrf
    <input type="hidden" name="date" id="saveDate" value="{{ $date }}">
    <div id="savePoleInputs"></div>
</form>

@push('scripts')
<script src="/assets/libs/leaflet/leaflet.js"></script>
<script>
(function () {

    /* ── State ── */
    @php
        $polesJson = $poles->map(fn($p) => [
            'id'     => $p->id,
            'code'   => $p->pole_code,
            'name'   => $p->pole_name ?: $p->pole_code,
            'status' => $p->status ?? 'not_started',
            'lat'    => (float)($p->map_latitude ?? 0),
            'lng'    => (float)($p->map_longitude ?? 0),
        ]);
    @endphp
    const ALL_POLES = @json($polesJson);

    const SAVED_SEQ = @json($sequences);   // array of pole IDs in order

    let sequence = [];   // ordered array of pole objects in plan
    let dragSrc  = null;

    /* ── Colours ── */
    const C = {
        completed:   { fill:'#10b981', border:'#059669' },
        active:      { fill:'#f59e0b', border:'#d97706' },
        pending:     { fill:'#f59e0b', border:'#d97706' },
        not_started: { fill:'#94a3b8', border:'#64748b' },
    };
    function gc(s){ return C[s] || C.not_started; }

    /* ── Map ── */
    const map = L.map('planMap', { center:[12.3,122.5], zoom:6, zoomControl:true, attributionControl:false });
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        opacity:0.3, maxZoom:22, maxNativeZoom:19
    }).addTo(map);

    const markerMap = {};  // pole id → L.marker

    function buildPoleIcon(pole, seqNum) {
        const c    = gc(pole.status);
        const size = 34;
        const label = pole.code.replace(/^[A-Z0-9]+-/, '');
        const badge = seqNum
            ? `<div style="position:absolute;top:-9px;right:-9px;
                   background:#7c3aed;color:#fff;border:2px solid #fff;
                   border-radius:50%;width:20px;height:20px;
                   display:flex;align-items:center;justify-content:center;
                   font-size:9px;font-weight:900;box-shadow:0 2px 6px rgba(124,58,237,.5);">${seqNum}</div>`
            : '';
        return L.divIcon({
            className:'',
            html:`<div style="position:relative;width:${size}px;height:${size}px;">
                    <div style="width:${size}px;height:${size}px;border-radius:50%;border:3px solid ${c.border};
                         background:${c.fill};color:#fff;font-size:8px;font-weight:800;
                         display:flex;align-items:center;justify-content:center;
                         box-shadow:0 2px 8px rgba(0,0,0,.22);cursor:pointer;">${label}</div>
                    ${badge}
                  </div>`,
            iconSize:[size,size], iconAnchor:[size/2,size/2],
            tooltipAnchor:[0,-(size/2)-6],
        });
    }

    function buildTooltip(pole, seqNum) {
        const c = gc(pole.status);
        const badge = seqNum ? `<span style="background:#7c3aed;color:#fff;border-radius:999px;font-size:9px;font-weight:900;padding:1px 7px;margin-left:4px;">#${seqNum}</span>` : '';
        return `<div style="font-family:system-ui,sans-serif;background:#1e2433;color:#fff;border-radius:12px;padding:10px 14px;min-width:160px;box-shadow:0 6px 24px rgba(0,0,0,.4);">
            <div style="font-size:13px;font-weight:800;border-bottom:1px solid rgba(255,255,255,.1);padding-bottom:6px;margin-bottom:6px;">
                🔌 ${pole.code}${badge}
            </div>
            ${seqNum ? `<div style="display:flex;justify-content:space-between;font-size:11px;margin-top:4px;"><span style="color:#9ca3af;">Sequence</span><span style="color:#a78bfa;font-weight:800;">Step #${seqNum}</span></div>` : ''}
            <div style="display:flex;justify-content:space-between;font-size:11px;margin-top:4px;"><span style="color:#9ca3af;">Status</span><span style="font-weight:700;">${pole.status.replace(/_/g,' ')}</span></div>
            <div style="margin-top:8px;font-size:10px;color:#6b7280;font-weight:600;">${seqNum ? 'Click to remove from plan' : 'Click to add to plan'}</div>
        </div>`;
    }

    function refreshMarker(pole) {
        const seqNum = sequence.findIndex(p => p.id === pole.id);
        const num    = seqNum >= 0 ? seqNum + 1 : null;
        if (markerMap[pole.id]) {
            markerMap[pole.id].setIcon(buildPoleIcon(pole, num));
            markerMap[pole.id].setTooltipContent(buildTooltip(pole, num));
        }
    }

    /* ── Draw all poles ── */
    const bounds = [];
    ALL_POLES.forEach(pole => {
        if (!pole.lat || !pole.lng) return;
        const seqNum = null;
        const marker = L.marker([pole.lat, pole.lng], { icon: buildPoleIcon(pole, seqNum) })
            .addTo(map)
            .bindTooltip(buildTooltip(pole, seqNum), { sticky:true, direction:'top', opacity:1, className:'' });

        marker.on('click', () => togglePole(pole));
        markerMap[pole.id] = marker;
        bounds.push([pole.lat, pole.lng]);
    });
    if (bounds.length) {
        if (bounds.length === 1) map.setView(bounds[0], 16);
        else map.fitBounds(L.latLngBounds(bounds), { padding:[50,50], maxZoom:18 });
    }

    /* ── Toggle pole in/out of sequence ── */
    function togglePole(pole) {
        const idx = sequence.findIndex(p => p.id === pole.id);
        if (idx >= 0) {
            sequence.splice(idx, 1);
        } else {
            sequence.push(pole);
        }
        renderSidebar();
        // Refresh all markers (sequence numbers shifted)
        sequence.forEach((p, i) => refreshMarker(p));
        ALL_POLES.forEach(p => { if (!sequence.find(s => s.id === p.id)) refreshMarker(p); });
        updateAllPolesList();
        updateSaveButton();
    }

    /* ── Sidebar render ── */
    function renderSidebar() {
        const list  = document.getElementById('seqList');
        const empty = document.getElementById('seqEmpty');
        const count = document.getElementById('seqCount');
        count.textContent = sequence.length + ' pole' + (sequence.length !== 1 ? 's' : '');

        if (!sequence.length) {
            list.innerHTML = '';
            if (!empty) {
                const d = document.createElement('div');
                d.id = 'seqEmpty'; d.className = 'pl-sb-empty';
                d.innerHTML = '<i class="mgc_map_pin_line"></i>Click poles on the map to build the sequence';
                list.appendChild(d);
            }
            return;
        }

        const existingEmpty = document.getElementById('seqEmpty');
        if (existingEmpty) existingEmpty.remove();

        list.innerHTML = sequence.map((pole, i) => {
            const s = pole.status;
            const statusCls = 'status-' + (s || 'not_started');
            return `<div class="pl-sb-item" draggable="true" data-idx="${i}" data-id="${pole.id}">
                <div class="pl-seq-badge">${i + 1}</div>
                <div>
                    <div class="pl-sb-code">${pole.code}</div>
                    <div style="font-size:.64rem;color:#9ca3af;">${pole.name !== pole.code ? pole.name : ''}</div>
                </div>
                <span class="pl-sb-status ${statusCls}">${s.replace(/_/g,' ')}</span>
                <button class="pl-sb-remove" data-id="${pole.id}" title="Remove"><i class="mgc_close_line"></i></button>
            </div>`;
        }).join('');

        // Drag-to-reorder
        list.querySelectorAll('.pl-sb-item').forEach(item => {
            item.addEventListener('dragstart', e => { dragSrc = item; item.classList.add('dragging'); });
            item.addEventListener('dragend',   e => { item.classList.remove('dragging'); dragSrc = null; });
            item.addEventListener('dragover',  e => { e.preventDefault(); });
            item.addEventListener('drop', e => {
                e.preventDefault();
                if (!dragSrc || dragSrc === item) return;
                const fromIdx = +dragSrc.dataset.idx;
                const toIdx   = +item.dataset.idx;
                const moved   = sequence.splice(fromIdx, 1)[0];
                sequence.splice(toIdx, 0, moved);
                renderSidebar();
                ALL_POLES.forEach(p => refreshMarker(p));
                updateSaveButton();
            });
        });

        // Remove buttons
        list.querySelectorAll('.pl-sb-remove').forEach(btn => {
            btn.addEventListener('click', () => {
                const id  = +btn.dataset.id;
                const pole = ALL_POLES.find(p => p.id === id);
                if (pole) togglePole(pole);
            });
        });
    }

    /* ── All-poles list: mark in-plan ── */
    function updateAllPolesList() {
        document.querySelectorAll('.pl-all-item').forEach(item => {
            const id = +item.dataset.poleId;
            const inPlan = sequence.some(p => p.id === id);
            item.classList.toggle('in-plan', inPlan);
        });
    }

    /* ── All-poles list click handler ── */
    document.querySelectorAll('.pl-all-item').forEach(item => {
        item.addEventListener('click', () => {
            const pole = ALL_POLES.find(p => p.id === +item.dataset.poleId);
            if (pole) togglePole(pole);
        });
    });

    /* ── Save button ── */
    function updateSaveButton() {
        document.getElementById('btnSave').disabled = sequence.length === 0;
    }

    document.getElementById('btnSave').addEventListener('click', () => {
        const form   = document.getElementById('saveForm');
        const inputs = document.getElementById('savePoleInputs');
        inputs.innerHTML = sequence.map(p => `<input type="hidden" name="poles[]" value="${p.id}">`).join('');
        document.getElementById('saveDate').value = document.getElementById('planDate').value;
        form.submit();
    });

    /* ── Date change → reload page ── */
    document.getElementById('planDate').addEventListener('change', function() {
        const url = new URL(window.location.href);
        url.searchParams.set('date', this.value);
        window.location.href = url.toString();
    });

    document.getElementById('clearDate').value = document.getElementById('planDate').value;

    /* ── Load saved sequence on page load ── */
    if (SAVED_SEQ.length) {
        SAVED_SEQ.forEach(id => {
            const pole = ALL_POLES.find(p => p.id === id);
            if (pole) sequence.push(pole);
        });
        renderSidebar();
        sequence.forEach((p, i) => refreshMarker(p));
        updateAllPolesList();
        updateSaveButton();
    }

    /* ── Flash messages ── */
    @if(session('success'))
        const fl = document.createElement('div');
        fl.className = 'pl-flash ok';
        fl.textContent = '✓ {{ session("success") }}';
        document.body.appendChild(fl);
        setTimeout(() => fl.remove(), 3500);
    @endif
    @if(session('error'))
        const fle = document.createElement('div');
        fle.className = 'pl-flash err';
        fle.textContent = '✗ {{ session("error") }}';
        document.body.appendChild(fle);
        setTimeout(() => fle.remove(), 4000);
    @endif

})();
</script>
@endpush

</x-layout>
