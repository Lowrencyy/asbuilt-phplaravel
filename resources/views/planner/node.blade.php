<x-layout>

@push('styles')
<link rel="stylesheet" href="/assets/libs/leaflet/leaflet.css"/>
<style>
*,*::before,*::after{box-sizing:border-box;}
:root{
  --p:#2563eb;--p2:#1d4ed8;--pg:rgba(37,99,235,.08);
  --surf:#ffffff;--surf2:#f8fafc;
  --bdr:#e2e8f0;--txt:#0f172a;--txt2:#475569;--muted:#94a3b8;
  --r:14px;--sh:0 1px 3px rgba(15,23,42,.05),0 4px 16px rgba(15,23,42,.07);
  --ff:system-ui,-apple-system,sans-serif;--fm:'JetBrains Mono','Fira Mono',monospace;
  --green:#16a34a;--amber:#d97706;
}
body{font-family:var(--ff);}

.pl-wrap{padding:1rem 1.5rem 2.5rem;display:flex;flex-direction:column;gap:1rem;}

/* breadcrumb */
.bc{display:flex;align-items:center;gap:.4rem;font-size:.75rem;color:var(--muted);margin-bottom:.1rem;}
.bc a{color:var(--p);text-decoration:none;font-weight:600;}
.bc a:hover{text-decoration:underline;}

.pg-hd{display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap;}
.pg-hd h2{margin:.1rem 0 0;font-size:1.4rem;font-weight:900;color:var(--txt);letter-spacing:-.02em;}
.pg-hd p{margin:.15rem 0 0;font-size:.77rem;color:var(--txt2);}

