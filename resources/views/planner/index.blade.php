<x-layout>

@push('styles')
<style>
*,*::before,*::after{box-sizing:border-box;}

:root{
  --p:#2563eb;
  --p2:#1d4ed8;
  --ink:#0f172a;
  --sub:#475569;
  --muted:#94a3b8;
  --line:#e2e8f0;
  --card:#ffffff;
  --soft:#f8fbff;
  --ok:#16a34a;
  --warn:#d97706;
  --danger:#dc2626;
  --r:22px;
  --r-sm:16px;
  --shadow:0 10px 30px rgba(15,23,42,.08),0 2px 8px rgba(15,23,42,.05);
  --shadow-lg:0 18px 45px rgba(37,99,235,.14),0 10px 24px rgba(15,23,42,.08);
  --ff:system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  --fm:'JetBrains Mono','Fira Code',monospace;
}

body{font-family:var(--ff);}

.pl-wrap{
  padding:1rem 1.35rem 2.7rem;
  position:relative;
}

.eyebrow{
  font-size:.64rem;
  font-weight:800;
  letter-spacing:.16em;
  text-transform:uppercase;
  color:var(--p);
  display:flex;
  align-items:center;
  gap:.45rem;
  margin-bottom:.25rem;
}
.eyebrow::before{
  content:'';
  width:14px;
  height:2px;
  border-radius:999px;
  background:var(--p);
  display:inline-block;
}

