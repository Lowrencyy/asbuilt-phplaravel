<x-layout>

@push('styles')
<style>
:root{
    --rtd-bg:#ffffff;
    --rtd-surface:#ffffff;
    --rtd-surface-2:rgba(255,255,255,.76);
    --rtd-text:#0f172a;
    --rtd-muted:#64748b;
    --rtd-line:#e2e8f0;
    --rtd-green:#10b981;
    --rtd-green-deep:#059669;
    --rtd-green-soft:#ecfdf5;
    --rtd-green-soft-2:#dff7ec;
    --rtd-green-glow:rgba(16,185,129,.18);
    --rtd-blue:#3b82f6;
    --rtd-blue-deep:#1d4ed8;
    --rtd-blue-soft:#eff6ff;
    --rtd-shadow:0 18px 45px rgba(15,23,42,.08);
    --rtd-shadow-soft:0 10px 30px rgba(15,23,42,.05);
    --rtd-radius-xl:28px;
    --rtd-radius-lg:22px;
    --rtd-radius-md:16px;
    --sans:"Instrument Sans","Plus Jakarta Sans","Manrope","Segoe UI",sans-serif;
    --mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,monospace;
}

body{
    font-family:var(--sans);
    background:#ffffff;
    color:var(--rtd-text);
}

.rtd-shell{
    position:relative;
    padding:1.5rem 1.25rem 3rem;
}

.rtd-shell::before,
.rtd-shell::after{
    content:"";
    position:absolute;
    border-radius:999px;
    filter:blur(18px);
    opacity:.5;
    pointer-events:none;
}

.rtd-shell::before{
    width:180px;height:180px;
    top:18px;right:4%;
    background:rgba(16,185,129,.10);
}

.rtd-shell::after{
    width:140px;height:140px;
    top:240px;left:2%;
    background:rgba(5,150,105,.08);
}

.rtd-hero{
    position:relative;
    overflow:hidden;
    background:
        linear-gradient(135deg, rgba(255,255,255,.94), rgba(255,255,255,.82)),
        linear-gradient(135deg, rgba(16,185,129,.07), rgba(59,130,246,.06));
    border:1px solid rgba(255,255,255,.9);
    box-shadow:var(--rtd-shadow);
    border-radius:var(--rtd-radius-xl);
    padding:1.35rem;
    margin-bottom:1.25rem;
}

.rtd-hero::before{
    content:"";
    position:absolute;
    inset:0;
    background:
        linear-gradient(120deg, transparent 0%, rgba(16,185,129,.05) 32%, transparent 64%),
        repeating-linear-gradient(90deg, transparent 0 34px, rgba(148,163,184,.04) 34px 35px);
    pointer-events:none;
}

.rtd-hero-grid{
    position:relative;
    z-index:1;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    gap:1.15rem;
    text-align:center;
}

.rtd-kicker{
    display:inline-flex;
    align-items:center;
    gap:.55rem;
    border-radius:999px;
    padding:.45rem .8rem;
    background:var(--rtd-green-soft);
    color:var(--rtd-green-deep);
    font-size:.7rem;
    font-weight:900;
    letter-spacing:.16em;
    text-transform:uppercase;
    border:1px solid rgba(16,185,129,.15);
    margin:0 auto .8rem;
}

.rtd-kicker::before{
    content:"";
    width:8px;height:8px;border-radius:50%;
    background:linear-gradient(135deg,var(--rtd-green),var(--rtd-green-deep));
    box-shadow:0 0 0 5px rgba(16,185,129,.10);
}

.rtd-title{
    margin:0 auto;
    font-size:clamp(1.9rem,3vw,2.8rem);
    line-height:1.02;
    letter-spacing:-.055em;
    font-weight:950;
    color:#0b1324;
    max-width:11ch;
}

.rtd-desc{
    margin:.8rem auto 0;
    max-width:54ch;
    color:#5f728a;
    font-size:1rem;
    line-height:1.75;
}

