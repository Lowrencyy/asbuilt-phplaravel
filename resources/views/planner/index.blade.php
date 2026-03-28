<x-layout>

@push('styles')
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
.pl-wrap{padding:1rem 1.5rem 2.5rem;}

.eyebrow{font-size:.63rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--p);display:flex;align-items:center;gap:.4rem;margin-bottom:.2rem;}
.eyebrow::before{content:'';display:inline-block;width:14px;height:2px;background:var(--p);border-radius:2px;}
.pg-hd{display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.4rem;}
.pg-hd h2{margin:.1rem 0 0;font-size:1.5rem;font-weight:900;color:var(--txt);letter-spacing:-.02em;}
.pg-hd p{margin:.2rem 0 0;font-size:.77rem;color:var(--txt2);}

/* stat strip */
.stat-strip{display:grid;grid-template-columns:repeat(4,1fr);gap:.75rem;margin-bottom:1.3rem;}
@media(max-width:900px){.stat-strip{grid-template-columns:repeat(2,1fr);}}
.sc{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);padding:.9rem 1rem;position:relative;overflow:hidden;}
.sc::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;border-radius:3px 3px 0 0;background:var(--sc-accent,var(--p));}
.sc-val{font-size:1.9rem;font-weight:900;font-family:var(--fm);color:var(--txt);line-height:1.1;margin-top:.2rem;}
.sc-lbl{font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);margin-top:.25rem;}
.sc-icon{position:absolute;bottom:.6rem;right:.8rem;font-size:1.4rem;opacity:.08;}