.hero-panel{
  position:relative;
  display:grid;
  grid-template-columns:minmax(0,1.2fr) minmax(320px,.95fr);
  gap:1rem;
  padding:1.25rem;
  margin-bottom:1.15rem;
  border:1px solid rgba(191,219,254,.9);
  border-radius:28px;
  background:linear-gradient(135deg,#ffffff 0%,#f7fbff 48%,#eef6ff 100%);
  box-shadow:var(--shadow-lg);
  overflow:hidden;
}
.hero-panel::before{
  content:'';
  position:absolute;
  width:260px;
  height:260px;
  right:-80px;
  top:-120px;
  background:radial-gradient(circle, rgba(37,99,235,.15), transparent 68%);
}
.hero-panel::after{
  content:'';
  position:absolute;
  width:220px;
  height:220px;
  left:-100px;
  bottom:-130px;
  background:radial-gradient(circle, rgba(59,130,246,.1), transparent 70%);
}
.hero-copy,
.search-panel{
  position:relative;
  z-index:1;
}
.hero-copy h2{
  margin:.1rem 0 0;
  font-size:1.8rem;
  line-height:1.1;
  letter-spacing:-.03em;
  font-weight:900;
  color:var(--ink);
}
.hero-copy p{
  margin:.55rem 0 0;
  max-width:700px;
  color:var(--sub);
  font-size:.9rem;
}
.hero-tags{
  display:flex;
  flex-wrap:wrap;
  gap:.55rem;
  margin-top:.95rem;
}
.hero-tag{
  display:inline-flex;
  align-items:center;
  gap:.35rem;
  padding:.45rem .75rem;
  border-radius:999px;
  background:rgba(255,255,255,.9);
  border:1px solid rgba(226,232,240,.9);
  box-shadow:0 8px 20px rgba(15,23,42,.05);
  font-size:.74rem;
  font-weight:800;
  color:var(--ink);
}

.search-panel{
  display:flex;
  flex-direction:column;
  justify-content:center;
  gap:.65rem;
  padding:1rem;
  border-radius:24px;
  background:rgba(255,255,255,.78);
  border:1px solid rgba(255,255,255,.95);
  box-shadow:0 12px 25px rgba(37,99,235,.08);
  backdrop-filter:blur(8px);
}
.search-title{
  font-size:.72rem;
  font-weight:800;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:var(--muted);
}
.search-shell{
  display:flex;
  align-items:center;
  gap:.75rem;
  padding:.8rem .9rem;
  border-radius:18px;
  border:1px solid #dbeafe;
  background:#fff;
  box-shadow:0 8px 20px rgba(37,99,235,.08);
  transition:border-color .15s ease, box-shadow .15s ease, transform .15s ease;
}
.search-shell:focus-within{
  border-color:var(--p);
  box-shadow:0 0 0 4px rgba(37,99,235,.12),0 12px 24px rgba(37,99,235,.08);
  transform:translateY(-1px);
}
.search-ico{
  font-size:1rem;
  color:var(--p);
  font-weight:900;
  line-height:1;
}
.search-shell input{
  flex:1;
  min-width:0;
  border:none;
  outline:none;
  background:transparent;
  color:var(--ink);
  font-size:.92rem;
}
.search-shell input::placeholder{color:#94a3b8;}
.search-clear{
  border:none;
  cursor:pointer;
  padding:.5rem .85rem;
  border-radius:999px;
  background:linear-gradient(135deg,var(--p),var(--p2));
  color:#fff;
  font-size:.72rem;
  font-weight:800;
  box-shadow:0 8px 18px rgba(37,99,235,.16);
}
.search-meta{
  font-size:.78rem;
  font-weight:800;
  color:var(--sub);
}
.search-hint{
  font-size:.74rem;
  color:var(--muted);
}

.stat-strip{
  display:grid;
  grid-template-columns:repeat(4,minmax(0,1fr));
  gap:.85rem;
  margin:1.1rem 0 1.45rem;
}
.sc{
  position:relative;
  overflow:hidden;
  padding:1rem 1rem 1.05rem;
  border-radius:20px;
  border:1px solid rgba(226,232,240,.95);
  background:linear-gradient(180deg,#fff 0%,#f8fbff 100%);
  box-shadow:var(--shadow);
  transition:transform .16s ease, box-shadow .16s ease;
}
.sc:hover{
  transform:translateY(-3px);
  box-shadow:0 16px 32px rgba(15,23,42,.1),0 8px 18px rgba(37,99,235,.06);
}
.sc::before{
  content:'';
  position:absolute;
  inset:0 0 auto 0;
  height:4px;
  background:var(--sc-accent,var(--p));
}
.sc::after{
  content:'';
  position:absolute;
  width:120px;
  height:120px;
  right:-28px;
  top:-50px;
  border-radius:50%;
  background:radial-gradient(circle, rgba(148,163,184,.14), transparent 70%);
}
.sc-lbl{
  font-size:.62rem;
  font-weight:800;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:var(--muted);
}
.sc-val{
  margin-top:.28rem;
  font-size:1.95rem;
  line-height:1;
  font-weight:900;
  color:var(--ink);
  font-family:var(--fm);
}
.sc-sub{
  margin-top:.35rem;
  color:var(--sub);
  font-size:.76rem;
}
.sc-icon{
  position:absolute;
  right:.9rem;
  bottom:.8rem;
  font-size:1.55rem;
  opacity:.08;
}

.project-list{
  display:grid;
  gap:1rem;
}

.project-card{
  position:relative;
  overflow:hidden;
  background:linear-gradient(180deg,rgba(255,255,255,.98),rgba(248,250,252,.98));
  border:1px solid rgba(226,232,240,.96);
  border-radius:24px;
  box-shadow:var(--shadow);
}
.project-card::before{
  content:'';
  position:absolute;
  inset:0 0 auto 0;
  height:4px;
  background:linear-gradient(90deg,var(--accent),rgba(255,255,255,.8));
}

.project-toggle{
  width:100%;
  display:flex;
  align-items:center;
  gap:1rem;
  padding:1.1rem 1.15rem;
  border:none;
  background:transparent;
  text-align:left;
  cursor:pointer;
}
.project-toggle:hover{
  background:rgba(248,250,252,.7);
}
.project-toggle.open{
  background:linear-gradient(180deg,rgba(248,250,252,.92),rgba(255,255,255,0));
}

.project-badge{
  width:52px;
  height:52px;
  flex-shrink:0;
  display:grid;
  place-items:center;
  border-radius:16px;
  color:#fff;
  font-weight:900;
  font-size:.92rem;
  font-family:var(--fm);
  background:linear-gradient(135deg,var(--accent),#0f172a);
  box-shadow:0 12px 24px rgba(15,23,42,.15);
}

.project-main{
  flex:1;
  min-width:0;
}
.project-line{
  display:flex;
  align-items:center;
  gap:.55rem;
  flex-wrap:wrap;
}
.project-copy h3{
  margin:0;
  font-size:1.02rem;
  font-weight:900;
  letter-spacing:-.02em;
  color:var(--ink);
}
.project-copy p{
  margin:.28rem 0 0;
  font-size:.79rem;
  color:var(--sub);
}
.project-progress{
  display:flex;
  align-items:center;
  gap:.65rem;
  margin-top:.75rem;
}
.project-progress strong{
  font-size:.78rem;
  color:var(--ink);
}
.project-progress-bar{
  flex:1;
  height:8px;
  border-radius:999px;
  overflow:hidden;
  background:#e2e8f0;
}
.project-progress-bar span{
  display:block;
  height:100%;
  border-radius:999px;
}

.project-metrics{
  display:flex;
  align-items:center;
  justify-content:flex-end;
  gap:.5rem;
  flex-wrap:wrap;
}

.chip{
  padding:.34rem .72rem;
  border-radius:999px;
  font-size:.68rem;
  line-height:1;
  font-weight:800;
  white-space:nowrap;
}
.chip-blue{background:rgba(37,99,235,.1);color:#1d4ed8;}
.chip-green{background:rgba(22,163,74,.12);color:#15803d;}
.chip-amber{background:rgba(217,119,6,.14);color:#b45309;}
.chip-soft{background:#eff6ff;color:#2563eb;}

.caret-wrap{
  width:34px;
  height:34px;
  display:grid;
  place-items:center;
  border-radius:999px;
  background:#f8fafc;
  border:1px solid #e2e8f0;
}
.caret{
  color:var(--sub);
  transition:transform .2s ease;
}
.project-toggle.open .caret{
  transform:rotate(180deg);
}

.project-body{
  padding:0 1.15rem 1.15rem;
}
.project-body[hidden]{display:none !important;}

.node-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
  gap:1rem;
  padding-top:1rem;
  border-top:1px solid var(--line);
}

.node-card{
  position:relative;
  display:flex;
  flex-direction:column;
  gap:.85rem;
  min-height:265px;
  padding:1rem;
  border-radius:20px;
  background:linear-gradient(180deg,#ffffff 0%,#f8fbff 100%);
  border:1px solid #e8eef6;
  box-shadow:0 10px 24px rgba(15,23,42,.06);
  transition:transform .18s ease, box-shadow .18s ease, border-color .18s ease;
}
.node-card::before{
  content:'';
  position:absolute;
  left:1rem;
  right:1rem;
  top:0;
  height:4px;
  border-radius:0 0 12px 12px;
  background:var(--node-fill,#2563eb);
}
.node-card:hover{
  transform:translateY(-4px);
  border-color:rgba(96,165,250,.45);
  box-shadow:0 16px 32px rgba(37,99,235,.12),0 8px 18px rgba(15,23,42,.08);
}

.node-top{
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:.7rem;
}
.node-code{
  display:inline-flex;
  align-items:center;
  padding:.38rem .72rem;
  border-radius:999px;
  background:#f8fafc;
  border:1px solid #e2e8f0;
  font-family:var(--fm);
  font-size:.72rem;
  font-weight:900;
  color:var(--ink);
}
.node-state{
  padding:.33rem .7rem;
  border-radius:999px;
  font-size:.68rem;
  font-weight:800;
  white-space:nowrap;
}
.node-state.good{background:rgba(22,163,74,.12);color:#15803d;}
.node-state.mid{background:rgba(37,99,235,.1);color:#1d4ed8;}
.node-state.low{background:rgba(217,119,6,.14);color:#b45309;}

.node-title{
  margin:0;
  font-size:1rem;
  line-height:1.2;
  font-weight:900;
  letter-spacing:-.02em;
  color:var(--ink);
}
.node-location{
  margin:.28rem 0 0;
  display:flex;
  align-items:center;
  gap:.35rem;
  font-size:.78rem;
  color:var(--sub);
}

.metric-grid{
  display:grid;
  grid-template-columns:repeat(2,minmax(0,1fr));
  gap:.65rem;
}
.metric-box{
  padding:.82rem;
  border-radius:16px;
  border:1px solid #edf2f7;
  background:#fff;
}
.metric-label{
  display:block;
  margin-bottom:.28rem;
  font-size:.61rem;
  font-weight:800;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:var(--muted);
}
.metric-value{
  font-size:1.16rem;
  line-height:1;
  font-weight:900;
  font-family:var(--fm);
  color:var(--ink);
}

.node-note{
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:.75rem;
  padding:.76rem .85rem;
  border-radius:14px;
  border:1px solid #eef2f7;
  background:linear-gradient(180deg,#fff,#fbfdff);
  color:var(--sub);
  font-size:.78rem;
}
.node-note strong{
  font-size:.96rem;
  font-family:var(--fm);
  color:var(--ink);
}

.progress-wrap{
  display:flex;
  align-items:center;
  gap:.7rem;
}
.progress-track{
  flex:1;
  height:10px;
  border-radius:999px;
  overflow:hidden;
  background:#e2e8f0;
}
.progress-fill{
  height:100%;
  border-radius:999px;
  background:var(--node-fill,#2563eb);
}
.progress-text{
  font-size:.74rem;
  font-weight:800;
  color:var(--sub);
  white-space:nowrap;
}

.node-actions{
  margin-top:auto;
  display:flex;
  justify-content:flex-end;
}
.btn-open{
  display:inline-flex;
  align-items:center;
  gap:.42rem;
  padding:.68rem 1rem;
  border-radius:12px;
  text-decoration:none;
  background:linear-gradient(135deg,var(--p),var(--p2));
  color:#fff;
  font-size:.79rem;
  font-weight:800;
  box-shadow:0 10px 20px rgba(37,99,235,.18);
  transition:transform .15s ease, box-shadow .15s ease, filter .15s ease;
}
.btn-open:hover{
  transform:translateY(-2px);
  box-shadow:0 16px 24px rgba(37,99,235,.22);
  filter:brightness(1.03);
}

.search-empty,
.empty-state{
  margin-top:1rem;
  padding:3rem 1.2rem;
  text-align:center;
  border-radius:24px;
  background:linear-gradient(180deg,#fff,#f8fbff);
  border:1px solid #e2e8f0;
  box-shadow:var(--shadow);
}
.search-empty-icon,
.empty-state i{
  display:inline-grid;
  place-items:center;
  width:64px;
  height:64px;
  border-radius:50%;
  margin:0 auto .9rem;
  font-size:1.45rem;
  color:var(--p);
  background:rgba(37,99,235,.08);
}
.search-empty h3,
.empty-state h3{
  margin:0 0 .4rem;
  font-size:1.08rem;
  color:var(--ink);
}
.search-empty p,
.empty-state p{
  margin:0;
  color:var(--sub);
  font-size:.86rem;
}

@media (max-width:1024px){
  .hero-panel{grid-template-columns:1fr;}
}

@media (max-width:900px){
  .stat-strip{grid-template-columns:repeat(2,minmax(0,1fr));}
  .project-toggle{flex-wrap:wrap;}
  .project-metrics{
    width:100%;
    justify-content:flex-start;
    margin-left:68px;
  }
}

@media (max-width:640px){
  .pl-wrap{padding:1rem 1rem 2rem;}
  .stat-strip{grid-template-columns:1fr;}
  .node-grid{grid-template-columns:1fr;}
  .search-shell{flex-wrap:wrap;}
  .search-clear{width:100%;}
  .project-badge{
    width:46px;
    height:46px;
    border-radius:14px;
  }
  .project-metrics{
    margin-left:0;
  }
}
</style>
@endpush

@php
    $totalNodes  = $nodesByProject->flatten()->count();
    $totalPoles  = $poleCounts->sum('total');
    $withGps     = $poleCounts->sum('with_gps');
    $noGps       = $totalPoles - $withGps;
    $coverage    = $totalPoles > 0 ? round($withGps / $totalPoles * 100, 1) : 0;
    $hasAnyNodes = $totalNodes > 0;

    $activeProjects = $projects->filter(function ($proj) use ($nodesByProject) {
        return $nodesByProject->get($proj->id, collect())->isNotEmpty();
    })->count();
@endphp

<div class="col-span-full pl-wrap">

    <div class="hero-panel">
        <div class="hero-copy">
            <div class="eyebrow"><i class="mgc_location_line"></i> Planning</div>
            <h2>Pole GPS Planner</h2>
        
            <div class="hero-tags">
                <span class="hero-tag">{{ $activeProjects }} active projects</span>
                <span class="hero-tag">{{ $coverage }}% GPS coverage</span>
                <span class="hero-tag">{{ $withGps }} poles with GPS</span>
            </div>
        </div>

        <div class="search-panel">
            <div class="search-title">Quick Search</div>

            <div class="search-shell">
                <span class="search-ico">⌕</span>
                <input
                    id="plannerSearch"
                    type="text"
                    autocomplete="off"
                    placeholder="Search project, node ID, node name, city, or province..."
                >
                <button type="button" id="clearPlannerSearch" class="search-clear" hidden>Clear</button>
            </div>

            <div class="search-meta" id="searchMeta">{{ $activeProjects }} projects • {{ $totalNodes }} nodes</div>
            <div class="search-hint">Please Search NODE ID to filter</div>
        </div>
    </div>

    <div class="stat-strip">
        <div class="sc" style="--sc-accent:#2563eb">
            <div class="sc-lbl">Total Nodes</div>
            <div class="sc-val">{{ $totalNodes }}</div>
            <div class="sc-sub">All mapped nodes</div>
            <i class="mgc_node_line sc-icon"></i>
        </div>

        <div class="sc" style="--sc-accent:#64748b">
            <div class="sc-lbl">Total Poles</div>
            <div class="sc-val">{{ $totalPoles }}</div>
            <div class="sc-sub">Across all projects</div>
            <i class="mgc_vertical_align_top_line sc-icon"></i>
        </div>

        <div class="sc" style="--sc-accent:#16a34a">
            <div class="sc-lbl">With GPS</div>
            <div class="sc-val">{{ $withGps }}</div>
            <div class="sc-sub">Ready for validation</div>
            <i class="mgc_location_line sc-icon"></i>
        </div>

        <div class="sc" style="--sc-accent:#d97706">
            <div class="sc-lbl">Missing GPS</div>
            <div class="sc-val">{{ $noGps }}</div>
            <div class="sc-sub">Needs attention</div>
            <i class="mgc_location_off_line sc-icon"></i>
        </div>
    </div>

    @if($hasAnyNodes)
        @php
            $colors = ['#2563eb','#7c3aed','#16a34a','#d97706','#dc2626','#0891b2','#be185d','#059669'];
        @endphp

        <div class="project-list" id="plannerProjectList">
            @foreach($projects as $proj)
                @php
                    $projNodes = $nodesByProject->get($proj->id, collect());
                @endphp

                @continue($projNodes->isEmpty())

                @php
                    $projNodeIds = $projNodes->pluck('id');
                    $projTotal   = $poleCounts->whereIn('node_id', $projNodeIds->all())->sum('total');
                    $projGps     = $poleCounts->whereIn('node_id', $projNodeIds->all())->sum('with_gps');
                    $projPct     = $projTotal > 0 ? round($projGps / $projTotal * 100) : 0;
                    $color       = $colors[$loop->index % count($colors)];
                    $projectStateClass = $projPct >= 100 ? 'chip-green' : ($projPct > 50 ? 'chip-blue' : 'chip-amber');
                    $projectStateText  = $projPct >= 100 ? 'Complete' : ($projPct > 50 ? 'On Track' : 'Needs GPS');
                @endphp

                <section class="project-card" style="--accent:{{ $color }};" data-project="{{ $proj->project_name }}">
                    <button
                        type="button"
                        class="project-toggle"
                        data-project-id="{{ $proj->id }}"
                        aria-expanded="false"
                        aria-controls="project-body-{{ $proj->id }}"
                    >
                        <div class="project-badge">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>

                        <div class="project-main">
                            <div class="project-copy">
                                <div class="project-line">
                                    <h3>{{ $proj->project_name }}</h3>
                                    <span class="chip chip-soft project-match-count">{{ $projNodes->count() }} shown</span>
                                </div>

                                <p>{{ $projNodes->count() }} nodes available for GPS planning and mapping.</p>

                                <div class="project-progress">
                                    <div class="project-progress-bar">
                                        <span style="width:{{ $projPct }}%;background:{{ $projPct >= 100 ? '#16a34a' : ($projPct > 50 ? '#2563eb' : '#d97706') }};"></span>
                                    </div>
                                    <strong>{{ $projPct }}%</strong>
                                </div>
                            </div>
                        </div>

                        <div class="project-metrics">
                            <span class="chip chip-blue">{{ $projNodes->count() }} nodes</span>
                            <span class="chip chip-green">{{ $projGps }}/{{ $projTotal }} GPS</span>
                            <span class="chip {{ $projectStateClass }}">{{ $projectStateText }}</span>

                            <span class="caret-wrap">
                                <i class="mgc_down_line caret"></i>
                            </span>
                        </div>
                    </button>

                    <div id="project-body-{{ $proj->id }}" class="project-body" hidden>
                        <div class="node-grid">
                            @foreach($projNodes as $node)
                                @php
                                    $pc      = $poleCounts->get($node->id);
                                    $tot     = $pc ? (int) $pc->total : 0;
                                    $gps     = $pc ? (int) $pc->with_gps : 0;
                                    $pct     = $tot > 0 ? round($gps / $tot * 100) : 0;
                                    $missing = max($tot - $gps, 0);
                                    $fill    = $pct >= 100 ? '#16a34a' : ($pct > 50 ? '#2563eb' : '#d97706');
                                    $stateClass = $pct >= 100 ? 'good' : ($pct > 50 ? 'mid' : 'low');
                                @endphp

                                <article
                                    class="node-card"
                                    style="--node-fill:{{ $fill }};"
                                    data-search="{{ $proj->project_name }} {{ $node->node_id }} {{ $node->node_name ?? '' }} {{ $node->city ?? '' }} {{ $node->province ?? '' }}"
                                >
                                    <div class="node-top">
                                        <span class="node-code">{{ $node->node_id }}</span>
                                        <span class="node-state {{ $stateClass }}">{{ $pct }}% GPS</span>
                                    </div>

                                    <div>
                                        <h4 class="node-title">{{ $node->node_name ?? 'Unnamed Node' }}</h4>
                                        <p class="node-location">
                                            <i class="mgc_location_line"></i>
                                            {{ $node->city }}{{ $node->province ? ', '.$node->province : '' }}
                                        </p>
                                    </div>

                                    <div class="metric-grid">
                                        <div class="metric-box">
                                            <span class="metric-label">Total Poles</span>
                                            <span class="metric-value">{{ $tot }}</span>
                                        </div>

                                        <div class="metric-box">
                                            <span class="metric-label">With GPS</span>
                                            <span class="metric-value">{{ $gps }}</span>
                                        </div>
                                    </div>

                                    <div class="node-note">
                                        <span>Missing GPS</span>
                                        <strong>{{ $missing }}</strong>
                                    </div>

                                    <div class="progress-wrap">
                                        <div class="progress-track">
                                            <div class="progress-fill" style="width:{{ $pct }}%;"></div>
                                        </div>
                                        <span class="progress-text">{{ $gps }}/{{ $tot }}</span>
                                    </div>

                                    <div class="node-actions">
                                        <a href="{{ route('planner.node', $node) }}" class="btn-open">
                                            <i class="mgc_map_line"></i> Open Node
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endforeach
        </div>

        <div class="search-empty" id="searchEmpty" hidden>
            <div class="search-empty-icon">⌕</div>
            <h3>No results found</h3>
            <p>Subukan mo ibang keyword gaya ng project name, node ID, city, o province.</p>
        </div>
    @else
        <div class="empty-state">
            <i class="mgc_location_line"></i>
            <h3>No nodes found</h3>
            <p>Walang available na node records para i-display sa planner.</p>
        </div>
    @endif

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggles = Array.from(document.querySelectorAll('.project-toggle'));
    const projectCards = Array.from(document.querySelectorAll('.project-card'));
    const searchInput = document.getElementById('plannerSearch');
    const clearBtn = document.getElementById('clearPlannerSearch');
    const searchMeta = document.getElementById('searchMeta');
    const searchEmpty = document.getElementById('searchEmpty');
    const defaultMeta = @json($activeProjects . ' projects • ' . $totalNodes . ' nodes');

    function getBody(btn) {
        return document.getElementById(btn.getAttribute('aria-controls'));
    }

    function setOpen(btn, open) {
        const body = getBody(btn);
        btn.classList.toggle('open', open);
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (body) body.hidden = !open;
    }

    function closeAll() {
        toggles.forEach(function (btn) {
            setOpen(btn, false);
        });
    }

    function openFirstVisible() {
        const firstVisibleCard = projectCards.find(function (card) {
            return card.style.display !== 'none';
        });

        if (!firstVisibleCard) return;

        const btn = firstVisibleCard.querySelector('.project-toggle');
        if (btn) setOpen(btn, true);
    }

    toggles.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const hasQuery = searchInput && searchInput.value.trim().length > 0;
            const currentlyOpen = this.getAttribute('aria-expanded') === 'true';

            if (!hasQuery) {
                closeAll();
                setOpen(this, !currentlyOpen);
            } else {
                setOpen(this, !currentlyOpen);
            }
        });
    });

    if (toggles.length) {
        setOpen(toggles[0], true);
    }

    function updateSearch() {
        if (!searchInput) return;

        const q = searchInput.value.trim().toLowerCase();
        let visibleProjects = 0;
        let visibleNodes = 0;

        if (clearBtn) {
            clearBtn.hidden = q.length === 0;
        }

        projectCards.forEach(function (card) {
            const projectText = (card.dataset.project || '').toLowerCase();
            const nodes = Array.from(card.querySelectorAll('.node-card'));
            const btn = card.querySelector('.project-toggle');
            const matchBadge = card.querySelector('.project-match-count');

            const projectMatched = q ? projectText.includes(q) : true;
            let nodeMatches = 0;

            nodes.forEach(function (node) {
                const haystack = (node.dataset.search || '').toLowerCase();
                const matched = q ? (projectMatched || haystack.includes(q)) : true;

                node.style.display = matched ? '' : 'none';
                if (matched) nodeMatches++;
            });

            const shouldShowProject = q ? (projectMatched || nodeMatches > 0) : true;
            card.style.display = shouldShowProject ? '' : 'none';

            if (shouldShowProject) {
                visibleProjects++;
                visibleNodes += projectMatched ? nodes.length : nodeMatches;
            }

            if (matchBadge) {
                if (!q) {
                    matchBadge.textContent = nodes.length + ' shown';
                } else {
                    const shownCount = projectMatched ? nodes.length : nodeMatches;
                    matchBadge.textContent = shownCount + ' match' + (shownCount === 1 ? '' : 'es');
                }
            }

            if (q && btn) {
                setOpen(btn, shouldShowProject);
            }
        });

        if (!q) {
            if (searchMeta) searchMeta.textContent = defaultMeta;
            if (searchEmpty) searchEmpty.hidden = true;
            closeAll();
            openFirstVisible();
            return;
        }

        if (searchMeta) {
            searchMeta.textContent =
                visibleProjects + ' project' + (visibleProjects === 1 ? '' : 's') +
                ' • ' +
                visibleNodes + ' match' + (visibleNodes === 1 ? '' : 'es');
        }

        if (searchEmpty) {
            searchEmpty.hidden = visibleProjects !== 0;
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', updateSearch);
    }

    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            searchInput.value = '';
            updateSearch();
            searchInput.focus();
        });
    }
});
</script>

</x-layout>