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
</style>
@endpush

<div class="col-span-full tl-wrap">

    <div class="tl-top">
        <div>
            <div class="tl-eyebrow">Teardown Monitoring</div>
            <h2 class="tl-title">Live Teardown Logs</h2>
            <p class="tl-sub">All span teardown submissions from linemen in the field.</p>
        </div>
        <div class="live-badge">
            <span class="live-dot"></span>
            Live Feed
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

</x-layout>
