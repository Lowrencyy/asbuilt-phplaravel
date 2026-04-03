{{-- Redesigned Teardown Log View --}}
<x-layout>

@push('styles')
<link rel="stylesheet" href="/assets/libs/leaflet/leaflet.css"/>
<style>
:root{
    --bg:#f6fbf8;
    --surface:#ffffff;
    --surface-2:#f8fcfa;
    --line:#dce9e1;
    --line-strong:#c8ddd1;
    --text:#123126;
    --muted:#6a7f75;
    --success:#0A5C3B;
    --success-2:#15803d;
    --success-soft:#ecf8f1;
    --info:#2563eb;
    --info-soft:#eef4ff;
    --warn:#b45309;
    --warn-soft:#fff7ed;
    --danger:#b91c1c;
    --danger-soft:#fef2f2;
    --shadow:0 18px 40px rgba(10,92,59,.08);
    --shadow-soft:0 10px 24px rgba(15,23,42,.05);
}

body{
    font-family:inherit;
    background:
        radial-gradient(circle at top left, rgba(10,92,59,.06), transparent 22%),
        linear-gradient(180deg, #f7fcf9 0%, #ffffff 42%);
    color:var(--text);
}

.td-shell{
    width:100%;
    max-width:none;
    margin:0;
    padding:0 0 56px;
}

.td-back{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:11px 18px;
    border-radius:999px;
    border:1px solid #d7e6dd;
    background:#ffffff;
    color:var(--success);
    font-weight:800;
    font-size:.8rem;
    letter-spacing:.02em;
    text-decoration:none;
    box-shadow:var(--shadow-soft);
    transition:.18s ease;
}
.td-back:hover{ transform:translateY(-1px); border-color:#bfd7ca; box-shadow:0 14px 28px rgba(10,92,59,.09); }

.td-hero{
    margin-top:22px;
    padding:30px;
    border:1px solid #d8e8de;
    border-radius:34px;
    background:
        radial-gradient(circle at top right, rgba(37,99,235,.08), transparent 22%),
        radial-gradient(circle at bottom left, rgba(10,92,59,.10), transparent 28%),
        linear-gradient(135deg, #f7fffb 0%, #f2fbf6 34%, #eef6ff 100%);
    box-shadow:0 26px 60px rgba(10,92,59,.08);
    position:relative;
    overflow:hidden;
}
.td-hero::before,
.td-hero::after{
    display:none;
}
.td-hero::before{
    width:260px;height:260px;right:-60px;top:-90px;
    background:radial-gradient(circle, rgba(32,78,207,.14), transparent 68%);
}
.td-hero::after{
    width:220px;height:220px;left:-80px;bottom:-120px;
    background:radial-gradient(circle, rgba(23,114,69,.12), transparent 70%);
}

.td-hero-grid{
    position:relative;
    display:grid;
    grid-template-columns:1.7fr .95fr;
    gap:22px;
}
@media(max-width:1080px){ .td-hero-grid{ grid-template-columns:1fr; } }

.td-kicker{
    display:inline-flex;
    align-items:center;
    gap:8px;
    text-transform:uppercase;
    letter-spacing:.16em;
    font-size:.67rem;
    color:#0A5C3B;
    font-weight:900;
    margin-bottom:14px;
    padding:8px 12px;
    border-radius:999px;
    background:rgba(255,255,255,.8);
    border:1px solid rgba(10,92,59,.10);
}

.td-title{
    margin:0;
    font-family:inherit;
    font-size:clamp(2.4rem,4.4vw,4rem);
    line-height:.95;
    letter-spacing:-.055em;
    color:#0A5C3B;
    font-weight:900;
    text-wrap:balance;
}

.td-subtitle{
    margin-top:16px;
    color:#496156;
    font-size:1rem;
    font-weight:700;
    display:flex;
    flex-wrap:wrap;
    gap:10px;
}

.td-badges{ display:flex; flex-wrap:wrap; gap:10px; margin:20px 0 0; }
.badge{
    display:inline-flex; align-items:center; gap:8px;
    padding:10px 15px; border-radius:999px; font-size:.75rem; font-weight:800;
    border:1px solid transparent; letter-spacing:.03em;
    box-shadow:0 8px 18px rgba(15,23,42,.04);
}
.badge-info{ background:#edf4ff; color:#2457d6; border-color:#cfe0ff; }
.badge-success{ background:#eaf8f0; color:#0A5C3B; border-color:#bfe0cd; }
.badge-warn{ background:var(--warn-soft); color:var(--warn); border-color:rgba(184,106,0,.15); }
.badge-neutral{ background:#fffdf8; color:#6a5b47; border-color:#eadfce; }

.td-summary{
    display:grid;
    grid-template-columns:repeat(2,minmax(0,1fr));
    gap:14px;
    align-content:start;
}
@media(max-width:640px){ .td-summary{ grid-template-columns:1fr; } }
.summary-card{
    padding:18px;
    border-radius:24px;
    background:rgba(255,255,255,.88);
    border:1px solid rgba(216,232,222,.95);
    box-shadow:0 12px 24px rgba(15,23,42,.04);
    backdrop-filter:blur(8px);
}
.summary-label{
    font-size:.71rem;
    letter-spacing:.11em;
    text-transform:uppercase;
    color:#7f8e86;
    font-weight:900;
    margin-bottom:8px;
}
.summary-value{
    font-size:1.45rem;
    font-weight:900;
    color:#0A5C3B;
}
.summary-sub{ margin-top:6px; color:#6b7280; font-size:.8rem; font-weight:600; }

.td-layout{
    display:grid;
    grid-template-columns:minmax(0,1.3fr) minmax(360px,.9fr);
    gap:20px;
    margin-top:20px;
}
@media(max-width:1180px){ .td-layout{ grid-template-columns:1fr; } }

.stack{ display:flex; flex-direction:column; gap:20px; }
.panel{
    background:#ffffff;
    border:1px solid #dce9e1;
    border-radius:30px;
    box-shadow:var(--shadow);
    overflow:hidden;
}
.panel-head{
    display:flex; align-items:flex-start; justify-content:space-between; gap:12px;
    padding:24px 24px 0;
}
.panel-title{
    margin:0;
    font-size:1.08rem;
    font-weight:900;
    color:#113528;
    letter-spacing:-.02em;
}
.panel-sub{ margin-top:6px; color:#708278; font-size:.86rem; font-weight:600; line-height:1.45; }
.panel-body{ padding:18px 22px 22px; }

.metric-grid{ display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:14px; }
@media(max-width:640px){ .metric-grid{ grid-template-columns:1fr; } }
.metric-card{
    padding:20px;
    border-radius:24px;
    border:1px solid #ddeae2;
    background:linear-gradient(180deg,#ffffff 0%, #fbfefc 100%);
    box-shadow:0 10px 22px rgba(15,23,42,.035);
}
.metric-card.highlight{ border-color:#bddbc9; background:linear-gradient(180deg,#f4fff8 0%, #eefbf3 100%); }
.metric-label{ font-size:.72rem; text-transform:uppercase; letter-spacing:.11em; color:#7a8a82; font-weight:900; }
.metric-value{ margin-top:8px; font-size:2.2rem; font-family:inherit; font-weight:900; color:#0A5C3B; letter-spacing:-.04em; }
.metric-note{ margin-top:6px; color:#6b7280; font-size:.82rem; font-weight:600; }

.progress-wrap{ margin-top:18px; }
.progress-top{ display:flex; justify-content:space-between; gap:10px; margin-bottom:10px; font-size:.82rem; font-weight:700; color:#6b7280; }
.progress-track{ height:14px; border-radius:999px; background:#e6f0ea; overflow:hidden; box-shadow:inset 0 1px 3px rgba(10,92,59,.08); }
.progress-fill{ height:100%; border-radius:999px; position:relative; }
.progress-fill::after{
    content:""; position:absolute; inset:0;
    background:linear-gradient(90deg, rgba(255,255,255,.12), rgba(255,255,255,.45), rgba(255,255,255,.12));
    transform:translateX(-100%); animation:shine 2.8s linear infinite;
}
@keyframes shine { to { transform:translateX(100%); } }
.callout{
    margin-top:14px; padding:14px 16px; border-radius:18px; border:1px solid transparent;
    font-size:.85rem; font-weight:700;
}
.callout.warn{ background:var(--warn-soft); color:#9a5a00; border-color:#f1d59b; }
.callout.success{ background:linear-gradient(135deg,#edf9f1 0%, #e2f4e8 100%); color:var(--success); border-color:#bfe0cd; }

.component-list{ display:grid; gap:12px; }
.component-row{
    display:grid; grid-template-columns:1.1fr .95fr 110px; gap:12px; align-items:center;
    padding:18px 18px; border-radius:22px; border:1px solid #ddeae2; background:linear-gradient(180deg,#ffffff 0%, #fbfefc 100%);
    box-shadow:0 8px 18px rgba(15,23,42,.03);
}
@media(max-width:640px){ .component-row{ grid-template-columns:1fr; } }
.component-name{ font-weight:900; color:#133326; font-size:1rem; }
.component-mini{ font-size:.8rem; color:#8a94a3; font-weight:700; margin-top:4px; }
.component-count{ font-family:inherit; font-size:1.6rem; font-weight:900; letter-spacing:-.04em; color:#0A5C3B; }
.component-status{
    justify-self:end; padding:8px 12px; border-radius:999px; font-size:.73rem; font-weight:800;
}
.component-status.ok{ background:var(--success-soft); color:var(--success); }
.component-status.short{ background:var(--warn-soft); color:var(--warn); }

.meta-grid{ display:grid; grid-template-columns:1fr 1fr; gap:12px; }
@media(max-width:640px){ .meta-grid{ grid-template-columns:1fr; } }
.meta-card{
    padding:18px 18px;
    border-radius:22px;
    border:1px solid #ddeae2;
    background:linear-gradient(180deg,#ffffff 0%, #fbfefc 100%);
    box-shadow:0 8px 18px rgba(15,23,42,.03);
}
.meta-label{ color:#8b7b69; font-size:.7rem; letter-spacing:.08em; text-transform:uppercase; font-weight:800; }
.meta-value{ margin-top:10px; color:#123126; font-weight:900; font-size:1rem; line-height:1.35; }
.meta-link{
    display:inline-flex; align-items:center; gap:8px; margin-top:12px; text-decoration:none;
    color:#204ecf; font-weight:800;
}

.map-shell{
    height:390px;
    border-radius:26px;
    border:1px solid #dce9e1;
    overflow:hidden;
    position:relative;
    background:#f4faf7;
    box-shadow:0 10px 24px rgba(15,23,42,.04);
}
.map-toolbar{
    position:absolute; z-index:500; top:14px; right:14px; display:flex; gap:10px; flex-wrap:wrap;
}
.pill-btn, .stat-pill{
    background:linear-gradient(135deg, #0A5C3B 0%, #0f6b45 60%, #169255 100%);
    color:#ffffff;
}
.pill-btn{
    background:linear-gradient(135deg, #0A5C3B 0%, #0f6b45 60%, #15803d 100%);
    color:#ffffff;
    cursor:pointer;
}
.pill-btn.off{ background:#f3f7f4; color:#60756a; box-shadow:none; }
.stat-pill{ background:rgba(255,255,255,.9); color:#1d2532; }
.map-empty{
    min-height:320px;
    border-radius:24px;
    border:1px dashed #d1d5db;
    background:#ffffff;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    gap:12px;
    color:#6b7280;
    font-weight:700;
}

.photo-group{ display:grid; gap:14px; }
.photo-group-head{ display:flex; align-items:center; gap:12px; margin-bottom:4px; }
.photo-code{ font-family:inherit; font-size:1.45rem; font-weight:900; letter-spacing:-.03em; color:#0A5C3B; }
.photo-role{ padding:8px 12px; border-radius:999px; font-size:.72rem; font-weight:800; }
.photo-role.from{ background:var(--info-soft); color:var(--info); }
.photo-role.to{ background:#f4efff; color:#6842cf; }
.photo-grid{ display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:14px; }
@media(max-width:760px){ .photo-grid{ grid-template-columns:1fr; } }
.photo-card{
    border-radius:24px;
    overflow:hidden;
    background:#ffffff;
    border:1px solid #ddeae2;
    box-shadow:0 10px 22px rgba(15,23,42,.04);
}
.photo-label{ padding:15px 16px 11px; font-size:.72rem; font-weight:900; text-transform:uppercase; letter-spacing:.11em; color:#708278; }
.photo-frame{ background:#f6faf8; border-top:1px solid #eef4f0; }
.photo-frame img{ width:100%; aspect-ratio:4/3; object-fit:cover; display:block; cursor:zoom-in; transition:transform .25s ease, opacity .25s ease; }
.photo-frame img:hover{ transform:scale(1.03); opacity:.94; }
.photo-empty{ aspect-ratio:4/3; display:flex; align-items:center; justify-content:center; color:#bba892; font-size:.92rem; font-weight:700; }

#td-lightbox{ display:none; position:fixed; inset:0; z-index:2000; background:rgba(18,20,24,.92); align-items:center; justify-content:center; }
#td-lightbox.open{ display:flex; }
#td-lightbox img{ max-width:94vw; max-height:92vh; border-radius:24px; box-shadow:0 30px 90px rgba(0,0,0,.45); }
#td-lb-close{
    position:absolute; top:22px; right:22px; width:48px; height:48px; border:none; border-radius:14px;
    background:rgba(255,255,255,.14); color:#fff; font-size:1.4rem; cursor:pointer;
}

.leaflet-popup-content-wrapper{ border-radius:18px !important; box-shadow:0 18px 40px rgba(31,41,55,.2) !important; }
.leaflet-popup-content{ margin:0 !important; }
.map-popup{ padding:14px 16px; min-width:200px; font-family:var(--body); }
.map-popup-role{ font-size:.68rem; text-transform:uppercase; letter-spacing:.12em; font-weight:800; margin-bottom:6px; }
.map-popup-code{ font-family:inherit; font-size:1.05rem; font-weight:800; color:#111827; }
.map-popup-row{ margin-top:5px; color:#5b6472; font-size:.78rem; font-weight:600; }
.map-popup-row strong{ color:#18202d; }
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

    $submittedName = $log->submittedByUser?->name
        ?? $log->user?->name
        ?? $log->employee?->name
        ?? ($log->submitted_by_name ?: null)
        ?? (filter_var($log->submitted_by, FILTER_VALIDATE_EMAIL)
            ? ucwords(str_replace(['.','_','-'], ' ', strstr($log->submitted_by, '@', true)))
            : $log->submitted_by);

    $workStart = $log->started_at
        ?? $images['from_before']?->created_at
        ?? $images['from_before']?->updated_at
        ?? $log->created_at;

    $workEnd = $log->finished_at
        ?? $images['to_after']?->created_at
        ?? $images['to_after']?->updated_at
        ?? $images['from_after']?->created_at
        ?? $images['from_after']?->updated_at
        ?? $log->updated_at;

    $workMinutes = ($workStart && $workEnd) ? max(0, $workStart->diffInMinutes($workEnd)) : null;

    $workSpanText = '—';
    if (!is_null($workMinutes)) {
        $hours = intdiv($workMinutes, 60);
        $mins  = $workMinutes % 60;
        $parts = [];
        if ($hours > 0) $parts[] = $hours . 'h';
        if ($mins > 0 || !$hours) $parts[] = $mins . 'm';
        $workSpanText = implode(' ', $parts);
    }

    $fromCode  = $fromPole?->pole_code ?? '?';
    $toCode    = $toPole?->pole_code   ?? '?';
    $spanCode  = $span?->pole_span_code ?? ('Log #'.$log->id);

    $cableCol  = (float)$log->collected_cable;
    $cableExp  = (float)$log->expected_cable_snapshot;
    $cablePct  = $cableExp > 0 ? min(100, round(($cableCol / $cableExp) * 100)) : ($cableCol > 0 ? 100 : 0);
    $cableBar  = $cablePct >= 100 ? 'linear-gradient(90deg,#177245,#3ebd77)'
               : ($cablePct >= 80  ? 'linear-gradient(90deg,#204ecf,#5b83ff)'
                                   : 'linear-gradient(90deg,#c86a10,#f2a148)');

    $imgFor = fn($type) => ($images[$type] ?? null)?->image_path
                ? asset('storage/' . $images[$type]->image_path)
                : null;

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

<div class="col-span-full td-shell">
    <a href="{{ route('reports.teardown-logs.index') }}" class="td-back">
        <i class="mgc_arrow_left_line"></i>
        Back to Live Teardown Logs
    </a>

    <section class="td-hero">
        <div class="td-hero-grid">
            <div>
                <div class="td-kicker">Field recovery summary</div>
                <h1 class="td-title">{{ $fromCode }} <span style="opacity:.4;">→</span> {{ $toCode }}</h1>
                <div class="td-subtitle">
                    <span>{{ $spanCode }}</span>
                    @if($span?->length_meters)<span>• {{ number_format($span->length_meters,0) }}m span</span>@endif
                    @if($node?->city)<span>• {{ $node->city }}</span>@endif
                </div>

                <div class="td-badges">
                    @if($node)
                        <span class="badge badge-info"><i class="mgc_cell_tower_line"></i>{{ $node->node_id }}{{ $node->node_name ? ' · '.$node->node_name : '' }}</span>
                    @endif
                    @if($project)
                        <span class="badge badge-neutral"><i class="mgc_folder_3_line"></i>{{ $project->project_name }}</span>
                    @endif
                    <span class="badge {{ ($log->status ?? 'submitted') === 'submitted' ? 'badge-success' : 'badge-neutral' }}">
                        <i class="mgc_check_circle_line"></i>{{ strtoupper(str_replace('_',' ',$log->status ?? 'submitted')) }}
                    </span>
                    @if($log->offline_mode)
                        <span class="badge badge-warn"><i class="mgc_wifi_off_line"></i>Offline capture</span>
                    @endif
                </div>
            </div>

            <div class="td-summary">
                <div class="summary-card">
                    <div class="summary-label">Collected cable</div>
                    <div class="summary-value">{{ number_format($cableCol,2) }} m</div>
                    <div class="summary-sub">Against {{ number_format($cableExp,2) }} m expected</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Recovery rate</div>
                    <div class="summary-value">{{ $cablePct }}%</div>
                    <div class="summary-sub">{{ $log->did_collect_all_cable ? 'Complete recovery logged' : 'Needs field review' }}</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Submitted by</div>
                    <div class="summary-value" style="font-size:1rem; line-height:1.3;">{{ $submittedName ?: '—' }}</div>
                    <div class="summary-sub">{{ $log->team ?: 'No team assigned' }}</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Work span time</div>
                    <div class="summary-value" style="font-size:1rem; line-height:1.35;">
                        {{ $workSpanText }}
                    </div>
                    <div class="summary-sub">
                        {{ $workStart?->format('M d, Y · H:i') ?? '—' }} → {{ $workEnd?->format('H:i') ?? '—' }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="td-layout">
        <div class="stack">
            <article class="panel">
                <div class="panel-head">
                    <div>
                        <h2 class="panel-title">Cable recovery</h2>
                        <div class="panel-sub">A cleaner KPI-first presentation for field supervisors and auditors.</div>
                    </div>
                    <span class="badge {{ $log->did_collect_all_cable ? 'badge-success' : 'badge-warn' }}">
                        {{ $log->did_collect_all_cable ? 'All cable recovered' : 'Partial recovery' }}
                    </span>
                </div>
                <div class="panel-body">
                    <div class="metric-grid">
                        <div class="metric-card highlight">
                            <div class="metric-label">Collected</div>
                            <div class="metric-value">{{ number_format($cableCol,2) }} m</div>
                            <div class="metric-note">Actual pullback captured from teardown log.</div>
                        </div>
                        <div class="metric-card">
                            <div class="metric-label">Expected</div>
                            <div class="metric-value">{{ number_format($cableExp,2) }} m</div>
                            <div class="metric-note">Snapshot from planned span teardown quantity.</div>
                        </div>
                    </div>

                    <div class="progress-wrap">
                        <div class="progress-top">
                            <span>Recovery performance</span>
                            <span>{{ $cablePct }}%</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width:{{ $cablePct }}%; background:{{ $cableBar }}"></div>
                        </div>
                    </div>

                    @if(!$log->did_collect_all_cable && $log->unrecovered_cable > 0)
                        <div class="callout warn">
                            <i class="mgc_alert_line"></i>
                            Unrecovered: {{ number_format($log->unrecovered_cable,2) }} m
                            @if($log->unrecovered_reason) — {{ $log->unrecovered_reason }} @endif
                        </div>
                    @else
                        <div class="callout success">
                            <i class="mgc_check_circle_line"></i>
                            Span fully recovered and ready for final validation.
                        </div>
                    @endif
                </div>
            </article>

            <article class="panel">
                <div class="panel-head">
                    <div>
                        <h2 class="panel-title">Recovered components</h2>
                        <div class="panel-sub">Switched from tiny tiles to readable operational rows.</div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="component-list">
                        @foreach($comps as [$label, $col, $exp])
                            @php $ok = $col >= $exp; @endphp
                            <div class="component-row">
                                <div>
                                    <div class="component-name">{{ $label }}</div>
                                    <div class="component-mini">Expected {{ $exp }} unit{{ $exp == 1 ? '' : 's' }}</div>
                                </div>
                                <div class="component-count">{{ $col }} <span style="font-family:inherit; font-size:.9rem; color:#7a8391; font-weight:800;">/ {{ $exp }}</span></div>
                                <div class="component-status {{ $ok ? 'ok' : 'short' }}">
                                    {{ $ok ? 'Complete' : 'Short by '.($exp-$col) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </article>

            <article class="panel">
                <div class="panel-head">
                    <div>
                        <h2 class="panel-title">Span location intelligence</h2>
                        <div class="panel-sub">Map becomes a true evidence module instead of a filler card.</div>
                    </div>
                </div>
                <div class="panel-body">
                    @if($hasGps)
                        <div class="map-shell">
                            <div class="map-toolbar">
                                @if($span?->length_meters)
                                    <span class="stat-pill">{{ number_format($span->length_meters,0) }} m span</span>
                                @endif
                                <button class="pill-btn" id="btnToggleLine" onclick="toggleSpanLine()">Span line: ON</button>
                            </div>
                            <div id="spanMap" style="height:100%; width:100%;"></div>
                        </div>
                    @else
                        <div class="map-empty">
                            <i class="mgc_map_line" style="font-size:2rem;"></i>
                            No GPS coordinates recorded for this span.
                        </div>
                    @endif
                </div>
            </article>
        </div>

        <div class="stack">
            <article class="panel">
                <div class="panel-head">
                    <div>
                        <h2 class="panel-title">Operational metadata</h2>
                        <div class="panel-sub">Grouped for quicker scanning by project admin and warehouse teams.</div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="meta-grid">
                        <div class="meta-card">
                            <div class="meta-label">Node</div>
                            <div class="meta-value">{{ $node?->node_id ?? '—' }}{{ $node?->node_name ? ' · '.$node->node_name : '' }}</div>
                        </div>
                        <div class="meta-card">
                            <div class="meta-label">Project</div>
                            <div class="meta-value">{{ $project?->project_name ?? '—' }}</div>
                        </div>
                        <div class="meta-card">
                            <div class="meta-label">Team</div>
                            <div class="meta-value">{{ $log->team ?: '—' }}</div>
                        </div>
                        <div class="meta-card">
                            <div class="meta-label">Submission status</div>
                            <div class="meta-value">{{ strtoupper(str_replace('_',' ',$log->status ?? 'submitted')) }}</div>
                        </div>
                    </div>
                    @if($sub)
                        <a href="{{ route('reports.show', $sub->id) }}" class="meta-link">
                            <i class="mgc_external_link_line"></i> Open linked daily report
                        </a>
                    @endif
                </div>
            </article>

            <article class="panel">
                <div class="panel-head">
                    <div>
                        <h2 class="panel-title">From pole documentation</h2>
                        <div class="panel-sub">Large previews and better hierarchy for before/after/tag evidence.</div>
                    </div>
                </div>
                <div class="panel-body photo-group">
                    <div class="photo-group-head">
                        <div class="photo-code">{{ $fromCode }}</div>
                        <span class="photo-role from">From pole</span>
                    </div>
                    <div class="photo-grid">
                        @foreach([['from_before','Before'],['from_after','After'],['from_tag','Pole Tag']] as [$type,$label])
                            @php $src = $imgFor($type); @endphp
                            <div class="photo-card">
                                <div class="photo-label">{{ $label }}</div>
                                <div class="photo-frame">
                                    @if($src)
                                        <img src="{{ $src }}" alt="{{ $label }}" onclick="tdZoom('{{ $src }}')">
                                    @else
                                        <div class="photo-empty">No image uploaded</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </article>

            <article class="panel">
                <div class="panel-head">
                    <div>
                        <h2 class="panel-title">To pole documentation</h2>
                        <div class="panel-sub">Same visual system, clearer and more polished for site evidence review.</div>
                    </div>
                </div>
                <div class="panel-body photo-group">
                    <div class="photo-group-head">
                        <div class="photo-code">{{ $toCode }}</div>
                        <span class="photo-role to">To pole</span>
                    </div>
                    <div class="photo-grid">
                        @foreach([['to_before','Before'],['to_after','After'],['to_tag','Pole Tag']] as [$type,$label])
                            @php $src = $imgFor($type); @endphp
                            <div class="photo-card">
                                <div class="photo-label">{{ $label }}</div>
                                <div class="photo-frame">
                                    @if($src)
                                        <img src="{{ $src }}" alt="{{ $label }}" onclick="tdZoom('{{ $src }}')">
                                    @else
                                        <div class="photo-empty">No image uploaded</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>

<div id="td-lightbox" onclick="this.classList.remove('open')">
    <button id="td-lb-close" onclick="event.stopPropagation();document.getElementById('td-lightbox').classList.remove('open')">&times;</button>
    <img id="td-lb-img" src="" alt="">
</div>

@push('scripts')
<script src="/assets/libs/leaflet/leaflet.js"></script>
<script>
function tdZoom(src) {
    document.getElementById('td-lb-img').src = src;
    document.getElementById('td-lightbox').classList.add('open');
}
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') document.getElementById('td-lightbox').classList.remove('open');
});

let _spanLine = null;
let _spanMap  = null;
function toggleSpanLine() {
    const btn = document.getElementById('btnToggleLine');
    if (!_spanLine || !_spanMap) return;
    if (_spanMap.hasLayer(_spanLine)) {
        _spanMap.removeLayer(_spanLine);
        btn.classList.add('off');
        btn.innerHTML = 'Span line: OFF';
    } else {
        _spanLine.addTo(_spanMap);
        btn.classList.remove('off');
        btn.innerHTML = 'Span line: ON';
    }
}

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

    const points = [FROM, TO].filter(p => p.lat && p.lng);
    const centerLat = points.reduce((s,p) => s + p.lat, 0) / points.length;
    const centerLng = points.reduce((s,p) => s + p.lng, 0) / points.length;

    const map = L.map('spanMap', { zoomControl: true }).setView([centerLat, centerLng], 17);
    _spanMap = map;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 20,
    }).addTo(map);

    function makeIcon(color) {
        return L.divIcon({
            className: '',
            html: `<div style="
                width:38px;height:38px;border-radius:50% 50% 50% 0;
                background:${color};border:4px solid rgba(255,255,255,.95);
                box-shadow:0 10px 24px rgba(0,0,0,.22);
                transform:rotate(-45deg);
            "></div>`,
            iconSize: [38, 38],
            iconAnchor: [19, 38],
            popupAnchor: [0, -34],
        });
    }

    function popupHTML(pole) {
        const roleColor = pole.role === 'From Pole' ? '#204ecf' : '#6842cf';
        let rows = '';
        if (pole.lat && pole.lng) rows += `<div class="map-popup-row">GPS <strong>${pole.lat.toFixed(6)}, ${pole.lng.toFixed(6)}</strong></div>`;
        if (pole.accuracy) rows += `<div class="map-popup-row">Accuracy <strong>±${parseFloat(pole.accuracy).toFixed(1)} m</strong></div>`;
        if (pole.gpsAt) rows += `<div class="map-popup-row">Captured <strong>${new Date(pole.gpsAt).toLocaleString('en-PH',{month:'short',day:'numeric',hour:'2-digit',minute:'2-digit'})}</strong></div>`;
        return `<div class="map-popup"><div class="map-popup-role" style="color:${roleColor}">${pole.role}</div><div class="map-popup-code">${pole.code}</div>${rows}</div>`;
    }

    const bounds = [];

    if (FROM.lat && FROM.lng) {
        L.marker([FROM.lat, FROM.lng], { icon: makeIcon('#204ecf') }).addTo(map).bindPopup(popupHTML(FROM), { maxWidth: 260 });
        bounds.push([FROM.lat, FROM.lng]);
    }

    if (TO.lat && TO.lng) {
        L.marker([TO.lat, TO.lng], { icon: makeIcon('#6842cf') }).addTo(map).bindPopup(popupHTML(TO), { maxWidth: 260 });
        bounds.push([TO.lat, TO.lng]);
    }

    if (FROM.lat && FROM.lng && TO.lat && TO.lng) {
        _spanLine = L.polyline([[FROM.lat, FROM.lng],[TO.lat, TO.lng]], {
            color: '#1b5bcb',
            weight: 5,
            opacity: .82,
            dashArray: '10 8',
        }).addTo(map);

        _spanLine.bindPopup(`<div class="map-popup">
            <div class="map-popup-role" style="color:#177245;">Span overview</div>
            <div class="map-popup-code">${spanCode}</div>
            ${spanLength ? `<div class="map-popup-row">Length <strong>${spanLength.toLocaleString()} m</strong></div>` : ''}
            <div class="map-popup-row">Cable recovered <strong>${cable.toFixed(2)} m</strong></div>
            <div class="map-popup-row">Route <strong>${FROM.code} → ${TO.code}</strong></div>
        </div>`, { maxWidth: 260 });
    }

    function refreshSpanMap() {
        map.invalidateSize();
        if (bounds.length > 1) {
            map.fitBounds(bounds, { padding: [44, 44], maxZoom: 18 });
        } else if (bounds.length === 1) {
            map.setView(bounds[0], 18);
        }
    }

    requestAnimationFrame(refreshSpanMap);
    setTimeout(refreshSpanMap, 120);
    window.addEventListener('load', refreshSpanMap);
    window.addEventListener('resize', refreshSpanMap);
})();
@endif
</script>
@endpush

</x-layout>
