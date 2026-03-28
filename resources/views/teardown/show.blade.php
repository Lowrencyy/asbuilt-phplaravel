<x-layout>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<style>
:root{
    --sans:"Instrument Sans","Plus Jakarta Sans","Manrope","Segoe UI",sans-serif;
    --mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,monospace;
}
body{ font-family:var(--sans); }

.td-wrap{
    max-width:960px;
    margin:0 auto;
    padding:1.5rem 1.25rem 4rem;
}

/* back */
.td-back{
    display:inline-flex;align-items:center;gap:.45rem;
    font-size:.77rem;font-weight:800;color:#6b7280;
    text-decoration:none;margin-bottom:1.25rem;
    padding:.38rem .72rem;border-radius:10px;
    border:1px solid #eef2f6;background:#fff;transition:.14s ease;
}
.td-back:hover{ color:#111827;background:#f9fafb; }

/* header card */
.td-header{
    background:#fff;border:1px solid #eef2f6;border-radius:22px;
    padding:1.4rem 1.5rem 1.2rem;margin-bottom:1rem;
    box-shadow:0 4px 20px rgba(17,24,39,.05);
}
.td-badges{ display:flex;flex-wrap:wrap;gap:.38rem;margin-bottom:.8rem; }
.badge{
    display:inline-flex;align-items:center;padding:.26rem .68rem;
    border-radius:999px;font-size:.66rem;font-weight:800;
    letter-spacing:.04em;border:1px solid transparent;
}
.badge-blue  { background:#eef4ff;color:#1d4ed8;border-color:#c7d7fe; }
.badge-green { background:#ecfdf3;color:#15803d;border-color:#b7ebcb; }
.badge-amber { background:#fff7ed;color:#b45309;border-color:#fde68a; }
.badge-gray  { background:#f4f4f5;color:#52525b;border-color:#e4e4e7; }

.td-span{
    font-size:1.65rem;font-weight:900;color:#111827;
    letter-spacing:-.04em;line-height:1.1;margin-bottom:.3rem;
}
.td-sub{ font-size:.82rem;color:#6b7280;font-weight:600; }

.td-meta-row{
    display:flex;flex-wrap:wrap;gap:.42rem;
    margin-top:1rem;padding-top:1rem;border-top:1px solid #f1f4f8;
}
.td-chip{
    display:inline-flex;align-items:center;gap:.38rem;
    padding:.3rem .7rem;border-radius:999px;
    border:1px solid #eef2f6;background:#f9fafb;
    font-size:.71rem;font-weight:700;color:#374151;
    text-decoration:none;
}
.td-chip.link{ border-color:#c7d7fe;background:#f0f4ff;color:#1d4ed8; }
.td-chip.link:hover{ background:#e8eeff; }

/* section card */
.td-card{
    background:#fff;border:1px solid #eef2f6;border-radius:18px;
    padding:1.15rem 1.3rem;margin-bottom:.85rem;
    box-shadow:0 2px 10px rgba(17,24,39,.04);
}
.td-card-title{
    font-size:.78rem;font-weight:900;color:#111827;letter-spacing:-.01em;
    margin-bottom:.8rem;
    display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.4rem;
}

/* cable */
.cable-grid{ display:grid;grid-template-columns:1fr 1fr;gap:.6rem;margin-bottom:.7rem; }
.cable-cell{ border-radius:14px;padding:.8rem;border:1px solid transparent; }
.cable-cell.col{ background:#f0f8ff;border-color:#c7d7fe; }
.cable-cell.exp{ background:#f9fafb;border-color:#eef2f6; }
.cable-label{ font-size:.62rem;color:#9ca3af;font-weight:700;text-transform:uppercase;letter-spacing:.1em; }
.cable-val  { font-size:1.15rem;font-weight:900;color:#111827;margin-top:.2rem; }

.progress-track{ background:#f1f4f8;border-radius:999px;height:7px;overflow:hidden;margin-bottom:.3rem; }
.progress-fill { height:100%;border-radius:999px;transition:width .5s ease; }
.progress-pct  { text-align:right;font-size:.7rem;color:#9ca3af;font-weight:700; }

.unrecovered{
    margin-top:.6rem;padding:.55rem .8rem;border-radius:12px;
    background:#fff7ed;border:1px solid #fde68a;
    font-size:.75rem;color:#b45309;font-weight:700;
}

/* components */
.comp-grid{ display:grid;grid-template-columns:repeat(4,1fr);gap:.5rem; }
@media(max-width:640px){ .comp-grid{ grid-template-columns:1fr 1fr; } }
.comp-cell{
    border-radius:14px;padding:.7rem .8rem;
    border:1px solid #eef2f6;background:#f9fafb;
}
.comp-cell.ok  { border-color:#b7ebcb;background:#f0fdf4; }
.comp-cell.warn{ border-color:#fde68a;background:#fff7ed; }
.comp-label{ font-size:.61rem;color:#9ca3af;font-weight:700;text-transform:uppercase;letter-spacing:.08em; }
.comp-val  { font-size:1rem;font-weight:900;color:#111827;margin-top:.18rem; }
.comp-val span{ font-size:.71rem;color:#9ca3af;font-weight:600; }
.comp-sub  { font-size:.66rem;color:#9ca3af;margin-top:.06rem; }

/* photo sections */
.pole-section{ margin-bottom:.85rem; }
.pole-header{
    display:flex;align-items:center;gap:.6rem;
    margin-bottom:.6rem;
}
.pole-code{
    font-size:.9rem;font-weight:900;color:#111827;letter-spacing:-.01em;
    font-family:var(--mono);
}
.pole-role{
    font-size:.66rem;font-weight:800;padding:.22rem .55rem;
    border-radius:999px;border:1px solid transparent;letter-spacing:.04em;
}
.pole-role.from{ background:#eef4ff;color:#1d4ed8;border-color:#c7d7fe; }
.pole-role.to  { background:#f5f3ff;color:#6d28d9;border-color:#ddd6fe; }

.photo-grid{ display:grid;grid-template-columns:1fr 1fr 1fr;gap:.65rem; }
@media(max-width:580px){ .photo-grid{ grid-template-columns:1fr 1fr; } }

.photo-card{
    border-radius:16px;overflow:hidden;
    border:1px solid #eef2f6;background:#f3f5f7;
}
.photo-card-label{
    font-size:.64rem;font-weight:800;color:#6b7280;
    text-transform:uppercase;letter-spacing:.1em;
    padding:.5rem .7rem .3rem;
}
.photo-card img{
    width:100%;aspect-ratio:4/3;object-fit:cover;
    display:block;cursor:zoom-in;transition:opacity .14s ease;
}
.photo-card img:hover{ opacity:.88; }
.photo-empty{
    aspect-ratio:4/3;display:flex;align-items:center;
    justify-content:center;color:#c0c8d4;font-size:1.6rem;
    background:#f3f5f7;
}

/* map */
.td-map-wrap{
    border-radius:16px;overflow:hidden;height:340px;
    border:1px solid #eef2f6;position:relative;
}
.td-map-no-gps{
    height:340px;display:flex;align-items:center;justify-content:center;
    flex-direction:column;gap:.5rem;color:#9ca3af;font-size:.88rem;font-weight:600;
    background:#f9fafb;border-radius:16px;border:1px solid #eef2f6;
}
.td-map-no-gps i{ font-size:2rem;color:#d0d7e0; }
.leaflet-popup-content-wrapper{
    border-radius:14px !important;box-shadow:0 8px 24px rgba(17,24,39,.12) !important;
    font-family:var(--sans) !important;padding:0 !important;overflow:hidden;
}
.leaflet-popup-content{ margin:0 !important; }
.map-popup{
    padding:.8rem 1rem;min-width:180px;
}
.map-popup-role{
    font-size:.62rem;font-weight:800;text-transform:uppercase;letter-spacing:.1em;
    margin-bottom:.35rem;
}
.map-popup-code{
    font-size:.92rem;font-weight:900;color:#111827;
    font-family:var(--mono);margin-bottom:.3rem;
}
.map-popup-row{
    font-size:.71rem;color:#6b7280;font-weight:600;margin-top:.18rem;
}
.map-popup-row strong{ color:#374151; }

/* lightbox */
#td-lightbox{
    display:none;position:fixed;inset:0;z-index:2000;
    background:rgba(0,0,0,.92);align-items:center;justify-content:center;cursor:zoom-out;
}
#td-lightbox.open{ display:flex; }
#td-lightbox img{
    max-width:96vw;max-height:96vh;
    border-radius:14px;box-shadow:0 24px 64px rgba(0,0,0,.6);
}
#td-lb-close{
    position:absolute;top:1rem;right:1rem;background:rgba(255,255,255,.15);
    border:none;border-radius:12px;color:#fff;font-size:1.3rem;
    width:42px;height:42px;display:flex;align-items:center;justify-content:center;
    cursor:pointer;transition:.14s ease;
}
#td-lb-close:hover{ background:rgba(255,255,255,.28); }
</style>
@endpush

@php
    $log      = $teardownLog;
    $span     = $log->poleSpan;
    $fromPole = $span?->fromPole;
    $toPole   = $span?->toPole;
    $node     = $log->node;
    $project  = $log->project;
    $sub      = $log->submissionItem?->submission;

    $fromCode  = $fromPole?->pole_code ?? '?';
    $toCode    = $toPole?->pole_code   ?? '?';
    $spanCode  = $span?->pole_span_code ?? ('Log #'.$log->id);

    $cableCol  = (float)$log->collected_cable;
    $cableExp  = (float)$log->expected_cable_snapshot;
    $cablePct  = $cableExp > 0 ? min(100, round(($cableCol / $cableExp) * 100)) : ($cableCol > 0 ? 100 : 0);
    $cableBar  = $cablePct >= 100 ? 'linear-gradient(90deg,#15803d,#22c55e)'
               : ($cablePct >= 80  ? 'linear-gradient(90deg,#2563eb,#3b82f6)'
                                   : 'linear-gradient(90deg,#dc2626,#f87171)');

    $imgFor = fn($type) => ($images[$type] ?? null)?->image_path
                ? asset('storage/' . $images[$type]->image_path)
                : null;

    // GPS — prefer per-pole coords captured at photo time, fallback to pole map coords
    $fromLat = (float)($log->from_pole_latitude  ?: $fromPole?->map_latitude  ?: 0);
    $fromLng = (float)($log->from_pole_longitude ?: $fromPole?->map_longitude ?: 0);
    $toLat   = (float)($log->to_pole_latitude    ?: $toPole?->map_latitude    ?: 0);
    $toLng   = (float)($log->to_pole_longitude   ?: $toPole?->map_longitude   ?: 0);
    $hasGps  = ($fromLat && $fromLng) || ($toLat && $toLng);

    $comps = [
        ['Node',      $log->collected_node,      $log->expected_node_snapshot],
        ['Amplifier', $log->collected_amplifier, $log->expected_amplifier_snapshot],
        ['Extender',  $log->collected_extender,  $log->expected_extender_snapshot],
        ['TSC',       $log->collected_tsc,       $log->expected_tsc_snapshot],
    ];
@endphp

<div class="col-span-full td-wrap">

    <a href="{{ route('reports.teardown-logs.index') }}" class="td-back" style="text-decoration:none;">
        <i class="mgc_arrow_left_line"></i> Live Teardown Logs
    </a>

    {{-- ── Header ──────────────────────────────────────────────────── --}}
    <div class="td-header">
        <div class="td-badges">
            @if($node)
                <span class="badge badge-blue">{{ $node->node_id }}{{ $node->node_name ? ' — '.$node->node_name : '' }}</span>
            @endif
            @if($project)
                <span class="badge badge-gray">{{ $project->project_name }}</span>
            @endif
            <span class="badge badge-green">{{ strtoupper(str_replace('_',' ',$log->status ?? 'submitted')) }}</span>
            @if($log->offline_mode)
                <span class="badge badge-amber">OFFLINE</span>
            @endif
        </div>

        <div class="td-span">{{ $fromCode }} → {{ $toCode }}</div>
        <div class="td-sub">
            {{ $spanCode }}
            @if($span?->length_meters) &nbsp;·&nbsp; {{ number_format($span->length_meters,0) }} m span @endif
            @if($node?->city) &nbsp;·&nbsp; {{ $node->city }} @endif
        </div>

        <div class="td-meta-row">
            @if($log->team)
                <span class="td-chip"><i class="mgc_group_line"></i>{{ $log->team }}</span>
            @endif
            @if($log->submitted_by)
                <span class="td-chip"><i class="mgc_user_3_line"></i>{{ $log->submitted_by }}</span>
            @endif
            @if($log->started_at)
                <span class="td-chip">
                    <i class="mgc_time_line"></i>
                    {{ $log->started_at->format('M d, Y H:i') }} → {{ $log->finished_at?->format('H:i') ?? '—' }}
                </span>
            @endif
            @if($sub)
                <a href="{{ route('reports.show', $sub->id) }}" class="td-chip link">
                    <i class="mgc_external_link_line"></i>View Daily Report
                </a>
            @endif
        </div>
    </div>

    {{-- ── Cable Recovery ───────────────────────────────────────────── --}}
    <div class="td-card">
        <div class="td-card-title">
            Cable Recovery
            @if($log->did_collect_all_cable)
                <span class="badge badge-green">✓ All Collected</span>
            @else
                <span class="badge badge-amber">⚠ Partial</span>
            @endif
        </div>

        <div class="cable-grid">
            <div class="cable-cell col">
                <div class="cable-label">Collected</div>
                <div class="cable-val">{{ number_format($cableCol,2) }} m</div>
            </div>
            <div class="cable-cell exp">
                <div class="cable-label">Expected</div>
                <div class="cable-val">{{ number_format($cableExp,2) }} m</div>
            </div>
        </div>

        <div class="progress-track">
            <div class="progress-fill" style="width:{{ $cablePct }}%;background:{{ $cableBar }};"></div>
        </div>
        <div class="progress-pct">{{ $cablePct }}% recovered</div>

        @if(!$log->did_collect_all_cable && $log->unrecovered_cable > 0)
            <div class="unrecovered">
                ⚠ Unrecovered: {{ number_format($log->unrecovered_cable,2) }} m
                @if($log->unrecovered_reason) — {{ $log->unrecovered_reason }} @endif
            </div>
        @endif
    </div>

    {{-- ── Components ───────────────────────────────────────────────── --}}
    <div class="td-card">
        <div class="td-card-title">Components Recovered</div>
        <div class="comp-grid">
            @foreach($comps as [$label, $col, $exp])
                @php $ok = $col >= $exp; @endphp
                <div class="comp-cell {{ $ok ? 'ok' : 'warn' }}">
                    <div class="comp-label">{{ $label }}</div>
                    <div class="comp-val">{{ $col }} <span>/ {{ $exp }}</span></div>
                    <div class="comp-sub">{{ $ok ? '✓ Complete' : '⚠ Short by '.($exp-$col) }}</div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ── Span Map ──────────────────────────────────────────────────── --}}
    <div class="td-card">
        <div class="td-card-title">
            Span Location Map
            @if($span?->length_meters)
                <span class="badge badge-blue">{{ number_format($span->length_meters,0) }} m span</span>
            @endif
        </div>

        @if($hasGps)
            <div class="td-map-wrap" id="spanMap"></div>
        @else
            <div class="td-map-no-gps">
                <i class="mgc_map_line"></i>
                No GPS coordinates recorded for this span.
            </div>
        @endif
    </div>

    {{-- ── From Pole Photos ──────────────────────────────────────────── --}}
    <div class="td-card">
        <div class="td-card-title">
            <div class="pole-header" style="margin-bottom:0;">
                <span class="pole-code">{{ $fromCode }}</span>
                <span class="pole-role from">From Pole</span>
            </div>
        </div>
        <div class="photo-grid">
            @foreach([['from_before','Before'],['from_after','After'],['from_tag','Pole Tag']] as [$type,$label])
                @php $src = $imgFor($type); @endphp
                <div class="photo-card">
                    <div class="photo-card-label">{{ $label }}</div>
                    @if($src)
                        <img src="{{ $src }}" alt="{{ $label }}" onclick="tdZoom('{{ $src }}')">
                    @else
                        <div class="photo-empty"><i class="mgc_pic_2_line"></i></div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{-- ── To Pole Photos ────────────────────────────────────────────── --}}
    <div class="td-card">
        <div class="td-card-title">
            <div class="pole-header" style="margin-bottom:0;">
                <span class="pole-code">{{ $toCode }}</span>
                <span class="pole-role to">To Pole</span>
            </div>
        </div>
        <div class="photo-grid">
            @foreach([['to_before','Before'],['to_after','After'],['to_tag','Pole Tag']] as [$type,$label])
                @php $src = $imgFor($type); @endphp
                <div class="photo-card">
                    <div class="photo-card-label">{{ $label }}</div>
                    @if($src)
                        <img src="{{ $src }}" alt="{{ $label }}" onclick="tdZoom('{{ $src }}')">
                    @else
                        <div class="photo-empty"><i class="mgc_pic_2_line"></i></div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

</div>

{{-- Lightbox --}}
<div id="td-lightbox" onclick="this.classList.remove('open')">
    <button id="td-lb-close" onclick="event.stopPropagation();document.getElementById('td-lightbox').classList.remove('open')">&times;</button>
    <img id="td-lb-img" src="" alt="">
</div>

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
/* ── Lightbox ─────────────────────────────────────────────────────── */
function tdZoom(src) {
    document.getElementById('td-lb-img').src = src;
    document.getElementById('td-lightbox').classList.add('open');
}
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') document.getElementById('td-lightbox').classList.remove('open');
});

/* ── Span Map ─────────────────────────────────────────────────────── */
@if($hasGps)
(function () {
    const FROM = {
        lat:  {{ $fromLat ?: 'null' }},
        lng:  {{ $fromLng ?: 'null' }},
        code: @json($fromCode),
        role: 'From Pole',
        gpsAt: @json($log->from_pole_gps_captured_at ?? null),
        accuracy: @json($log->from_pole_gps_accuracy ?? null),
    };
    const TO = {
        lat:  {{ $toLat ?: 'null' }},
        lng:  {{ $toLng ?: 'null' }},
        code: @json($toCode),
        role: 'To Pole',
        gpsAt: @json($log->to_pole_gps_captured_at ?? null),
        accuracy: @json($log->to_pole_gps_accuracy ?? null),
    };

    const spanLength = {{ $span?->length_meters ?? 'null' }};
    const spanCode   = @json($spanCode);
    const cable      = {{ $cableCol }};

    // Determine map center
    const points = [FROM, TO].filter(p => p.lat && p.lng);
    const centerLat = points.reduce((s,p) => s + p.lat, 0) / points.length;
    const centerLng = points.reduce((s,p) => s + p.lng, 0) / points.length;

    const map = L.map('spanMap', { zoomControl: true }).setView([centerLat, centerLng], 17);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 20,
    }).addTo(map);

    function makeIcon(color) {
        return L.divIcon({
            className: '',
            html: `<div style="
                width:36px;height:36px;border-radius:50% 50% 50% 0;
                background:${color};border:3px solid #fff;
                box-shadow:0 4px 14px rgba(0,0,0,.25);
                transform:rotate(-45deg);
            "></div>`,
            iconSize: [36, 36],
            iconAnchor: [18, 36],
            popupAnchor: [0, -36],
        });
    }

    function popupHTML(pole) {
        const roleColor = pole.role === 'From Pole' ? '#1d4ed8' : '#6d28d9';
        let rows = '';
        if (pole.lat && pole.lng)
            rows += `<div class="map-popup-row">GPS <strong>${pole.lat.toFixed(6)}, ${pole.lng.toFixed(6)}</strong></div>`;
        if (pole.accuracy)
            rows += `<div class="map-popup-row">Accuracy <strong>±${parseFloat(pole.accuracy).toFixed(1)} m</strong></div>`;
        if (pole.gpsAt)
            rows += `<div class="map-popup-row">Captured <strong>${new Date(pole.gpsAt).toLocaleString('en-PH',{month:'short',day:'numeric',hour:'2-digit',minute:'2-digit'})}</strong></div>`;
        return `<div class="map-popup">
            <div class="map-popup-role" style="color:${roleColor}">${pole.role}</div>
            <div class="map-popup-code">${pole.code}</div>
            ${rows}
        </div>`;
    }

    const bounds = [];

    if (FROM.lat && FROM.lng) {
        L.marker([FROM.lat, FROM.lng], { icon: makeIcon('#2563eb') })
            .addTo(map)
            .bindPopup(popupHTML(FROM), { maxWidth: 240 });
        bounds.push([FROM.lat, FROM.lng]);
    }

    if (TO.lat && TO.lng) {
        L.marker([TO.lat, TO.lng], { icon: makeIcon('#7c3aed') })
            .addTo(map)
            .bindPopup(popupHTML(TO), { maxWidth: 240 });
        bounds.push([TO.lat, TO.lng]);
    }

    // Draw span line between poles
    if (FROM.lat && FROM.lng && TO.lat && TO.lng) {
        const line = L.polyline([[FROM.lat, FROM.lng],[TO.lat, TO.lng]], {
            color: '#2563eb',
            weight: 4,
            opacity: .75,
            dashArray: '8 6',
        }).addTo(map);

        // Clickable span line popup with summary
        line.bindPopup(`<div class="map-popup">
            <div class="map-popup-role" style="color:#15803d;">Span</div>
            <div class="map-popup-code">${spanCode}</div>
            ${spanLength ? `<div class="map-popup-row">Length <strong>${spanLength.toLocaleString()} m</strong></div>` : ''}
            <div class="map-popup-row">Cable collected <strong>${cable.toFixed(2)} m</strong></div>
            <div class="map-popup-row">${FROM.code} → ${TO.code}</div>
        </div>`, { maxWidth: 240 });
    }

    if (bounds.length > 1) {
        map.fitBounds(bounds, { padding: [48, 48] });
    }
})();
@endif
</script>
@endpush

</x-layout>
