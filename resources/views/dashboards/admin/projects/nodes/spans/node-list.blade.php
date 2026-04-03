<x-layout>

@push('styles')
<style>
:root{ --sans:"Instrument Sans","Plus Jakarta Sans","Manrope","Segoe UI",sans-serif; }
body{ font-family:var(--sans); }

.ds-wrap{ padding:1.25rem 1.25rem 3rem; }

.ds-top{
    display:flex;align-items:flex-end;justify-content:space-between;
    gap:1rem;margin-bottom:1.25rem;flex-wrap:wrap;
}
.ds-eyebrow{
    display:inline-flex;align-items:center;gap:.5rem;
    padding:.35rem .72rem;border:1px solid #eef2f6;border-radius:999px;
    background:rgba(255,255,255,.9);font-size:.66rem;font-weight:800;
    letter-spacing:.14em;text-transform:uppercase;color:#6b7280;
    margin-bottom:.6rem;
}
.ds-eyebrow::before{
    content:"";width:8px;height:8px;border-radius:50%;
    background:linear-gradient(135deg,#2563eb,#111827);
    box-shadow:0 0 0 4px rgba(37,99,235,.08);
}
.ds-title{ margin:0;font-size:clamp(1.5rem,2vw,2rem);font-weight:900;color:#111827;letter-spacing:-.04em; }
.ds-sub{ margin:.3rem 0 0;color:#6b7280;font-size:.9rem; }

.ds-search{
    width:100%;max-width:420px;box-sizing:border-box;
    background:#fff;border:1.5px solid #e5e7eb;border-radius:12px;
    color:#111827;font-size:.85rem;padding:.52rem .85rem;outline:none;
    font-family:var(--sans);box-shadow:0 1px 4px rgba(17,24,39,.05);
    transition:border-color .14s;margin-bottom:1rem;display:block;
}
.ds-search:focus{ border-color:#2563eb; }

.ds-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(290px,1fr));
    gap:.85rem;
}

.ds-card{
    background:#fff;border:1.5px solid #eef2f6;border-radius:20px;
    padding:1rem 1.15rem 1.05rem;
    box-shadow:0 2px 10px rgba(17,24,39,.05);
    text-decoration:none;color:inherit;display:block;
    transition:transform .16s,box-shadow .16s,border-color .16s;
}
.ds-card:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 28px rgba(17,24,39,.09);
    border-color:#bfdbfe;
}
.ds-card-id{
    font-size:.68rem;font-weight:800;color:#2563eb;
    letter-spacing:.08em;text-transform:uppercase;
    font-family:ui-monospace,monospace;
}
.ds-card-name{
    font-size:.92rem;font-weight:900;color:#111827;
    margin:.15rem 0 .18rem;line-height:1.25;
}
.ds-card-loc{ font-size:.7rem;color:#9ca3af;font-weight:600;margin-bottom:.7rem; }

.ds-card-chips{ display:flex;gap:.4rem;flex-wrap:wrap;align-items:center; }
.ds-chip{
    display:inline-flex;align-items:center;gap:.3rem;
    font-size:.67rem;font-weight:800;padding:.2rem .52rem;border-radius:7px;
}
.chip-blue  { background:#eef4ff;color:#1d4ed8; }
.chip-violet{ background:#f5f3ff;color:#6d28d9; }
.chip-gray  { background:#f4f4f5;color:#52525b; }

.ds-card-foot{
    display:flex;align-items:center;justify-content:space-between;
    margin-top:.75rem;padding-top:.65rem;border-top:1px solid #f1f4f8;
    font-size:.7rem;color:#9ca3af;font-weight:700;
}
.ds-arrow{ color:#c0c8d4;font-size:.9rem; }

.ds-empty{
    text-align:center;padding:4rem 1rem;color:#9ca3af;grid-column:1/-1;
    font-size:.88rem;
}
</style>
@endpush

<div class="col-span-full ds-wrap">

    <div class="ds-top">
        <div>
            <div class="ds-eyebrow">Span Management</div>
            <h2 class="ds-title">Declare Span</h2>
            <p class="ds-sub">Select a node to declare or manage its pole spans.</p>
        </div>
    </div>

    <input class="ds-search" id="dsSearch" type="text" placeholder="🔍  Search node ID, name, city, province, project…" autocomplete="off">

    <div class="ds-grid" id="dsGrid">
        @forelse($nodes as $node)
            @php
                $createUrl = route('admin.projects.nodes.spans.create', [
                    'project' => $node['project_id'],
                    'node'    => $node['id'],
                ]);
            @endphp
            <a class="ds-card"
               href="{{ $createUrl }}"
               data-search="{{ strtolower(implode(' ', array_filter([$node['node_id'], $node['node_name'], $node['city'], $node['province'], $node['project']]))) }}">

                <div class="ds-card-id">{{ $node['node_id'] ?? '—' }}</div>
                <div class="ds-card-name">{{ $node['node_name'] ?: ($node['node_id'] ?? '—') }}</div>
                <div class="ds-card-loc">
                    {{ implode(' · ', array_filter([$node['city'], $node['province'], $node['project']])) ?: '—' }}
                </div>

                <div class="ds-card-chips">
                    <span class="ds-chip chip-blue">
                        <i class="mgc_electricity_line"></i> {{ $node['poles_count'] }} poles
                    </span>
                    <span class="ds-chip chip-violet">
                        <i class="mgc_link_line"></i> {{ $node['spans_count'] }} spans
                    </span>
                    @if($node['status'])
                        <span class="ds-chip chip-gray">{{ ucfirst($node['status']) }}</span>
                    @endif
                </div>

                <div class="ds-card-foot">
                    <span>Click to declare spans</span>
                    <span class="ds-arrow"><i class="mgc_arrow_right_line"></i></span>
                </div>
            </a>
        @empty
            <div class="ds-empty">No nodes found.</div>
        @endforelse
    </div>

</div>

@push('scripts')
<script>
document.getElementById('dsSearch').addEventListener('input', function () {
    const q = this.value.toLowerCase().trim();
    document.querySelectorAll('.ds-card').forEach(card => {
        card.style.display = (!q || card.dataset.search.includes(q)) ? '' : 'none';
    });
    const visible = [...document.querySelectorAll('.ds-card')].filter(c => c.style.display !== 'none');
    const empty   = document.getElementById('dsEmpty');
    if (!visible.length && !document.getElementById('dsEmpty')) {
        const div = document.createElement('div');
        div.id = 'dsEmpty';
        div.className = 'ds-empty';
        div.textContent = 'No nodes match your search.';
        document.getElementById('dsGrid').appendChild(div);
    } else if (visible.length && document.getElementById('dsEmpty')) {
        document.getElementById('dsEmpty').remove();
    }
});
</script>
@endpush

</x-layout>
