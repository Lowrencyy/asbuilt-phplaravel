<x-layout>

@push('styles')
<style>
:root{
    --sans:"Instrument Sans","Plus Jakarta Sans","Manrope","Segoe UI",sans-serif;
    --mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,monospace;
}
body{ font-family:var(--sans); }

.tl-wrap{ padding:1.25rem 1.25rem 3rem; }

/* ── Page header ────────────────────────────────────────────────── */
.tl-top{
    display:flex;align-items:flex-end;justify-content:space-between;
    gap:1rem;margin-bottom:1.25rem;flex-wrap:wrap;
}
.tl-eyebrow{
    display:inline-flex;align-items:center;gap:.5rem;
    padding:.35rem .72rem;border:1px solid #eef2f6;border-radius:999px;
    background:rgba(255,255,255,.9);font-size:.66rem;font-weight:800;
    letter-spacing:.14em;text-transform:uppercase;color:#6b7280;
    margin-bottom:.6rem;
}
.tl-eyebrow::before{
    content:"";width:8px;height:8px;border-radius:50%;
    background:linear-gradient(135deg,#2563eb,#111827);
    box-shadow:0 0 0 4px rgba(37,99,235,.08);
}
.tl-title{ margin:0;font-size:clamp(1.5rem,2vw,2rem);font-weight:900;color:#111827;letter-spacing:-.04em; }
.tl-sub{ margin:.3rem 0 0;color:#6b7280;font-size:.9rem; }

/* ── Live dot badge ─────────────────────────────────────────────── */
.live-badge{
    display:inline-flex;align-items:center;gap:.45rem;
    padding:.38rem .8rem;border-radius:999px;
    background:#ecfdf3;border:1px solid #b7ebcb;
    font-size:.72rem;font-weight:800;color:#15803d;
}
.live-dot{
    width:8px;height:8px;border-radius:50%;background:#22c55e;
    box-shadow:0 0 0 0 rgba(34,197,94,.5);
    animation:livepulse 1.4s infinite;
}
@keyframes livepulse{
    0%  { box-shadow:0 0 0 0 rgba(34,197,94,.55); }
    70% { box-shadow:0 0 0 7px rgba(34,197,94,0); }
    100%{ box-shadow:0 0 0 0 rgba(34,197,94,0); }
}

/* ── Cards grid ─────────────────────────────────────────────────── */
.tl-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(290px,1fr));
    gap:.85rem;
}

.tl-card{
    background:#fff;border:1px solid #eef2f6;border-radius:20px;
    padding:1rem 1.15rem 1.05rem;
    box-shadow:0 2px 10px rgba(17,24,39,.05);
    text-decoration:none;color:inherit;display:block;
    transition:transform .16s ease,box-shadow .16s ease,border-color .16s ease;
}
.tl-card:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 28px rgba(17,24,39,.09);
    border-color:#d1dffe;
}

/* thumbnail strip */
.tl-thumb-strip{
    display:flex;gap:.35rem;margin-bottom:.85rem;height:70px;border-radius:12px;overflow:hidden;
}
.tl-thumb{
    flex:1;background:#f3f5f7;border-radius:10px;overflow:hidden;
    display:flex;align-items:center;justify-content:center;
    color:#c0c8d4;font-size:1rem;
}
.tl-thumb img{ width:100%;height:100%;object-fit:cover;display:block; }

/* card body */
.tl-card-span{
    font-size:.82rem;font-weight:900;color:#111827;
    font-family:var(--mono);letter-spacing:.01em;margin-bottom:.2rem;
}
.tl-card-poles{
    font-size:.9rem;font-weight:900;color:#111827;letter-spacing:-.01em;
    margin-bottom:.25rem;
}
.tl-card-node{
    font-size:.73rem;color:#6b7280;font-weight:600;margin-bottom:.7rem;
}