/* project accordion */
.proj-block{background:var(--surf);border:1px solid var(--bdr);border-radius:var(--r);box-shadow:var(--sh);overflow:hidden;margin-bottom:1rem;}
.proj-hd{display:flex;align-items:center;gap:.75rem;padding:.9rem 1.1rem;cursor:pointer;user-select:none;transition:background .1s;}
.proj-hd:hover{background:var(--surf2);}
.proj-hd.open{border-bottom:1px solid var(--bdr);}
.proj-dot{width:10px;height:10px;border-radius:50%;flex-shrink:0;}
.proj-name{font-size:.9rem;font-weight:800;color:var(--txt);flex:1;}
.proj-meta{display:flex;gap:.5rem;align-items:center;}
.chip{padding:.18rem .6rem;border-radius:999px;font-size:.65rem;font-weight:700;}
.chip-blue{background:var(--pg);color:var(--p);}
.chip-green{background:rgba(22,163,74,.1);color:#15803d;}
.chip-amber{background:rgba(217,119,6,.1);color:#b45309;}
.caret{font-size:1rem;color:var(--muted);transition:transform .2s;}
.caret.open{transform:rotate(180deg);}

/* node rows */
.node-table{width:100%;border-collapse:collapse;}
.node-table tr{border-bottom:1px solid var(--bdr);transition:background .1s;}
.node-table tr:last-child{border-bottom:none;}
.node-table tr:hover{background:#f0f6ff;}
.node-table td{padding:.65rem 1.1rem;font-size:.8rem;color:var(--txt2);vertical-align:middle;}
.td-id{font-family:var(--fm);font-weight:700;color:var(--txt);font-size:.78rem;}
.td-name{font-weight:600;color:var(--txt);}
.td-loc{font-size:.72rem;color:var(--muted);}

/* GPS bar */
.gps-bar-wrap{display:flex;align-items:center;gap:.5rem;}
.gps-bar{height:6px;flex:1;background:#e2e8f0;border-radius:4px;overflow:hidden;min-width:80px;}
.gps-fill{height:100%;border-radius:4px;background:var(--green);}
.gps-pct{font-size:.72rem;font-weight:800;white-space:nowrap;}

.btn-open{display:inline-flex;align-items:center;gap:.3rem;padding:.35rem .8rem;background:var(--p);color:#fff;border:none;border-radius:8px;font-size:.75rem;font-weight:700;font-family:var(--ff);cursor:pointer;text-decoration:none;}
.btn-open:hover{background:var(--p2);}
</style>
@endpush

<div class="col-span-full pl-wrap">

    {{-- Header --}}
    <div class="pg-hd">
        <div>
            <div class="eyebrow"><i class="mgc_location_line"></i> Planning</div>
            <h2>Pole GPS Planner</h2>
            <p>View and set GPS coordinates for all poles across every node and project.</p>
        </div>
    </div>

    {{-- Summary stats --}}
    @php
        $totalNodes  = $nodesByProject->flatten()->count();
        $totalPoles  = $poleCounts->sum('total');
        $withGps     = $poleCounts->sum('with_gps');
        $noGps       = $totalPoles - $withGps;
        $coverage    = $totalPoles > 0 ? round($withGps / $totalPoles * 100, 1) : 0;
    @endphp
    <div class="stat-strip">
        <div class="sc" style="--sc-accent:#2563eb">
            <div class="sc-lbl">Total Nodes</div>
            <div class="sc-val">{{ $totalNodes }}</div>
            <i class="mgc_node_line sc-icon"></i>
        </div>
        <div class="sc" style="--sc-accent:#64748b">
            <div class="sc-lbl">Total Poles</div>
            <div class="sc-val">{{ $totalPoles }}</div>
            <i class="mgc_vertical_align_top_line sc-icon"></i>
        </div>
        <div class="sc" style="--sc-accent:#16a34a">
            <div class="sc-lbl">With GPS</div>
            <div class="sc-val">{{ $withGps }}</div>
            <i class="mgc_location_line sc-icon"></i>
        </div>
        <div class="sc" style="--sc-accent:#d97706">
            <div class="sc-lbl">Missing GPS</div>
            <div class="sc-val">{{ $noGps }}</div>
            <i class="mgc_location_off_line sc-icon"></i>
        </div>
    </div>

    {{-- Project accordions --}}
    @php
        $colors = ['#2563eb','#7c3aed','#16a34a','#d97706','#dc2626','#0891b2','#be185d','#059669'];
    @endphp

    @forelse($projects as $proj)
        @php
            $projNodes = $nodesByProject->get($proj->id, collect());
            if ($projNodes->isEmpty()) continue;
            $projNodeIds = $projNodes->pluck('id');
            $projTotal   = $poleCounts->whereIn('node_id', $projNodeIds->all())->sum('total');
            $projGps     = $poleCounts->whereIn('node_id', $projNodeIds->all())->sum('with_gps');
            $projPct     = $projTotal > 0 ? round($projGps / $projTotal * 100) : 0;
            $color       = $colors[$loop->index % count($colors)];
        @endphp

        <div class="proj-block">
            {{-- Project header --}}
            <div class="proj-hd" onclick="toggleProj({{ $proj->id }})">
                <div class="proj-dot" style="background:{{ $color }};"></div>
                <div class="proj-name">{{ $proj->project_name }}</div>
                <div class="proj-meta">
                    <span class="chip chip-blue">{{ $projNodes->count() }} nodes</span>
                    <span class="chip chip-green">{{ $projGps }}/{{ $projTotal }} GPS</span>
                    <span class="chip" style="background:{{ $projPct>=100?'rgba(22,163,74,.1)':($projPct>50?'rgba(37,99,235,.08)':'rgba(217,119,6,.1)') }};color:{{ $projPct>=100?'#15803d':($projPct>50?'#1d4ed8':'#b45309') }};">
                        {{ $projPct }}%
                    </span>
                </div>
                <i class="mgc_down_line caret" id="caret-{{ $proj->id }}"></i>
            </div>

            {{-- Node rows (hidden by default) --}}
            <div id="proj-body-{{ $proj->id }}" style="display:none;">
                <table class="node-table">
                    @foreach($projNodes as $node)
                        @php
                            $pc = $poleCounts->get($node->id);
                            $tot = $pc ? (int)$pc->total : 0;
                            $gps = $pc ? (int)$pc->with_gps : 0;
                            $pct = $tot > 0 ? round($gps / $tot * 100) : 0;
                        @endphp
                        <tr>
                            <td style="width:120px;"><span class="td-id">{{ $node->node_id }}</span></td>
                            <td><span class="td-name">{{ $node->node_name ?? '—' }}</span></td>
                            <td><span class="td-loc">📍 {{ $node->city }}{{ $node->province ? ', '.$node->province : '' }}</span></td>
                            <td style="width:220px;">
                                <div class="gps-bar-wrap">
                                    <div class="gps-bar">
                                        <div class="gps-fill" style="width:{{ $pct }}%;background:{{ $pct>=100?'#16a34a':($pct>50?'#2563eb':'#d97706') }};"></div>
                                    </div>
                                    <span class="gps-pct" style="color:{{ $pct>=100?'#16a34a':($pct>50?'#2563eb':'#d97706') }};">
                                        {{ $gps }}/{{ $tot }}
                                    </span>
                                </div>
                            </td>
                            <td style="width:100px;text-align:right;">
                                <a href="{{ route('planner.node', $node) }}" class="btn-open">
                                    <i class="mgc_map_line"></i> Open
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @empty
        <div style="text-align:center;padding:4rem;color:var(--muted);font-size:.9rem;">
            <i class="mgc_location_line" style="font-size:2.5rem;display:block;margin-bottom:.5rem;"></i>
            No nodes found.
        </div>
    @endforelse

</div>

<script>
function toggleProj(id) {
    const body  = document.getElementById('proj-body-' + id);
    const caret = document.getElementById('caret-' + id);
    const hd    = caret.closest('.proj-hd');
    const open  = body.style.display === 'none';
    body.style.display  = open ? '' : 'none';
    caret.classList.toggle('open', open);
    hd.classList.toggle('open', open);
}
</script>

</x-layout>
