<x-layout>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<style>
*,*::before,*::after{box-sizing:border-box;}

:root{
  --bg:#f4f7fb;
  --bg2:#eef3f9;
  --bg3:#ffffff;

  --card:rgba(255,255,255,.92);
  --card-2:#ffffff;
  --card-soft:#f8fbff;

  --line:#e5edf6;
  --line-2:#d9e4f0;

  --txt:#0f172a;
  --txt2:#475569;
  --txt3:#94a3b8;

  --blue:#2563eb;
  --blue2:#1d4ed8;
  --blue-soft:rgba(37,99,235,.08);

  --green:#16a34a;
  --green-soft:rgba(22,163,74,.08);

  --amber:#d97706;
  --amber-soft:rgba(217,119,6,.10);

  --red:#dc2626;
  --red-soft:rgba(220,38,38,.08);

  --purple:#7c3aed;
  --purple-soft:rgba(124,58,237,.08);

  --cyan:#0891b2;
  --cyan-soft:rgba(8,145,178,.08);

  --shadow:0 10px 30px rgba(15,23,42,.06);
  --shadow-lg:0 22px 60px rgba(15,23,42,.10);

  --r-sm:14px;
  --r:18px;
  --r-lg:24px;
  --r-xl:30px;

  --ff:'Outfit',system-ui,-apple-system,sans-serif;
  --fm:'JetBrains Mono','Fira Code','IBM Plex Mono',monospace;
}

body{
  font-family:var(--ff);
  color:var(--txt);
  background:
    radial-gradient(circle at top left, rgba(37,99,235,.07), transparent 24%),
    radial-gradient(circle at top right, rgba(124,58,237,.05), transparent 20%),
    linear-gradient(180deg,var(--bg) 0%, var(--bg2) 50%, var(--bg3) 100%);
}

.page-content{
  background:transparent !important;
}

.db-wrap{
  padding:1.25rem 1.5rem 2.75rem;
  display:flex;
  flex-direction:column;
  gap:1rem;
}

/* hero */
.hero{
  position:relative;
  overflow:hidden;
  border:1px solid var(--line);
  border-radius:var(--r-xl);
  background:
    linear-gradient(135deg, rgba(37,99,235,.06), rgba(124,58,237,.04) 45%, rgba(8,145,178,.03)),
    #ffffff;
  box-shadow:var(--shadow-lg);
  padding:1.35rem 1.35rem 1.2rem;
}

.hero::before{
  content:"";
  position:absolute;
  inset:0;
  pointer-events:none;
  background:
    radial-gradient(circle at 18% 25%, rgba(37,99,235,.06), transparent 16%),
    radial-gradient(circle at 82% 18%, rgba(124,58,237,.05), transparent 14%);
}

.hero-top{
  position:relative;
  z-index:1;
  display:flex;
  justify-content:space-between;
  gap:1rem;
  align-items:flex-start;
  flex-wrap:wrap;
}

.eyebrow{
  display:inline-flex;
  align-items:center;
  gap:.5rem;
  padding:.35rem .7rem;
  border-radius:999px;
  border:1px solid rgba(37,99,235,.12);
  background:rgba(37,99,235,.06);
  color:var(--blue);
  font-size:.64rem;
  font-weight:800;
  letter-spacing:.14em;
  text-transform:uppercase;
}

.eyebrow i{font-size:.9rem;}

.hero-title{
  margin:.8rem 0 .25rem;
  font-size:clamp(1.55rem, 2.2vw, 2.35rem);
  font-weight:900;
  letter-spacing:-.04em;
  line-height:1.02;
  color:var(--txt);
}

.hero-sub{
  margin:0;
  max-width:760px;
  font-size:.85rem;
  color:var(--txt2);
  line-height:1.55;
}

.hero-actions{
  display:flex;
  gap:.6rem;
  flex-wrap:wrap;
}

.btn-top{
  display:inline-flex;
  align-items:center;
  gap:.45rem;
  padding:.65rem .95rem;
  border-radius:12px;
  text-decoration:none;
  font-size:.78rem;
  font-weight:700;
  transition:transform .16s ease, background .16s ease, border-color .16s ease;
  border:1px solid var(--line);
  background:#fff;
  color:var(--txt2);
}

.btn-top:hover{
  transform:translateY(-1px);
  background:#f8fbff;
  color:var(--txt);
}

.btn-top.primary{
  background:linear-gradient(135deg,var(--blue),var(--blue2));
  border-color:transparent;
  color:#fff;
  box-shadow:0 10px 26px rgba(37,99,235,.18);
}

/* stat strip */
.stat-strip{
  display:grid;
  grid-template-columns:repeat(6,1fr);
  gap:.8rem;
  margin-top:1rem;
  position:relative;
  z-index:1;
}
@media(max-width:1180px){.stat-strip{grid-template-columns:repeat(3,1fr);}}
@media(max-width:700px){.stat-strip{grid-template-columns:repeat(2,1fr);}}

.sc{
  position:relative;
  overflow:hidden;
  border:1px solid var(--line);
  border-radius:18px;
  background:#fff;
  padding:1rem 1rem .95rem;
  box-shadow:var(--shadow);
}

.sc::before{
  content:'';
  position:absolute;
  top:0;left:0;right:0;
  height:3px;
  background:var(--sc-accent,var(--blue));
}

.sc-lbl{
  font-size:.62rem;
  font-weight:800;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:var(--txt3);
}

.sc-val{
  margin-top:.4rem;
  font-size:2rem;
  line-height:1;
  font-weight:900;
  letter-spacing:-.05em;
  color:var(--txt);
  font-family:var(--fm);
}

.sc-foot{
  margin-top:.45rem;
  font-size:.7rem;
  color:var(--txt2);
}

.sc-icon{
  position:absolute;
  right:.9rem;
  bottom:.7rem;
  font-size:1.35rem;
  color:var(--txt);
  opacity:.08;
}

/* main */
.db-main{
  display:grid;
  grid-template-columns:350px minmax(0,1fr);
  gap:1rem;
  align-items:start;
}
@media(max-width:1200px){.db-main{grid-template-columns:1fr;}}