.rtd-search-panel{
    width:min(100%, 620px);
    align-self:center;
    display:flex;
    flex-direction:column;
    justify-content:center;
    gap:.55rem;
    padding:.85rem .95rem 1rem;
    border-radius:22px;
    background:linear-gradient(180deg, rgba(255,255,255,.94), rgba(248,250,252,.90));
    border:1px solid rgba(226,232,240,.9);
    box-shadow:0 12px 28px rgba(15,23,42,.05), inset 0 1px 0 rgba(255,255,255,.7);
    backdrop-filter:blur(12px);
    text-align:center;
    margin:1.1rem auto 0;
}

.rtd-search-label{
    font-size:.66rem;
    font-weight:900;
    letter-spacing:.18em;
    text-transform:uppercase;
    color:#94a3b8;
    margin-bottom:0;
}

.rtd-search-wrap{ position:relative; width:100%; max-width:520px; margin:0 auto; }
.rtd-search-wrap i{
    position:absolute;
    left:1rem;
    top:50%;
    transform:translateY(-50%);
    color:#94a3b8;
    font-size:1rem;
    pointer-events:none;
}

.rtd-search{
    width:100%;
    height:50px;
    border-radius:16px;
    border:1.5px solid #dbe4ea;
    background:linear-gradient(180deg,#ffffff,#f8fafc);
    padding:0 1rem 0 3rem;
    color:#334155;
    font-size:.9rem;
    font-family:var(--sans);
    outline:none;
    transition:border-color .16s, box-shadow .16s, transform .16s;
    box-shadow:0 6px 16px rgba(15,23,42,.04);
}

.rtd-search:focus{
    border-color:rgba(16,185,129,.45);
    box-shadow:0 0 0 5px rgba(16,185,129,.10), 0 10px 26px rgba(15,23,42,.06);
}


.rtd-stats{
    display:grid;
    grid-template-columns:repeat(3, minmax(0,1fr));
    gap:.85rem;
    margin:1.25rem 0 1.5rem;
    text-align:center;
}

.rtd-stat{
    position:relative;
    overflow:hidden;
    padding:1rem 1.05rem;
    background:rgba(255,255,255,.82);
    border:1px solid rgba(255,255,255,.8);
    border-radius:20px;
    box-shadow:var(--rtd-shadow-soft);
}

.rtd-stat::before{
    content:"";
    position:absolute;
    inset:auto auto 0 0;
    width:100%;
    height:3px;
    background:linear-gradient(90deg,var(--rtd-green),var(--rtd-blue),rgba(59,130,246,.12));
}

.rtd-stat-label{
    color:#94a3b8;
    text-transform:uppercase;
    letter-spacing:.12em;
    font-size:.68rem;
    font-weight:900;
    margin-bottom:.38rem;
}

.rtd-stat-value{
    font-size:1.4rem;
    font-weight:900;
    letter-spacing:-.04em;
    color:#0f172a;
}

.rtd-stat-sub{
    margin-top:.22rem;
    font-size:.78rem;
    color:var(--rtd-muted);
}

.rtd-section{
    margin-bottom:1.55rem;
}

.rtd-section-head{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:1rem;
    margin-bottom:1.4rem;
    text-align:center;
}

.rtd-section-badge{
    flex:0 0 auto;
    width:64px;
    height:64px;
    padding:10px;
    border-radius:20px;
    display:grid;
    place-items:center;
    background:linear-gradient(180deg,#ffffff,#f5f9ff);
    border:1.5px solid rgba(59,130,246,.20);
    box-shadow:0 12px 26px rgba(59,130,246,.08), inset 0 1px 0 rgba(255,255,255,.9);
    overflow:hidden;
}

.rtd-group-title-wrap{ min-width:0; text-align:center; }

.rtd-group-title{
    margin:0;
    font-size:1.45rem;
    font-weight:950;
    letter-spacing:-.04em;
    color:#0f172a;
    text-transform:capitalize;
}

.rtd-group-meta{
    margin-top:.28rem;
    font-size:.95rem;
    color:#94a3b8;
}

.rtd-divider{
    display:none;
}

.rtd-grid{
    display:grid;
    grid-template-columns:repeat(4,minmax(0,1fr));
    gap:1rem;
    align-items:stretch;
}

.rtd-card{
    position:relative;
    display:flex;
    flex-direction:column;
    align-items:center;
    text-align:center;
    text-decoration:none;
    color:inherit;
    min-height:292px;
    background:linear-gradient(180deg,#ffffff,#fbfdff);
    border:1px solid transparent;
    border-radius:30px;
    padding:1.1rem 1.05rem 1rem;
    box-shadow:0 18px 40px rgba(15,23,42,.06), 0 8px 22px rgba(16,185,129,.05);
    overflow:hidden;
    isolation:isolate;
    transition:transform .2s ease, box-shadow .2s ease, border-color .2s ease;
}

.rtd-card::before{
    content:"";
    position:absolute;
    inset:0;
    padding:1.5px;
    border-radius:30px;
    background:linear-gradient(135deg, rgba(34,197,94,.95), rgba(59,130,246,.9) 55%, rgba(239,68,68,.85));
    -webkit-mask:linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite:xor;
    mask-composite:exclude;
    pointer-events:none;
    z-index:1;
}

.rtd-card::after{
    content:"";
    position:absolute;
    inset:1px;
    border-radius:28px;
    background:
        radial-gradient(circle at top left, rgba(34,197,94,.08), transparent 28%),
        radial-gradient(circle at top right, rgba(59,130,246,.08), transparent 28%),
        radial-gradient(circle at bottom right, rgba(239,68,68,.07), transparent 26%);
    pointer-events:none;
    z-index:0;
}

.rtd-card:hover{
    transform:translateY(-6px);
    box-shadow:0 28px 54px rgba(15,23,42,.10), 0 12px 26px rgba(59,130,246,.12);
}



.rtd-card-top{
    position:relative;
    z-index:2;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    gap:1.1rem;
    margin-bottom:1.1rem;
    width:100%;
}

.rtd-id{
    display:inline-flex;
    align-items:center;
    gap:.5rem;
    min-width:0;
    max-width:100%;
    padding:.58rem 1rem;
    border-radius:999px;
    background:linear-gradient(180deg,#fbfffd,#f0fdf4);
    border:1px solid rgba(16,185,129,.14);
    color:#166534;
    font-family:var(--mono);
    font-size:.9rem;
    font-weight:900;
    letter-spacing:.02em;
    box-shadow:0 8px 18px rgba(16,185,129,.08);
}

.rtd-id::before{
    content:"";
    width:9px;
    height:9px;
    border-radius:50%;
    background:linear-gradient(135deg,var(--rtd-green),var(--rtd-green-deep));
    box-shadow:0 0 0 5px rgba(16,185,129,.12);
}

.rtd-card-arrow{
    width:calc(100% - 32px);
    max-width:none;
    height:92px;
    padding:12px 18px;
    flex:0 0 auto;
    border-radius:24px;
    display:grid;
    place-items:center;
    background:linear-gradient(180deg,#ffffff,#f3f8ff);
    border:1.5px solid rgba(34,197,94,.16);
    box-shadow:0 12px 28px rgba(34,197,94,.10), inset 0 1px 0 rgba(255,255,255,.9);
    overflow:hidden;
    transition:transform .16s ease, box-shadow .16s ease;
}

.rtd-card:hover .rtd-card-arrow{
    transform:translateY(-1px) scale(1.03);
    box-shadow:0 14px 26px rgba(34,197,94,.12), inset 0 1px 0 rgba(255,255,255,.9);
}

.rtd-card-name{
    position:relative;
    z-index:2;
    margin:0 0 .55rem;
    font-size:1.1rem;
    font-weight:900;
    line-height:1.2;
    letter-spacing:-.035em;
    color:#143b27;
}

.rtd-card-loc{
    position:relative;
    z-index:2;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:.45rem;
    color:#6b7f94;
    font-size:.83rem;
    margin-bottom:1rem;
    text-align:center;
}

.rtd-card-loc i{ color:#16a34a; }

.rtd-chip-row{
    position:relative;
    z-index:2;
    display:flex;
    justify-content:center;
    flex-wrap:wrap;
    gap:.55rem;
    margin-bottom:1rem;
}

.rtd-chip{
    display:inline-flex;
    align-items:center;
    gap:.42rem;
    padding:.46rem .78rem;
    border-radius:999px;
    background:linear-gradient(180deg,#fbfffd,#f2fbf6);
    border:1px solid rgba(16,185,129,.11);
    color:#166534;
    font-size:.74rem;
    font-weight:800;
}

.rtd-chip strong{
    color:#14532d;
    font-weight:900;
}

.rtd-chip-date{
    background:linear-gradient(180deg,#ecfdf5,#dff7ec);
    color:var(--rtd-green-deep);
    border-color:rgba(16,185,129,.16);
}

.rtd-card-foot{
    position:relative;
    z-index:2;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:.75rem;
    padding-top:1rem;
    border-top:none;
    width:100%;
    margin-top:auto;
}

.rtd-card-foot-text{
    display:none;
}

.rtd-card-foot-action{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:.5rem;
    min-height:44px;
    min-width:132px;
    padding:.75rem 1.12rem;
    border-radius:999px;
    color:#ffffff;
    font-size:.82rem;
    font-weight:900;
    letter-spacing:.01em;
    background:linear-gradient(135deg, #22c55e, #10b981 55%, #059669);
    box-shadow:0 14px 26px rgba(16,185,129,.22), inset 0 1px 0 rgba(255,255,255,.24);
}

.rtd-empty,
#rtdNoResults{
    border-radius:22px;
    padding:2.25rem 1rem;
    text-align:center;
    background:rgba(255,255,255,.75);
    border:1px dashed #cbd5e1;
    color:#94a3b8;
    box-shadow:var(--rtd-shadow-soft);
}

#rtdNoResults{ display:none; margin-bottom:1.2rem; }

@media (max-width: 980px){
    .rtd-title{ max-width:none; }
    .rtd-section-head{ flex-direction:column; }
    .rtd-search-panel{ width:100%; }
}
    .rtd-title{ max-width:none; }
    .rtd-section-head{ flex-direction:column; }
}

@media (max-width: 1200px){
    .rtd-grid{ grid-template-columns:repeat(3,minmax(0,1fr)); }
}

@media (max-width: 900px){
    .rtd-grid{ grid-template-columns:repeat(2,minmax(0,1fr)); }
}

@media (max-width: 700px){
    .rtd-shell{ padding-inline:.8rem; }
    .rtd-hero{ padding:1rem; border-radius:22px; }
    .rtd-search-panel{ border-radius:20px; }
    .rtd-stats{ grid-template-columns:1fr; }
    .rtd-grid{ grid-template-columns:1fr; }
    .rtd-card{ border-radius:20px; }
    .rtd-card-arrow,
    .rtd-section-badge{ width:calc(100% - 24px); height:76px; padding:10px 14px; border-radius:18px; }
    .rtd-card-foot{ align-items:flex-start; flex-direction:column; }
}
}
</style>
@endpush

<div class="col-span-full rtd-shell">

    @php
        $projectCount = $projects->filter(fn($project) => $project->nodes->isNotEmpty())->count();
        $nodeCount = $projects->sum(fn($project) => $project->nodes->count());
        $totalLogs = $projects->sum(fn($project) => $project->nodes->sum('teardown_logs_count'));
    @endphp

    <section class="rtd-hero">
        <div class="rtd-hero-grid">
            <div>
                <div class="rtd-kicker">RTD Report</div>
                <h2 class="rtd-title">Removal / Teardown Records</h2>
                <p class="rtd-desc">
                    Review node-level teardown activity, jump into detailed logs, and export records faster from a cleaner operational workspace.
                </p>
            </div>
        </div>
    </section>

    <section class="rtd-stats">
        <div class="rtd-stat">
            <div class="rtd-stat-label">Projects</div>
            <div class="rtd-stat-value">{{ number_format($projectCount) }}</div>
            <div class="rtd-stat-sub">Grouped sections with active nodes</div>
        </div>
        <div class="rtd-stat">
            <div class="rtd-stat-label">Nodes</div>
            <div class="rtd-stat-value">{{ number_format($nodeCount) }}</div>
            <div class="rtd-stat-sub">Available records ready for review</div>
        </div>
        <div class="rtd-stat">
            <div class="rtd-stat-label">Logs</div>
            <div class="rtd-stat-value">{{ number_format($totalLogs) }}</div>
            <div class="rtd-stat-sub">Captured teardown entries across all nodes</div>
        </div>
    </section>

    <div class="rtd-search-panel mb-5">
        <div class="rtd-search-label">Quick search</div>
        <div class="rtd-search-wrap">
            <i class="mgc_search_line"></i>
            <input id="rtdSearch" class="rtd-search" type="search" placeholder="Search node ID, name, city, province, or project...">
        </div>
    </div>

    <div id="rtdNoResults">No nodes match your search.</div>

    @forelse($projects as $project)
        @if($project->nodes->isNotEmpty())
        <section class="rtd-section" data-project="{{ strtolower($project->project_name) }}">
            <div class="rtd-section-head mt-5">
                <div class="rtd-section-badge">
                    <img src="{{ asset('assets/images/logo-light.png') }}" alt="Logo" style="width:100%;height:100%;object-fit:contain;display:block;">
                </div>

                <div class="rtd-group-title-wrap">
                    <h3 class="rtd-group-title">{{ $project->project_name }}</h3>
                    <div class="rtd-group-meta">
                        {{ $project->nodes->count() }} node{{ $project->nodes->count() !== 1 ? 's' : '' }} in this project
                    </div>
                </div>

                <div class="rtd-divider"></div>
            </div>

            <div class="rtd-grid">
                @foreach($project->nodes as $node)
                <a
                    class="rtd-card"
                    href="{{ route('reports.rtd.show', $node) }}"
                    data-search="{{ strtolower($node->node_id . ' ' . $node->node_name . ' ' . $node->city . ' ' . $node->province . ' ' . $project->project_name) }}"
                >
                    <div class="rtd-card-top">
                        <div class="rtd-id">{{ $node->node_id }}</div>
                        <div class="rtd-card-arrow">
                            <img src="{{ asset('assets/images/logo-light.png') }}" alt="Logo" style="width:100%;height:100%;object-fit:contain;display:block;">
                        </div>
                    </div>

                    <h4 class="rtd-card-name">{{ $node->node_name ?: $node->node_id }}</h4>

                    <div class="rtd-card-loc">
                        <i class="mgc_location_line"></i>
                        <span>
                            {{ collect([$node->city, $node->province])->filter()->implode(', ') ?: 'Location not specified' }}
                        </span>
                    </div>

                    <div style="height:.35rem"></div>

                    <div class="rtd-chip-row">
                        <span class="rtd-chip">
                            <i class="mgc_file_line"></i>
                            <strong>{{ $node->teardown_logs_count }}</strong>
                            log{{ $node->teardown_logs_count != 1 ? 's' : '' }}
                        </span>

                        @if($node->teardown_logs_max_finished_at)
                        <span class="rtd-chip rtd-chip-date">
                            <i class="mgc_calendar_2_line"></i>
                            {{ \Carbon\Carbon::parse($node->teardown_logs_max_finished_at)->setTimezone('Asia/Manila')->format('M d, Y') }}
                        </span>
                        @endif
                    </div>

                    <div class="rtd-card-foot">
                        <div class="rtd-card-foot-action">
                            View report
                            <i class="mgc_arrow_right_up_line"></i>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endif
    @empty
        <div class="rtd-empty">No projects found.</div>
    @endforelse

</div>

@push('scripts')
<script>
(function(){
    const input = document.getElementById('rtdSearch');
    const noRes = document.getElementById('rtdNoResults');
    const groups = document.querySelectorAll('.rtd-section');

    if(!input) return;

    input.addEventListener('input', function(){
        const q = this.value.toLowerCase().trim();
        let visible = 0;

        groups.forEach(group => {
            const cards = group.querySelectorAll('.rtd-card');
            let groupVisible = 0;

            cards.forEach(card => {
                const searchText = (card.dataset.search || '') + ' ' + (group.dataset.project || '');
                const show = !q || searchText.includes(q);
                card.style.display = show ? '' : 'none';
                if(show) groupVisible++;
            });

            group.style.display = groupVisible > 0 ? '' : 'none';
            visible += groupVisible;
        });

        noRes.style.display = (q && visible === 0) ? 'block' : 'none';
    });
})();
</script>
@endpush

</x-layout>
