<x-layout>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<style>
*,*::before,*::after{box-sizing:border-box;}
:root{
  --p:#2563eb;--p2:#1d4ed8;--pg:rgba(37,99,235,.08);
  --surf:#fff;--surf2:#f8fafc;--bdr:#e2e8f0;
  --txt:#0f172a;--txt2:#475569;--muted:#94a3b8;
  --r:14px;--sh:0 1px 3px rgba(15,23,42,.05),0 4px 16px rgba(15,23,42,.07);
  --ff:system-ui,-apple-system,sans-serif;--fm:'JetBrains Mono','Fira Mono',monospace;
}
body{font-family:var(--ff);}
.sw{padding:.75rem 1.25rem 2.5rem;}

/* eyebrow */
.eyebrow{font-size:.62rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--p);display:flex;align-items:center;gap:.35rem;margin-bottom:.2rem;}
.eyebrow::before{content:'';display:inline-block;width:12px;height:2px;background:var(--p);border-radius:2px;}

/* status badges */
.badge{display:inline-flex;align-items:center;padding:.24rem .65rem;border-radius:999px;font-size:.68rem;font-weight:800;white-space:nowrap;}
.s-draft                    {background:#f1f5f9;color:#64748b;}
.s-submitted_to_pm          {background:#fef3c7;color:#b45309;}
.s-pm_for_rework            {background:#fee2e2;color:#dc2626;}
.s-pm_approved              {background:#dbeafe;color:#1d4ed8;}
.s-submitted_to_telcovantage{background:#ede9fe;color:#7c3aed;}
.s-telcovantage_for_rework  {background:#fee2e2;color:#dc2626;}
.s-telcovantage_approved    {background:#d1fae5;color:#059669;}
.s-ready_for_delivery       {background:#dbeafe;color:#1d4ed8;}
.s-delivered                {background:#dcfce7;color:#166534;}
.s-closed                   {background:#f1f5f9;color:#374151;}

/* flash */
.flash{display:flex;align-items:center;gap:.5rem;padding:.65rem 1rem;border-radius:10px;font-size:.8rem;font-weight:600;margin-bottom:1rem;}
.flash-ok{background:rgba(22,163,74,.08);border:1px solid rgba(22,163,74,.2);color:#15803d;}
.flash-err{background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);color:#dc2626;}

/* action buttons */
.btn-ghost{display:inline-flex;align-items:center;gap:.35rem;padding:.44rem .85rem;border:1px solid var(--bdr);border-radius:9px;background:var(--surf);color:var(--txt2);font-size:.79rem;font-weight:600;font-family:var(--ff);text-decoration:none;}
.btn-ghost:hover{background:var(--surf2);}
.btn-approve{display:inline-flex;align-items:center;gap:.3rem;padding:.46rem 1rem;border-radius:9px;background:rgba(22,163,74,.1);color:#15803d;border:1.5px solid rgba(22,163,74,.25);font-size:.8rem;font-weight:700;font-family:var(--ff);cursor:pointer;transition:all .12s;}
.btn-approve:hover{background:rgba(22,163,74,.2);}
.btn-map{display:inline-flex;align-items:center;gap:.35rem;padding:.46rem 1rem;border-radius:9px;background:rgba(37,99,235,.08);color:var(--p);border:1px solid rgba(37,99,235,.25);font-size:.8rem;font-weight:700;font-family:var(--ff);cursor:pointer;text-decoration:none;transition:all .12s;}
.btn-map:hover{background:rgba(37,99,235,.15);}

/* stat strip */
.stat-strip{display:grid;grid-template-columns:repeat(auto-fit,minmax(110px,1fr));gap:.7rem;margin-bottom:1.25rem;}
.sc{background:var(--surf);border:1px solid var(--bdr);border-radius:12px;box-shadow:var(--sh);padding:.85rem 1rem;position:relative;overflow:hidden;}
.sc::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:var(--sc-a,var(--p));border-radius:3px 3px 0 0;}
.sc-val{font-size:1.45rem;font-weight:900;font-family:var(--fm);color:var(--txt);line-height:1.1;}
.sc-lbl{font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);margin-top:.25rem;}

/* panel */
.panel{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;margin-bottom:1.2rem;}
.panel-hd{display:flex;align-items:center;gap:.5rem;padding:.75rem 1.1rem;border-bottom:1px solid var(--bdr);background:var(--surf2);}
.panel-title{font-size:.85rem;font-weight:800;color:var(--txt);}

/* map */
#spanMap{height:380px;width:100%;}

/* workflow row */
.wf-row{display:flex;flex-wrap:wrap;gap:1.5rem;padding:1rem 1.1rem;}
.wf-block .wf-lbl{font-size:.59rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);margin-bottom:.18rem;}
.wf-block .wf-name{font-size:.82rem;font-weight:800;color:var(--txt);}
.wf-block .wf-time{font-size:.68rem;color:var(--muted);margin-top:.1rem;}

/* span accordion cards */
.span-list{display:flex;flex-direction:column;gap:.6rem;padding:.85rem 1rem;}
.span-card{background:var(--surf2);border:1px solid var(--bdr);border-radius:12px;overflow:hidden;transition:box-shadow .15s;}
.span-card.open{box-shadow:0 4px 20px rgba(15,23,42,.1);}
.span-hd{display:flex;align-items:center;gap:.75rem;padding:.7rem 1rem;cursor:pointer;user-select:none;}
.span-hd:hover{background:rgba(37,99,235,.03);}
.span-arrow{font-size:.85rem;color:var(--muted);transition:transform .2s;flex-shrink:0;}
.span-card.open .span-arrow{transform:rotate(90deg);}
.span-code{font-family:var(--fm);font-size:.78rem;font-weight:700;color:var(--p);}
.span-poles{font-size:.82rem;font-weight:800;color:var(--txt);}
.span-poles .arr{color:var(--muted);font-weight:400;margin:0 .3rem;}
.span-chips{display:flex;gap:.3rem;flex-wrap:wrap;margin-left:auto;}
.chip{display:inline-flex;align-items:center;gap:.18rem;padding:.18rem .5rem;border-radius:6px;font-size:.68rem;font-weight:800;white-space:nowrap;}
.chip-cable{background:#d1fae5;color:#065f46;}
.chip-node {background:#dbeafe;color:#1e40af;}
.chip-amp  {background:#d1fae5;color:#065f46;}
.chip-ext  {background:#ede9fe;color:#6d28d9;}
.chip-tsc  {background:#fef3c7;color:#92400e;}

/* span detail (expanded) */
.span-body{border-top:1px solid var(--bdr);padding:1rem;}
.detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-bottom:.9rem;}
@media(max-width:640px){.detail-grid{grid-template-columns:1fr;}}
.detail-box{background:var(--surf);border:1px solid var(--bdr);border-radius:10px;padding:.7rem .85rem;}
.detail-box-title{font-size:.59rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);margin-bottom:.5rem;display:flex;align-items:center;gap:.3rem;}
.cmp-row{display:flex;justify-content:space-between;align-items:center;padding:.28rem 0;border-bottom:1px solid var(--bdr);}
.cmp-row:last-child{border-bottom:none;}
.cmp-lbl{font-size:.75rem;color:var(--txt2);}
.cmp-val{font-size:.78rem;font-weight:800;font-family:var(--fm);color:var(--txt);}
.cmp-val.miss{color:#dc2626;}
.cmp-val.ok{color:#15803d;}

/* photo gallery */
.photo-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(100px,1fr));gap:.45rem;}
.photo-thumb{width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:8px;border:1px solid var(--bdr);cursor:pointer;transition:opacity .15s;}
.photo-thumb:hover{opacity:.85;}
.photo-tag{display:inline-flex;align-items:center;gap:.2rem;padding:.18rem .55rem;border-radius:6px;font-size:.64rem;font-weight:700;background:var(--surf2);border:1px solid var(--bdr);color:var(--txt2);}

/* lightbox */
#lb{display:none;position:fixed;inset:0;background:rgba(0,0,0,.88);z-index:9999;align-items:center;justify-content:center;flex-direction:column;gap:.75rem;}
#lb.open{display:flex;}
#lb img{max-width:90vw;max-height:82vh;border-radius:10px;object-fit:contain;}
#lb-close{position:absolute;top:1rem;right:1.2rem;background:rgba(255,255,255,.15);border:none;color:#fff;font-size:1.4rem;border-radius:8px;padding:.2rem .55rem;cursor:pointer;}
#lb-cap{color:#fff;font-size:.8rem;opacity:.7;}
</style>
@endpush

@php
    $user    = auth()->user();
    $isAdmin = in_array($user->role, ['admin','pm','project_manager','executives']);
    $node    = $submission->node;
    $proj    = $submission->project;

    $statusMeta = [
        'draft'                     => ['label'=>'Draft',           'cls'=>'s-draft'],
        'submitted_to_pm'           => ['label'=>'Pending Approval','cls'=>'s-submitted_to_pm'],
        'pm_for_rework'             => ['label'=>'For Rework',      'cls'=>'s-pm_for_rework'],
        'pm_approved'               => ['label'=>'PM Approved',     'cls'=>'s-pm_approved'],
        'submitted_to_telcovantage' => ['label'=>'Pending TV',      'cls'=>'s-submitted_to_telcovantage'],
        'telcovantage_for_rework'   => ['label'=>'Rework (TV)',     'cls'=>'s-telcovantage_for_rework'],
        'telcovantage_approved'     => ['label'=>'Approved ✓',      'cls'=>'s-telcovantage_approved'],
        'ready_for_delivery'        => ['label'=>'For Delivery',    'cls'=>'s-ready_for_delivery'],
        'delivered'                 => ['label'=>'Delivered',       'cls'=>'s-delivered'],
        'closed'                    => ['label'=>'Closed',          'cls'=>'s-closed'],
    ];
    $sm = $statusMeta[$submission->status] ?? ['label'=>$submission->status,'cls'=>'s-draft'];

    $resolvedSubmitter = is_numeric($submission->submitted_by)
        ? ($userNameMap[$submission->submitted_by] ?? "User #{$submission->submitted_by}")
        : $submission->submitted_by;
    $resolvedTv = is_numeric($submission->telcovantage_reviewed_by)
        ? ($userNameMap[$submission->telcovantage_reviewed_by] ?? "User #{$submission->telcovantage_reviewed_by}")
        : $submission->telcovantage_reviewed_by;

    $pendingStatuses = ['submitted_to_pm','pm_for_rework','pm_approved','submitted_to_telcovantage','telcovantage_for_rework'];
    $canApprove = $isAdmin && in_array($submission->status, $pendingStatuses);

    $statCards = [
        ['label'=>'Cable (m)',   'val'=> $submission->total_cable > 0      ? number_format($submission->total_cable,1)    : '—', 'a'=>'#059669'],
        ['label'=>'Strand (m)',  'val'=> $submission->total_strand_length > 0 ? number_format($submission->total_strand_length,1) : '—', 'a'=>'#0891b2'],
        ['label'=>'Nodes',       'val'=> $submission->total_node > 0        ? $submission->total_node        : '—', 'a'=>'#2563eb'],
        ['label'=>'Amplifiers',  'val'=> $submission->total_amplifier > 0   ? $submission->total_amplifier   : '—', 'a'=>'#10b981'],
        ['label'=>'Extenders',   'val'=> $submission->total_extender > 0    ? $submission->total_extender    : '—', 'a'=>'#6366f1'],
        ['label'=>'TSC',         'val'=> $submission->total_tsc > 0         ? $submission->total_tsc         : '—', 'a'=>'#f59e0b'],
        ['label'=>'Power Supply','val'=> $submission->total_powersupply > 0 ? $submission->total_powersupply : '—', 'a'=>'#ec4899'],
    ];
@endphp

<div class="col-span-full sw">

    @if(session('success'))
        <div class="flash flash-ok"><i class="mgc_check_circle_line"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash flash-err"><i class="mgc_close_circle_line"></i> {{ session('error') }}</div>
    @endif

    {{-- Header --}}
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.25rem;">
        <div>
            <a href="{{ route('reports.index') }}" class="btn-ghost" style="margin-bottom:.55rem;display:inline-flex;">
                <i class="mgc_arrow_left_line"></i> Back
            </a>
            <div class="eyebrow"><i class="mgc_file_line"></i> Daily Report · {{ \Carbon\Carbon::parse($submission->report_date)->format('F j, Y') }}</div>
            <h2 style="margin:.1rem 0 0;font-size:1.45rem;font-weight:900;color:var(--txt);letter-spacing:-.02em;display:flex;align-items:center;gap:.55rem;flex-wrap:wrap;">
                {{ $node?->node_id ?? 'Report #'.$submission->id }}
                <span class="badge {{ $sm['cls'] }}">{{ $sm['label'] }}</span>
            </h2>
            <p style="margin:.3rem 0 0;font-size:.78rem;color:var(--txt2);display:flex;gap:.65rem;flex-wrap:wrap;align-items:center;">
                @if($node?->city || $node?->province)
                    <span><i class="mgc_location_line" style="font-size:.72rem;"></i>
                        {{ collect([$node->city, $node->province])->filter()->join(', ') }}
                    </span>
                @endif
                @if($node?->sites ?? $node?->area ?? null)
                    <span style="color:var(--p);font-weight:700;">{{ $node->sites ?? $node->area }}</span>
                @endif
                @if($proj)<span><i class="mgc_folder_line" style="font-size:.72rem;"></i> {{ $proj->project_name }}</span>@endif
                <span><i class="mgc_calendar_line" style="font-size:.72rem;"></i>
                    {{ \Carbon\Carbon::parse($submission->report_date)->format('l, F j, Y') }}
                </span>
            </p>
        </div>
        <div style="display:flex;gap:.45rem;flex-wrap:wrap;align-items:flex-start;padding-top:2rem;">
            @if($mapData->isNotEmpty())
                <button type="button" class="btn-map" onclick="toggleMap()">
                    <i class="mgc_map_line"></i> <span id="mapBtnLbl">Progress Map</span>
                </button>
            @endif
            @if($canApprove)
                <form method="POST" action="{{ route('reports.approve', $submission) }}">
                    @csrf
                    <button type="submit" class="btn-approve"><i class="mgc_check_line"></i> Approve</button>
                </form>
            @endif
        </div>
    </div>

    {{-- Summary strip --}}
    <div class="stat-strip">
        @foreach($statCards as $sc)
            <div class="sc" style="--sc-a:{{ $sc['a'] }}">
                <div class="sc-val">{{ $sc['val'] }}</div>
                <div class="sc-lbl">{{ $sc['label'] }}</div>
            </div>
        @endforeach
    </div>

    {{-- Workflow panel --}}
    <div class="panel">
        <div class="panel-hd">
            <i class="mgc_user_3_line" style="color:var(--p);font-size:.95rem;"></i>
            <span class="panel-title">Workflow</span>
        </div>
        <div class="wf-row">
            @if($resolvedSubmitter)
            <div class="wf-block">
                <div class="wf-lbl">Submitted by (Lineman)</div>
                <div class="wf-name" style="color:#c2410c;">{{ $resolvedSubmitter }}</div>
                @if($submission->submitted_at)
                    <div class="wf-time">{{ \Carbon\Carbon::parse($submission->submitted_at)->format('M d, Y · H:i') }}</div>
                @endif
            </div>
            @endif
            @if($resolvedTv)
            <div class="wf-block">
                <div class="wf-lbl">Approved by</div>
                <div class="wf-name" style="color:#065f46;">{{ $resolvedTv }}</div>
                @if($submission->telcovantage_reviewed_at)
                    <div class="wf-time">{{ \Carbon\Carbon::parse($submission->telcovantage_reviewed_at)->format('M d, Y · H:i') }}</div>
                @endif
            </div>
            @endif
            @if($submission->warehouse_location)
            <div class="wf-block">
                <div class="wf-lbl">Warehouse</div>
                <div class="wf-name">{{ $submission->warehouse_location }}</div>
            </div>
            @endif
        </div>
    </div>

    {{-- Progress Map (hidden by default) --}}
    @if($mapData->isNotEmpty())
    <div class="panel" id="mapPanel" style="display:none;">
        <div class="panel-hd">
            <i class="mgc_map_line" style="color:var(--p);font-size:.95rem;"></i>
            <span class="panel-title">Progress Map</span>
            <span style="margin-left:auto;font-size:.72rem;color:var(--muted);">{{ $logs->count() }} span{{ $logs->count()!==1?'s':'' }} plotted</span>
        </div>
        <div id="spanMap"></div>
    </div>
    @endif

    {{-- Spans collected --}}
    <div class="panel">
        <div class="panel-hd">
            <i class="mgc_route_line" style="color:var(--p);font-size:.95rem;"></i>
            <span class="panel-title">Spans Collected</span>
            <span style="margin-left:.4rem;font-size:.72rem;color:var(--muted);">({{ $logs->count() }})</span>
        </div>
        <div class="span-list">
            @forelse($logs as $i => $log)
                @php
                    $span  = $log->poleSpan;
                    $fromP = $span?->fromPole;
                    $toP   = $span?->toPole;
                    $images= $log->images ?? collect();
                    $cardId= 'span-'.$i;
                @endphp
                <div class="span-card" id="{{ $cardId }}">
                    {{-- Accordion header --}}
                    <div class="span-hd" onclick="toggleSpan('{{ $cardId }}')">
                        <i class="mgc_arrow_right_line span-arrow"></i>
                        <div style="min-width:0;">
                            @if($span?->pole_span_code)
                                <div class="span-code">{{ $span->pole_span_code }}</div>
                            @endif
                            <div class="span-poles">
                                {{ $fromP?->pole_code ?? 'From' }}
                                <span class="arr">→</span>
                                {{ $toP?->pole_code ?? 'To' }}
                            </div>
                            @if($span?->length_meters)
                                <div style="font-size:.68rem;color:var(--muted);margin-top:.1rem;">{{ number_format($span->length_meters,1) }} m span</div>
                            @endif
                        </div>
                        <div class="span-chips">
                            @if($log->collected_cable > 0)
                                <span class="chip chip-cable"><i class="mgc_cable_line" style="font-size:.65rem;"></i> {{ number_format($log->collected_cable,1) }}m</span>
                            @endif
                            @if($log->collected_node > 0)
                                <span class="chip chip-node">Node {{ $log->collected_node }}</span>
                            @endif
                            @if($log->collected_amplifier > 0)
                                <span class="chip chip-amp">Amp {{ $log->collected_amplifier }}</span>
                            @endif
                            @if($log->collected_extender > 0)
                                <span class="chip chip-ext">Ext {{ $log->collected_extender }}</span>
                            @endif
                            @if($log->collected_tsc > 0)
                                <span class="chip chip-tsc">TSC {{ $log->collected_tsc }}</span>
                            @endif
                            @if($images->isNotEmpty())
                                <span class="chip" style="background:#f1f5f9;color:#475569;">
                                    <i class="mgc_photo_album_line" style="font-size:.65rem;"></i> {{ $images->count() }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Expanded detail --}}
                    <div class="span-body" id="{{ $cardId }}-body" style="display:none;">
                        <div class="detail-grid">

                            {{-- Cable collected vs expected --}}
                            <div class="detail-box">
                                <div class="detail-box-title"><i class="mgc_cable_line" style="color:#059669;"></i> Cable Collection</div>
                                @php
                                    $expCable = (float)($log->expected_cable_snapshot ?? $span?->length_meters ?? 0);
                                    $colCable = (float)$log->collected_cable;
                                    $cablePct = $expCable > 0 ? min(100, round($colCable/$expCable*100)) : 100;
                                @endphp
                                <div class="cmp-row">
                                    <span class="cmp-lbl">Collected</span>
                                    <span class="cmp-val ok">{{ number_format($colCable,1) }} m</span>
                                </div>
                                <div class="cmp-row">
                                    <span class="cmp-lbl">Expected</span>
                                    <span class="cmp-val">{{ $expCable > 0 ? number_format($expCable,1).' m' : '—' }}</span>
                                </div>
                                <div class="cmp-row">
                                    <span class="cmp-lbl">Recovery</span>
                                    <span class="cmp-val {{ $cablePct >= 90 ? 'ok' : 'miss' }}">{{ $cablePct }}%</span>
                                </div>
                                @if($log->unrecovered_cable > 0)
                                <div class="cmp-row">
                                    <span class="cmp-lbl">Unrecovered</span>
                                    <span class="cmp-val miss">{{ number_format($log->unrecovered_cable,1) }} m</span>
                                </div>
                                @endif
                                @if($log->unrecovered_reason)
                                <div style="font-size:.7rem;color:var(--txt2);margin-top:.4rem;padding:.35rem .5rem;background:#fef3c7;border-radius:6px;">
                                    ⚠️ {{ $log->unrecovered_reason }}
                                </div>
                                @endif
                                {{-- Progress bar --}}
                                <div style="margin-top:.6rem;height:6px;background:var(--bdr);border-radius:999px;overflow:hidden;">
                                    <div style="height:100%;width:{{ $cablePct }}%;background:{{ $cablePct>=90?'#16a34a':'#f59e0b' }};border-radius:999px;"></div>
                                </div>
                            </div>

                            {{-- Components --}}
                            <div class="detail-box">
                                <div class="detail-box-title"><i class="mgc_box_3_line" style="color:#6366f1;"></i> Components</div>
                                @foreach([
                                    ['Node',      $log->collected_node,       $log->expected_node_snapshot,       '#2563eb'],
                                    ['Amplifier', $log->collected_amplifier,  $log->expected_amplifier_snapshot,  '#10b981'],
                                    ['Extender',  $log->collected_extender,   $log->expected_extender_snapshot,   '#6366f1'],
                                    ['TSC',       $log->collected_tsc,        $log->expected_tsc_snapshot,        '#f59e0b'],
                                ] as [$lbl,$col,$exp,$clr])
                                    @if($col > 0 || $exp > 0)
                                    <div class="cmp-row">
                                        <span class="cmp-lbl">{{ $lbl }}</span>
                                        <span style="display:flex;align-items:center;gap:.4rem;">
                                            <span class="cmp-val" style="color:{{ $clr }};">{{ $col ?: '0' }}</span>
                                            @if($exp > 0)<span style="font-size:.65rem;color:var(--muted);">/ {{ $exp }}</span>@endif
                                        </span>
                                    </div>
                                    @endif
                                @endforeach
                                @if($log->did_collect_components !== null)
                                <div style="margin-top:.5rem;font-size:.7rem;font-weight:700;color:{{ $log->did_collect_components?'#15803d':'#dc2626' }};">
                                    {{ $log->did_collect_components ? '✓ All components collected' : '✗ Not all components collected' }}
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- Pole tags row --}}
                        @if($fromP || $toP)
                        <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:.8rem;">
                            @if($fromP)
                                <span class="photo-tag"><i class="mgc_map_pin_line" style="font-size:.65rem;color:#2563eb;"></i>
                                    From: {{ $fromP->pole_code }}{{ $fromP->pole_name ? ' · '.$fromP->pole_name : '' }}
                                </span>
                            @endif
                            @if($toP)
                                <span class="photo-tag"><i class="mgc_map_pin_line" style="font-size:.65rem;color:#059669;"></i>
                                    To: {{ $toP->pole_code }}{{ $toP->pole_name ? ' · '.$toP->pole_name : '' }}
                                </span>
                            @endif
                            @if($log->finished_at)
                                <span class="photo-tag"><i class="mgc_time_line" style="font-size:.65rem;"></i>
                                    {{ \Carbon\Carbon::parse($log->finished_at)->format('g:i A · M d') }}
                                </span>
                            @endif
                            @if($log->submitted_by)
                                <span class="photo-tag"><i class="mgc_user_3_line" style="font-size:.65rem;color:#c2410c;"></i>
                                    {{ $log->submitted_by }}
                                </span>
                            @endif
                        </div>
                        @endif

                        {{-- Photos --}}
                        @if($images->isNotEmpty())
                        <div style="margin-bottom:.3rem;">
                            <div style="font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);margin-bottom:.5rem;display:flex;align-items:center;gap:.35rem;">
                                <i class="mgc_photo_album_line" style="font-size:.78rem;"></i>
                                Photos ({{ $images->count() }})
                            </div>
                            <div class="photo-grid">
                                @foreach($images as $img)
                                    @php
                                        $src = asset('storage/'.$img->image_path);
                                        $tag = $img->photo_type ?? $img->type ?? null;
                                    @endphp
                                    <div style="position:relative;">
                                        <img src="{{ $src }}" class="photo-thumb" loading="lazy"
                                             onclick="openLb('{{ $src }}','{{ $fromP?->pole_code ?? '' }} → {{ $toP?->pole_code ?? '' }}{{ $tag ? ' · '.ucfirst(str_replace('_',' ',$tag)) : '' }}')"
                                             alt="photo">
                                        @if($tag)
                                        <div style="position:absolute;bottom:.25rem;left:.25rem;background:rgba(0,0,0,.6);color:#fff;font-size:.55rem;font-weight:700;padding:.1rem .35rem;border-radius:4px;text-transform:uppercase;letter-spacing:.04em;">
                                            {{ str_replace('_',' ',$tag) }}
                                        </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <div style="font-size:.75rem;color:var(--muted);font-style:italic;">No photos for this span.</div>
                        @endif
                    </div>
                </div>
            @empty
                <div style="text-align:center;padding:2.5rem;color:var(--muted);">
                    <i class="mgc_route_line" style="font-size:2rem;display:block;margin-bottom:.5rem;"></i>
                    No teardown spans recorded in this report
                </div>
            @endforelse
        </div>
    </div>

    {{-- Remarks --}}
    @if($submission->remarks->isNotEmpty())
    <div class="panel">
        <div class="panel-hd">
            <i class="mgc_comment_line" style="color:var(--p);font-size:.95rem;"></i>
            <span class="panel-title">Remarks</span>
        </div>
        <div style="padding:.85rem 1rem;display:flex;flex-direction:column;gap:.6rem;">
            @foreach($submission->remarks as $remark)
                <div style="background:var(--surf2);border-radius:9px;padding:.65rem .9rem;border:1px solid var(--bdr);">
                    <div style="font-size:.8rem;color:var(--txt);font-weight:600;">{{ $remark->body ?? $remark->remark ?? $remark->comment ?? '' }}</div>
                    <div style="font-size:.67rem;color:var(--muted);margin-top:.2rem;">
                        {{ $remark->user_name ?? '' }}
                        @if($remark->created_at) · {{ \Carbon\Carbon::parse($remark->created_at)->format('M d, Y H:i') }}@endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

{{-- Lightbox --}}
<div id="lb" onclick="if(event.target===this)closeLb()">
    <button id="lb-close" onclick="closeLb()">✕</button>
    <img id="lb-img" src="" alt="">
    <div id="lb-cap"></div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
// ── Accordion ──
function toggleSpan(id) {
    const card = document.getElementById(id);
    const body = document.getElementById(id + '-body');
    const open = card.classList.toggle('open');
    body.style.display = open ? '' : 'none';
}

// ── Map toggle ──
let mapInit = false;
function toggleMap() {
    const panel = document.getElementById('mapPanel');
    const btn   = document.getElementById('mapBtnLbl');
    const vis   = panel.style.display === 'none';
    panel.style.display = vis ? '' : 'none';
    btn.textContent = vis ? 'Hide Map' : 'Progress Map';
    if (vis && !mapInit) { initMap(); mapInit = true; }
}

// ── Leaflet map ──
const MAP_DATA = @json($mapData);
function initMap() {
    const valid = MAP_DATA.filter(d => d.from_lat || d.to_lat);
    const coords = valid.flatMap(d => {
        const pts = [];
        if (d.from_lat && d.from_lng) pts.push([d.from_lat, d.from_lng]);
        if (d.to_lat && d.to_lng)     pts.push([d.to_lat,   d.to_lng]);
        return pts;
    });
    if (!coords.length) return;

    const center = coords.reduce((acc, c) => [acc[0]+c[0], acc[1]+c[1]], [0,0]);
    center[0] /= coords.length; center[1] /= coords.length;

    const map = L.map('spanMap').setView(center, 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const green  = L.divIcon({ html:'<div style="width:10px;height:10px;background:#2563eb;border:2px solid #fff;border-radius:50%;box-shadow:0 1px 4px rgba(0,0,0,.4);"></div>', className:'', iconSize:[10,10], iconAnchor:[5,5] });
    const red    = L.divIcon({ html:'<div style="width:10px;height:10px;background:#dc2626;border:2px solid #fff;border-radius:50%;box-shadow:0 1px 4px rgba(0,0,0,.4);"></div>', className:'', iconSize:[10,10], iconAnchor:[5,5] });

    valid.forEach((d, idx) => {
        const pts = [];
        if (d.from_lat && d.from_lng) {
            pts.push([d.from_lat, d.from_lng]);
            L.marker([d.from_lat, d.from_lng], {icon: green})
             .addTo(map)
             .bindPopup(`<b>${d.from_code}</b><br>Span: ${d.span_code ?? '—'}`);
        }
        if (d.to_lat && d.to_lng) {
            pts.push([d.to_lat, d.to_lng]);
            L.marker([d.to_lat, d.to_lng], {icon: red})
             .addTo(map)
             .bindPopup(`<b>${d.to_code}</b><br>Cable: ${d.cable} m`);
        }
        if (pts.length === 2) {
            L.polyline(pts, { color:'#2563eb', weight:3, opacity:.75, dashArray:'6 4' })
             .addTo(map)
             .bindPopup(`${d.from_code} → ${d.to_code}<br>${d.span_code ?? ''}<br>Cable: ${d.cable} m`);
        }
    });

    if (coords.length > 1) {
        map.fitBounds(L.latLngBounds(coords), { padding:[30,30] });
    }
}

// ── Lightbox ──
function openLb(src, cap) {
    document.getElementById('lb-img').src = src;
    document.getElementById('lb-cap').textContent = cap;
    document.getElementById('lb').classList.add('open');
}
function closeLb() { document.getElementById('lb').classList.remove('open'); }
document.addEventListener('keydown', e => { if(e.key==='Escape') closeLb(); });
</script>

</x-layout>
