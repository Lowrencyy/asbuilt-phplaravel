<x-layout>

@push('styles')
<link rel="stylesheet" href="/assets/libs/leaflet/leaflet.css"/>
<style>
:root{
    --sans:"Instrument Sans","Plus Jakarta Sans","Manrope","Segoe UI",sans-serif;
    --mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,monospace;
}
body{ font-family:var(--sans); }

.st-wrap{ padding:1.25rem 1.25rem 3rem; }

/* ── Header ─────────────────────────────────────────────────────── */
.st-top{
    display:flex;align-items:flex-end;justify-content:space-between;
    gap:1rem;margin-bottom:1.25rem;flex-wrap:wrap;
}
.st-eyebrow{
    display:inline-flex;align-items:center;gap:.5rem;
    padding:.35rem .72rem;border:1px solid #eef2f6;border-radius:999px;
    background:rgba(255,255,255,.9);font-size:.66rem;font-weight:800;
    letter-spacing:.14em;text-transform:uppercase;color:#6b7280;
    margin-bottom:.6rem;
}
.st-eyebrow::before{
    content:"";width:8px;height:8px;border-radius:50%;
    background:linear-gradient(135deg,#6366f1,#4f46e5);
    box-shadow:0 0 0 4px rgba(99,102,241,.1);
}
.st-title{ margin:0;font-size:clamp(1.5rem,2vw,2rem);font-weight:900;color:#111827;letter-spacing:-.04em; }
.st-sub{ margin:.3rem 0 0;color:#6b7280;font-size:.9rem; }

/* ── Search ─────────────────────────────────────────────────────── */
.st-search-wrap{ margin-bottom:1rem; }
.st-search{
    width:100%;max-width:420px;box-sizing:border-box;
    background:#fff;border:1.5px solid #e5e7eb;border-radius:12px;
    color:#111827;font-size:.85rem;padding:.52rem .85rem;outline:none;
    font-family:var(--sans);box-shadow:0 1px 4px rgba(17,24,39,.05);
    transition:border-color .14s;
}
.st-search:focus{ border-color:#6366f1; }

/* ── Stats bar ──────────────────────────────────────────────────── */
.st-stats{
    display:flex;gap:.75rem;flex-wrap:wrap;margin-bottom:1.25rem;
}
.st-stat-card{
    background:#fff;border:1px solid #eef2f6;border-radius:14px;
    padding:.6rem 1rem;display:flex;align-items:center;gap:.55rem;
    box-shadow:0 1px 6px rgba(17,24,39,.05);min-width:120px;
}
.st-stat-dot{ width:10px;height:10px;border-radius:50%;flex-shrink:0; }
.st-stat-label{ font-size:.68rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.06em; }
.st-stat-val{ font-size:1.15rem;font-weight:900;color:#111827;line-height:1; }

/* ── Node grid ──────────────────────────────────────────────────── */
.st-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(290px,1fr));
    gap:.85rem;
}
.st-card{
    background:#fff;border:1.5px solid #eef2f6;border-radius:20px;
    padding:1rem 1.15rem 1.05rem;
    box-shadow:0 2px 10px rgba(17,24,39,.05);
    cursor:pointer;
    transition:transform .16s ease,box-shadow .16s ease,border-color .16s ease;
}
.st-card:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 28px rgba(17,24,39,.09);
    border-color:#c7d2fe;
}
.st-card-top{
    display:flex;align-items:flex-start;justify-content:space-between;
    gap:.6rem;margin-bottom:.65rem;
}
.st-card-id{
    font-size:.68rem;font-weight:800;color:#6366f1;
    letter-spacing:.08em;text-transform:uppercase;font-family:var(--mono);
}
.st-card-name{
    font-size:.92rem;font-weight:900;color:#111827;
    margin:.15rem 0 .18rem;line-height:1.25;
}
.st-card-loc{ font-size:.7rem;color:#9ca3af;font-weight:600; }
.st-pct-badge{
    flex-shrink:0;font-size:.76rem;font-weight:900;
    padding:.28rem .62rem;border-radius:8px;
    border:1.5px solid;
}
.st-progress-bar{
    height:5px;border-radius:999px;background:#f3f4f6;
    overflow:hidden;margin:.5rem 0 .65rem;
}
.st-progress-fill{
    height:100%;border-radius:999px;
    transition:width .4s ease;
}
.st-card-stats{
    display:flex;gap:.55rem;flex-wrap:wrap;align-items:center;
}
.st-chip{
    display:inline-flex;align-items:center;gap:.28rem;
    font-size:.67rem;font-weight:800;padding:.2rem .5rem;border-radius:7px;
}
.st-chip-dot{ width:7px;height:7px;border-radius:50%;flex-shrink:0; }
.chip-green  { background:#ecfdf3;color:#15803d; }
.chip-amber  { background:#fff7ed;color:#b45309; }
.chip-blue   { background:#eef4ff;color:#1d4ed8; }
.chip-gray   { background:#f4f4f5;color:#52525b; }
.st-arrow{
    margin-left:auto;font-size:.72rem;color:#d1d5db;
}

/* ── Empty / loading ────────────────────────────────────────────── */
.st-empty{
    text-align:center;padding:4rem 1rem;color:#9ca3af;grid-column:1/-1;
}

/* ── Map overlay (full screen) ──────────────────────────────────── */
#stMapOverlay{
    position:fixed;inset:0;z-index:2000;
    background:#0f172a;
    display:flex;flex-direction:column;
    opacity:0;pointer-events:none;
    transition:opacity .22s;
}
#stMapOverlay.open{ opacity:1;pointer-events:all; }

.stm-hd{
    display:flex;align-items:center;gap:.75rem;
    padding:.7rem 1.1rem;
    background:#111827;border-bottom:1px solid #1e293b;
    flex-shrink:0;
}
.stm-back{
    background:#1e293b;border:1px solid #334155;color:#94a3b8;
    border-radius:8px;padding:.3rem .75rem;
    font-size:.76rem;font-weight:800;cursor:pointer;
    transition:all .14s;display:inline-flex;align-items:center;gap:.35rem;
    text-decoration:none;
}
.stm-back:hover{ background:#334155;color:#f1f5f9; }
.stm-title{ font-size:.9rem;font-weight:900;color:#f1f5f9; }
.stm-sub{ font-size:.69rem;color:#64748b;font-weight:600;margin-top:.1rem; }
.stm-close{
    margin-left:auto;width:34px;height:34px;border-radius:10px;
    background:#1e293b;border:1px solid #334155;color:#94a3b8;
    display:inline-flex;align-items:center;justify-content:center;
    cursor:pointer;font-size:1rem;transition:all .14s;
}
.stm-close:hover{ background:#dc2626;border-color:#dc2626;color:#fff; }

#stMapEl{ flex:1;min-height:0; }

.stm-legend{
    display:flex;align-items:center;gap:1.2rem;
    padding:.45rem 1.1rem;background:#111827;border-top:1px solid #1e293b;
    flex-shrink:0;flex-wrap:wrap;
}
.stm-ld{
    display:inline-flex;align-items:center;gap:.35rem;
    font-size:.68rem;font-weight:700;color:#64748b;
}
.stm-ld-dot{ width:10px;height:10px;border-radius:50%;flex-shrink:0; }

/* ── Leaflet tooltip overrides ──────────────────────────────────── */
.leaflet-tooltip{ font-family:var(--sans)!important;padding:0!important;background:none!important;border:none!important;box-shadow:none!important; }
.leaflet-tooltip-top:before{ display:none; }
.tt{ background:#1e2433;color:#fff;border-radius:12px;padding:11px 15px;min-width:190px;box-shadow:0 6px 24px rgba(0,0,0,.45);pointer-events:none; }
.tt-title{ font-size:13px;font-weight:800;margin-bottom:7px;border-bottom:1px solid rgba(255,255,255,.1);padding-bottom:6px; }
.tt-row{ display:flex;justify-content:space-between;font-size:11px;margin-top:5px;gap:12px; }
.tt-label{ color:#9ca3af;font-weight:600; }
.tt-val{ color:#fff;font-weight:700;text-align:right; }
.badge-tt{ display:inline-block;padding:2px 8px;border-radius:99px;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.4px; }
.pole-marker{ display:flex;align-items:center;justify-content:center;border-radius:50%;border:3px solid;font-weight:800;font-size:8px;box-shadow:0 2px 8px rgba(0,0,0,.22);cursor:pointer;transition:transform .15s,box-shadow .15s; }
.pole-marker:hover{ transform:scale(1.2);box-shadow:0 4px 18px rgba(0,0,0,.35); }
.leaflet-div-icon{ background:none!important;border:none!important; }
</style>
@endpush

<div class="col-span-full st-wrap">

    <div class="st-top">
        <div>
            <div class="st-eyebrow">Teardown Monitoring</div>
            <h2 class="st-title">Sequence Tracker</h2>
            <p class="st-sub">Node-by-node teardown progress — click any node to view its full map.</p>
        </div>
        <a href="{{ route('reports.teardown-logs.index') }}" class="stm-back" style="background:#fff;border-color:#e5e7eb;color:#374151;">
            <i class="mgc_arrow_left_line"></i> Live Teardown
        </a>
    </div>

    {{-- Summary stats --}}
    <div class="st-stats" id="stStats">
        <div class="st-stat-card">
            <span class="st-stat-dot" style="background:#6366f1;"></span>
            <div><div class="st-stat-label">Nodes</div><div class="st-stat-val" id="statNodes">—</div></div>
        </div>
        <div class="st-stat-card">
            <span class="st-stat-dot" style="background:#10b981;"></span>
            <div><div class="st-stat-label">Poles Done</div><div class="st-stat-val" id="statDone">—</div></div>
        </div>
        <div class="st-stat-card">
            <span class="st-stat-dot" style="background:#f59e0b;"></span>
            <div><div class="st-stat-label">Pending</div><div class="st-stat-val" id="statPending">—</div></div>
        </div>
        <div class="st-stat-card">
            <span class="st-stat-dot" style="background:#3b82f6;"></span>
            <div><div class="st-stat-label">Not Started</div><div class="st-stat-val" id="statNot">—</div></div>
        </div>
    </div>

    {{-- Search --}}
    <div class="st-search-wrap">
        <input class="st-search" id="stSearch" type="text" placeholder="🔍  Search node ID, name, city, province…" autocomplete="off">
    </div>

    {{-- Node grid --}}
    <div class="st-grid" id="stGrid">
        <div class="st-empty">Loading nodes…</div>
    </div>
</div>

{{-- ── Full-screen map overlay ──────────────────────────────────── --}}
<div id="stMapOverlay">
    <div class="stm-hd">
        <button class="stm-back" id="stMapBack"><i class="mgc_arrow_left_line"></i> Nodes</button>
        <div>
            <div class="stm-title" id="stMapTitle">—</div>
            <div class="stm-sub" id="stMapSub">—</div>
        </div>
        <button class="stm-close" id="stMapClose" title="Close"><i class="mgc_close_line"></i></button>
    </div>
    <div id="stMapEl"></div>
    <div class="stm-legend">
        <span class="stm-ld"><span class="stm-ld-dot" style="background:#10b981;"></span> Completed</span>
        <span class="stm-ld"><span class="stm-ld-dot" style="background:#f59e0b;"></span> Pending / Active</span>
        <span class="stm-ld"><span class="stm-ld-dot" style="background:#3b82f6;"></span> Not Started</span>
        <span class="stm-ld"><span class="stm-ld-dot" style="background:#ef4444;"></span> Canceled</span>
        <span class="stm-ld" style="margin-left:auto;font-size:.64rem;color:#334155;">Hover poles &amp; lines for details</span>
    </div>
</div>

@push('scripts')
<script src="/assets/libs/leaflet/leaflet.js"></script>
<script>
(function () {
    const NODES_URL    = '{{ route("reports.sequence-nodes") }}';
    const NODE_MAP_URL = '{{ url("reports/sequence-nodes") }}';

    let _all = [], smap = null;

    /* ── Status colours ── */
    const C = {
        completed:   { fill:'#10b981', border:'#059669', text:'#fff', badge:'background:#d1fae5;color:#065f46' },
        active:      { fill:'#f59e0b', border:'#d97706', text:'#fff', badge:'background:#fef3c7;color:#92400e' },
        pending:     { fill:'#f59e0b', border:'#d97706', text:'#fff', badge:'background:#fef3c7;color:#92400e' },
        not_started: { fill:'#3b82f6', border:'#2563eb', text:'#fff', badge:'background:#dbeafe;color:#1e40af' },
        canceled:    { fill:'#ef4444', border:'#dc2626', text:'#fff', badge:'background:#fee2e2;color:#991b1b' },
    };
    function gc(s){ return C[s] || C.not_started; }

    /* ── Render node cards ── */
    function renderCards(list) {
        const grid = document.getElementById('stGrid');
        if (!list.length) {
            grid.innerHTML = '<div class="st-empty">No nodes found.</div>';
            return;
        }
        grid.innerHTML = list.map(n => {
            const pct  = n.pct ?? 0;
            const barC = pct >= 100 ? '#10b981' : pct > 60 ? '#6366f1' : pct > 30 ? '#f59e0b' : '#ef4444';
            const bdC  = pct >= 100 ? '#d1fae5' : pct > 60 ? '#e0e7ff' : pct > 30 ? '#fef3c7' : '#fee2e2';
            const txtC = pct >= 100 ? '#065f46' : pct > 60 ? '#3730a3' : pct > 30 ? '#92400e' : '#991b1b';
            return `<div class="st-card" data-id="${n.id}" data-name="${(n.node_name||n.node_id||'').replace(/"/g,'&quot;')}" data-loc="${[n.city,n.province].filter(Boolean).join(', ')}">
                <div class="st-card-top">
                    <div>
                        <div class="st-card-id">${n.node_id||'—'}</div>
                        <div class="st-card-name">${n.node_name||n.node_id||'—'}</div>
                        <div class="st-card-loc">${[n.city,n.province,n.project].filter(Boolean).join(' · ')||'—'}</div>
                    </div>
                    <div class="st-pct-badge" style="color:${txtC};background:${bdC};border-color:${barC}55;">${pct}%</div>
                </div>
                <div class="st-progress-bar">
                    <div class="st-progress-fill" style="width:${Math.min(100,pct)}%;background:${barC};"></div>
                </div>
                <div class="st-card-stats">
                    <span class="st-chip chip-green"><span class="st-chip-dot" style="background:#10b981;"></span>${n.completed} done</span>
                    <span class="st-chip chip-amber"><span class="st-chip-dot" style="background:#f59e0b;"></span>${n.pending} pending</span>
                    <span class="st-chip chip-blue"><span class="st-chip-dot" style="background:#3b82f6;"></span>${n.not_started} not started</span>
                    <span class="st-chip chip-gray st-arrow">${n.spans_count} spans &rsaquo;</span>
                </div>
            </div>`;
        }).join('');

        grid.querySelectorAll('.st-card').forEach(card => {
            card.addEventListener('click', function() {
                openMap(+this.dataset.id, this.dataset.name, this.dataset.loc);
            });
        });
    }

    /* ── Load nodes + update stats ── */
    async function loadNodes() {
        try {
            const r = await fetch(NODES_URL, { headers:{ Accept:'application/json' } });
            _all    = await r.json();

            const totDone    = _all.reduce((s,n)=>s+n.completed,0);
            const totPending = _all.reduce((s,n)=>s+n.pending,0);
            const totNot     = _all.reduce((s,n)=>s+n.not_started,0);
            document.getElementById('statNodes').textContent   = _all.length;
            document.getElementById('statDone').textContent    = totDone;
            document.getElementById('statPending').textContent = totPending;
            document.getElementById('statNot').textContent     = totNot;

            renderCards(_all);
        } catch(e) {
            document.getElementById('stGrid').innerHTML =
                '<div class="st-empty" style="color:#ef4444;">Failed to load nodes.</div>';
        }
    }

    /* ── Search ── */
    document.getElementById('stSearch').addEventListener('input', function() {
        const q = this.value.toLowerCase().trim();
        renderCards(q ? _all.filter(n =>
            (n.node_id||'').toLowerCase().includes(q) ||
            (n.node_name||'').toLowerCase().includes(q) ||
            (n.city||'').toLowerCase().includes(q) ||
            (n.province||'').toLowerCase().includes(q) ||
            (n.project||'').toLowerCase().includes(q)
        ) : _all);
    });

    /* ── Open map overlay ── */
    async function openMap(nodeId, name, loc) {
        document.getElementById('stMapTitle').textContent = name;
        document.getElementById('stMapSub').textContent   = loc || '—';
        document.getElementById('stMapOverlay').classList.add('open');
        document.body.style.overflow = 'hidden';

        if (!smap) {
            smap = L.map('stMapEl', { center:[12.3,122.5], zoom:6, zoomControl:true, attributionControl:false });
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                opacity:0.28, maxZoom:22, maxNativeZoom:19
            }).addTo(smap);
        }
        smap.eachLayer(l => { if (!(l instanceof L.TileLayer)) smap.removeLayer(l); });
        setTimeout(() => smap.invalidateSize(), 80);
        setTimeout(() => smap.invalidateSize(), 350);

        try {
            const r    = await fetch(`${NODE_MAP_URL}/${nodeId}`, { headers:{ Accept:'application/json' } });
            const data = await r.json();
            drawMap(data.poles||[], data.spans||[]);
        } catch(e) { console.error('map load failed', e); }
    }

    function closeMap() {
        document.getElementById('stMapOverlay').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.getElementById('stMapBack').addEventListener('click', closeMap);
    document.getElementById('stMapClose').addEventListener('click', closeMap);
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMap(); });

    /* ── Draw poles + spans ── */
    function drawMap(poles, spans) {
        const bounds = [];

        spans.forEach(s => {
            if (!s.from_lat || !s.from_lng || !s.to_lat || !s.to_lng) return;
            const c    = gc(s.status);
            const opts = { color:c.fill, weight:4, opacity:s.status==='canceled'?0.45:0.88 };
            if (s.status === 'not_started' || s.status === 'canceled') opts.dashArray = '7,5';

            const line = L.polyline([[s.from_lat,s.from_lng],[s.to_lat,s.to_lng]], opts).addTo(smap);

            const rec = s.len > 0 ? Math.round((s.collected/s.len)*100) : 0;
            function compRow(label, col, exp) {
                if (!exp) return '';
                const ok = col >= exp;
                return `<div class="tt-row"><span class="tt-label">${label}</span><span class="tt-val" style="color:${ok?'#10b981':'#f59e0b'}">${col}/${exp}${ok?' ✓':' ⚠'}</span></div>`;
            }
            const unrecParts = [];
            if ((s.exp_node||0)-(s.col_node||0)>0) unrecParts.push('Node ×'+((s.exp_node||0)-(s.col_node||0)));
            if ((s.exp_amp||0)-(s.col_amp||0)>0)   unrecParts.push('AMP ×'+((s.exp_amp||0)-(s.col_amp||0)));
            if ((s.exp_ext||0)-(s.col_ext||0)>0)   unrecParts.push('EXT ×'+((s.exp_ext||0)-(s.col_ext||0)));
            if ((s.exp_tsc||0)-(s.col_tsc||0)>0)   unrecParts.push('TSC ×'+((s.exp_tsc||0)-(s.col_tsc||0)));
            const hasComp = s.exp_node||s.exp_amp||s.exp_ext||s.exp_tsc;

            const tt = `<div class="tt">
                <div class="tt-title">${s.seq ? `<span style="background:${c.fill};color:#fff;border-radius:50%;width:18px;height:18px;display:inline-flex;align-items:center;justify-content:center;font-size:10px;margin-right:5px;">${s.seq}</span>` : ''}📡 ${s.code}</div>
                ${s.seq?`<div class="tt-row"><span class="tt-label">Sequence</span><span class="tt-val" style="color:#10b981;">Step #${s.seq}</span></div>`:''}
                <div class="tt-row"><span class="tt-label">Status</span><span class="tt-val"><span class="badge-tt" style="${c.badge}">${s.status.replace(/_/g,' ')}</span></span></div>
                ${s.submitted_by?`<div class="tt-row"><span class="tt-label">By</span><span class="tt-val">👤 ${s.submitted_by}</span></div>`:''}
                <div style="border-top:1px solid rgba(255,255,255,.08);margin:6px 0 3px"></div>
                <div style="font-size:10px;color:#6b7280;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:3px">Cable</div>
                <div class="tt-row"><span class="tt-label">Span Length</span><span class="tt-val">${s.len} m</span></div>
                <div class="tt-row"><span class="tt-label">Collected</span><span class="tt-val">${s.collected} m</span></div>
                <div class="tt-row"><span class="tt-label">Recovery</span><span class="tt-val" style="color:${rec>=100?'#10b981':rec>50?'#f59e0b':'#ef4444'}">${rec}%</span></div>
                ${hasComp?`<div style="border-top:1px solid rgba(255,255,255,.08);margin:6px 0 3px"></div>
                <div style="font-size:10px;color:#6b7280;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:3px">Components</div>
                ${compRow('Node',s.col_node||0,s.exp_node||0)}
                ${compRow('Amplifier',s.col_amp||0,s.exp_amp||0)}
                ${compRow('Extender',s.col_ext||0,s.exp_ext||0)}
                ${compRow('TSC',s.col_tsc||0,s.exp_tsc||0)}`:''}
                ${unrecParts.length?`<div style="border-top:1px solid rgba(239,68,68,.3);margin:6px 0 3px"></div>
                <div style="font-size:10px;color:#ef4444;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:3px">⚠ Unrecovered</div>
                <div class="tt-row"><span class="tt-label" style="color:#fca5a5">Items</span><span class="tt-val" style="color:#fca5a5">${unrecParts.join(' · ')}</span></div>`:''}
                ${s.completed_at?`<div style="border-top:1px solid rgba(255,255,255,.08);margin:6px 0 3px"></div>
                <div class="tt-row"><span class="tt-label">Done</span><span class="tt-val">${s.completed_at}</span></div>`:''}
            </div>`;
            line.bindTooltip(tt, { sticky:true, direction:'top', opacity:1, className:'', offset:[0,-4] });

            // Midpoint distance label
            if (s.len > 0) {
                const ml=(s.from_lat+s.to_lat)/2, mg=(s.from_lng+s.to_lng)/2;
                L.marker([ml,mg],{ icon:L.divIcon({
                    className:'',
                    html:`<span style="font:700 11px 'Inter',sans-serif;color:#f1f5f9;background:#1e293b;padding:3px 8px;border-radius:6px;white-space:nowrap;display:inline-block;box-shadow:0 1px 6px rgba(0,0,0,.45);border:1px solid ${c.fill}55;">${s.len} m</span>`,
                    iconSize:[80,22], iconAnchor:[40,11]
                }), interactive:false }).addTo(smap);
            }
        });

        poles.forEach(p => {
            if (!p.lat || !p.lng) return;
            const c    = gc(p.status);
            const size = 33;
            const label= p.code.replace(/^[A-Z0-9]+-/,'');

            // Sequence badge — small circle attached top-right of the pole
            const seqHtml = p.seq
                ? `<div style="position:absolute;top:-8px;right:-8px;
                       background:#1e293b;color:#f1f5f9;border:2px solid ${c.fill};
                       border-radius:50%;width:20px;height:20px;
                       display:flex;align-items:center;justify-content:center;
                       font-size:9px;font-weight:900;line-height:1;
                       box-shadow:0 2px 6px rgba(0,0,0,.45);z-index:10;">${p.seq}</div>`
                : '';

            const icon = L.divIcon({
                className:'',
                html:`<div style="position:relative;width:${size}px;height:${size}px;">
                        <div class="pole-marker" style="width:${size}px;height:${size}px;background:${c.fill};border-color:${c.border};color:${c.text};">${label}</div>
                        ${seqHtml}
                      </div>`,
                iconSize:[size,size], iconAnchor:[size/2,size/2]
            });

            const tt = `<div class="tt">
                <div class="tt-title">🔌 ${p.code}${p.seq ? ` <span style="background:#1e293b;border:1px solid ${c.fill};color:${c.fill};border-radius:999px;font-size:9px;font-weight:900;padding:1px 7px;margin-left:4px;">#${p.seq}</span>` : ''}</div>
                ${p.seq ? `<div class="tt-row"><span class="tt-label">Sequence</span><span class="tt-val" style="color:#10b981;">Step #${p.seq}</span></div>` : ''}
                <div class="tt-row"><span class="tt-label">Status</span><span class="tt-val"><span class="badge-tt" style="${c.badge}">${p.status.replace(/_/g,' ')}</span></span></div>
                ${p.completed_at?`<div class="tt-row"><span class="tt-label">Completed</span><span class="tt-val">${p.completed_at}</span></div>`:''}
            </div>`;
            L.marker([p.lat,p.lng],{icon}).addTo(smap)
              .bindTooltip(tt,{sticky:true,direction:'top',opacity:1,className:'',offset:[0,-(size/2)-6]});
            bounds.push([p.lat,p.lng]);
        });

        if (bounds.length) {
            if (bounds.length === 1) smap.setView(bounds[0], 16);
            else smap.fitBounds(L.latLngBounds(bounds), { padding:[65,65], maxZoom:18 });
        }
    }

    /* ── Boot ── */
    loadNodes();
})();
</script>
@endpush

</x-layout>
