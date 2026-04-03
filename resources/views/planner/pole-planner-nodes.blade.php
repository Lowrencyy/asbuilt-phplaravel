<x-layout>

@push('styles')
<style>
:root{ --sans:"Instrument Sans","Plus Jakarta Sans","Manrope","Segoe UI",sans-serif; }
body{ font-family:var(--sans); }
.pp-wrap{ padding:1.25rem 1.25rem 3rem; }
.pp-top{ display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;margin-bottom:1.25rem;flex-wrap:wrap; }
.pp-eyebrow{ display:inline-flex;align-items:center;gap:.5rem;padding:.35rem .72rem;border:1px solid #eef2f6;border-radius:999px;background:rgba(255,255,255,.9);font-size:.66rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:#6b7280;margin-bottom:.6rem; }
.pp-eyebrow::before{ content:"";width:8px;height:8px;border-radius:50%;background:linear-gradient(135deg,#7c3aed,#2563eb);box-shadow:0 0 0 4px rgba(124,58,237,.1); }
.pp-title{ margin:0;font-size:clamp(1.5rem,2vw,2rem);font-weight:900;color:#111827;letter-spacing:-.04em; }
.pp-sub{ margin:.3rem 0 0;color:#6b7280;font-size:.9rem; }
.pp-search{ width:100%;max-width:420px;box-sizing:border-box;background:#fff;border:1.5px solid #e5e7eb;border-radius:12px;color:#111827;font-size:.85rem;padding:.52rem .85rem;outline:none;font-family:var(--sans);box-shadow:0 1px 4px rgba(17,24,39,.05);transition:border-color .14s;margin-bottom:1rem;display:block; }
.pp-search:focus{ border-color:#7c3aed; }
.pp-grid{ display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:.85rem; }
.pp-card{ background:#fff;border:1.5px solid #eef2f6;border-radius:20px;padding:1rem 1.15rem 1.05rem;box-shadow:0 2px 10px rgba(17,24,39,.05);text-decoration:none;color:inherit;display:block;transition:transform .16s,box-shadow .16s,border-color .16s; }
.pp-card:hover{ transform:translateY(-2px);box-shadow:0 10px 28px rgba(17,24,39,.09);border-color:#ddd6fe; }
.pp-card-id{ font-size:.68rem;font-weight:800;color:#7c3aed;letter-spacing:.08em;text-transform:uppercase;font-family:ui-monospace,monospace; }
.pp-card-name{ font-size:.92rem;font-weight:900;color:#111827;margin:.15rem 0 .18rem;line-height:1.25; }
.pp-card-loc{ font-size:.7rem;color:#9ca3af;font-weight:600;margin-bottom:.7rem; }
.pp-chips{ display:flex;gap:.4rem;flex-wrap:wrap;align-items:center; }
.pp-chip{ display:inline-flex;align-items:center;gap:.3rem;font-size:.67rem;font-weight:800;padding:.2rem .52rem;border-radius:7px; }
.chip-violet{ background:#f5f3ff;color:#6d28d9; }
.chip-blue  { background:#eef4ff;color:#1d4ed8; }
.chip-gray  { background:#f4f4f5;color:#52525b; }
.pp-foot{ display:flex;align-items:center;justify-content:space-between;margin-top:.75rem;padding-top:.65rem;border-top:1px solid #f1f4f8;font-size:.7rem;color:#9ca3af;font-weight:700; }
.pp-arrow{ color:#c0c8d4;font-size:.9rem; }
.pp-empty{ text-align:center;padding:4rem 1rem;color:#9ca3af;grid-column:1/-1;font-size:.88rem; }
</style>
@endpush

<div class="col-span-full pp-wrap">
    <div class="pp-top">
        <div>
            <div class="pp-eyebrow">Daily Planning</div>
            <h2 class="pp-title">Pole Planner</h2>
            <p class="pp-sub">Select a node to assign the day's pole work sequence for linemen.</p>
        </div>
    </div>

    <input class="pp-search" id="ppSearch" type="text" placeholder="🔍  Search node, city, province, project…" autocomplete="off">

    <div class="pp-grid" id="ppGrid">
        @forelse($nodes as $node)
            <a class="pp-card"
               href="{{ route('admin.pole-planner.show', $node['id']) }}"
               data-search="{{ strtolower(implode(' ', array_filter([$node['node_id'], $node['node_name'], $node['city'], $node['province'], $node['project']]))) }}">
                <div class="pp-card-id">{{ $node['node_id'] ?? '—' }}</div>
                <div class="pp-card-name">{{ $node['node_name'] ?: ($node['node_id'] ?? '—') }}</div>
                <div class="pp-card-loc">{{ implode(' · ', array_filter([$node['city'], $node['province'], $node['project']])) ?: '—' }}</div>
                <div class="pp-chips">
                    <span class="pp-chip chip-violet"><i class="mgc_electricity_line"></i> {{ $node['poles_count'] }} poles</span>
                    <span class="pp-chip chip-blue"><i class="mgc_link_line"></i> {{ $node['spans_count'] }} spans</span>
                    @if($node['status'])
                        <span class="pp-chip chip-gray">{{ ucfirst($node['status']) }}</span>
                    @endif
                </div>
                <div class="pp-foot">
                    <span>Plan today's sequence</span>
                    <span class="pp-arrow"><i class="mgc_arrow_right_line"></i></span>
                </div>
            </a>
        @empty
            <div class="pp-empty">No nodes found.</div>
        @endforelse
    </div>
</div>

@push('scripts')
<script>
document.getElementById('ppSearch').addEventListener('input', function() {
    const q = this.value.toLowerCase().trim();
    document.querySelectorAll('.pp-card').forEach(c => {
        c.style.display = (!q || c.dataset.search.includes(q)) ? '' : 'none';
    });
});
</script>
@endpush

</x-layout>