.tl-card-chips{ display:flex;flex-wrap:wrap;gap:.35rem; }
.chip{
    display:inline-flex;align-items:center;gap:.3rem;
    padding:.22rem .55rem;border-radius:8px;
    font-size:.67rem;font-weight:800;letter-spacing:.02em;
}
.chip-blue   { background:#eef4ff;color:#1d4ed8; }
.chip-green  { background:#ecfdf3;color:#15803d; }
.chip-amber  { background:#fff7ed;color:#b45309; }
.chip-gray   { background:#f4f4f5;color:#52525b; }
.chip-violet { background:#f5f3ff;color:#6d28d9; }

.tl-card-foot{
    display:flex;align-items:center;justify-content:space-between;
    margin-top:.7rem;padding-top:.65rem;border-top:1px solid #f1f4f8;
    font-size:.7rem;color:#9ca3af;font-weight:700;
}
.tl-card-foot .arrow{ color:#c0c8d4;font-size:.85rem; }

/* ── Pagination ─────────────────────────────────────────────────── */
.tl-pag{
    display:flex;align-items:center;justify-content:space-between;
    gap:1rem;padding:1rem 0;font-size:.82rem;color:#6b7280;margin-top:.75rem;flex-wrap:wrap;
}
.tl-pag-links{ display:flex;align-items:center;gap:.35rem;flex-wrap:wrap; }
.tl-pag-links a,
.tl-pag-links span{
    display:inline-flex;align-items:center;justify-content:center;
    min-width:34px;height:34px;padding:0 .5rem;
    border-radius:10px;border:1px solid #eef2f6;background:#fff;
    color:#6b7280;text-decoration:none;font-size:.8rem;font-weight:800;transition:.14s ease;
}
.tl-pag-links a:hover{ background:#eef4ff;color:#2563eb;border-color:#c7d7fe; }
.tl-pag-links .active{ background:#111827;color:#fff;border-color:#111827; }

/* ── Empty state ────────────────────────────────────────────────── */
.tl-empty{
    text-align:center;padding:4rem 1rem;color:#9ca3af;
}
.tl-empty i{ font-size:2.5rem;display:block;margin-bottom:.6rem;color:#d0d7e0; }

/* ── Map tooltip + pole styles (used inside seq tracker map) ────── */
.leaflet-tooltip{ font-family:system-ui,sans-serif!important;padding:0!important;background:none!important;border:none!important;box-shadow:none!important; }
.leaflet-tooltip-top:before{ display:none; }
.tt{ background:#1e2433;color:#fff;border-radius:12px;padding:11px 15px;min-width:190px;font-family:system-ui,sans-serif;box-shadow:0 6px 24px rgba(0,0,0,.45);pointer-events:none; }
.tt-title{ font-size:13px;font-weight:800;margin-bottom:7px;border-bottom:1px solid rgba(255,255,255,.1);padding-bottom:6px; }
.tt-row{ display:flex;justify-content:space-between;font-size:11px;margin-top:5px;gap:12px; }
.tt-label{ color:#9ca3af;font-weight:600; }
.tt-val{ color:#fff;font-weight:700;text-align:right; }
.badge{ display:inline-block;padding:2px 8px;border-radius:99px;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.4px; }
.pole-circle{ display:flex;align-items:center;justify-content:center;border-radius:50%;border:3px solid;font-weight:800;box-shadow:0 2px 8px rgba(0,0,0,.22);cursor:pointer;transition:transform .15s,box-shadow .15s; }
.pole-circle:hover{ transform:scale(1.2);box-shadow:0 4px 18px rgba(0,0,0,.35); }
.leaflet-div-icon{ background:none!important;border:none!important; }

/* ── Sequence Tracker button ────────────────────────────────────── */
.btn-seqtracker{
    display:inline-flex;align-items:center;gap:.45rem;
    padding:.42rem .9rem;border-radius:999px;
    background:#4f46e5;color:#fff;border:none;
    font-size:.74rem;font-weight:800;font-family:var(--sans);
    cursor:pointer;box-shadow:0 4px 14px rgba(79,70,229,.28);
    transition:background .14s,transform .14s;
}
.btn-seqtracker:hover{ background:#4338ca;transform:translateY(-1px); }

/* ── Sequence Tracker Overlay ───────────────────────────────────── */
#seqOverlay{
    position:fixed;inset:0;z-index:2100;
    background:#0f172a;
    display:flex;flex-direction:column;
    opacity:0;pointer-events:none;
    transition:opacity .22s;
}
#seqOverlay.open{ opacity:1;pointer-events:all; }

.seq-hd{
    display:flex;align-items:center;gap:.75rem;
    padding:.75rem 1.1rem;
    background:#111827;border-bottom:1px solid #1e293b;
    flex-shrink:0;
}
.seq-hd-title{
    font-size:.92rem;font-weight:900;color:#f1f5f9;
    display:flex;align-items:center;gap:.5rem;
}
.seq-hd-close{
    margin-left:auto;width:34px;height:34px;border-radius:10px;
    background:#1e293b;border:1px solid #334155;color:#94a3b8;
    display:inline-flex;align-items:center;justify-content:center;
    cursor:pointer;font-size:1rem;transition:all .14s;
}
.seq-hd-close:hover{ background:#dc2626;border-color:#dc2626;color:#fff; }

/* Panel: node list */
#seqPanel{
    flex:1;min-height:0;overflow-y:auto;
    padding:1rem 1.1rem;
}
#seqPanel::-webkit-scrollbar{ width:5px; }
#seqPanel::-webkit-scrollbar-thumb{ background:#1e293b;border-radius:4px; }

.seq-search-wrap{
    margin-bottom:.85rem;
}
.seq-search{
    width:100%;box-sizing:border-box;
    background:#1e293b;border:1px solid #334155;border-radius:10px;
    color:#f1f5f9;font-size:.84rem;padding:.52rem .8rem;outline:none;
    font-family:var(--sans);
}
.seq-search::placeholder{ color:#475569; }
.seq-search:focus{ border-color:#6366f1; }

.seq-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
    gap:.75rem;
}
.seq-card{
    background:#1e293b;border:1px solid #334155;border-radius:16px;
    padding:1rem 1.1rem;cursor:pointer;
    transition:border-color .14s,transform .14s,background .14s;
}
.seq-card:hover{ background:#263547;border-color:#6366f1;transform:translateY(-2px); }
.seq-card-top{
    display:flex;align-items:flex-start;justify-content:space-between;gap:.6rem;
    margin-bottom:.65rem;
}
.seq-card-id{
    font-size:.7rem;font-weight:800;color:#6366f1;
    letter-spacing:.08em;text-transform:uppercase;
}
.seq-card-name{
    font-size:.9rem;font-weight:900;color:#f1f5f9;
    margin:.18rem 0 .22rem;line-height:1.25;
}
.seq-card-loc{
    font-size:.69rem;color:#64748b;font-weight:600;
}
.seq-pct-badge{
    flex-shrink:0;font-size:.75rem;font-weight:900;
    padding:.28rem .6rem;border-radius:8px;
    background:#0f172a;border:1px solid #1e293b;
    color:#f1f5f9;
}
.seq-progress-bar{
    height:5px;border-radius:999px;background:#0f172a;
    overflow:hidden;margin:.5rem 0 .6rem;
}
.seq-progress-fill{
    height:100%;border-radius:999px;
    background:linear-gradient(90deg,#22c55e,#16a34a);
    transition:width .4s ease;
}
.seq-card-stats{
    display:flex;gap:.65rem;flex-wrap:wrap;
}
.seq-stat{
    display:inline-flex;align-items:center;gap:.3rem;
    font-size:.68rem;font-weight:800;
}
.seq-stat-dot{
    width:8px;height:8px;border-radius:50%;flex-shrink:0;
}

/* Panel: map view */
#seqMapPanel{
    flex:1;min-height:0;display:none;
    flex-direction:column;
}
#seqMapPanel.active{ display:flex; }
.seq-map-bar{
    display:flex;align-items:center;gap:.65rem;
    padding:.6rem 1rem;background:#111827;border-bottom:1px solid #1e293b;
    flex-shrink:0;
}
.seq-map-back{
    background:#1e293b;border:1px solid #334155;color:#94a3b8;
    border-radius:8px;padding:.3rem .7rem;
    font-size:.75rem;font-weight:800;cursor:pointer;
    transition:all .14s;display:inline-flex;align-items:center;gap:.35rem;
}
.seq-map-back:hover{ background:#334155;color:#f1f5f9; }
.seq-map-title{
    font-size:.84rem;font-weight:900;color:#f1f5f9;
}
.seq-map-sub{
    font-size:.7rem;color:#64748b;font-weight:600;
}
#seqMapEl{
    flex:1;min-height:0;
}
.seq-legend{
    display:flex;align-items:center;gap:1.2rem;
    padding:.45rem 1rem;background:#111827;border-top:1px solid #1e293b;
    flex-shrink:0;flex-wrap:wrap;
}
.seq-ld{
    display:inline-flex;align-items:center;gap:.35rem;
    font-size:.68rem;font-weight:700;color:#64748b;
}
.seq-ld-dot{
    width:10px;height:10px;border-radius:50%;flex-shrink:0;
}

/* ── Live Map button ────────────────────────────────────────────── */
.btn-livemap{
    display:inline-flex;align-items:center;gap:.45rem;
    padding:.42rem .9rem;border-radius:999px;
    background:#111827;color:#fff;border:none;
    font-size:.74rem;font-weight:800;font-family:var(--sans);
    cursor:pointer;box-shadow:0 4px 14px rgba(17,24,39,.18);
    transition:background .14s,transform .14s;
}
.btn-livemap:hover{ background:#1f2937;transform:translateY(-1px); }
.btn-livemap .lm-dot{
    width:8px;height:8px;border-radius:50%;background:#22c55e;
    box-shadow:0 0 0 0 rgba(34,197,94,.5);
    animation:livepulse 1.4s infinite;flex-shrink:0;
}

/* ── Live Map Overlay ───────────────────────────────────────────── */
#liveMapOverlay{
    position:fixed;inset:0;z-index:2000;
    background:#0f172a;
    display:flex;flex-direction:column;
    opacity:0;pointer-events:none;
    transition:opacity .22s;
}
#liveMapOverlay.open{ opacity:1;pointer-events:all; }

.lmo-hd{
    display:flex;align-items:center;gap:.75rem;
    padding:.75rem 1.1rem;
    background:#111827;border-bottom:1px solid #1e293b;
    flex-shrink:0;
}
.lmo-title{
    font-size:.92rem;font-weight:900;color:#f1f5f9;
    display:flex;align-items:center;gap:.5rem;
}
.lmo-count{
    font-size:.72rem;font-weight:800;
    background:#1e293b;border:1px solid #334155;color:#94a3b8;
    padding:.2rem .55rem;border-radius:999px;
}
.lmo-last-sync{
    font-size:.69rem;color:#475569;margin-left:.5rem;font-weight:600;
}
.lmo-close{
    margin-left:auto;width:34px;height:34px;border-radius:10px;
    background:#1e293b;border:1px solid #334155;color:#94a3b8;
    display:inline-flex;align-items:center;justify-content:center;
    cursor:pointer;font-size:1rem;transition:all .14s;
}
.lmo-close:hover{ background:#dc2626;border-color:#dc2626;color:#fff; }

.lmo-legend{
    display:flex;align-items:center;gap:1rem;
    padding:.5rem 1.1rem;background:#0f172a;border-bottom:1px solid #1e293b;
    flex-shrink:0;flex-wrap:wrap;
}
.legend-item{
    display:inline-flex;align-items:center;gap:.35rem;
    font-size:.68rem;font-weight:700;color:#64748b;
}
.legend-dot{
    width:10px;height:10px;border-radius:50%;flex-shrink:0;
}

/* ── Map body = sidebar + map ───────────────────────────────────── */
.lmo-body{
    flex:1;min-height:0;display:flex;
}
.lmo-sidebar{
    width:260px;flex-shrink:0;
    background:#0f172a;border-right:1px solid #1e293b;
    display:flex;flex-direction:column;overflow:hidden;
}
.lmo-sb-search-wrap{
    padding:.6rem .75rem;border-bottom:1px solid #1e293b;flex-shrink:0;
}
.lmo-sb-search{
    width:100%;box-sizing:border-box;
    background:#1e293b;border:1px solid #334155;border-radius:8px;
    color:#f1f5f9;font-size:.78rem;padding:.42rem .65rem;outline:none;
    font-family:var(--sans);
}
.lmo-sb-search::placeholder{ color:#475569; }
.lmo-sb-search:focus{ border-color:#3b82f6; }
.lmo-sb-list{
    flex:1;overflow-y:auto;padding:.4rem .4rem;
}
.lmo-sb-list::-webkit-scrollbar{ width:4px; }
.lmo-sb-list::-webkit-scrollbar-track{ background:transparent; }
.lmo-sb-list::-webkit-scrollbar-thumb{ background:#1e293b;border-radius:4px; }

.lmo-sb-item{
    display:flex;align-items:center;gap:.6rem;
    padding:.55rem .65rem;border-radius:10px;
    cursor:pointer;transition:background .13s;
    border:1px solid transparent;margin-bottom:.25rem;
}
.lmo-sb-item:hover{ background:#1e293b;border-color:#334155; }
.lmo-sb-item.active{ background:#1e3a5f;border-color:#2563eb; }
.lmo-sb-avatar{
    width:34px;height:34px;border-radius:50%;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;
    font-size:.66rem;font-weight:900;color:#fff;
    border:2px solid transparent;
}
.lmo-sb-info{ flex:1;min-width:0; }
.lmo-sb-name{
    font-size:.78rem;font-weight:800;color:#f1f5f9;
    white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
}
.lmo-sb-meta{
    font-size:.65rem;color:#64748b;font-weight:600;
    white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
}
.lmo-sb-status{
    width:8px;height:8px;border-radius:50%;flex-shrink:0;
}
.lmo-sb-empty{
    color:#475569;font-size:.76rem;text-align:center;
    padding:2rem 1rem;font-weight:600;
}

#liveMapEl{
    flex:1;min-height:0;
}

/* ── Lineman avatar marker (DivIcon) ────────────────────────────── */
.lm-avatar-wrap{
    display:flex;flex-direction:column;align-items:center;gap:2px;
    cursor:pointer;
}
.lm-avatar{
    width:38px;height:38px;border-radius:50%;
    border:3px solid #fff;
    display:flex;align-items:center;justify-content:center;
    font-size:.7rem;font-weight:900;color:#fff;
    box-shadow:0 3px 12px rgba(0,0,0,.35);
    overflow:hidden;position:relative;
}
.lm-avatar img{
    width:100%;height:100%;object-fit:cover;
}
.lm-avatar-initials{
    font-size:.72rem;font-weight:900;letter-spacing:-.02em;
}
.lm-avatar-pulse{
    position:absolute;inset:-3px;border-radius:50%;
    border:3px solid currentColor;
    animation:avatarpulse 2s infinite;
    opacity:.5;
}
@keyframes avatarpulse{
    0%  {transform:scale(1);opacity:.5;}
    70% {transform:scale(1.35);opacity:0;}
    100%{transform:scale(1);opacity:0;}
}
.lm-name-tag{
    background:rgba(15,23,42,.82);color:#f1f5f9;
    padding:.15rem .45rem;border-radius:6px;
    font-size:.62rem;font-weight:800;white-space:nowrap;
    backdrop-filter:blur(4px);
    max-width:120px;overflow:hidden;text-overflow:ellipsis;
}
</style>
<link rel="stylesheet" href="/assets/libs/leaflet/leaflet.css"/>
@endpush

<div class="col-span-full tl-wrap">

    <div class="tl-top">
        <div>
            <div class="tl-eyebrow">Teardown Monitoring</div>
            <h2 class="tl-title">Live Teardown Logs</h2>
            <p class="tl-sub">All span teardown submissions from linemen in the field.</p>
        </div>
        <div style="display:flex;align-items:center;gap:.6rem;flex-wrap:wrap;">
            <a href="{{ route('reports.sequence-tracker') }}" class="btn-seqtracker">
                <i class="mgc_radar_line"></i> Sequence Tracker
            </a>
            <button class="btn-livemap" id="openLiveMap">
                <span class="lm-dot"></span>
                <i class="mgc_map_line"></i> Live Map
            </button>
            <div class="live-badge">
                <span class="live-dot"></span>
                Live Feed
            </div>
        </div>
    </div>

    @if($logs->isEmpty())
        <div class="tl-empty">
            <i class="mgc_file_line"></i>
            No teardown logs yet.
        </div>
    @else

        <div class="tl-grid">
            @foreach($logs as $log)
                @php
                    $span     = $log->poleSpan;
                    $fromPole = $span?->fromPole;
                    $toPole   = $span?->toPole;
                    $imgMap   = $log->images->keyBy('photo_type');
                    $thumb    = fn($t) => ($imgMap[$t] ?? null)?->image_path
                                    ? asset('storage/' . $imgMap[$t]->image_path)
                                    : null;

                    $fromCode = $fromPole?->pole_code ?? '?';
                    $toCode   = $toPole?->pole_code   ?? '?';
                    $cableCol = (float)$log->collected_cable;
                    $cableExp = (float)$log->expected_cable_snapshot;
                    $cablePct = $cableExp > 0 ? min(100, round(($cableCol / $cableExp) * 100)) : 0;
                @endphp

                <a class="tl-card" href="{{ route('reports.teardown-log.show', $log->id) }}">

                    {{-- Thumbnail strip: before (from) · before (to) · tag (from) --}}
                    <div class="tl-thumb-strip">
                        @foreach(['from_before','to_before','from_tag'] as $t)
                            <div class="tl-thumb">
                                @if($thumb($t))
                                    <img src="{{ $thumb($t) }}" alt="{{ $t }}">
                                @else
                                    <i class="mgc_pic_2_line"></i>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="tl-card-span">{{ $span?->pole_span_code ?? ('Log #'.$log->id) }}</div>
                    <div class="tl-card-poles">{{ $fromCode }} → {{ $toCode }}</div>
                    <div class="tl-card-node">
                        {{ $log->node?->node_id }}
                        @if($log->node?->node_name) — {{ $log->node->node_name }}@endif
                        @if($log->node?->city), {{ $log->node->city }}@endif
                    </div>

                    <div class="tl-card-chips">
                        @if($cableCol > 0)
                            <span class="chip chip-blue">{{ number_format($cableCol,1) }} m cable</span>
                        @endif
                        @if($log->team || $log->submitted_by)
                            <span class="chip chip-violet">{{ $log->team ?? $log->submitted_by }}</span>
                        @endif
                        @if($log->offline_mode)
                            <span class="chip chip-amber">Offline</span>
                        @endif
                        @if($cableExp > 0)
                            <span class="chip {{ $cablePct >= 100 ? 'chip-green' : ($cablePct >= 80 ? 'chip-blue' : 'chip-amber') }}">
                                {{ $cablePct }}%
                            </span>
                        @endif
                    </div>

                    <div class="tl-card-foot">
                        <span>{{ ($log->finished_at ?? $log->created_at)->diffForHumans() }}</span>
                        <span class="arrow"><i class="mgc_arrow_right_line"></i></span>
                    </div>

                </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($logs->hasPages())
            <div class="tl-pag">
                <span>Showing {{ $logs->firstItem() }}–{{ $logs->lastItem() }} of {{ $logs->total() }}</span>
                <div class="tl-pag-links">
                    @if($logs->onFirstPage())
                        <span style="opacity:.4;">‹</span>
                    @else
                        <a href="{{ $logs->previousPageUrl() }}">‹</a>
                    @endif

                    @foreach($logs->getUrlRange(max(1,$logs->currentPage()-2), min($logs->lastPage(),$logs->currentPage()+2)) as $page => $url)
                        @if($page == $logs->currentPage())
                            <span class="active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($logs->hasMorePages())
                        <a href="{{ $logs->nextPageUrl() }}">›</a>
                    @else
                        <span style="opacity:.4;">›</span>
                    @endif
                </div>
            </div>
        @endif

    @endif

</div>

{{-- ── Sequence Tracker Overlay ─────────────────────────────────── --}}
<div id="seqOverlay">
    <div class="seq-hd">
        <span style="color:#6366f1;font-size:1.1rem;"><i class="mgc_radar_line"></i></span>
        <span class="seq-hd-title">Sequence Tracker</span>
        <button class="seq-hd-close" id="closeSeqTracker" title="Close"><i class="mgc_close_line"></i></button>
    </div>

    {{-- Node list panel --}}
    <div id="seqPanel">
        <div class="seq-search-wrap">
            <input class="seq-search" id="seqSearch" type="text" placeholder="Search node, city, province…" autocomplete="off">
        </div>
        <div class="seq-grid" id="seqGrid">
            <div style="color:#475569;font-size:.8rem;grid-column:1/-1;text-align:center;padding:2rem;">Loading nodes…</div>
        </div>
    </div>

    {{-- Map panel (shown after selecting a node) --}}
    <div id="seqMapPanel">
        <div class="seq-map-bar">
            <button class="seq-map-back" id="seqMapBack"><i class="mgc_arrow_left_line"></i> Nodes</button>
            <div>
                <div class="seq-map-title" id="seqMapTitle">—</div>
                <div class="seq-map-sub" id="seqMapSub">—</div>
            </div>
        </div>
        <div id="seqMapEl"></div>
        <div class="seq-legend">
            <span class="seq-ld"><span class="seq-ld-dot" style="background:#10b981;"></span> Completed</span>
            <span class="seq-ld"><span class="seq-ld-dot" style="background:#f59e0b;"></span> Pending / Active</span>
            <span class="seq-ld"><span class="seq-ld-dot" style="background:#3b82f6;"></span> Not Started</span>
            <span class="seq-ld"><span class="seq-ld-dot" style="background:#ef4444;"></span> Canceled</span>
            <span class="seq-ld" style="margin-left:auto;font-size:.64rem;color:#334155;">Hover poles &amp; lines for details</span>
        </div>
    </div>
</div>

{{-- ── Live Field Map Overlay ──────────────────────────────────── --}}
<div id="liveMapOverlay">
    <div class="lmo-hd">
        <span class="lm-dot" style="flex-shrink:0;"></span>
        <span class="lmo-title">
            <i class="mgc_map_line"></i> Live Field Map
        </span>
        <span class="lmo-count" id="lmoCount">0 online</span>
        <span class="lmo-last-sync" id="lmoSync"></span>
        <button class="lmo-close" id="closeLiveMap" title="Close"><i class="mgc_close_line"></i></button>
    </div>
    <div class="lmo-legend">
        <span class="legend-item"><span class="legend-dot" style="background:#22c55e;box-shadow:0 0 0 3px rgba(34,197,94,.2);"></span> Active &lt; 5 min</span>
        <span class="legend-item"><span class="legend-dot" style="background:#f59e0b;"></span> Recent 5–30 min</span>
        <span class="legend-item"><span class="legend-dot" style="background:#64748b;"></span> Idle &gt; 30 min</span>
        <span class="legend-item" style="margin-left:auto;font-size:.67rem;color:#334155;">
            <i class="mgc_refresh_2_line"></i>&nbsp;Auto-refresh every 60s
        </span>
    </div>
    <div class="lmo-body">
        <div class="lmo-sidebar" id="lmoSidebar">
            <div class="lmo-sb-search-wrap">
                <input class="lmo-sb-search" id="lmoSearch" type="text" placeholder="Search lineman…" autocomplete="off">
            </div>
            <div class="lmo-sb-list" id="lmoList">
                <div class="lmo-sb-empty">No linemen online</div>
            </div>
        </div>
        <div id="liveMapEl"></div>
    </div>
</div>

@push('scripts')
<script src="/assets/libs/leaflet/leaflet.js"></script>
<script>
(function () {
    const LIVE_URL = '{{ route("reports.lineman-locations") }}';
    const CSRF     = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    let lmap = null, pollTimer = null, firstLoad = true;
    const markers = {};   // user_id → marker

    /* ── Colour palette for avatar backgrounds ── */
    const PALETTE = ['#2563eb','#7c3aed','#dc2626','#059669','#d97706','#0891b2','#db2777','#65a30d'];
    function avatarColor(id) { return PALETTE[id % PALETTE.length]; }

    /* ── Staleness helpers ── */
    function minsAgo(iso) {
        return (Date.now() - new Date(iso).getTime()) / 60000;
    }
    function statusColor(mins) {
        if (mins < 5)  return '#22c55e';
        if (mins < 30) return '#f59e0b';
        return '#64748b';
    }
    function statusLabel(mins) {
        if (mins < 1)  return 'Just now';
        if (mins < 60) return Math.round(mins) + ' min ago';
        return Math.round(mins / 60) + 'h ago';
    }

    /* ── Build a DivIcon with avatar + name tag ── */
    function buildIcon(u, mins) {
        const bg    = avatarColor(u.user_id);
        const sc    = statusColor(mins);
        const init  = (u.name || '?').split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
        const pulse = mins < 5
            ? `<div class="lm-avatar-pulse" style="color:${sc};"></div>` : '';
        const photo = u.photo_url
            ? `<img src="${u.photo_url}" alt="${u.name}"/>`
            : `<span class="lm-avatar-initials">${init}</span>`;
        return L.divIcon({
            className: '',
            html: `<div class="lm-avatar-wrap">
                     <div class="lm-avatar" style="background:${bg};border-color:${sc};">
                       ${pulse}${photo}
                     </div>
                     <div class="lm-name-tag">${(u.name||'Lineman').split(' ')[0]}</div>
                   </div>`,
            iconSize:   [44, 58],
            iconAnchor: [22, 58],
            popupAnchor:[0, -60],
        });
    }

    /* ── Popup content ── */
    function buildPopup(u, mins) {
        const sc   = statusColor(mins);
        const init = (u.name||'?').split(' ').map(w=>w[0]).join('').substring(0,2).toUpperCase();
        const rows = [
            u.subcon ? ['🏢 Subcon',  u.subcon]                         : null,
            u.team   ? ['👥 Team',    u.team]                           : null,
            u.role   ? ['🎖 Role',    u.role.replace(/_/g,' ').replace(/\b\w/g,c=>c.toUpperCase())] : null,
                       ['📍 Coords',  `${(+u.latitude).toFixed(5)}, ${(+u.longitude).toFixed(5)}`],
        ].filter(Boolean);

        return `<div style="font-family:system-ui,-apple-system,sans-serif;min-width:210px;padding:2px 0;">
            <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:.7rem;">
                <div style="width:42px;height:42px;border-radius:50%;flex-shrink:0;
                            background:${avatarColor(u.user_id)};border:2.5px solid ${sc};
                            display:flex;align-items:center;justify-content:center;
                            color:#fff;font-size:.78rem;font-weight:900;">
                    ${init}
                </div>
                <div>
                    <div style="font-weight:900;font-size:.92rem;color:#0f172a;line-height:1.2;">${u.name||'Lineman'}</div>
                    <div style="display:flex;align-items:center;gap:.3rem;margin-top:.18rem;">
                        <span style="width:7px;height:7px;border-radius:50%;background:${sc};display:inline-block;flex-shrink:0;"></span>
                        <span style="font-size:.68rem;font-weight:800;color:${sc};">${statusLabel(mins)}</span>
                    </div>
                </div>
            </div>
            <div style="background:#f8fafc;border-radius:10px;padding:.55rem .65rem;display:flex;flex-direction:column;gap:.32rem;">
                ${rows.map(([label, val]) => `
                <div style="display:flex;gap:.4rem;align-items:baseline;">
                    <span style="font-size:.62rem;font-weight:800;color:#94a3b8;min-width:58px;flex-shrink:0;">${label}</span>
                    <span style="font-size:.74rem;font-weight:700;color:#1e293b;">${val}</span>
                </div>`).join('')}
            </div>
        </div>`;
    }

    /* ── Init map (lazy, only once) ── */
    function initMap() {
        if (lmap) return;
        lmap = L.map('liveMapEl', { center:[12.3,122.5], zoom:6, zoomControl:true });
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution:'© OpenStreetMap', maxZoom:20
        }).addTo(lmap);
        // Invalidate twice — once fast, once after CSS transition settles
        setTimeout(() => lmap.invalidateSize(), 80);
        setTimeout(() => lmap.invalidateSize(), 350);
    }

    /* ── Sidebar ── */
    let _lastList = [];

    function renderSidebar(list, query) {
        const q = (query || '').toLowerCase().trim();
        const filtered = q ? list.filter(u => (u.name||'').toLowerCase().includes(q)
            || (u.subcon||'').toLowerCase().includes(q)
            || (u.team||'').toLowerCase().includes(q)) : list;

        const el = document.getElementById('lmoList');
        if (!filtered.length) {
            el.innerHTML = '<div class="lmo-sb-empty">' + (q ? 'No match' : 'No linemen online') + '</div>';
            return;
        }
        el.innerHTML = filtered.map(u => {
            const mins  = minsAgo(u.last_seen_at);
            const sc    = statusColor(mins);
            const bg    = avatarColor(u.user_id);
            const init  = (u.name||'?').split(' ').map(w=>w[0]).join('').substring(0,2).toUpperCase();
            const meta  = [u.subcon, u.team].filter(Boolean).join(' · ') || statusLabel(mins);
            return `<div class="lmo-sb-item" data-uid="${u.user_id}" data-lat="${u.latitude}" data-lng="${u.longitude}">
                <div class="lmo-sb-avatar" style="background:${bg};border-color:${sc};">${init}</div>
                <div class="lmo-sb-info">
                    <div class="lmo-sb-name">${u.name||'Lineman'}</div>
                    <div class="lmo-sb-meta">${meta}</div>
                </div>
                <div class="lmo-sb-status" style="background:${sc};"></div>
            </div>`;
        }).join('');

        el.querySelectorAll('.lmo-sb-item').forEach(row => {
            row.addEventListener('click', function() {
                const lat = +this.dataset.lat, lng = +this.dataset.lng, uid = +this.dataset.uid;
                lmap.setView([lat, lng], 16, { animate:true });
                if (markers[uid]) {
                    markers[uid].openPopup();
                }
                el.querySelectorAll('.lmo-sb-item').forEach(r => r.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }

    document.getElementById('lmoSearch').addEventListener('input', function() {
        renderSidebar(_lastList, this.value);
    });

    /* ── Fetch & render ── */
    async function fetchLocations() {
        try {
            const r    = await fetch(LIVE_URL, { headers:{ 'Accept':'application/json', 'X-CSRF-TOKEN':CSRF } });
            const data = await r.json();
            const list = Array.isArray(data) ? data : (data.data ?? []);
            _lastList  = list;

            const seen = new Set();

            list.forEach(u => {
                if (!u.latitude || !u.longitude) return;
                const mins = minsAgo(u.last_seen_at);
                seen.add(u.user_id);

                if (markers[u.user_id]) {
                    const m = markers[u.user_id];
                    m.setLatLng([+u.latitude, +u.longitude]);
                    m.setIcon(buildIcon(u, mins));
                    m.setPopupContent(buildPopup(u, mins));
                } else {
                    const m = L.marker([+u.latitude, +u.longitude], { icon: buildIcon(u, mins) })
                        .addTo(lmap)
                        .bindPopup(buildPopup(u, mins), { maxWidth:220 });
                    markers[u.user_id] = m;
                }
            });

            // Remove markers for users no longer in response
            Object.keys(markers).forEach(id => {
                if (!seen.has(+id)) { lmap.removeLayer(markers[id]); delete markers[id]; }
            });

            // Fit to markers only on first load
            if (firstLoad && Object.keys(markers).length) {
                firstLoad = false;
                const pts = list.filter(u => u.latitude && u.longitude)
                                .map(u => [+u.latitude, +u.longitude]);
                if (pts.length === 1) {
                    lmap.setView(pts[0], 14);
                } else if (pts.length > 1) {
                    lmap.fitBounds(L.latLngBounds(pts), { padding:[60,60], maxZoom:14 });
                }
            }

            // Update header count + sidebar
            const onlineCount = list.filter(u => minsAgo(u.last_seen_at) < 30).length;
            document.getElementById('lmoCount').textContent = onlineCount + ' online';
            const t = new Date();
            document.getElementById('lmoSync').textContent =
                'Synced ' + t.toLocaleTimeString('en-PH',{hour:'2-digit',minute:'2-digit',second:'2-digit'});
            renderSidebar(list, document.getElementById('lmoSearch').value);

        } catch(e) {
            document.getElementById('lmoSync').textContent = 'Sync failed — ' + new Date().toLocaleTimeString();
        }
    }

    /* ── Open / Close ── */
    document.getElementById('openLiveMap').addEventListener('click', function () {
        document.getElementById('liveMapOverlay').classList.add('open');
        document.body.style.overflow = 'hidden';
        firstLoad = true;
        initMap();
        // Delay first fetch so invalidateSize + CSS transition settle first
        setTimeout(fetchLocations, 400);
        if (pollTimer) clearInterval(pollTimer);
        pollTimer = setInterval(fetchLocations, 60000);
    });

    function closeMap() {
        document.getElementById('liveMapOverlay').classList.remove('open');
        document.body.style.overflow = '';
        clearInterval(pollTimer);
        pollTimer = null;
    }

    document.getElementById('closeLiveMap').addEventListener('click', closeMap);
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMap(); });
})();

/* ── Sequence Tracker ─────────────────────────────────────────── */
(function () {
    const NODES_URL    = '{{ route("reports.sequence-nodes") }}';
    const NODE_MAP_URL = '{{ url("reports/sequence-nodes") }}';

    let _allNodes = [], smap = null;

    /* ── Status colours (same as index.html) ── */
    const C = {
        completed:   { fill:'#10b981', border:'#059669', text:'#fff', badge:'background:#d1fae5;color:#065f46' },
        active:      { fill:'#f59e0b', border:'#d97706', text:'#fff', badge:'background:#fef3c7;color:#92400e' },
        pending:     { fill:'#f59e0b', border:'#d97706', text:'#fff', badge:'background:#fef3c7;color:#92400e' },
        not_started: { fill:'#3b82f6', border:'#2563eb', text:'#fff', badge:'background:#dbeafe;color:#1e40af' },
        canceled:    { fill:'#ef4444', border:'#dc2626', text:'#fff', badge:'background:#fee2e2;color:#991b1b' },
    };
    function gc(s){ return C[s] || C.not_started; }

    /* ── Node list rendering ── */
    function renderNodes(list) {
        const grid = document.getElementById('seqGrid');
        if (!list.length) {
            grid.innerHTML = '<div style="color:#475569;font-size:.8rem;grid-column:1/-1;text-align:center;padding:2rem;">No nodes found.</div>';
            return;
        }
        grid.innerHTML = list.map(n => {
            const pct  = n.pct ?? 0;
            const barW = Math.min(100, pct);
            const barC = pct >= 100 ? '#22c55e' : pct > 60 ? '#6366f1' : pct > 30 ? '#f59e0b' : '#ef4444';
            return `<div class="seq-card" data-id="${n.id}" data-name="${(n.node_name||n.node_id).replace(/"/g,'&quot;')}" data-loc="${[n.city,n.province].filter(Boolean).join(', ')}">
                <div class="seq-card-top">
                    <div>
                        <div class="seq-card-id">${n.node_id||'—'}</div>
                        <div class="seq-card-name">${n.node_name||n.node_id||'—'}</div>
                        <div class="seq-card-loc">${[n.city,n.province].filter(Boolean).join(', ')||'—'}</div>
                    </div>
                    <div class="seq-pct-badge" style="color:${barC};">${pct}%</div>
                </div>
                <div class="seq-progress-bar">
                    <div class="seq-progress-fill" style="width:${barW}%;background:${barC};"></div>
                </div>
                <div class="seq-card-stats">
                    <span class="seq-stat"><span class="seq-stat-dot" style="background:#10b981;"></span><span style="color:#d1fae5;">${n.completed} done</span></span>
                    <span class="seq-stat"><span class="seq-stat-dot" style="background:#f59e0b;"></span><span style="color:#fef3c7;">${n.pending} pending</span></span>
                    <span class="seq-stat"><span class="seq-stat-dot" style="background:#3b82f6;"></span><span style="color:#dbeafe;">${n.not_started} not started</span></span>
                    <span class="seq-stat" style="margin-left:auto;color:#475569;">${n.spans_count} spans</span>
                </div>
            </div>`;
        }).join('');

        grid.querySelectorAll('.seq-card').forEach(card => {
            card.addEventListener('click', function() {
                openNodeMap(+this.dataset.id, this.dataset.name, this.dataset.loc);
            });
        });
    }

    /* ── Filter ── */
    document.getElementById('seqSearch').addEventListener('input', function() {
        const q = this.value.toLowerCase().trim();
        const filtered = q ? _allNodes.filter(n =>
            (n.node_id||'').toLowerCase().includes(q) ||
            (n.node_name||'').toLowerCase().includes(q) ||
            (n.city||'').toLowerCase().includes(q) ||
            (n.province||'').toLowerCase().includes(q)
        ) : _allNodes;
        renderNodes(filtered);
    });

    /* ── Load node list ── */
    async function loadNodes() {
        try {
            const r    = await fetch(NODES_URL, { headers:{ Accept:'application/json' } });
            _allNodes  = await r.json();
            renderNodes(_allNodes);
        } catch(e) {
            document.getElementById('seqGrid').innerHTML =
                '<div style="color:#ef4444;grid-column:1/-1;text-align:center;padding:2rem;">Failed to load nodes.</div>';
        }
    }

    /* ── Open / close overlay ── */
    document.getElementById('openSeqTracker').addEventListener('click', function() {
        document.getElementById('seqOverlay').classList.add('open');
        document.body.style.overflow = 'hidden';
        if (!_allNodes.length) loadNodes();
    });

    function closeSeq() {
        document.getElementById('seqOverlay').classList.remove('open');
        document.body.style.overflow = '';
        showNodeList();
    }
    document.getElementById('closeSeqTracker').addEventListener('click', closeSeq);
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && document.getElementById('seqOverlay').classList.contains('open')) closeSeq(); });

    /* ── Panel switching ── */
    function showNodeList() {
        document.getElementById('seqPanel').style.display = '';
        document.getElementById('seqMapPanel').classList.remove('active');
    }
    function showMap() {
        document.getElementById('seqPanel').style.display = 'none';
        document.getElementById('seqMapPanel').classList.add('active');
    }
    document.getElementById('seqMapBack').addEventListener('click', showNodeList);

    /* ── Open a node map ── */
    async function openNodeMap(nodeId, name, loc) {
        document.getElementById('seqMapTitle').textContent = name;
        document.getElementById('seqMapSub').textContent   = loc || '—';
        showMap();

        // Init Leaflet once
        if (!smap) {
            smap = L.map('seqMapEl', { center:[12.3,122.5], zoom:6, zoomControl:true, attributionControl:false });
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                opacity:0.28, maxZoom:22, maxNativeZoom:19
            }).addTo(smap);
        }
        // Clear previous layers (keep tile layer)
        smap.eachLayer(l => { if (!(l instanceof L.TileLayer)) smap.removeLayer(l); });
        setTimeout(() => smap.invalidateSize(), 80);

        try {
            const r    = await fetch(`${NODE_MAP_URL}/${nodeId}`, { headers:{ Accept:'application/json' } });
            const data = await r.json();
            drawMap(data.poles || [], data.spans || []);
        } catch(e) { console.error('seq map load failed', e); }
    }

    /* ── Draw poles + spans ── */
    function drawMap(poles, spans) {
        const poleById = {};
        poles.forEach(p => { poleById[p.id] = p; });
        const bounds = [];

        /* Spans */
        spans.forEach(s => {
            if (!s.from_lat || !s.from_lng || !s.to_lat || !s.to_lng) return;
            const c    = gc(s.status);
            const dash = (s.status === 'not_started' || s.status === 'canceled') ? '7,5' : null;
            const opts = { color:c.fill, weight:4, opacity: s.status==='canceled'?0.45:0.88 };
            if (dash) opts.dashArray = dash;

            const line = L.polyline([[s.from_lat,s.from_lng],[s.to_lat,s.to_lng]], opts).addTo(smap);

            const rec  = s.len > 0 ? Math.round((s.collected/s.len)*100) : 0;
            function compRow(label, col, exp) {
                if (!exp) return '';
                const ok = col >= exp;
                return `<div class="tt-row"><span class="tt-label">${label}</span><span class="tt-val" style="color:${ok?'#10b981':'#f59e0b'}">${col}/${exp}${ok?' ✓':' ⚠'}</span></div>`;
            }
            const unrecParts = [];
            if ((s.exp_node||0)-(s.col_node||0)>0) unrecParts.push('Node ×'+((s.exp_node||0)-(s.col_node||0)));
            if ((s.exp_amp||0)-(s.col_amp||0)>0)  unrecParts.push('AMP ×'+((s.exp_amp||0)-(s.col_amp||0)));
            if ((s.exp_ext||0)-(s.col_ext||0)>0)  unrecParts.push('EXT ×'+((s.exp_ext||0)-(s.col_ext||0)));
            if ((s.exp_tsc||0)-(s.col_tsc||0)>0)  unrecParts.push('TSC ×'+((s.exp_tsc||0)-(s.col_tsc||0)));
            const hasComp = s.exp_node||s.exp_amp||s.exp_ext||s.exp_tsc;

            const tt = `<div class="tt">
                <div class="tt-title">📡 ${s.code}</div>
                <div class="tt-row"><span class="tt-label">Status</span><span class="tt-val"><span class="badge" style="${c.badge}">${s.status.replace(/_/g,' ')}</span></span></div>
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
            const ml=(s.from_lat+s.to_lat)/2, mg=(s.from_lng+s.to_lng)/2;
            if (s.len > 0) {
                L.marker([ml,mg],{ icon:L.divIcon({
                    className:'',
                    html:`<span style="font:700 11px Inter,sans-serif;color:#f1f5f9;background:#1e293b;padding:3px 8px;border-radius:6px;white-space:nowrap;display:inline-block;box-shadow:0 1px 6px rgba(0,0,0,.45);border:1px solid ${c.fill}55;">${s.len} m</span>`,
                    iconSize:[80,22],iconAnchor:[40,11]
                }), interactive:false }).addTo(smap);
            }
        });

        /* Poles */
        poles.forEach(p => {
            if (!p.lat || !p.lng) return;
            const c    = gc(p.status);
            const size = 33;
            const label= p.code.replace(/^[A-Z0-9]+-/,'');
            const icon = L.divIcon({
                className:'',
                html:`<div class="pole-circle" style="width:${size}px;height:${size}px;background:${c.fill};border-color:${c.border};color:${c.text};font-size:8px;">${label}</div>`,
                iconSize:[size,size], iconAnchor:[size/2,size/2]
            });
            const rec  = 0;
            const tt   = `<div class="tt">
                <div class="tt-title">🔌 ${p.code}</div>
                <div class="tt-row"><span class="tt-label">Status</span><span class="tt-val"><span class="badge" style="${c.badge}">${p.status.replace(/_/g,' ')}</span></span></div>
                ${p.completed_at?`<div class="tt-row"><span class="tt-label">Completed</span><span class="tt-val">${p.completed_at}</span></div>`:''}
            </div>`;
            L.marker([p.lat,p.lng],{icon}).addTo(smap).bindTooltip(tt,{sticky:true,direction:'top',opacity:1,className:'',offset:[0,-(size/2)-6]});
            bounds.push([p.lat,p.lng]);
        });

        if (bounds.length) {
            if (bounds.length === 1) smap.setView(bounds[0], 16);
            else smap.fitBounds(L.latLngBounds(bounds), { padding:[65,65], maxZoom:18 });
        }
    }
})();
</script>
@endpush

</x-layout>
