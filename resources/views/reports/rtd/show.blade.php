<x-layout>

@push('styles')
<style>
:root{
    --sans:"Instrument Sans","Plus Jakarta Sans","Manrope","Segoe UI",sans-serif;
    --mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,monospace;
}
body{ font-family:var(--sans); }

.rtd-show-wrap{ padding:1.25rem 1.25rem 3rem; }

/* ── Actions ──────────────────────────────────────────────────────── */
.rtd-actions{
    display:flex;align-items:center;gap:.65rem;
    margin-bottom:1.25rem;flex-wrap:wrap;
}
.rtd-btn{
    display:inline-flex;align-items:center;gap:.4rem;
    padding:.48rem 1rem;border-radius:10px;font-size:.8rem;
    font-weight:800;text-decoration:none;cursor:pointer;
    border:1.5px solid;transition:all .15s ease;
}
.rtd-btn-back{ background:#fff;border-color:#e5e7eb;color:#374151; }
.rtd-btn-back:hover{ background:#f9fafb;border-color:#d1d5db;color:#111827; }
.rtd-btn-excel{ background:#1e7e45;border-color:#1e7e45;color:#fff; }
.rtd-btn-excel:hover{ background:#176338;border-color:#176338; }

/* ── Header meta ──────────────────────────────────────────────────── */
.rtd-header-meta{ margin-bottom:1rem; }
.rtd-eyebrow{
    display:inline-flex;align-items:center;gap:.5rem;
    padding:.3rem .7rem;border:1px solid #eef2f6;border-radius:999px;
    background:rgba(255,255,255,.9);font-size:.64rem;font-weight:800;
    letter-spacing:.14em;text-transform:uppercase;color:#6b7280;margin-bottom:.5rem;
}
.rtd-page-title{ font-size:1.35rem;font-weight:900;color:#111827;letter-spacing:-.03em;margin:0 0 .2rem; }
.rtd-page-sub{ font-size:.82rem;color:#6b7280;margin:0; }

/* ── Doc wrapper ──────────────────────────────────────────────────── */
.rtd-doc{
    background:#fff;border:1.5px solid #dde3ea;border-radius:16px;
    overflow:hidden;box-shadow:0 4px 22px rgba(17,24,39,.07);
}

/* ── Table ────────────────────────────────────────────────────────── */
.rtd-table{ width:100%;border-collapse:collapse; }
.rtd-table th{
    padding:10px 10px;border:1.5px solid #dde3ea;
    background:#1e3a5f;color:#fff;
    font-size:.72rem;font-weight:800;text-align:center;
    letter-spacing:.06em;text-transform:uppercase;
}
.rtd-table td{
    padding:9px 10px;border:1.5px solid #dde3ea;
    font-size:.8rem;color:#374151;vertical-align:middle;
}
.rtd-table tr:nth-child(even) td{ background:#f9fafb; }
.rtd-table tr:hover td{ background:#eef4ff; }

.td-num{ text-align:center;font-weight:800;color:#6366f1;width:52px; }
.td-pole{ font-family:var(--mono);font-size:.75rem;font-weight:700;color:#1e3a5f;width:110px; }
.td-loc{ font-size:.76rem;color:#4b5563; }
.td-date{ text-align:center;white-space:nowrap;width:110px; }
.td-remarks{ width:160px; }

/* ── Empty ────────────────────────────────────────────────────────── */
.rtd-empty{ text-align:center;padding:3rem 1rem;color:#9ca3af; }
.rtd-empty i{ font-size:2.5rem;margin-bottom:.5rem;display:block; }
</style>
@endpush

<div class="col-span-full rtd-show-wrap">

    {{-- Actions --}}
    <div class="rtd-actions">
        <a href="{{ route('reports.rtd.index') }}" class="rtd-btn rtd-btn-back">
            <i class="mgc_arrow_left_line"></i> All Nodes
        </a>
        <a href="{{ route('reports.rtd.excel', $node) }}" class="rtd-btn rtd-btn-excel">
            <i class="mgc_file_excel_line"></i> Export Excel
        </a>
    </div>

    {{-- Header meta --}}
    <div class="rtd-header-meta">
        <div class="rtd-eyebrow">RTD Report</div>
        <h2 class="rtd-page-title">{{ $node->node_name ?: $node->node_id }}</h2>
        <p class="rtd-page-sub">
            {{ $node->node_id }}
            @if($node->city || $node->province)
                &middot; {{ collect([$node->city, $node->province])->filter()->join(', ') }}
            @endif
            @if($node->project)
                &middot; {{ $node->project->project_name }}
            @endif
        </p>
    </div>

    {{-- Document --}}
    <div class="rtd-doc">
        @if($rows->isEmpty())
            <div class="rtd-empty">
                <i class="mgc_file_line"></i>
                <p>No teardown logs found for this node yet.</p>
            </div>
        @else
        <div style="overflow-x:auto;">
        <table class="rtd-table">
            <thead>
                <tr>
                    <th style="width:52px;">Item No.</th>
                    <th style="width:110px;">Pole Number</th>
                    <th>Location_Area</th>
                    <th style="width:100px;">Cable Position</th>
                    <th style="width:160px;">Detachment Date</th>
                    <th style="width:180px;">REMARKS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $i => $row)
                <tr>
                    <td class="td-num">{{ $i + 1 }}</td>
                    <td class="td-pole">{{ $row->pole_number }}</td>
                    <td class="td-loc">{{ $row->location }}</td>
                    <td class="td-date">{{ $row->cable_position }}</td>
                    <td class="td-date">{{ $row->detach_date }}</td>
                    <td class="td-remarks">{{ $row->remarks }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        @endif
    </div>

</div>

</x-layout>