/* flash */
.flash{display:flex;align-items:center;gap:.5rem;padding:.65rem 1rem;border-radius:10px;font-size:.8rem;font-weight:600;}
.flash-ok{background:rgba(22,163,74,.08);border:1px solid rgba(22,163,74,.2);color:#15803d;}
.flash-err{background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);color:#dc2626;}

/* split layout */
.split{display:grid;grid-template-columns:340px 1fr;gap:1rem;align-items:start;}
@media(max-width:1100px){.split{grid-template-columns:1fr;}}

/* left: pole list */
.pole-panel{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;display:flex;flex-direction:column;}
.panel-hd{display:flex;align-items:center;gap:.5rem;padding:.75rem 1rem;border-bottom:1px solid var(--bdr);background:var(--surf2);flex-shrink:0;}
.panel-title{font-size:.82rem;font-weight:800;color:var(--txt);}
.sec-badge{padding:.15rem .5rem;border-radius:999px;background:var(--pg);color:var(--p);font-size:.65rem;font-weight:700;margin-left:auto;}

/* search */
.search-box{padding:.6rem .8rem;border-bottom:1px solid var(--bdr);flex-shrink:0;}
.search-input{width:100%;border:1px solid var(--bdr);border-radius:8px;padding:.4rem .7rem;font-size:.8rem;font-family:var(--ff);color:var(--txt);background:var(--surf);outline:none;}
.search-input:focus{border-color:var(--p);}

/* pole list */
.pole-list{overflow-y:auto;max-height:calc(100vh - 300px);min-height:200px;}
.pole-row{display:flex;align-items:center;gap:.6rem;padding:.65rem 1rem;border-bottom:1px solid var(--bdr);cursor:pointer;transition:background .1s;}
.pole-row:last-child{border-bottom:none;}
.pole-row:hover{background:var(--surf2);}
.pole-row.active{background:#eff6ff;border-left:3px solid var(--p);}
.pole-code{font-family:var(--fm);font-size:.78rem;font-weight:700;color:var(--txt);flex:1;}
.gps-badge{display:inline-flex;align-items:center;gap:.25rem;font-size:.65rem;font-weight:700;padding:.18rem .5rem;border-radius:6px;}
.gps-on{background:rgba(22,163,74,.1);color:#15803d;}
.gps-off{background:rgba(217,119,6,.1);color:#b45309;}
.pole-coords{font-size:.65rem;color:var(--muted);font-family:var(--fm);}

/* right: map panel */
.map-panel{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;}
.map-hd{display:flex;align-items:center;gap:.5rem;padding:.75rem 1rem;border-bottom:1px solid var(--bdr);background:var(--surf2);}
#nodeMap{height:calc(100vh - 320px);min-height:460px;width:100%;}

/* GPS save bar */
.gps-bar{display:flex;align-items:center;gap:.75rem;padding:.75rem 1rem;border-top:1px solid var(--bdr);background:var(--surf2);flex-wrap:wrap;}
.gps-coords{font-family:var(--fm);font-size:.78rem;color:var(--txt);flex:1;}
.gps-coords span{color:var(--muted);font-size:.7rem;}
.btn-save{display:inline-flex;align-items:center;gap:.35rem;padding:.48rem 1.1rem;background:var(--green);color:#fff;border:none;border-radius:9px;font-size:.8rem;font-weight:700;font-family:var(--ff);cursor:pointer;}
.btn-save:disabled{opacity:.45;cursor:not-allowed;}
.btn-save:not(:disabled):hover{background:#15803d;}
.hint{font-size:.72rem;color:var(--muted);}

/* Assign popup (floating card on map click) */
.assign-overlay{position:fixed;inset:0;background:rgba(15,23,42,.35);z-index:9000;display:flex;align-items:flex-end;justify-content:center;}
.assign-card{background:#fff;border-radius:20px 20px 0 0;width:100%;max-width:540px;padding:0 0 1rem;box-shadow:0 -4px 30px rgba(15,23,42,.15);animation:slideUp .22s ease;}
@keyframes slideUp{from{transform:translateY(60px);opacity:0}to{transform:translateY(0);opacity:1}}
.assign-handle{width:40px;height:4px;border-radius:2px;background:#e2e8f0;margin:12px auto 10px;}
.assign-header{padding:.1rem 1rem .65rem;}
.assign-title{font-size:.95rem;font-weight:800;color:var(--txt);}
.assign-coords{display:inline-flex;align-items:center;gap:.4rem;background:#eff6ff;border-radius:8px;padding:.3rem .65rem;font-family:var(--fm);font-size:.75rem;color:var(--p);font-weight:700;margin-top:.35rem;}
.assign-search-wrap{padding:.1rem 1rem .5rem;}
.assign-search{width:100%;border:1.5px solid var(--bdr);border-radius:10px;padding:.45rem .75rem .45rem 2.2rem;font-size:.82rem;font-family:var(--ff);color:var(--txt);background:var(--surf);outline:none;}
.assign-search:focus{border-color:var(--p);}
.assign-search-icon{position:absolute;left:1.7rem;top:50%;transform:translateY(-50%);color:var(--muted);font-size:.95rem;pointer-events:none;}
.assign-list{max-height:260px;overflow-y:auto;border-top:1px solid var(--bdr);}
.assign-row{display:flex;align-items:center;gap:.65rem;padding:.6rem 1rem;border-bottom:1px solid var(--bdr);cursor:pointer;transition:background .1s;}
.assign-row:last-child{border-bottom:none;}
.assign-row:hover{background:var(--surf2);}
.assign-pole-code{font-family:var(--fm);font-size:.8rem;font-weight:700;color:var(--txt);flex:1;}
.assign-pole-loc{font-size:.68rem;color:var(--muted);}
.assign-btn{display:inline-flex;align-items:center;gap:.3rem;padding:.3rem .75rem;background:var(--p);color:#fff;border:none;border-radius:8px;font-size:.75rem;font-weight:700;font-family:var(--ff);cursor:pointer;}
.assign-btn:hover{background:var(--p2);}
.assign-btn.saving{opacity:.6;cursor:not-allowed;}
.assign-empty{text-align:center;padding:2rem;color:var(--muted);font-size:.8rem;}
.assign-cancel{display:block;width:calc(100% - 2rem);margin:.75rem 1rem 0;padding:.7rem;background:var(--surf2);border:1px solid var(--bdr);border-radius:10px;font-size:.82rem;font-weight:700;color:var(--txt2);cursor:pointer;font-family:var(--ff);}
.assign-cancel:hover{background:#e9ecef;}

/* popup */
.leaflet-popup-content-wrapper{border-radius:12px!important;box-shadow:0 4px 20px rgba(15,23,42,.15)!important;border:1px solid #e2e8f0!important;}
.leaflet-popup-tip{display:none!important;}

/* Map location search */
.map-search-wrap{position:absolute;top:10px;left:50%;transform:translateX(-50%);z-index:1000;width:320px;max-width:calc(100% - 80px);}
.map-search-inner{display:flex;background:#fff;border:1px solid var(--bdr);border-radius:10px;box-shadow:0 4px 18px rgba(15,23,42,.14);overflow:hidden;}
.map-search-input{flex:1;border:none;outline:none;padding:.52rem .75rem;font-size:.82rem;font-family:var(--ff);color:var(--txt);background:transparent;}
.map-search-input::placeholder{color:var(--muted);}
.map-search-btn{padding:.52rem .8rem;background:var(--p);border:none;color:#fff;cursor:pointer;font-size:.85rem;display:flex;align-items:center;}
.map-search-btn:hover{background:var(--p2);}
.map-search-results{background:#fff;border:1px solid var(--bdr);border-radius:0 0 10px 10px;border-top:none;max-height:220px;overflow-y:auto;box-shadow:0 8px 24px rgba(15,23,42,.13);}
.map-search-item{padding:.55rem .8rem;font-size:.78rem;cursor:pointer;border-bottom:1px solid var(--bdr);color:var(--txt);line-height:1.35;}
.map-search-item:last-child{border-bottom:none;}
.map-search-item:hover{background:var(--surf2);}
.map-search-empty{padding:.7rem .8rem;font-size:.78rem;color:var(--muted);text-align:center;}
.map-search-spinner{padding:.6rem .8rem;font-size:.75rem;color:var(--muted);text-align:center;}
</style>
@endpush

<div class="col-span-full pl-wrap">

    {{-- Breadcrumb + header --}}
    <div>
        <div class="bc">
            <a href="{{ route('planner.index') }}"><i class="mgc_location_line"></i> Pole GPS Planner</a>
            <span>/</span>
            <span>{{ $node->project?->project_name ?? 'Project' }}</span>
            <span>/</span>
            <span>{{ $node->node_id }}</span>
        </div>
        <div class="pg-hd">
            <div>
                <h2>{{ $node->node_id }}{{ $node->node_name ? ' — '.$node->node_name : '' }}</h2>
                <p>
                    📍 {{ $node->city }}{{ $node->province ? ', '.$node->province : '' }}
                    &nbsp;·&nbsp; {{ $poles->count() }} poles
                    &nbsp;·&nbsp;
                    @php $withGps = $poles->whereNotNull('map_latitude')->count(); @endphp
                    <span style="color:#16a34a;font-weight:700;">{{ $withGps }} with GPS</span>
                    &nbsp;/&nbsp;
                    <span style="color:#d97706;font-weight:700;">{{ $poles->count() - $withGps }} missing</span>
                </p>
            </div>
            <a href="{{ route('planner.index') }}" style="display:inline-flex;align-items:center;gap:.35rem;padding:.46rem .9rem;border:1px solid var(--bdr);border-radius:10px;background:var(--surf);color:var(--txt2);font-size:.8rem;font-weight:600;text-decoration:none;">
                <i class="mgc_arrow_left_line"></i> Back
            </a>
        </div>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div class="flash flash-ok"><i class="mgc_check_circle_line"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash flash-err"><i class="mgc_close_circle_line"></i> {{ session('error') }}</div>
    @endif

    {{-- Split pane --}}
    <div class="split">

        {{-- LEFT: Pole list --}}
        <div class="pole-panel">
            <div class="panel-hd">
                <i class="mgc_vertical_align_top_line" style="color:var(--p);font-size:1rem;"></i>
                <span class="panel-title">Poles</span>
                <span class="sec-badge">{{ $poles->count() }} total</span>
            </div>
            <div class="search-box">
                <input type="text" class="search-input" id="poleSearch" placeholder="Search pole code…" oninput="filterPoles(this.value)"/>
            </div>
            <div class="pole-list" id="poleList">
                @forelse($poles as $pole)
                    <div class="pole-row"
                         id="pr-{{ $pole->id }}"
                         onclick="selectPole({{ $pole->id }}, '{{ addslashes($pole->pole_code ?? 'Pole #'.$pole->id) }}', {{ $pole->map_latitude ?? 'null' }}, {{ $pole->map_longitude ?? 'null' }})">
                        <div style="flex:1;min-width:0;">
                            <div class="pole-code">{{ $pole->pole_code ?? "Pole #{$pole->id}" }}</div>
                            @if($pole->map_latitude && $pole->map_longitude)
                                <div class="pole-coords">{{ number_format((float)$pole->map_latitude,6) }}, {{ number_format((float)$pole->map_longitude,6) }}</div>
                            @endif
                        </div>
                        @if($pole->map_latitude && $pole->map_longitude)
                            <span class="gps-badge gps-on"><i class="mgc_location_line"></i> GPS</span>
                        @else
                            <span class="gps-badge gps-off"><i class="mgc_location_off_line"></i> No GPS</span>
                        @endif
                    </div>
                @empty
                    <div style="padding:2rem;text-align:center;color:var(--muted);font-size:.8rem;">No poles in this node.</div>
                @endforelse
            </div>
        </div>

        {{-- RIGHT: Map --}}
        <div class="map-panel">
            <div class="map-hd">
                <i class="mgc_map_line" style="color:var(--p);font-size:1rem;"></i>
                <span class="panel-title">Map</span>
                <span style="font-size:.72rem;color:var(--muted);margin-left:auto;">
                    Click map or drag pin to set GPS &nbsp;·&nbsp;
                    <span style="color:#16a34a;font-weight:700;">●</span> Has GPS &nbsp;
                    <span style="color:#d97706;font-weight:700;">●</span> No GPS &nbsp;
                    <span style="color:#2563eb;font-weight:700;">●</span> Selected
                </span>
            </div>
            <div style="position:relative;">
              <div id="nodeMap"></div>
              <div class="map-search-wrap" id="mapSearchWrap">
                <div class="map-search-inner">
                  <input id="mapSearchInput" class="map-search-input" type="text" placeholder="Search location…" autocomplete="off"/>
                  <button class="map-search-btn" onclick="doMapSearch()"><i class="mgc_search_line"></i></button>
                </div>
                <div id="mapSearchResults" style="display:none;" class="map-search-results"></div>
              </div>
            </div>
            <div class="gps-bar">
                <i class="mgc_touch_line" style="color:var(--muted);font-size:1rem;"></i>
                <span style="font-size:.78rem;color:var(--muted);">Click anywhere on the map to assign GPS to a pole &nbsp;·&nbsp; Drag existing pins to reposition</span>
            </div>
        </div>

    </div>

</div>

{{-- Assign GPS popup --}}
<div class="assign-overlay" id="assignOverlay" style="display:none;" onclick="if(event.target===this)closeAssign()">
    <div class="assign-card">
        <div class="assign-handle"></div>
        <div class="assign-header">
            <div class="assign-title">📍 Assign GPS Coordinates</div>
            <div class="assign-coords" id="assignCoords">—</div>
        </div>
        <div class="assign-search-wrap" style="position:relative;">
            <i class="mgc_search_line assign-search-icon"></i>
            <input type="text" class="assign-search" id="assignSearch" placeholder="Search pole code…" oninput="filterAssign(this.value)" autocomplete="off"/>
        </div>
        <div class="assign-list" id="assignList"></div>
        <button class="assign-cancel" onclick="closeAssign()">Cancel</button>
    </div>
</div>

<script src="/assets/libs/leaflet/leaflet.js"></script>
<script>
(function(){
    const ALL_POLES   = @json($mapPoles);
    const ALL_POLES_FULL = @json($poles->map(fn($p) => ['id'=>$p->id,'code'=>$p->pole_code ?? 'Pole #'.$p->id,'has_gps'=>!!($p->map_latitude && $p->map_longitude)]));
    const CSRF        = '{{ csrf_token() }}';
    const GPS_URL_TPL = '{{ route("planner.poles.gps", ":id") }}';

    const PH = [14.5995, 120.9842];

    const map = L.map('nodeMap', { center: PH, zoom: 13 });

    // OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 20,
    }).addTo(map);

    // Teardrop pin SVG
    function pinSvg(color, size) {
        const s = size || 26, h = Math.round(s * 36 / 28);
        return `<svg xmlns="http://www.w3.org/2000/svg" width="${s}" height="${h}" viewBox="0 0 28 36">
            <path d="M14 0C6.268 0 0 6.268 0 14c0 9.333 14 22 14 22S28 23.333 28 14C28 6.268 21.732 0 14 0z"
                  fill="${color}" stroke="#fff" stroke-width="2.5"/>
            <circle cx="14" cy="13" r="5" fill="#fff" opacity=".9"/>
        </svg>`;
    }
    function pinIcon(color, size) {
        const s = size || 26, h = Math.round(s * 36 / 28);
        return L.divIcon({ className:'', html: pinSvg(color, s),
            iconSize:[s,h], iconAnchor:[s/2,h], popupAnchor:[0,-h-2] });
    }

    const markerMap = {}; // pole_id → marker

    // Place existing GPS markers (draggable)
    ALL_POLES.forEach(p => {
        if (!p.has_gps) return;
        const m = L.marker([p.lat, p.lng], { icon: pinIcon('#e11d48'), draggable: true })
            .addTo(map)
            .bindPopup(makePopup(p.code, p.lat, p.lng), { maxWidth: 220 });
        m.on('dragend', e => onDragEnd(p.id, p.code, e.target.getLatLng()));
        markerMap[p.id] = m;
    });

    // Fit to existing GPS markers
    const withGps = ALL_POLES.filter(p => p.has_gps);
    if (withGps.length) {
        map.fitBounds(L.latLngBounds(withGps.map(p => [p.lat, p.lng])), { padding:[50,50] });
    }

    function makePopup(code, lat, lng) {
        return `<div style="font-family:system-ui;min-width:170px;">
            <b style="font-size:.85rem;color:#0f172a;">${code}</b>
            <div style="font-size:.7rem;color:#94a3b8;font-family:monospace;margin-top:.2rem;">${(+lat).toFixed(6)}, ${(+lng).toFixed(6)}</div>
            <div style="font-size:.7rem;color:#94a3b8;margin-top:.2rem;">Drag to reposition</div>
        </div>`;
    }

    // ── Map click → open Assign popup ────────────────────────────────────────
    let pendingLat = null, pendingLng = null;

    map.on('click', function(e) {
        pendingLat = e.latlng.lat;
        pendingLng = e.latlng.lng;
        openAssign(pendingLat, pendingLng);
    });

    window.openAssign = function(lat, lng) {
        pendingLat = lat; pendingLng = lng;
        document.getElementById('assignCoords').textContent = lat.toFixed(7) + ',  ' + lng.toFixed(7);
        document.getElementById('assignSearch').value = '';
        renderAssignList('');
        document.getElementById('assignOverlay').style.display = 'flex';
        setTimeout(() => document.getElementById('assignSearch').focus(), 150);
    };

    window.closeAssign = function() {
        document.getElementById('assignOverlay').style.display = 'none';
    };

    window.filterAssign = function(q) { renderAssignList(q); };

    function renderAssignList(q) {
        const lq = q.toLowerCase().trim();
        const filtered = lq
            ? ALL_POLES_FULL.filter(p => p.code.toLowerCase().includes(lq))
            : ALL_POLES_FULL;
        const list = document.getElementById('assignList');
        if (!filtered.length) {
            list.innerHTML = '<div class="assign-empty">No poles match "' + q + '"</div>';
            return;
        }
        list.innerHTML = filtered.map(p => `
            <div class="assign-row" onclick="assignGps(${p.id}, '${p.code.replace(/'/g,"\\'")}')">
                <div>
                    <div class="assign-pole-code">${p.code}</div>
                    <div class="assign-pole-loc">${p.has_gps ? '✅ GPS set' : '⚠️ No GPS yet'}</div>
                </div>
                <button class="assign-btn" id="abtn-${p.id}" onclick="event.stopPropagation();assignGps(${p.id},'${p.code.replace(/'/g,"\\'")}')">
                    <i class="mgc_location_line"></i> Assign
                </button>
            </div>`).join('');
    }

    window.assignGps = async function(poleId, code) {
        const btn = document.getElementById('abtn-' + poleId);
        if (btn) { btn.classList.add('saving'); btn.textContent = 'Saving…'; }

        try {
            const resp = await fetch(GPS_URL_TPL.replace(':id', poleId), {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                body: JSON.stringify({ map_latitude: pendingLat, map_longitude: pendingLng }),
            });

            if (!resp.ok) throw new Error('Server error');

            // Update or add marker on map
            if (markerMap[poleId]) {
                markerMap[poleId].setLatLng([pendingLat, pendingLng]);
                markerMap[poleId].setPopupContent(makePopup(code, pendingLat, pendingLng));
            } else {
                const m = L.marker([pendingLat, pendingLng], { icon: pinIcon('#e11d48'), draggable: true })
                    .addTo(map)
                    .bindPopup(makePopup(code, pendingLat, pendingLng), { maxWidth: 220 });
                m.on('dragend', e => onDragEnd(poleId, code, e.target.getLatLng()));
                markerMap[poleId] = m;
            }

            // Update left pole list badge
            const badge = document.querySelector(`#pr-${poleId} .gps-badge`);
            if (badge) {
                badge.className = 'gps-badge gps-on';
                badge.innerHTML = '<i class="mgc_location_line"></i> GPS';
            }
            const coordEl = document.querySelector(`#pr-${poleId} .pole-coords`);
            if (!coordEl) {
                const codeEl = document.querySelector(`#pr-${poleId} .pole-code`);
                if (codeEl) {
                    const c = document.createElement('div');
                    c.className = 'pole-coords';
                    c.textContent = pendingLat.toFixed(6) + ', ' + pendingLng.toFixed(6);
                    codeEl.parentNode.appendChild(c);
                }
            } else {
                coordEl.textContent = pendingLat.toFixed(6) + ', ' + pendingLng.toFixed(6);
            }

            // Update ALL_POLES_FULL in memory
            const entry = ALL_POLES_FULL.find(p => p.id === poleId);
            if (entry) entry.has_gps = true;

            closeAssign();

            // Flash success toast
            showToast('✓ GPS saved for ' + code);
        } catch {
            if (btn) { btn.classList.remove('saving'); btn.innerHTML = '<i class="mgc_location_line"></i> Assign'; }
            showToast('❌ Failed to save', true);
        }
    };

    // Drag existing marker → auto-save
    async function onDragEnd(poleId, code, latlng) {
        try {
            await fetch(GPS_URL_TPL.replace(':id', poleId), {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                body: JSON.stringify({ map_latitude: latlng.lat, map_longitude: latlng.lng }),
            });
            markerMap[poleId]?.setPopupContent(makePopup(code, latlng.lat, latlng.lng));
            const coordEl = document.querySelector(`#pr-${poleId} .pole-coords`);
            if (coordEl) coordEl.textContent = latlng.lat.toFixed(6) + ', ' + latlng.lng.toFixed(6);
            showToast('✓ ' + code + ' repositioned');
        } catch {
            showToast('❌ Failed to update position', true);
        }
    }

    // Click pole in list → zoom map
    window.selectPole = function(poleId, code, lat, lng) {
        document.querySelectorAll('.pole-row').forEach(r => r.classList.remove('active'));
        const row = document.getElementById('pr-' + poleId);
        if (row) { row.classList.add('active'); row.scrollIntoView({ behavior:'smooth', block:'nearest' }); }
        if (lat && lng) {
            map.flyTo([lat, lng], 16, { duration: 0.8 });
            setTimeout(() => markerMap[poleId]?.openPopup(), 900);
        }
    };

    // Fix: invalidate map size after layout paints (grid sizing issue)
    setTimeout(() => map.invalidateSize(), 100);
    setTimeout(() => map.invalidateSize(), 400);
    window.addEventListener('resize', () => map.invalidateSize());

    // Prevent search bar clicks from triggering map click → assign popup
    const searchWrap = document.getElementById('mapSearchWrap');
    if (searchWrap) L.DomEvent.disableClickPropagation(searchWrap);

    // ── Location search (Nominatim) ──────────────────────────────────────
    let searchTimer = null;
    let searchMarker = null;

    document.getElementById('mapSearchInput').addEventListener('input', function() {
        clearTimeout(searchTimer);
        const q = this.value.trim();
        if (!q) { hideResults(); return; }
        searchTimer = setTimeout(() => doMapSearch(), 500);
    });
    document.getElementById('mapSearchInput').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') { e.preventDefault(); clearTimeout(searchTimer); doMapSearch(); }
    });

    window.doMapSearch = async function() {
        const q = document.getElementById('mapSearchInput').value.trim();
        if (!q) return;
        const res = document.getElementById('mapSearchResults');
        res.style.display = 'block';
        res.innerHTML = '<div class="map-search-spinner">Searching…</div>';
        try {
            const r = await fetch(
                `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(q)}&format=json&limit=6&addressdetails=1`,
                { headers: { 'Accept-Language': 'en', 'User-Agent': 'TelcoVantage/1.0' } }
            );
            const data = await r.json();
            if (!data.length) { res.innerHTML = '<div class="map-search-empty">No results found.</div>'; return; }
            res.innerHTML = data.map((item, i) =>
                `<div class="map-search-item" onclick="flyToResult(${item.lat},${item.lon},'${item.display_name.replace(/'/g,"&#39;").substring(0,80)}')">
                    <strong style="font-size:.8rem;">${item.display_name.split(',')[0]}</strong><br>
                    <span style="color:var(--muted);font-size:.7rem;">${item.display_name.substring(0,90)}</span>
                </div>`
            ).join('');
        } catch(e) {
            res.innerHTML = '<div class="map-search-empty">Search failed. Check connection.</div>';
        }
    };

    window.flyToResult = function(lat, lng, label) {
        map.flyTo([+lat, +lng], 16, { duration: 1 });
        if (searchMarker) map.removeLayer(searchMarker);
        searchMarker = L.marker([+lat, +lng], {
            icon: L.divIcon({
                className: '',
                html: `<div style="background:#2563eb;color:#fff;padding:.2rem .5rem;border-radius:6px;font-size:.7rem;font-weight:700;white-space:nowrap;box-shadow:0 2px 8px rgba(37,99,235,.4);">${label}</div>`,
                iconAnchor: [0, 10],
            })
        }).addTo(map);
        hideResults();
        document.getElementById('mapSearchInput').value = label;
    };

    function hideResults() {
        const res = document.getElementById('mapSearchResults');
        res.style.display = 'none';
        res.innerHTML = '';
    }

    document.addEventListener('click', function(e) {
        if (!document.getElementById('mapSearchWrap').contains(e.target)) hideResults();
    });

    // Toast notification
    function showToast(msg, isError) {
        const t = document.createElement('div');
        t.style.cssText = `position:fixed;bottom:1.5rem;left:50%;transform:translateX(-50%);background:${isError?'#dc2626':'#16a34a'};color:#fff;padding:.6rem 1.2rem;border-radius:10px;font-size:.82rem;font-weight:700;z-index:99999;box-shadow:0 4px 16px rgba(0,0,0,.2);font-family:system-ui;`;
        t.textContent = msg;
        document.body.appendChild(t);
        setTimeout(() => t.remove(), 2800);
    }

})();

function filterPoles(q) {
    const rows = document.querySelectorAll('#poleList .pole-row');
    const lq   = q.toLowerCase().trim();
    rows.forEach(r => {
        const code = r.querySelector('.pole-code')?.textContent?.toLowerCase() ?? '';
        r.style.display = (!lq || code.includes(lq)) ? '' : 'none';
    });
}
</script>

</x-layout>
