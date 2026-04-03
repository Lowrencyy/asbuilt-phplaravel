<x-layout>

@push('styles')
<style>
:root{
    --sans:"Instrument Sans","Plus Jakarta Sans","Manrope","Segoe UI",sans-serif;
    --mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,monospace;
    --pr-bg:#ffffff;
    --pr-surface:#ffffff;
    --pr-line:#e6edf5;
    --pr-text:#0f172a;
    --pr-muted:#7a8aa0;
    --pr-green:#22c55e;
    --pr-green-deep:#16a34a;
    --pr-blue:#3b82f6;
    --pr-red:#ef4444;
    --pr-shadow:0 18px 40px rgba(15,23,42,.06);
}
body{
    font-family:var(--sans);
    background:#ffffff;
    color:var(--pr-text);
}

.pr-wrap{ padding:1.4rem 1.25rem 3rem; }

.pr-top{
    position:relative;
    overflow:hidden;
    text-align:center;
    padding:1.5rem 1.25rem 1.35rem;
    margin-bottom:1.2rem;
    border-radius:28px;
    background:
        linear-gradient(180deg, rgba(255,255,255,.98), rgba(248,250,252,.96)),
        linear-gradient(90deg, rgba(34,197,94,.04), rgba(59,130,246,.04));
    border:1px solid #eef2f6;
    box-shadow:var(--pr-shadow);
}
.pr-top::before{
    content:"";
    position:absolute;
    inset:0;
    background:repeating-linear-gradient(90deg, transparent 0 34px, rgba(148,163,184,.05) 34px 35px);
    pointer-events:none;
}
.pr-top > *{ position:relative; z-index:1; }
.pr-eyebrow{
    display:inline-flex;align-items:center;gap:.5rem;
    padding:.45rem .9rem;border:1px solid rgba(34,197,94,.18);border-radius:999px;
    background:#f0fdf4;font-size:.72rem;font-weight:900;
    letter-spacing:.18em;text-transform:uppercase;color:#15803d;
    margin-bottom:.8rem;
}
.pr-eyebrow::before{
    content:"";width:9px;height:9px;border-radius:50%;
    background:linear-gradient(135deg,#22c55e,#16a34a);
    box-shadow:0 0 0 5px rgba(34,197,94,.10);
}
.pr-title{
    margin:0;
    font-size:clamp(2rem,4vw,3.2rem);
    font-weight:950;
    color:#0b1324;
    letter-spacing:-.06em;
    line-height:1.02;
}
.pr-sub{
    margin:.75rem auto 0;
    color:#66768d;
    font-size:1rem;
    max-width:760px;
    line-height:1.7;
}
.pr-top-action{
    margin-top:1rem;
    display:inline-flex;align-items:center;gap:.45rem;padding:.58rem 1rem;
    background:#fff;border:1px solid #e5e7eb;border-radius:999px;font-size:.8rem;font-weight:900;color:#374151;text-decoration:none;
    box-shadow:0 8px 18px rgba(15,23,42,.05);
}

.pr-search-wrap{
    margin:0 auto 1.25rem;
    max-width:620px;
    padding:1rem;
    border:1px solid var(--pr-line);
    border-radius:24px;
    background:linear-gradient(180deg,#fff,#fbfdff);
    box-shadow:0 12px 26px rgba(15,23,42,.04);
    text-align:center;
}
.pr-search-label{
    font-size:.72rem;
    font-weight:900;
    letter-spacing:.16em;
    text-transform:uppercase;
    color:#94a3b8;
    margin-bottom:.7rem;
}
.pr-search-field{ position:relative; }
.pr-search-field i{
    position:absolute;left:1rem;top:50%;transform:translateY(-50%);
    color:#94a3b8;font-size:1rem;pointer-events:none;
}
.pr-search{
    width:100%;box-sizing:border-box;
    background:#fff;border:1.5px solid #dbe4ea;border-radius:16px;
    color:#111827;font-size:.95rem;padding:.9rem 1rem .9rem 2.9rem;outline:none;
    font-family:var(--sans);box-shadow:0 1px 4px rgba(17,24,39,.03);
    transition:border-color .14s, box-shadow .14s;
}
.pr-search:focus{ border-color:#22c55e; box-shadow:0 0 0 5px rgba(34,197,94,.10); }

.pr-group{ margin-bottom:2.2rem; }
.pr-group-header{
    display:flex;flex-direction:column;align-items:center;justify-content:center;
    gap:.7rem;margin-bottom:1rem;padding:0 0 .2rem;
    text-align:center;
}
.pr-group-logo{
    width:78px;height:78px;padding:12px;
    border-radius:24px;
    display:grid;place-items:center;
    background:linear-gradient(180deg,#ffffff,#f5f9ff);
    border:1.5px solid rgba(59,130,246,.18);
    box-shadow:0 12px 24px rgba(59,130,246,.08);
}
.pr-group-logo img{ width:100%;height:100%;object-fit:contain;display:block; }
.pr-group-badge{
    display:inline-flex;align-items:center;
    padding:.34rem .78rem;background:#0f2f52;color:#fff;
    border-radius:999px;font-size:.72rem;font-weight:900;
    letter-spacing:.08em;text-transform:uppercase;
    font-family:var(--mono);
}
.pr-group-name{
    font-size:2rem;font-weight:950;color:#0b1324;letter-spacing:-.05em; line-height:1;
}
.pr-group-count{
    font-size:.95rem;font-weight:700;
    color:#94a3b8;background:transparent;border:none;
    border-radius:999px;padding:0;
}

.pr-grid{
    display:grid;
    grid-template-columns:repeat(4,minmax(0,1fr));
    gap:1rem;
}

.pr-card{
    position:relative;
    background:linear-gradient(180deg,#ffffff,#fbfdff);
    border:1px solid transparent;border-radius:28px;
    padding:1rem 1rem 1.05rem;
    box-shadow:0 10px 26px rgba(17,24,39,.06);
    text-decoration:none;display:block;
    transition:transform .18s ease,box-shadow .18s ease,border-color .18s ease;
    overflow:hidden;
}
.pr-card::before{
    content:"";
    position:absolute;
    inset:0;
    padding:1.5px;
    border-radius:28px;
    background:linear-gradient(135deg, rgba(34,197,94,.9), rgba(59,130,246,.9) 60%, rgba(239,68,68,.75));
    -webkit-mask:linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite:xor;
    mask-composite:exclude;
    pointer-events:none;
}
.pr-card::after{
    content:"";
    position:absolute;
    inset:1px;
    border-radius:26px;
    background:
        radial-gradient(circle at top left, rgba(34,197,94,.08), transparent 30%),
        radial-gradient(circle at top right, rgba(59,130,246,.08), transparent 28%),
        radial-gradient(circle at bottom right, rgba(239,68,68,.05), transparent 24%);
    pointer-events:none;
}
.pr-card:hover{
    transform:translateY(-4px);
    box-shadow:0 20px 40px rgba(17,24,39,.1);
}
.pr-card > *{ position:relative; z-index:1; }
.pr-card-top{
    display:flex;flex-direction:column;align-items:center;justify-content:center;
    gap:.8rem;margin-bottom:.8rem;text-align:center;
}
.pr-card-logo{
    width:calc(100% - 12px);
    height:88px;
    padding:10px 18px;
    border-radius:22px;
    display:grid;place-items:center;
    background:linear-gradient(180deg,#ffffff,#f3f8ff);
    border:1.5px solid rgba(34,197,94,.16);
    box-shadow:0 10px 22px rgba(34,197,94,.08), inset 0 1px 0 rgba(255,255,255,.9);
    overflow:hidden;
}
.pr-card-logo img{ width:100%;height:100%;object-fit:contain;display:block; }
.pr-card-id{
    display:inline-flex;align-items:center;gap:.5rem;
    font-size:.9rem;font-weight:900;color:#166534;
    letter-spacing:.02em;text-transform:uppercase;font-family:var(--mono);
    padding:.58rem 1rem;border-radius:999px;
    background:linear-gradient(180deg,#fbfffd,#f0fdf4);
    border:1px solid rgba(16,185,129,.14);
    box-shadow:0 8px 18px rgba(16,185,129,.08);
}
.pr-card-id::before{
    content:"";width:9px;height:9px;border-radius:50%;background:linear-gradient(135deg,#22c55e,#16a34a);
    box-shadow:0 0 0 5px rgba(34,197,94,.12);
}
.pr-card-name{
    font-size:1.1rem;font-weight:950;color:#0f172a;
    margin:.1rem 0 .2rem;line-height:1.2;text-align:center;
}
.pr-card-loc{ font-size:.82rem;color:#7f8ea4;font-weight:700; text-align:center; }
.pr-pct-badge{
    flex-shrink:0;font-size:.8rem;font-weight:900;
    padding:.34rem .72rem;border-radius:10px;
    border:1.5px solid;
}
.pr-progress-bar{
    height:7px;border-radius:999px;background:#eef2f7;
    overflow:hidden;margin:.7rem 0 .8rem;
}
.pr-progress-fill{ height:100%;border-radius:999px; transition:width .4s ease; }
.pr-card-stats{
    display:flex;gap:.55rem;flex-wrap:wrap;align-items:center;justify-content:center;
}
.pr-chip{
    display:inline-flex;align-items:center;gap:.32rem;
    font-size:.7rem;font-weight:900;padding:.3rem .62rem;border-radius:999px;
}
.pr-chip-dot{ width:7px;height:7px;border-radius:50%;flex-shrink:0; }
.chip-blue{ background:#eef4ff;color:#1d4ed8; }
.chip-green{ background:#ecfdf3;color:#15803d; }
.chip-gray{ background:#f4f4f5;color:#52525b; }
.pr-arrow{ margin-left:0; }

.pr-empty,
#prNoResults{
    text-align:center;padding:2.4rem 1rem;color:#9ca3af;
    border:1px dashed #d8e0ea;border-radius:22px;background:#fff;
}

#prNoResults{ display:none; margin-bottom:1rem; }

@media (max-width: 1200px){
    .pr-grid{ grid-template-columns:repeat(3,minmax(0,1fr)); }
}
@media (max-width: 900px){
    .pr-grid{ grid-template-columns:repeat(2,minmax(0,1fr)); }
}
@media (max-width: 700px){
    .pr-wrap{ padding:.9rem .8rem 2.3rem; }
    .pr-top{ padding:1.15rem .9rem 1.1rem; border-radius:22px; }
    .pr-title{ font-size:2rem; }
    .pr-sub{ font-size:.92rem; }
    .pr-search-wrap{ padding:.85rem; border-radius:20px; }
    .pr-grid{ grid-template-columns:1fr; }
    .pr-card{ border-radius:22px; }
    .pr-card-logo{ height:72px; width:calc(100% - 8px); }
    .pr-group-logo{ width:64px; height:64px; padding:10px; }
    .pr-group-name{ font-size:1.7rem; }
}
</style>
@endpush

<div class="col-span-full pr-wrap">

    <div class="pr-top">
        <div class="pr-eyebrow">Documentation</div>
        <h2 class="pr-title">Pole Reports</h2>
        <p class="pr-sub">Before &amp; after pole photos by node — click a node to view its full picture report.</p>
        <a href="{{ route('reports.sequence-tracker') }}" class="pr-top-action">
            <i class="mgc_arrow_left_line"></i> Sequence Tracker
        </a>
    </div>

    <div class="pr-search-wrap">
        <div class="pr-search-label">Quick search</div>
        <div class="pr-search-field">
            <i class="mgc_search_line"></i>
            <input class="pr-search" id="prSearch" type="text"
                   placeholder="Search node ID, name, city, province..."
                   autocomplete="off">
        </div>
    </div>

    <div id="prNoResults">No nodes match your search.</div>

    @forelse($projects as $project)
        @php
            $nodes = $project->nodes->sortBy('node_id');
        @endphp
        @if($nodes->isNotEmpty())
        <div class="pr-group" data-project="{{ strtolower($project->project_name) }}">
            <div class="pr-group-header">
                <div class="pr-group-logo">
                    <img src="{{ asset('assets/images/logo-light.png') }}" alt="Logo">
                </div>
                @if($project->project_code)
                    <span class="pr-group-badge">{{ $project->project_code }}</span>
                @endif
                <span class="pr-group-name">{{ $project->project_name }}</span>
                <span class="pr-group-count">{{ $nodes->count() }} nodes</span>
            </div>

            <div class="pr-grid">
                @foreach($nodes as $node)
                    @php
                        $total     = $node->poles_count ?? 0;
                        $completed = $completedByNode[$node->id] ?? 0;
                        $pct       = $total > 0 ? round(($completed / $total) * 100) : 0;
                        $barColor  = $pct >= 100 ? '#10b981' : ($pct > 60 ? '#6366f1' : ($pct > 30 ? '#f59e0b' : '#ef4444'));
                        $bdColor   = $pct >= 100 ? '#d1fae5' : ($pct > 60 ? '#e0e7ff' : ($pct > 30 ? '#fef3c7' : '#fee2e2'));
                        $txtColor  = $pct >= 100 ? '#065f46' : ($pct > 60 ? '#3730a3' : ($pct > 30 ? '#92400e' : '#991b1b'));
                    @endphp
                    <a href="{{ route('reports.pole-reports.show', $node) }}"
                       class="pr-card"
                       data-search="{{ strtolower($node->node_id . ' ' . $node->node_name . ' ' . $node->city . ' ' . $node->province) }}">
                        <div class="pr-card-top">
                            <div class="pr-card-id">{{ $node->node_id }}</div>
                            <div class="pr-card-logo">
                                <img src="{{ asset('assets/images/logo-light.png') }}" alt="Logo">
                            </div>
                            <div class="pr-card-name">{{ $node->node_name ?: $node->node_id }}</div>
                            <div class="pr-card-loc">
                                {{ collect([$node->city, $node->province])->filter()->join(', ') ?: '—' }}
                            </div>
                            <div class="pr-pct-badge"
                                 style="color:{{ $txtColor }};background:{{ $bdColor }};border-color:{{ $barColor }}55;">
                                {{ $pct }}%
                            </div>
                        </div>
                        <div class="pr-progress-bar">
                            <div class="pr-progress-fill"
                                 style="width:{{ min(100,$pct) }}%;background:{{ $barColor }};"></div>
                        </div>
                        <div class="pr-card-stats">
                            <span class="pr-chip chip-blue">
                                <span class="pr-chip-dot" style="background:#6366f1;"></span>
                                {{ $total }} poles
                            </span>
                            <span class="pr-chip chip-green">
                                <span class="pr-chip-dot" style="background:#10b981;"></span>
                                {{ $completed }} with photos
                            </span>
                            <span class="pr-chip chip-gray pr-arrow">View &rsaquo;</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    @empty
        <div class="pr-empty">No projects or nodes found.</div>
    @endforelse

</div>

@push('scripts')
<script>
(function () {
    const input    = document.getElementById('prSearch');
    const noResult = document.getElementById('prNoResults');
    const groups   = document.querySelectorAll('.pr-group');

    if (!input) return;

    input.addEventListener('input', function () {
        const q = this.value.toLowerCase().trim();
        let visibleCount = 0;

        groups.forEach(group => {
            const cards = group.querySelectorAll('.pr-card');
            let groupVisible = 0;

            cards.forEach(card => {
                const text = card.dataset.search || '';
                const projText = group.dataset.project || '';
                const show = !q || text.includes(q) || projText.includes(q);
                card.style.display = show ? '' : 'none';
                if (show) groupVisible++;
            });

            group.style.display = groupVisible > 0 ? '' : 'none';
            visibleCount += groupVisible;
        });

        noResult.style.display = (q && visibleCount === 0) ? 'block' : 'none';
    });
})();
</script>
@endpush

</x-layout>
