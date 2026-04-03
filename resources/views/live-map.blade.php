<x-layout>

@push('styles')
<link rel="stylesheet" href="/assets/libs/leaflet/leaflet.css">
<style>
:root{
    --sans:"Instrument Sans","Plus Jakarta Sans","Manrope","Segoe UI",sans-serif;
    --mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,monospace;
}
body{ font-family:var(--sans); }

/* ── Page shell ──────────────────────────────────────────────── */
.lm-page{
    display:flex;flex-direction:column;
    height:calc(100vh - 64px);  /* subtract topbar height */
    padding:1rem 1.25rem 1.25rem;
    gap:.75rem;
    box-sizing:border-box;
}

/* ── Top bar ─────────────────────────────────────────────────── */
.lm-topbar{
    display:flex;align-items:center;gap:.75rem;flex-wrap:wrap;
    flex-shrink:0;
}
.lm-title{
    font-size:1.1rem;font-weight:900;color:#111827;letter-spacing:-.02em;
    display:flex;align-items:center;gap:.5rem;
}
.lm-pulse-dot{
    width:10px;height:10px;border-radius:50%;background:#22c55e;
    animation:livepulse 1.4s infinite;flex-shrink:0;
}
@keyframes livepulse{
    0%,100%{box-shadow:0 0 0 0 rgba(34,197,94,.55);}
    50%{box-shadow:0 0 0 7px rgba(34,197,94,0);}
}
.lm-count{
    font-size:.74rem;font-weight:800;color:#22c55e;
    background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.2);
    border-radius:999px;padding:.18rem .65rem;
}
.lm-sync{
    font-size:.7rem;color:#9ca3af;margin-left:auto;
}
.lm-tabs{
    display:flex;gap:.5rem;
    background:#f3f4f6;border-radius:10px;padding:3px;
}
.lm-tab{
    padding:.35rem .85rem;border-radius:8px;font-size:.78rem;font-weight:700;
    cursor:pointer;border:none;background:transparent;color:#6b7280;
    transition:all .15s;
}
.lm-tab.active{
    background:#fff;color:#111827;
    box-shadow:0 1px 4px rgba(17,24,39,.1);
}

/* ── Legend ──────────────────────────────────────────────────── */
.lm-legend{
    display:flex;align-items:center;gap:.85rem;
    font-size:.68rem;font-weight:700;color:#4b5563;
    flex-shrink:0;flex-wrap:wrap;
}
.legend-dot{width:9px;height:9px;border-radius:50%;display:inline-block;margin-right:.3rem;}

/* ── Main content ────────────────────────────────────────────── */
.lm-content{
    flex:1;min-height:0;
    display:grid;
    grid-template-columns:280px 1fr;
    gap:.75rem;
    border-radius:14px;
    overflow:hidden;
    border:1.5px solid #e5e7eb;
    box-shadow:0 4px 18px rgba(17,24,39,.06);
}