.left-col,.map-col{
  display:flex;
  flex-direction:column;
  gap:1rem;
}

/* shared panel */
.panel,
.map-wrap{
  border:1px solid var(--line);
  border-radius:var(--r-lg);
  overflow:hidden;
  background:var(--card);
  box-shadow:var(--shadow);
}

.panel-hd,
.map-hd{
  display:flex;
  align-items:center;
  gap:.6rem;
  padding:.9rem 1rem;
  border-bottom:1px solid var(--line);
  background:linear-gradient(180deg, #fbfdff, #f7faff);
}

.panel-title{
  font-size:.84rem;
  font-weight:800;
  color:var(--txt);
  letter-spacing:-.01em;
}

.sec-badge{
  margin-left:auto;
  padding:.28rem .6rem;
  border-radius:999px;
  background:rgba(37,99,235,.06);
  border:1px solid rgba(37,99,235,.10);
  color:var(--blue);
  font-size:.63rem;
  font-weight:800;
  letter-spacing:.06em;
}

/* project list */
.proj-list{
  max-height:320px;
  overflow-y:auto;
}

.proj-row{
  display:flex;
  align-items:center;
  gap:.75rem;
  padding:.8rem 1rem;
  border-bottom:1px solid var(--line);
  cursor:pointer;
  transition:background .14s ease;
}
.proj-row:last-child{border-bottom:none;}
.proj-row:hover{
  background:#f8fbff;
}

.proj-dot{
  width:11px;
  height:11px;
  border-radius:50%;
  flex-shrink:0;
  box-shadow:0 0 0 4px rgba(37,99,235,.05);
}

.proj-meta{
  min-width:0;
  flex:1;
}

.proj-name{
  font-size:.8rem;
  font-weight:800;
  color:var(--txt);
  white-space:nowrap;
  overflow:hidden;
  text-overflow:ellipsis;
}

.proj-sub{
  margin-top:.18rem;
  font-size:.67rem;
  color:var(--txt3);
  font-family:var(--fm);
}

.proj-counts{
  display:flex;
  gap:.42rem;
  flex-wrap:wrap;
  justify-content:flex-end;
}

.pct-chip{
  padding:.22rem .48rem;
  border-radius:8px;
  font-size:.62rem;
  font-weight:800;
  letter-spacing:.02em;
  white-space:nowrap;
}
.chip-done{background:var(--green-soft);color:#166534;border:1px solid rgba(22,163,74,.10);}
.chip-pend{background:var(--amber-soft);color:#b45309;border:1px solid rgba(217,119,6,.10);}
.chip-tot{background:var(--blue-soft);color:var(--blue);border:1px solid rgba(37,99,235,.10);}

/* alerts */
.alerts-list{
  max-height:280px;
  overflow-y:auto;
}

.alert-row{
  display:flex;
  align-items:flex-start;
  gap:.75rem;
  padding:.8rem 1rem;
  border-bottom:1px solid var(--line);
  text-decoration:none;
  color:inherit;
  transition:background .14s ease;
  cursor:pointer;
}
.alert-row:hover{ background:var(--surface-muted,#f3f5f7); }
.alert-row:last-child{border-bottom:none;}

.alert-dot{
  width:9px;
  height:9px;
  border-radius:50%;
  background:linear-gradient(135deg,var(--green),#4ade80);
  flex-shrink:0;
  margin-top:.35rem;
  box-shadow:0 0 0 6px rgba(22,163,74,.08);
}

.alert-body{flex:1;min-width:0;}

.alert-span{
  font-size:.76rem;
  font-weight:800;
  color:var(--txt);
  font-family:var(--fm);
}

.alert-node{
  margin-top:.12rem;
  font-size:.69rem;
  color:var(--txt2);
  line-height:1.45;
}

.alert-time{
  flex-shrink:0;
  font-size:.64rem;
  color:var(--txt3);
  margin-top:.15rem;
  font-family:var(--fm);
}

.no-alerts{
  text-align:center;
  padding:2.3rem 1rem;
  color:var(--txt3);
  font-size:.8rem;
}
.no-alerts i{
  font-size:2rem;
  display:block;
  margin-bottom:.5rem;
  color:var(--green);
  opacity:.65;
}

/* map */
.map-wrap{
  overflow:hidden;
}

.map-hd{
  display:flex;
  align-items:center;
  gap:.55rem;
}

.map-meta{
  margin-left:auto;
  display:flex;
  gap:.5rem;
  flex-wrap:wrap;
}

.map-pill{
  padding:.28rem .58rem;
  border-radius:999px;
  font-size:.62rem;
  font-weight:800;
  border:1px solid var(--line);
  color:var(--txt2);
  background:#fff;
}

#mainMap{
  height:calc(72vh - 220px);
  min-height:560px;
  width:100%;
  background:#edf3f9;
}

.leaflet-container{
  background:#edf3f9;
}

.leaflet-control-zoom{
  border:none !important;
  box-shadow:0 8px 22px rgba(15,23,42,.12) !important;
}
.leaflet-control-zoom a{
  background:#fff !important;
  color:var(--txt) !important;
  border-bottom:1px solid var(--line) !important;
}

.leaflet-popup-content-wrapper{
  border-radius:16px !important;
  background:#fff !important;
  box-shadow:0 10px 30px rgba(15,23,42,.16) !important;
  border:1px solid #e5e7eb !important;
}
.leaflet-popup-content{
  margin:12px 14px !important;
}
.leaflet-popup-tip{
  background:#fff !important;
}

/* node list */
.node-panel{
  border:1px solid var(--line);
  border-radius:var(--r-lg);
  overflow:hidden;
  background:var(--card);
  box-shadow:var(--shadow);
}

.node-tools{
  display:flex;
  align-items:center;
  gap:.75rem;
  padding:.95rem 1rem;
  border-bottom:1px solid var(--line);
  background:linear-gradient(180deg, #fbfdff, #f7faff);
  flex-wrap:wrap;
}

.node-search{
  margin-left:auto;
  min-width:240px;
  max-width:320px;
  flex:1;
}

.node-search input{
  width:100%;
  border:1px solid var(--line-2);
  background:#fff;
  color:var(--txt);
  border-radius:12px;
  padding:.68rem .85rem;
  font-size:.8rem;
  outline:none;
}

.node-search input::placeholder{color:var(--txt3);}

.nl-wrap{
  overflow-x:auto;
}

.nl-table{
  width:100%;
  min-width:860px;
  border-collapse:collapse;
}

.nl-table thead th{
  position:sticky;
  top:0;
  z-index:1;
  padding:.8rem 1rem;
  text-align:left;
  font-size:.61rem;
  font-weight:800;
  text-transform:uppercase;
  letter-spacing:.12em;
  color:var(--txt3);
  background:#f8fbff;
  border-bottom:1px solid var(--line);
  white-space:nowrap;
}

.nl-table tbody tr{
  border-bottom:1px solid var(--line);
  transition:background .14s ease;
}
.nl-table tbody tr:last-child{border-bottom:none;}
.nl-table tbody tr:hover{
  background:#f8fbff;
  cursor:pointer;
}

.nl-table tbody td{
  padding:.88rem 1rem;
  font-size:.78rem;
  color:var(--txt2);
  vertical-align:middle;
}

.td-main{
  color:var(--txt);
  font-weight:800;
  font-size:.79rem;
}

.td-mono{
  font-family:var(--fm);
  font-size:.74rem;
  color:var(--blue);
  font-weight:800;
}

.td-sub{
  margin-top:.16rem;
  font-size:.67rem;
  color:var(--txt3);
}

.project-chip{
  display:inline-flex;
  align-items:center;
  gap:.35rem;
  padding:.28rem .52rem;
  border-radius:999px;
  background:#fff;
  border:1px solid var(--line);
  color:var(--txt2);
  font-size:.67rem;
  font-weight:700;
}

.prog-box{
  min-width:128px;
}

.prog-top{
  display:flex;
  justify-content:space-between;
  gap:.5rem;
  margin-bottom:.35rem;
}

.prog-top span:first-child{
  font-size:.68rem;
  color:var(--txt3);
}

.prog-top span:last-child{
  font-size:.69rem;
  color:var(--txt);
  font-weight:800;
  font-family:var(--fm);
}

.prog-bar{
  height:7px;
  background:#e7eef6;
  border-radius:999px;
  overflow:hidden;
}

.prog-fill{
  height:100%;
  border-radius:999px;
}

.badge{
  display:inline-flex;
  align-items:center;
  padding:.28rem .58rem;
  border-radius:999px;
  font-size:.64rem;
  font-weight:800;
  white-space:nowrap;
  border:1px solid transparent;
}
.b-done{background:var(--green-soft);color:#166534;border-color:rgba(22,163,74,.10);}
.b-active{background:var(--blue-soft);color:var(--blue);border-color:rgba(37,99,235,.10);}
.b-pending{background:var(--amber-soft);color:#b45309;border-color:rgba(217,119,6,.10);}
.b-default{background:#f1f5f9;color:#64748b;border-color:#e2e8f0;}

/* scrollbars */
.proj-list::-webkit-scrollbar,
.alerts-list::-webkit-scrollbar,
.nl-wrap::-webkit-scrollbar{
  height:8px;width:8px;
}
.proj-list::-webkit-scrollbar-thumb,
.alerts-list::-webkit-scrollbar-thumb,
.nl-wrap::-webkit-scrollbar-thumb{
  background:#d6e2ee;
  border-radius:999px;
}
</style>
@endpush

<div class="col-span-full db-wrap">

    {{-- HERO --}}
    <div class="hero">
        <div class="hero-top">
            <div>
                <div class="eyebrow"><i class="mgc_layout_grid_line"></i> Operations Overview</div>
                <h2 class="hero-title">Network Operations Dashboard</h2>
                <p class="hero-sub">Monitor projects, track node progress, review teardown activity, and jump directly into mapped locations across the Philippines.</p>
            </div>

            <div class="hero-actions">
                <a href="{{ route('reports.index') }}" class="btn-top">
                    <i class="mgc_file_list_line"></i> Reports
                </a>
                <a href="{{ route('warehouse.dashboard') }}" class="btn-top primary">
                    <i class="mgc_warehouse_line"></i> Warehouse
                </a>
            </div>
        </div>

        @php
        $statCards = [
            ['label'=>'Projects',        'value'=>$stats['total_projects'],   'icon'=>'mgc_folder_line',      'accent'=>'#2563eb', 'foot'=>'Active portfolio'],
            ['label'=>'Total Nodes',     'value'=>$stats['total_nodes'],      'icon'=>'mgc_node_line',        'accent'=>'#64748b', 'foot'=>'Tracked in system'],
            ['label'=>'Completed',       'value'=>$stats['done_nodes'],       'icon'=>'mgc_check_circle_line','accent'=>'#16a34a', 'foot'=>'Ready / finished'],
            ['label'=>'In Progress',     'value'=>$stats['pending_nodes'],    'icon'=>'mgc_time_line',        'accent'=>'#d97706', 'foot'=>'Still moving'],
            ['label'=>'Reports Today',   'value'=>$stats['reports_today'],    'icon'=>'mgc_document_line',    'accent'=>'#7c3aed', 'foot'=>'Submitted today'],
            ['label'=>'Pending Approval','value'=>$stats['pending_approval'], 'icon'=>'mgc_alert_line',       'accent'=>'#dc2626', 'foot'=>'Needs review'],
        ];
        @endphp

        <div class="stat-strip">
            @foreach($statCards as $sc)
                <div class="sc" style="--sc-accent:{{ $sc['accent'] }}">
                    <div class="sc-lbl">{{ $sc['label'] }}</div>
                    <div class="sc-val">{{ $sc['value'] }}</div>
                    <div class="sc-foot">{{ $sc['foot'] }}</div>
                    <i class="{{ $sc['icon'] }} sc-icon"></i>
                </div>
            @endforeach
        </div>
    </div>

    {{-- MAIN --}}
    <div class="db-main">

        {{-- LEFT --}}
        <div class="left-col">

            <div class="panel">
                <div class="panel-hd">
                    <i class="mgc_folder_line" style="color:var(--blue);font-size:1rem;"></i>
                    <span class="panel-title">Project Summary</span>
                    <span class="sec-badge">{{ $projects->count() }} projects</span>
                </div>

                <div class="proj-list">
                    @forelse($projects as $proj)
                        @php
                            $colors = ['#2563eb','#7c3aed','#16a34a','#d97706','#dc2626','#0891b2','#059669','#eab308'];
                            $color = $colors[$loop->index % count($colors)];
                            $total = $proj->total_nodes ?? 0;
                            $done  = $proj->done_nodes ?? 0;
                            $pend  = $proj->pending_nodes ?? 0;
                        @endphp
                        <div class="proj-row" onclick="filterByProject({{ $proj->id }})">
                            <div class="proj-dot" style="background:{{ $color }};"></div>

                            <div class="proj-meta">
                                <div class="proj-name" title="{{ $proj->project_name }}">{{ $proj->project_name }}</div>
                                <div class="proj-sub">Project #{{ $proj->id }}</div>
                            </div>

                            <div class="proj-counts">
                                <span class="pct-chip chip-done">{{ $done }} done</span>
                                <span class="pct-chip chip-pend">{{ $pend }} pending</span>
                                <span class="pct-chip chip-tot">{{ $total }} total</span>
                            </div>
                        </div>
                    @empty
                        <div style="padding:2.2rem 1rem;text-align:center;color:var(--txt3);font-size:.82rem;">
                            No projects yet.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="panel">
                <div class="panel-hd">
                    <i class="mgc_alert_line" style="color:var(--amber);font-size:1rem;"></i>
                    <span class="panel-title">Live Alerts</span>
                    <span class="sec-badge" style="background:var(--amber-soft);border-color:rgba(217,119,6,.10);color:#b45309;">Last 24h</span>
                </div>

                <div class="alerts-list">
                    @forelse($alerts as $alert)
                        @php
                            $fromCode = $alert->poleSpan?->fromPole?->pole_code ?? '';
                            $toCode   = $alert->poleSpan?->toPole?->pole_code   ?? '';
                            $imgMap   = $alert->images->keyBy('photo_type');
                            $imgUrl   = fn($type) => ($imgMap[$type] ?? null)?->image_path
                                            ? asset('storage/' . $imgMap[$type]->image_path)
                                            : null;
                            $submission = $alert->submissionItem?->submission;
                            $logData  = json_encode([
                                'span'              => $alert->poleSpan?->pole_span_code ?? ('Span #'.$alert->id),
                                'from_pole'         => $fromCode,
                                'to_pole'           => $toCode,
                                'node_id'           => $alert->node?->node_id,
                                'node_name'         => $alert->node?->node_name,
                                'city'              => $alert->node?->city,
                                'team'              => $alert->team,
                                'submitted_by'      => $alert->submitted_by,
                                'cable'             => (float)$alert->collected_cable,
                                'cable_expected'    => (float)$alert->expected_cable_snapshot,
                                'cable_all'         => (bool)$alert->did_collect_all_cable,
                                'unrecovered'       => (float)$alert->unrecovered_cable,
                                'unrecovered_reason'=> $alert->unrecovered_reason,
                                'node_col'          => (int)$alert->collected_node,
                                'node_exp'          => (int)$alert->expected_node_snapshot,
                                'amp_col'           => (int)$alert->collected_amplifier,
                                'amp_exp'           => (int)$alert->expected_amplifier_snapshot,
                                'ext_col'           => (int)$alert->collected_extender,
                                'ext_exp'           => (int)$alert->expected_extender_snapshot,
                                'tsc_col'           => (int)$alert->collected_tsc,
                                'tsc_exp'           => (int)$alert->expected_tsc_snapshot,
                                'offline'           => (bool)$alert->offline_mode,
                                'status'            => $alert->status,
                                'started_at'        => $alert->started_at?->toDateTimeString(),
                                'finished_at'       => $alert->finished_at?->toDateTimeString(),
                                'span_length'       => (float)($alert->poleSpan?->length_meters ?? 0),
                                'report_url'        => $submission ? route('reports.show', $submission->id) : null,
                                'photos' => [
                                    'from_before' => $imgUrl('from_before'),
                                    'from_after'  => $imgUrl('from_after'),
                                    'from_tag'    => $imgUrl('from_tag'),
                                    'to_before'   => $imgUrl('to_before'),
                                    'to_after'    => $imgUrl('to_after'),
                                    'to_tag'      => $imgUrl('to_tag'),
                                ],
                            ], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
                        @endphp
                        <a class="alert-row" href="{{ route('reports.teardown-log.show', $alert->id) }}">
                            <div class="alert-dot"></div>
                            <div class="alert-body">
                                <div class="alert-span">{{ $alert->poleSpan?->pole_span_code ?? 'Span #'.$alert->id }}</div>
                                <div class="alert-node">
                                    {{ $alert->node?->node_id ?? '' }}
                                    @if($alert->node?->node_name) — {{ $alert->node->node_name }}@endif
                                    @if($alert->node?->city), {{ $alert->node->city }}@endif
                                </div>
                            </div>
                            <div class="alert-time">
                                {{ ($alert->finished_at ?? $alert->synced_at_server)?->diffForHumans() ?? '' }}
                            </div>
                        </a>
                    @empty
                        <div class="no-alerts">
                            <i class="mgc_check_circle_line"></i>
                            No teardown activity in the last 24 hours.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- RIGHT --}}
        <div class="map-col">
            <div class="map-wrap">
                <div class="map-hd">
                    <i class="mgc_map_line" style="color:var(--blue);font-size:1rem;"></i>
                    <span class="panel-title">Project Map View</span>

                    <div class="map-meta">
                        <span class="map-pill" id="mapNodeCount">{{ $nodes->count() }} nodes</span>
                        <span class="map-pill">Philippines</span>
                    </div>
                </div>
                <div id="mainMap"></div>
            </div>
        </div>
    </div>

    {{-- NODE LIST --}}
    <div class="node-panel">
        <div class="node-tools">
            <i class="mgc_node_line" style="color:var(--blue);font-size:1rem;"></i>
            <span class="panel-title">Node Directory</span>
            <span class="sec-badge">{{ $nodeList->count() }} nodes</span>

            <div class="node-search">
                <input type="text" id="nodeSearch" placeholder="Search node ID, name, city, or project...">
            </div>
        </div>

        <div class="nl-wrap">
            <table class="nl-table">
                <thead>
                    <tr>
                        <th>Node ID</th>
                        <th>Node Name</th>
                        <th>Location</th>
                        <th>Project</th>
                        <th>Progress</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="nodeTableBody">
                    @forelse($nodeList as $node)
                        @php
                            $bCls = match($node->status) {
                                'done' => 'b-done',
                                'active','ongoing' => 'b-active',
                                'pending' => 'b-pending',
                                default => 'b-default',
                            };
                            $prog = (float)($node->progress_percentage ?? 0);
                            $fillColor = $prog >= 100 ? '#16a34a' : ($prog > 50 ? '#2563eb' : '#d97706');
                        @endphp
                        <tr onclick="focusNode('{{ $node->node_id }}')">
                            <td>
                                <span class="td-mono">{{ $node->node_id }}</span>
                            </td>
                            <td>
                                <span class="td-main">{{ $node->node_name ?? '—' }}</span>
                                <div class="td-sub">Operational node</div>
                            </td>
                            <td>
                                <span class="td-main">{{ $node->city ?? '—' }}</span>
                                <div class="td-sub">{{ $node->province ?? '' }}</div>
                            </td>
                            <td>
                                <span class="project-chip">
                                    <i class="mgc_folder_line"></i>
                                    {{ $node->project?->project_name ?? '—' }}
                                </span>
                            </td>
                            <td>
                                <div class="prog-box">
                                    <div class="prog-top">
                                        <span>Completion</span>
                                        <span>{{ number_format($prog,1) }}%</span>
                                    </div>
                                    <div class="prog-bar">
                                        <div class="prog-fill" style="width:{{ min(100,$prog) }}%;background:{{ $fillColor }};"></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge {{ $bCls }}">{{ ucfirst($node->status ?? 'unknown') }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;padding:2.8rem 1rem;color:var(--txt3);font-size:.82rem;">
                                No nodes found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
(function(){
    const nodeData = @json($nodes);

    const PH_CENTER = [12.3, 122.5];
    const PH_ZOOM   = 6;

    const PH_BOUNDS = L.latLngBounds(
        L.latLng(4.5, 115.5),
        L.latLng(21.5, 127.5)
    );

    const map = L.map('mainMap', {
        center: PH_CENTER,
        zoom: PH_ZOOM,
        minZoom: 6,
        maxZoom: 18,
        maxBounds: PH_BOUNDS,
        maxBoundsViscosity: 1.0,
        zoomControl: true,
        preferCanvas: false,
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19,
    }).addTo(map);

    const PIN_COLOR = '#dc2626';
    const FILTERED_PIN = '#2563eb';

    const nodeMarkers = {};
    let currentProjectId = null;

    function makePinIcon(color, active = false) {
        const glow = active
            ? `<circle cx="12" cy="12" r="10" fill="${color}" opacity=".14">
                 <animate attributeName="r" from="10" to="16" dur="1.6s" repeatCount="indefinite"/>
                 <animate attributeName="opacity" from=".14" to="0" dur="1.6s" repeatCount="indefinite"/>
               </circle>`
            : '';

        const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="28" height="36" viewBox="0 0 28 36">
            ${glow}
            <path d="M14 0C6.268 0 0 6.268 0 14c0 9.333 14 22 14 22S28 23.333 28 14C28 6.268 21.732 0 14 0z"
                  fill="${color}" stroke="#fff" stroke-width="2"/>
            <circle cx="14" cy="13" r="5" fill="#fff" opacity=".95"/>
        </svg>`;

        return L.divIcon({
            className: '',
            html: svg,
            iconSize: [28, 36],
            iconAnchor: [14, 36],
            popupAnchor: [0, -38],
        });
    }

    nodeData.forEach(n => {
        const statusLabel = {
            done:'Completed',
            active:'Active',
            ongoing:'Active',
            pending:'Pending',
            cancelled:'Cancelled',
        }[n.status] || n.status || 'Unknown';

        const popup = `
            <div style="font-family:system-ui,-apple-system,sans-serif;min-width:205px;padding:2px 0;">
                <div style="display:flex;align-items:center;gap:.42rem;margin-bottom:.4rem;">
                    <span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:${PIN_COLOR};flex-shrink:0;"></span>
                    <span style="font-size:.65rem;font-weight:800;text-transform:uppercase;letter-spacing:.08em;color:${PIN_COLOR};">${statusLabel}</span>
                </div>
                <div style="font-weight:800;font-size:.92rem;color:#0f172a;line-height:1.2;">${n.node_id}</div>
                ${n.node_name ? `<div style="font-size:.78rem;color:#475569;margin-top:.14rem;">${n.node_name}</div>` : ''}
                <div style="font-size:.72rem;color:#94a3b8;margin-top:.28rem;">
                    📍 ${[n.city, n.province].filter(Boolean).join(', ') || '—'}
                </div>
                <div style="font-size:.72rem;color:#2563eb;font-weight:700;margin-top:.14rem;">
                    ${n.project || '—'}
                </div>
                <div style="margin-top:.62rem;background:#f8fafc;border-radius:10px;padding:.45rem .55rem;">
                    <div style="display:flex;justify-content:space-between;margin-bottom:.34rem;">
                        <span style="font-size:.67rem;color:#94a3b8;font-weight:700;">PROGRESS</span>
                        <span style="font-size:.67rem;font-weight:900;color:${PIN_COLOR};">${Number(n.progress || 0).toFixed(1)}%</span>
                    </div>
                    <div style="height:6px;background:#e2e8f0;border-radius:999px;overflow:hidden;">
                        <div style="height:100%;width:${Math.min(100, Number(n.progress || 0))}%;background:${PIN_COLOR};border-radius:999px;"></div>
                    </div>
                </div>
            </div>`;

        const marker = L.marker([n.lat, n.lng], {
            icon: makePinIcon(PIN_COLOR, false)
        }).addTo(map).bindPopup(popup, { maxWidth: 250 });

        nodeMarkers[n.node_id] = {
            marker,
            lat: n.lat,
            lng: n.lng,
            project_id: n.project_id ?? null,
            raw: n,
        };
    });

    window.focusNode = function(nodeId){
        const entry = nodeMarkers[nodeId];
        if(!entry) return;
        map.flyTo([entry.lat, entry.lng], 14, { duration: 1 });
        setTimeout(() => entry.marker.openPopup(), 850);
        document.getElementById('mainMap').scrollIntoView({ behavior:'smooth', block:'center' });
    };

    window.filterByProject = function(projectId){
        currentProjectId = projectId;

        let count = 0;
        const bounds = [];

        Object.values(nodeMarkers).forEach(entry => {
            const visible = !projectId || String(entry.project_id) === String(projectId);
            if (visible) {
                entry.marker.addTo(map);
                entry.marker.setIcon(makePinIcon(FILTERED_PIN, true));
                count++;
                bounds.push([entry.lat, entry.lng]);
            } else {
                map.removeLayer(entry.marker);
            }
        });

        document.getElementById('mapNodeCount').textContent = count + ' nodes';

        if(bounds.length){
            map.fitBounds(bounds, { padding:[40,40] });
        }
    };

    const searchInput = document.getElementById('nodeSearch');
    if(searchInput){
        searchInput.addEventListener('input', function(){
            const q = this.value.trim().toLowerCase();
            const rows = document.querySelectorAll('#nodeTableBody tr');

            rows.forEach(row => {
                const txt = row.innerText.toLowerCase();
                row.style.display = txt.includes(q) ? '' : 'none';
            });
        });
    }
})();
</script>

{{-- ── Teardown Log Highlights Modal ─────────────────────────────────── --}}
<div id="log-modal-overlay" onclick="closeLogModal(event)" style="
    display:none;position:fixed;inset:0;z-index:1000;
    background:rgba(17,24,39,.5);backdrop-filter:blur(4px);
    align-items:center;justify-content:center;padding:1rem;
">
  <div id="log-modal" onclick="event.stopPropagation()" style="
      background:#fff;border-radius:24px;width:100%;max-width:460px;
      max-height:92vh;display:flex;flex-direction:column;
      box-shadow:0 32px 80px rgba(17,24,39,.22);overflow:hidden;
  ">

    {{-- Sticky header --}}
    <div style="padding:1.1rem 1.2rem .8rem;border-bottom:1px solid #eef2f6;
                background:linear-gradient(180deg,#f9fafb,#fff);flex-shrink:0;">
      <div style="display:flex;align-items:flex-start;gap:.6rem;">
        <div style="flex:1;min-width:0;">
          <div style="display:flex;flex-wrap:wrap;gap:.35rem;margin-bottom:.45rem;">
            <span id="lm-node-badge" style="padding:.25rem .6rem;border-radius:999px;font-size:.66rem;font-weight:800;letter-spacing:.04em;background:#eef4ff;color:#1d4ed8;border:1px solid #c7d7fe;"></span>
            <span id="lm-status-badge" style="padding:.25rem .6rem;border-radius:999px;font-size:.66rem;font-weight:800;background:#ecfdf3;color:#15803d;border:1px solid #b7ebcb;"></span>
            <span id="lm-offline-badge" style="display:none;padding:.25rem .6rem;border-radius:999px;font-size:.66rem;font-weight:800;background:#fff7ed;color:#b45309;border:1px solid #fde68a;">OFFLINE</span>
          </div>
          <div id="lm-span" style="font-size:1.05rem;font-weight:900;color:#111827;letter-spacing:-.02em;line-height:1.2;"></div>
          <div id="lm-location" style="font-size:.73rem;color:#6b7280;margin-top:.28rem;font-weight:600;"></div>
        </div>
        <button onclick="document.getElementById('log-modal-overlay').style.display='none'" style="
            background:#f3f4f6;border:none;border-radius:12px;width:32px;height:32px;
            cursor:pointer;font-size:1.1rem;display:flex;align-items:center;justify-content:center;
            color:#6b7280;flex-shrink:0;
        ">&times;</button>
      </div>
    </div>

    {{-- Tab bar --}}
    <div style="display:flex;border-bottom:1px solid #eef2f6;background:#fff;flex-shrink:0;">
      <button class="lm-tab lm-tab-active" data-tab="highlights" onclick="lmSwitchTab('highlights')">Highlights</button>
      <button class="lm-tab" data-tab="from-pole" onclick="lmSwitchTab('from-pole')" id="lm-tab-from"></button>
      <button class="lm-tab" data-tab="to-pole"   onclick="lmSwitchTab('to-pole')"   id="lm-tab-to"></button>
    </div>

    {{-- Scrollable body --}}
    <div style="overflow-y:auto;flex:1;">

      {{-- HIGHLIGHTS TAB --}}
      <div id="lm-pane-highlights">

        {{-- Cable Recovery --}}
        <div style="padding:.9rem 1.2rem;border-bottom:1px solid #f1f4f8;">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.6rem;">
            <span style="font-size:.76rem;font-weight:900;color:#111827;">Cable Recovery</span>
            <span id="lm-cable-tag" style="font-size:.66rem;font-weight:800;padding:.18rem .5rem;border-radius:8px;"></span>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:.55rem;margin-bottom:.6rem;">
            <div style="background:#f8faff;border:1px solid #e8efff;border-radius:13px;padding:.7rem;">
              <div style="font-size:.62rem;color:#9ca3af;font-weight:700;text-transform:uppercase;letter-spacing:.1em;">Collected</div>
              <div id="lm-cable-col" style="font-size:1.05rem;font-weight:900;color:#111827;margin-top:.22rem;"></div>
            </div>
            <div style="background:#f9fafb;border:1px solid #eef2f6;border-radius:13px;padding:.7rem;">
              <div style="font-size:.62rem;color:#9ca3af;font-weight:700;text-transform:uppercase;letter-spacing:.1em;">Expected</div>
              <div id="lm-cable-exp" style="font-size:1.05rem;font-weight:900;color:#374151;margin-top:.22rem;"></div>
            </div>
          </div>
          <div style="background:#f1f4f8;border-radius:999px;height:6px;overflow:hidden;">
            <div id="lm-cable-bar" style="height:100%;border-radius:999px;transition:width .4s ease;width:0%;"></div>
          </div>
          <div id="lm-unrecovered" style="display:none;margin-top:.5rem;padding:.5rem .65rem;border-radius:10px;background:#fff7ed;border:1px solid #fde68a;font-size:.71rem;color:#b45309;font-weight:700;"></div>
        </div>

        {{-- Components --}}
        <div style="padding:.9rem 1.2rem;border-bottom:1px solid #f1f4f8;">
          <div style="font-size:.76rem;font-weight:900;color:#111827;margin-bottom:.6rem;">Components Recovered</div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:.45rem;">
            <div id="lm-comp-node" class="lm-comp"></div>
            <div id="lm-comp-amp"  class="lm-comp"></div>
            <div id="lm-comp-ext"  class="lm-comp"></div>
            <div id="lm-comp-tsc"  class="lm-comp"></div>
          </div>
        </div>

        {{-- Meta --}}
        <div id="lm-meta" style="padding:.9rem 1.2rem .5rem;display:flex;flex-wrap:wrap;gap:.45rem;"></div>

        {{-- View report link --}}
        <div id="lm-report-link-wrap" style="padding:.5rem 1.2rem 1rem;display:none;">
          <a id="lm-report-link" href="#" target="_blank" style="
              display:inline-flex;align-items:center;gap:.45rem;
              padding:.55rem 1rem;border-radius:12px;
              background:#111827;color:#fff;
              font-size:.76rem;font-weight:800;
              text-decoration:none;transition:.15s ease;
          " onmouseover="this.style.background='#1f2937'" onmouseout="this.style.background='#111827'">
            <i class="mgc_external_link_line"></i>
            View Full Report
          </a>
        </div>
      </div>

      {{-- FROM POLE TAB --}}
      <div id="lm-pane-from-pole" style="display:none;padding:.9rem 1.2rem;">
        <div id="lm-from-photos" style="display:grid;grid-template-columns:1fr 1fr;gap:.65rem;"></div>
      </div>

      {{-- TO POLE TAB --}}
      <div id="lm-pane-to-pole" style="display:none;padding:.9rem 1.2rem;">
        <div id="lm-to-photos" style="display:grid;grid-template-columns:1fr 1fr;gap:.65rem;"></div>
      </div>

    </div>{{-- end scrollable --}}
  </div>
</div>

<style>
.lm-tab{
    flex:1;padding:.7rem .4rem;border:none;background:none;
    font-size:.73rem;font-weight:800;color:#6b7280;cursor:pointer;
    border-bottom:2px solid transparent;transition:.15s ease;
    font-family:inherit;letter-spacing:.01em;
}
.lm-tab:hover{ color:#111827; }
.lm-tab-active{ color:#111827;border-bottom-color:#111827; }

.lm-comp{
    background:#f9fafb;border:1px solid #eef2f6;
    border-radius:13px;padding:.6rem .7rem;font-size:.72rem;
}
.lm-comp .lm-comp-label{ color:#9ca3af;font-weight:700;text-transform:uppercase;letter-spacing:.08em;font-size:.61rem; }
.lm-comp .lm-comp-val{ font-size:.92rem;font-weight:900;color:#111827;margin-top:.18rem; }
.lm-comp .lm-comp-sub{ font-size:.65rem;color:#9ca3af;margin-top:.06rem; }
.lm-comp.ok{ border-color:#b7ebcb;background:#f0fdf4; }
.lm-comp.warn{ border-color:#fde68a;background:#fff7ed; }

.lm-meta-chip{
    display:inline-flex;align-items:center;gap:.32rem;
    padding:.3rem .65rem;border-radius:999px;
    border:1px solid #eef2f6;background:#f9fafb;
    font-size:.7rem;font-weight:700;color:#374151;
}

.lm-photo-card{
    border-radius:14px;overflow:hidden;
    border:1px solid #eef2f6;background:#f9fafb;
}
.lm-photo-label{
    font-size:.65rem;font-weight:800;color:#6b7280;
    text-transform:uppercase;letter-spacing:.1em;
    padding:.5rem .65rem .35rem;
}
.lm-photo-card img{
    width:100%;aspect-ratio:4/3;object-fit:cover;display:block;cursor:zoom-in;
}
.lm-photo-card img:hover{ opacity:.92; }
.lm-photo-empty{
    aspect-ratio:4/3;display:flex;align-items:center;justify-content:center;
    color:#c0c8d4;font-size:1.4rem;background:#f3f5f7;
}
</style>

<script>
function lmSwitchTab(name) {
    document.querySelectorAll('.lm-tab').forEach(t => {
        t.classList.toggle('lm-tab-active', t.dataset.tab === name);
    });
    ['highlights','from-pole','to-pole'].forEach(p => {
        document.getElementById('lm-pane-' + p).style.display = p === name ? '' : 'none';
    });
}

function lmPhotoGrid(containerId, photos) {
    const el = document.getElementById(containerId);
    const slots = [
        { key: 'before', label: 'Before' },
        { key: 'after',  label: 'After'  },
        { key: 'tag',    label: 'Pole Tag' },
    ];
    const prefix = containerId === 'lm-from-photos' ? 'from_' : 'to_';
    el.innerHTML = slots.map(s => {
        const src = photos[prefix + s.key];
        const inner = src
            ? `<img src="${src}" alt="${s.label}" onclick="lmZoom('${src}')">`
            : `<div class="lm-photo-empty"><i class="mgc_pic_2_line"></i></div>`;
        return `<div class="lm-photo-card">
                  <div class="lm-photo-label">${s.label}</div>
                  ${inner}
                </div>`;
    }).join('');
}

function lmZoom(src) {
    const z = document.createElement('div');
    z.style.cssText = 'position:fixed;inset:0;z-index:2000;background:rgba(0,0,0,.88);display:flex;align-items:center;justify-content:center;cursor:zoom-out;';
    z.innerHTML = `<img src="${src}" style="max-width:96vw;max-height:96vh;border-radius:12px;box-shadow:0 20px 60px rgba(0,0,0,.5);">`;
    z.onclick = () => z.remove();
    document.body.appendChild(z);
}

function openLogModal(el) {
    const d = JSON.parse(el.dataset.log);

    // Reset tab to highlights
    lmSwitchTab('highlights');

    // Badges
    const nodeCode = [d.node_id, d.node_name].filter(Boolean).join(' — ');
    document.getElementById('lm-node-badge').textContent = nodeCode || 'Unknown Node';
    document.getElementById('lm-status-badge').textContent = (d.status || 'submitted').toUpperCase().replace(/_/g,' ');
    document.getElementById('lm-offline-badge').style.display = d.offline ? 'inline-flex' : 'none';

    // Span title
    const fromTo = (d.from_pole && d.to_pole) ? d.from_pole + ' → ' + d.to_pole : '';
    document.getElementById('lm-span').textContent = fromTo || d.span || '—';
    const loc = [d.node_id, d.city].filter(Boolean).join(' • ');
    document.getElementById('lm-location').textContent = loc + (d.span_length ? '  ·  ' + d.span_length.toFixed(0) + ' m span' : '');

    // Tab labels
    document.getElementById('lm-tab-from').textContent = d.from_pole || 'From Pole';
    document.getElementById('lm-tab-to').textContent   = d.to_pole   || 'To Pole';

    // Cable
    const col = d.cable || 0, exp = d.cable_expected || 0;
    document.getElementById('lm-cable-col').textContent = col.toFixed(2) + ' m';
    document.getElementById('lm-cable-exp').textContent = exp.toFixed(2) + ' m';
    const pct = exp > 0 ? Math.min(100, (col / exp) * 100) : (col > 0 ? 100 : 0);
    const bar = document.getElementById('lm-cable-bar');
    bar.style.width = pct + '%';
    bar.style.background = pct >= 100 ? 'linear-gradient(90deg,#15803d,#22c55e)'
                         : pct >= 80  ? 'linear-gradient(90deg,#2563eb,#3b82f6)'
                                      : 'linear-gradient(90deg,#dc2626,#f87171)';
    const cTag = document.getElementById('lm-cable-tag');
    cTag.style.cssText = 'font-size:.66rem;font-weight:800;padding:.18rem .5rem;border-radius:8px;';
    if (d.cable_all) { cTag.textContent = '✓ All Collected'; cTag.style.background='#ecfdf3';cTag.style.color='#15803d';cTag.style.border='1px solid #b7ebcb'; }
    else             { cTag.textContent = '⚠ Partial';       cTag.style.background='#fff7ed';cTag.style.color='#b45309';cTag.style.border='1px solid #fde68a'; }

    const unrDiv = document.getElementById('lm-unrecovered');
    if (!d.cable_all && d.unrecovered > 0) {
        unrDiv.style.display = 'block';
        unrDiv.textContent = '⚠ Unrecovered: ' + d.unrecovered.toFixed(2) + ' m' + (d.unrecovered_reason ? ' — ' + d.unrecovered_reason : '');
    } else { unrDiv.style.display = 'none'; }

    // Components
    function compHTML(label, col, exp) {
        const ok = col >= exp;
        return `<div class="lm-comp-label">${label}</div>
                <div class="lm-comp-val">${col}<span style="font-size:.68rem;color:#9ca3af;font-weight:600;"> / ${exp}</span></div>
                <div class="lm-comp-sub">${ok ? '✓ Complete' : '⚠ Short by ' + (exp - col)}</div>`;
    }
    [['lm-comp-node','Node',d.node_col,d.node_exp],
     ['lm-comp-amp','Amplifier',d.amp_col,d.amp_exp],
     ['lm-comp-ext','Extender',d.ext_col,d.ext_exp],
     ['lm-comp-tsc','TSC',d.tsc_col,d.tsc_exp]
    ].forEach(([id, label, c, e]) => {
        const el2 = document.getElementById(id);
        el2.innerHTML = compHTML(label, c, e);
        el2.className = 'lm-comp ' + (c >= e ? 'ok' : 'warn');
    });

    // Meta
    const meta = document.getElementById('lm-meta');
    meta.innerHTML = '';
    if (d.team)         meta.innerHTML += `<span class="lm-meta-chip"><i class="mgc_group_line"></i>${d.team}</span>`;
    if (d.submitted_by) meta.innerHTML += `<span class="lm-meta-chip"><i class="mgc_user_3_line"></i>${d.submitted_by}</span>`;
    if (d.started_at)   meta.innerHTML += `<span class="lm-meta-chip"><i class="mgc_time_line"></i>${fmtTime(d.started_at)} → ${d.finished_at ? fmtTime(d.finished_at) : '—'}</span>`;

    // Photo tabs
    const photos = d.photos || {};
    lmPhotoGrid('lm-from-photos', photos);
    lmPhotoGrid('lm-to-photos',   photos);

    // Report link
    const linkWrap = document.getElementById('lm-report-link-wrap');
    const linkEl   = document.getElementById('lm-report-link');
    if (d.report_url) {
        linkEl.href       = d.report_url;
        linkWrap.style.display = 'block';
    } else {
        linkWrap.style.display = 'none';
    }

    document.getElementById('log-modal-overlay').style.display = 'flex';
}

function closeLogModal(e) {
    if (e && e.target !== document.getElementById('log-modal-overlay')) return;
    document.getElementById('log-modal-overlay').style.display = 'none';
}

function fmtTime(dt) {
    if (!dt) return '—';
    return new Date(dt).toLocaleString('en-PH', { month:'short', day:'numeric', hour:'2-digit', minute:'2-digit' });
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') document.getElementById('log-modal-overlay').style.display = 'none';
});

</x-layout>