/* ── Sidebar ─────────────────────────────────────────────────── */
.lm-sidebar{
    background:#fff;
    display:flex;flex-direction:column;
    border-right:1px solid #e5e7eb;
    min-height:0;
    overflow:hidden;
}
.lm-sb-head{
    padding:.65rem .85rem;border-bottom:1px solid #f3f4f6;
    font-size:.72rem;font-weight:900;letter-spacing:.08em;
    text-transform:uppercase;color:#9ca3af;flex-shrink:0;
}
.lm-sb-search{
    width:100%;padding:.5rem .75rem;border:none;border-bottom:1px solid #f3f4f6;
    font-size:.8rem;font-family:var(--sans);color:#374151;outline:none;
    background:#fafafa;flex-shrink:0;
}
.lm-sb-search:focus{background:#fff;}
.lm-sb-list{
    flex:1;overflow-y:auto;
}
.lm-sb-item{
    display:flex;align-items:center;gap:.6rem;
    padding:.6rem .85rem;border-bottom:1px solid #f9fafb;
    cursor:pointer;transition:background .12s;
}
.lm-sb-item:hover{background:#f0f9ff;}
.lm-sb-avatar{
    width:34px;height:34px;border-radius:50%;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;
    color:#fff;font-size:.72rem;font-weight:900;
    border:2px solid #e5e7eb;
}
.lm-sb-info{min-width:0;}
.lm-sb-name{font-size:.8rem;font-weight:700;color:#111827;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.lm-sb-meta{font-size:.67rem;color:#9ca3af;margin-top:.1rem;}
.lm-sb-status{
    width:8px;height:8px;border-radius:50%;flex-shrink:0;margin-left:auto;
}
.lm-sb-empty{
    padding:2rem;text-align:center;color:#9ca3af;font-size:.8rem;
}

/* ── Map ─────────────────────────────────────────────────────── */
#lmMapEl{ width:100%;height:100%; }

/* ── Teardown feed panel ─────────────────────────────────────── */
.lm-feed{
    background:#fff;
    display:flex;flex-direction:column;
    min-height:0;overflow:hidden;
}
.lm-feed-head{
    padding:.75rem 1rem;border-bottom:1px solid #f3f4f6;
    display:flex;align-items:center;gap:.5rem;flex-shrink:0;
}
.lm-feed-title{font-size:.8rem;font-weight:900;color:#111827;}
.lm-feed-status{font-size:.67rem;color:#9ca3af;margin-left:auto;}
.lm-feed-list{flex:1;overflow-y:auto;padding:.5rem;}

.log-item{
    padding:.6rem .75rem;border-radius:10px;border:1px solid #f3f4f6;
    margin-bottom:.5rem;transition:border-color .15s;background:#fff;
}
.log-item:hover{border-color:#e0e7ff;background:#fafbff;}
.log-item.is-new{border-color:#bbf7d0;background:#f0fdf4;}
.log-span{font-size:.82rem;font-weight:800;color:#1e3a5f;margin-bottom:.2rem;}
.log-node{font-size:.72rem;color:#6b7280;margin-bottom:.3rem;}
.log-meta{display:flex;gap:.3rem;flex-wrap:wrap;align-items:center;}
.log-chip{
    font-size:.63rem;font-weight:700;padding:.15rem .45rem;
    border-radius:999px;white-space:nowrap;
}
.log-chip.cable{background:#eff6ff;color:#2563eb;}
.log-chip.team{background:#f5f3ff;color:#7c3aed;}
.log-chip.time{background:#f3f4f6;color:#6b7280;}
.log-chip.offline{background:#fef2f2;color:#dc2626;}

/* ── Avatar marker ───────────────────────────────────────────── */
.lm-avatar-wrap{display:flex;flex-direction:column;align-items:center;gap:2px;}
.lm-avatar{
    width:40px;height:40px;border-radius:50%;border:2.5px solid #22c55e;
    display:flex;align-items:center;justify-content:center;
    font-size:.72rem;font-weight:900;color:#fff;position:relative;overflow:visible;
}
.lm-avatar-pulse{
    position:absolute;inset:-4px;border-radius:50%;
    border:2px solid currentColor;animation:livepulse 1.6s infinite;
    pointer-events:none;
}
.lm-avatar-initials{position:relative;z-index:1;pointer-events:none;}
.lm-avatar img{width:100%;height:100%;border-radius:50%;object-fit:cover;}
.lm-name-tag{
    font-size:.62rem;font-weight:800;color:#fff;
    background:rgba(15,23,42,.72);padding:1px 5px;border-radius:4px;
    white-space:nowrap;
}
</style>
@endpush

<div class="col-span-full lm-page">

    {{-- Top bar --}}
    <div class="lm-topbar">
        <div class="lm-title">
            <span class="lm-pulse-dot"></span>
            Live Field Map
        </div>
        <span class="lm-count" id="lmCount">0 online</span>

        <div class="lm-tabs">
            <button class="lm-tab active" id="tabMap" onclick="switchTab('map')">
                <i class="mgc_map_line"></i> Lineman Map
            </button>
            <button class="lm-tab" id="tabFeed" onclick="switchTab('feed')">
                <i class="mgc_radar_line"></i> Teardown Feed
            </button>
        </div>

        <span class="lm-sync" id="lmSync"></span>
    </div>

    {{-- Legend --}}
    <div class="lm-legend">
        <span><span class="legend-dot" style="background:#22c55e;box-shadow:0 0 0 3px rgba(34,197,94,.2);"></span>Active &lt; 5 min</span>
        <span><span class="legend-dot" style="background:#f59e0b;"></span>Recent 5–30 min</span>
        <span><span class="legend-dot" style="background:#64748b;"></span>Idle &gt; 30 min</span>
        <span style="margin-left:auto;font-size:.67rem;color:#9ca3af;"><i class="mgc_refresh_2_line"></i> Auto-refresh 60s</span>
    </div>

    {{-- Map panel --}}
    <div class="lm-content" id="panelMap">
        <div class="lm-sidebar">
            <div class="lm-sb-head">Linemen Online</div>
            <input class="lm-sb-search" id="lmSearch" type="search" placeholder="Search lineman, subcon, team…" autocomplete="off">
            <div class="lm-sb-list" id="lmList">
                <div class="lm-sb-empty">Loading…</div>
            </div>
        </div>
        <div id="lmMapEl"></div>
    </div>

    {{-- Teardown feed panel (hidden by default) --}}
    <div class="lm-content" id="panelFeed" style="display:none;grid-template-columns:1fr;">
        <div class="lm-feed">
            <div class="lm-feed-head">
                <i class="mgc_radar_line" style="color:#6366f1;"></i>
                <span class="lm-feed-title">Live Teardown Feed</span>
                <span class="lm-feed-status" id="feedStatus">Loading…</span>
            </div>
            <div class="lm-feed-list" id="feedList"></div>
        </div>
    </div>

</div>

@push('scripts')
<script src="/assets/libs/leaflet/leaflet.js"></script>
<script>
(function(){
    'use strict';

    const LIVE_URL = '{{ route("reports.lineman-locations") }}';
    const FEED_URL = '{{ route("reports.live-teardown-feed") }}';

    /* ── Tab switching ──────────────────────────────────── */
    window.switchTab = function(tab) {
        document.getElementById('panelMap').style.display  = tab === 'map'  ? '' : 'none';
        document.getElementById('panelFeed').style.display = tab === 'feed' ? '' : 'none';
        document.getElementById('tabMap').classList.toggle('active',  tab === 'map');
        document.getElementById('tabFeed').classList.toggle('active', tab === 'feed');
        if (tab === 'map')  { initMap(); fetchLocations(); }
        if (tab === 'feed') { loadFeed(); }
    };

    /* ── Map ────────────────────────────────────────────── */
    const PALETTE = ['#2563eb','#7c3aed','#dc2626','#059669','#d97706','#0891b2','#db2777','#65a30d'];
    function avatarColor(id){ return PALETTE[id % PALETTE.length]; }
    function minsAgo(iso){ return (Date.now() - new Date(iso).getTime()) / 60000; }
    function statusColor(m){ return m < 5 ? '#22c55e' : m < 30 ? '#f59e0b' : '#64748b'; }
    function statusLabel(m){
        if(m < 1)  return 'Just now';
        if(m < 60) return Math.round(m) + ' min ago';
        return Math.round(m/60) + 'h ago';
    }

    let lmap = null;
    const markers = {};

    function initMap(){
        if(lmap) return;
        lmap = L.map('lmMapEl', { center:[12.3,122.5], zoom:6, zoomControl:true });
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution:'© OpenStreetMap', maxZoom:20
        }).addTo(lmap);
        setTimeout(() => lmap.invalidateSize(), 100);
        setTimeout(() => lmap.invalidateSize(), 400);
    }

    function buildIcon(u, mins){
        const bg   = avatarColor(u.user_id);
        const sc   = statusColor(mins);
        const init = (u.name||'?').split(' ').map(w=>w[0]).join('').substring(0,2).toUpperCase();
        const pulse = mins < 5 ? `<div class="lm-avatar-pulse" style="color:${sc};"></div>` : '';
        return L.divIcon({
            className:'',
            html:`<div class="lm-avatar-wrap">
                    <div class="lm-avatar" style="background:${bg};border-color:${sc};">
                        ${pulse}<span class="lm-avatar-initials">${init}</span>
                    </div>
                    <div class="lm-name-tag">${(u.name||'Lineman').split(' ')[0]}</div>
                  </div>`,
            iconSize:[44,58], iconAnchor:[22,58], popupAnchor:[0,-60],
        });
    }

    function buildPopup(u, mins){
        const sc   = statusColor(mins);
        const init = (u.name||'?').split(' ').map(w=>w[0]).join('').substring(0,2).toUpperCase();
        const rows = [
            u.subcon ? ['🏢 Subcon', u.subcon] : null,
            u.team   ? ['👥 Team',   u.team]   : null,
            u.role   ? ['🎖 Role',   u.role.replace(/_/g,' ').replace(/\b\w/g,c=>c.toUpperCase())] : null,
                       ['📍 Coords', `${(+u.latitude).toFixed(5)}, ${(+u.longitude).toFixed(5)}`],
        ].filter(Boolean);
        return `<div style="font-family:system-ui,sans-serif;min-width:210px;padding:2px 0;">
            <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:.7rem;">
                <div style="width:42px;height:42px;border-radius:50%;flex-shrink:0;
                            background:${avatarColor(u.user_id)};border:2.5px solid ${sc};
                            display:flex;align-items:center;justify-content:center;
                            color:#fff;font-size:.78rem;font-weight:900;">${init}</div>
                <div>
                    <div style="font-weight:900;font-size:.92rem;color:#0f172a;">${u.name||'Lineman'}</div>
                    <div style="display:flex;align-items:center;gap:.3rem;margin-top:.18rem;">
                        <span style="width:7px;height:7px;border-radius:50%;background:${sc};display:inline-block;"></span>
                        <span style="font-size:.68rem;font-weight:800;color:${sc};">${statusLabel(mins)}</span>
                    </div>
                </div>
            </div>
            <div style="background:#f8fafc;border-radius:10px;padding:.55rem .65rem;display:flex;flex-direction:column;gap:.32rem;">
                ${rows.map(([l,v])=>`<div style="display:flex;gap:.4rem;align-items:baseline;">
                    <span style="font-size:.62rem;font-weight:800;color:#94a3b8;min-width:58px;">${l}</span>
                    <span style="font-size:.74rem;font-weight:700;color:#1e293b;">${v}</span>
                </div>`).join('')}
            </div>
        </div>`;
    }

    let _lastList = [];

    function renderSidebar(list, query){
        const q = (query||'').toLowerCase().trim();
        const filtered = q ? list.filter(u =>
            (u.name||'').toLowerCase().includes(q) ||
            (u.subcon||'').toLowerCase().includes(q) ||
            (u.team||'').toLowerCase().includes(q)
        ) : list;

        const el = document.getElementById('lmList');
        if(!filtered.length){
            el.innerHTML = `<div class="lm-sb-empty">${q ? 'No match' : 'No linemen online'}</div>`;
            return;
        }

        el.innerHTML = filtered.map(u => {
            const mins = u.last_seen_at ? minsAgo(u.last_seen_at) : 9999;
            const sc   = statusColor(mins);
            const bg   = avatarColor(u.user_id);
            const init = (u.name||'?').split(' ').map(w=>w[0]).join('').substring(0,2).toUpperCase();
            const meta = [u.subcon, u.team].filter(Boolean).join(' · ') || statusLabel(mins);
            return `<div class="lm-sb-item" onclick="flyTo(${u.user_id})" title="Fly to ${u.name}">
                <div class="lm-sb-avatar" style="background:${bg};border-color:${sc};">${init}</div>
                <div class="lm-sb-info">
                    <div class="lm-sb-name">${u.name||'Lineman'}</div>
                    <div class="lm-sb-meta">${meta}</div>
                </div>
                <div class="lm-sb-status" style="background:${sc};"></div>
            </div>`;
        }).join('');
    }

    window.flyTo = function(uid){
        const u = _lastList.find(x => x.user_id === uid);
        if(u && lmap) lmap.flyTo([u.latitude, u.longitude], 17, { animate:true, duration:.9 });
    };

    async function fetchLocations(){
        try {
            const r = await fetch(LIVE_URL, { headers:{'X-Requested-With':'XMLHttpRequest'} });
            const list = await r.json();
            _lastList = list;

            document.getElementById('lmCount').textContent = list.length + ' online';
            document.getElementById('lmSync').textContent =
                'Synced ' + new Date().toLocaleTimeString('en-PH', {hour:'2-digit',minute:'2-digit',second:'2-digit'});

            renderSidebar(list, document.getElementById('lmSearch').value);

            const seen = new Set();
            list.forEach(u => {
                seen.add(u.user_id);
                const mins = u.last_seen_at ? minsAgo(u.last_seen_at) : 9999;
                const icon = buildIcon(u, mins);
                const popup = buildPopup(u, mins);
                if(markers[u.user_id]){
                    markers[u.user_id].setLatLng([u.latitude, u.longitude])
                        .setIcon(icon).setPopupContent(popup);
                } else {
                    markers[u.user_id] = L.marker([u.latitude, u.longitude], {icon})
                        .addTo(lmap).bindPopup(popup, {maxWidth:260});
                }
            });
            Object.keys(markers).forEach(uid => {
                if(!seen.has(+uid)){ lmap.removeLayer(markers[uid]); delete markers[uid]; }
            });

            if(list.length && Object.values(markers).length){
                try{ lmap.fitBounds(L.featureGroup(Object.values(markers)).getBounds().pad(.3)); } catch(e){}
            }
        } catch(e){
            document.getElementById('lmSync').textContent = 'Sync failed';
        }
    }

    document.getElementById('lmSearch').addEventListener('input', function(){
        renderSidebar(_lastList, this.value);
    });

    /* ── Teardown Feed ──────────────────────────────────── */
    function elapsedLabel(dt){
        if(!dt) return '';
        const diff = Math.floor((Date.now() - new Date(dt))/1000);
        if(diff < 60)    return diff+'s ago';
        if(diff < 3600)  return Math.floor(diff/60)+'m ago';
        if(diff < 86400) return Math.floor(diff/3600)+'h ago';
        return Math.floor(diff/86400)+'d ago';
    }

    let knownIds = new Set();

    async function loadFeed(){
        document.getElementById('feedStatus').textContent = 'Loading…';
        try {
            const r = await fetch(FEED_URL, { headers:{'X-Requested-With':'XMLHttpRequest'} });
            const data = await r.json();
            const logs = data.logs || [];

            const body = document.getElementById('feedList');
            if(!logs.length){
                body.innerHTML = '<div class="lm-sb-empty" style="padding:3rem;"><i class="mgc_file_line"></i> No teardown logs yet.</div>';
            } else {
                body.innerHTML = logs.map(log => {
                    const from = log.from_pole || '?';
                    const to   = log.to_pole   || '?';
                    const spanTxt = (log.from_pole && log.to_pole) ? `${from} → ${to}` : (log.span_code || `${from} → ${to}`);
                    const nodeTxt = [log.node_id, log.node_name].filter(Boolean).join(' — ');
                    const cableTxt = log.cable ? log.cable.toFixed(1)+' m cable' : '';
                    const teamTxt  = log.team || log.submitted_by || '';
                    const isNew = !knownIds.has(log.id);
                    knownIds.add(log.id);
                    return `<div class="log-item${isNew?' is-new':''}">
                        <div class="log-span">${spanTxt}</div>
                        <div class="log-node">${nodeTxt}</div>
                        <div class="log-meta">
                            ${cableTxt ? `<span class="log-chip cable">${cableTxt}</span>` : ''}
                            ${teamTxt  ? `<span class="log-chip team">${teamTxt}</span>`   : ''}
                            ${log.offline_mode ? '<span class="log-chip offline">Offline</span>' : ''}
                            <span class="log-chip time">${elapsedLabel(log.created_at)}</span>
                        </div>
                    </div>`;
                }).join('');
            }

            document.getElementById('feedStatus').textContent =
                'Updated ' + new Date().toLocaleTimeString('en-PH',{hour:'2-digit',minute:'2-digit'}) +
                ' · ' + logs.length + ' log' + (logs.length !== 1 ? 's' : '');
        } catch(e){
            document.getElementById('feedStatus').textContent = 'Failed to load';
        }
    }

    /* ── Boot ───────────────────────────────────────────── */
    initMap();
    fetchLocations();
    setInterval(fetchLocations, 60000);
    setInterval(() => {
        if(document.getElementById('panelFeed').style.display !== 'none') loadFeed();
    }, 30000);
})();
</script>
@endpush

</x-layout>
