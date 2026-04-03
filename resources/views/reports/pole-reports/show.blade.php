<x-layout>

@push('styles')
<style>
:root{
    --paper:#ffffff;
    --ink:#1f2937;
    --muted:#6b7280;
    --line:#dbe3ee;
    --line-strong:#c8d3e1;
    --head:#183153;
    --head-soft:#31527f;
    --sb-green:#00704A;          /* starbucks-inspired green */
    --sb-green-soft:#d7efe7;
    --sb-green-line:#8fc9b4;
    --shadow:0 8px 24px rgba(15,23,42,.05);
}

html, body{
    background:#fff !important;
}

body{
    color:var(--ink);
    font-family:inherit;
}

*{
    box-sizing:border-box;
}

/* ── Wrapper ─────────────────────────────────────────────────────── */
.pr-show-wrap{
    padding:24px 24px 40px;
    background:#fff;
}

/* ── Top left action ─────────────────────────────────────────────── */
.pr-top-actions{
    display:flex;
    align-items:center;
    justify-content:flex-start;
    margin-bottom:18px;
}

.pr-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:.45rem;
    padding:.58rem 1rem;
    border-radius:10px;
    font-size:.8rem;
    font-weight:700;
    text-decoration:none;
    cursor:pointer;
    border:1px solid;
    transition:all .16s ease;
    white-space:nowrap;
    font-family:inherit;
}

.pr-btn-back{
    background:#fff;
    border-color:#d8e0eb;
    color:#334155;
}
.pr-btn-back:hover{
    background:#f8fafc;
    border-color:#c9d4e3;
}

.pr-btn-word{
    background:var(--head);
    border-color:var(--head);
    color:#fff;
}
.pr-btn-word:hover{
    background:#122844;
    border-color:#122844;
}

.pr-btn-print{
    background:var(--head-soft);
    border-color:var(--head-soft);
    color:#fff;
}
.pr-btn-print:hover{
    background:#29476f;
    border-color:#29476f;
}

/* ── Title row with export buttons ───────────────────────────────── */
.pr-title-row{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:16px;
    margin-bottom:16px;
}

.pr-title-left{
    min-width:0;
}

.pr-title-actions{
    display:flex;
    align-items:center;
    gap:10px;
    flex-wrap:wrap;
    justify-content:flex-end;
    padding-top:30px; /* para tumapat sa BGC row */
}

/* ── Page header ─────────────────────────────────────────────────── */
.pr-header-meta{
    margin-bottom:0;
}

.pr-eyebrow{
    display:inline-flex;
    align-items:center;
    gap:.5rem;
    padding:.34rem .72rem;
    border:1px solid #dde5ef;
    border-radius:999px;
    background:#fff;
    font-size:.64rem;
    font-weight:800;
    letter-spacing:.14em;
    text-transform:uppercase;
    color:#64748b;
    margin-bottom:.55rem;
    font-family:inherit;
}

.pr-page-title{
    font-size:1.55rem;
    font-weight:700;
    color:#132238;
    letter-spacing:-.02em;
    margin:0 0 .2rem;
    font-family:inherit;
}

.pr-page-sub{
    font-size:.84rem;
    color:#6b7280;
    margin:0;
    font-family:inherit;
}

/* ── Report wrapper ──────────────────────────────────────────────── */
.pr-doc{
    background:#fff;
    border:1px solid var(--line);
    border-radius:16px;
    overflow:hidden;
    box-shadow:var(--shadow);
}

/* ── Header table ────────────────────────────────────────────────── */
.pr-doc-header{
    width:100%;
    border-collapse:collapse;
}

.pr-doc-header td{
    padding:0;
    border:1px solid var(--line);
    vertical-align:middle;
    font-family:inherit;
}

.pr-doc-header .hdr-left{
    width:44%;
    background:linear-gradient(180deg, var(--head) 0%, #102744 100%);
    color:#fff;
    font-size:.93rem;
    font-weight:800;
    text-transform:uppercase;
    letter-spacing:.03em;
    text-align:center;
    padding:16px 18px;
}

.pr-doc-header .hdr-right{
    width:56%;
    background:#fff;
    color:var(--head);
    padding:16px 18px;
    text-align:left;
    font-size:.95rem;
    font-weight:800;
}

/* ── Table area ──────────────────────────────────────────────────── */
.pr-table-wrap{
    background:#fff;
    overflow-x:auto;
}

.pr-table{
    width:100%;
    border-collapse:collapse;
    table-layout:fixed;
    background:#fff;
}

.pr-table col.col-no{ width:82px; }
.pr-table col.col-tag{ width:120px; }
.pr-table col.col-photo{ width:205px; }   /* mas fit */
.pr-table col.col-just{ width:170px; }

.pr-table th{
    padding:11px 8px;
    border:1px solid var(--line-strong);
    background:#fff;
    color:#163150;
    font-size:.72rem;
    font-weight:800;
    text-align:center;
    letter-spacing:.10em;
    text-transform:uppercase;
    font-family:inherit;
}

.pr-table td{
    padding:3px;
    border:1px solid var(--line);
    text-align:center;
    vertical-align:top;
    font-size:.8rem;
    color:#334155;
    background:#fff;
    font-family:inherit;
}

/* ── Number / tag ────────────────────────────────────────────────── */
.pr-row-no{
    font-weight:800;
    font-size:1rem;
    color:#17304f;
    padding-top:18px !important;
}

.pr-pole-cell{
    padding-top:14px !important;
}

.pr-pole-code{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:56px;
    padding:8px 12px;
    border:1px solid #d8e1ec;
    border-radius:12px;
    background:#fff;
    font-size:.75rem;
    font-weight:800;
    color:#17304f;
    font-family:inherit;
    word-break:break-word;
}

/* ── Photo cells ─────────────────────────────────────────────────── */
.pr-photo-cell{
    padding:2px !important;
}

.pr-photo-box{
    background:#fff;
    border:1px solid var(--sb-green-line);
    border-radius:8px;
    padding:2px;              /* 2-3px lang */
    min-height:360px;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:none;
}

.pr-photo-cell img{
    width:auto;
    max-width:100%;
    height:350px;
    object-fit:contain;
    background:#fff;
    display:block;
    margin:0 auto;
    border-radius:6px;
    border:1px solid var(--sb-green-soft);
    padding:1px;
    cursor:pointer;
    transition:transform .12s ease, border-color .12s ease, box-shadow .12s ease;
    box-shadow:none;
}

.pr-photo-cell img:hover{
    transform:scale(1.01);
    border-color:var(--sb-green-line);
    box-shadow:0 8px 18px rgba(0,112,74,.08);
}

.pr-no-photo{
    width:100%;
    min-height:350px;
    display:flex;
    align-items:center;
    justify-content:center;
    border:1px dashed var(--sb-green-line);
    border-radius:6px;
    background:#fff;
    color:#7d9a91;
    font-size:.72rem;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.07em;
    font-family:inherit;
}

/* ── Justification ───────────────────────────────────────────────── */
.pr-justification-cell{
    padding:4px !important;
}

.pr-justification-box{
    min-height:360px;
    border:1px dashed #d6e0ec;
    border-radius:10px;
    background:#fff;
    padding:12px 10px;
    text-align:left;
    font-size:.76rem;
    line-height:1.55;
    color:#475569;
    word-break:break-word;
    font-family:inherit;
}

.pr-justification-empty{
    color:#94a3b8;
    font-style:italic;
}

/* ── Empty state ─────────────────────────────────────────────────── */
.pr-empty-state{
    text-align:center;
    padding:3rem 1rem;
    color:#94a3b8;
    background:#fff;
    font-family:inherit;
}

.pr-empty-state i{
    font-size:2.5rem;
    margin-bottom:.5rem;
    display:block;
}

/* ── Lightbox ────────────────────────────────────────────────────── */
#prLightbox{
    display:none;
    position:fixed;
    inset:0;
    z-index:9999;
    background:rgba(0,0,0,.88);
    align-items:center;
    justify-content:center;
    flex-direction:column;
    gap:.75rem;
    padding:20px;
}

#prLightbox.open{
    display:flex;
}

#prLightboxImg{
    max-width:94vw;
    max-height:84vh;
    border-radius:12px;
    object-fit:contain;
    background:#fff;
    padding:6px;
    box-shadow:0 18px 50px rgba(0,0,0,.45);
}

#prLightboxClose{
    position:absolute;
    top:14px;
    right:18px;
    background:rgba(255,255,255,.14);
    border:1px solid rgba(255,255,255,.22);
    color:#fff;
    border-radius:10px;
    padding:.38rem .8rem;
    font-size:.8rem;
    font-weight:800;
    cursor:pointer;
    transition:background .12s;
}

#prLightboxClose:hover{
    background:rgba(255,255,255,.24);
}

#prLightboxCaption{
    font-size:.8rem;
    color:#e5e7eb;
    font-weight:700;
    max-width:560px;
    text-align:center;
    font-family:inherit;
}

/* ── Responsive ──────────────────────────────────────────────────── */
@media (max-width: 1400px){
    .pr-table{
        min-width:1010px;
    }
}

@media (max-width: 1100px){
    .pr-title-row{
        flex-direction:column;
        align-items:flex-start;
    }

    .pr-title-actions{
        justify-content:flex-start;
        padding-top:0;
    }
}

@media (max-width: 768px){
    .pr-show-wrap{
        padding:16px 12px 28px;
    }

    .pr-page-title{
        font-size:1.35rem;
    }
}

/* ── Print ───────────────────────────────────────────────────────── */
@media print{
    html, body{
        background:#fff !important;
    }

    .no-print,
    #prLightbox{
        display:none !important;
    }

    .pr-show-wrap{
        padding:0 !important;
        background:#fff !important;
    }

    .pr-doc{
        border:none !important;
        box-shadow:none !important;
        border-radius:0 !important;
        background:#fff !important;
    }

    .pr-doc-header td,
    .pr-table th,
    .pr-table td{
        border:1px solid #c4cfdd !important;
        -webkit-print-color-adjust:exact;
        print-color-adjust:exact;
    }

    .pr-doc-header .hdr-left{
        background:#17304f !important;
        color:#fff !important;
    }

    .pr-doc-header .hdr-right,
    .pr-table th,
    .pr-table td,
    .pr-photo-box,
    .pr-justification-box,
    .pr-pole-code,
    .pr-no-photo{
        background:#fff !important;
        color:#17304f !important;
    }

    .pr-photo-box{
        min-height:250px !important;
        border-radius:8px !important;
        padding:2px !important;
        border:1px solid #7fb8a4 !important;
    }

    .pr-photo-cell img{
        width:auto !important;
        max-width:100% !important;
        height:230px !important;
        object-fit:contain !important;
        background:#fff !important;
        border-radius:6px !important;
        cursor:default !important;
        box-shadow:none !important;
        padding:1px !important;
        border:1px solid #d7efe7 !important;
    }

    .pr-photo-cell img:hover{
        transform:none !important;
        box-shadow:none !important;
    }

    .pr-no-photo{
        min-height:230px !important;
    }

    .pr-justification-box{
        min-height:250px !important;
        border-radius:8px !important;
    }

    .pr-table tbody tr{
        break-inside:avoid;
        page-break-inside:avoid;
    }

    @page{
        size:A4 landscape;
        margin:1cm;
    }
}
</style>
@endpush

<div class="col-span-full pr-show-wrap">

    <div class="pr-top-actions no-print">
        <a href="{{ route('reports.pole-reports.index') }}" class="pr-btn pr-btn-back">
            <i class="mgc_arrow_left_line"></i> All Nodes
        </a>
    </div>

    <div class="pr-title-row">
        <div class="pr-title-left">
            <div class="pr-header-meta">
                <div class="pr-eyebrow">Pole Report</div>
                <h2 class="pr-page-title">{{ $node->node_name ?: $node->node_id }}</h2>
                <p class="pr-page-sub">
                    {{ $node->node_id }}
                    @if($node->city || $node->province)
                        &middot; {{ collect([$node->city, $node->province])->filter()->join(', ') }}
                    @endif
                    @if($node->project)
                        &middot; {{ $node->project->project_name }}
                    @endif
                </p>
            </div>
        </div>

        <div class="pr-title-actions no-print">
            <a href="{{ route('reports.pole-reports.word', $node) }}" class="pr-btn pr-btn-word">
                <i class="mgc_file_word_line"></i> Export Word
            </a>

            <a href="{{ route('reports.pole-reports.pdf', $node) }}" target="_blank" class="pr-btn pr-btn-print">
                <i class="mgc_file_pdf_line"></i> Export PDF
            </a>
        </div>
    </div>

    <div class="pr-doc">
        <table class="pr-doc-header">
            <tr>
                <td class="hdr-left">POLE PICTURE BEFORE AND AFTER</td>
                <td class="hdr-right">
                    NODE ID: {{ $node->node_id }} &mdash; {{ $node->node_name }}
                </td>
            </tr>
        </table>

        @if($poleRows->isEmpty())
            <div class="pr-empty-state">
                <i class="mgc_picture_line"></i>
                <p>No pole photos found for this node yet.</p>
                <p style="font-size:.78rem;">Photos will appear here once field teams submit teardown logs.</p>
            </div>
        @else
            <div class="pr-table-wrap">
                <table class="pr-table">
                    <colgroup>
                        <col class="col-no">
                        <col class="col-tag">
                        <col class="col-photo">
                        <col class="col-photo">
                        <col class="col-photo">
                        <col class="col-just">
                    </colgroup>

                    <thead>
                        <tr>
                            <th>Picture #</th>
                            <th>Pole Tag</th>
                            <th>Before</th>
                            <th>After</th>
                            <th>Pole Pic</th>
                            <th>Justification</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($poleRows as $i => $row)
                        <tr>
                            <td class="pr-row-no">{{ $i + 1 }}</td>

                            <td class="pr-pole-cell">
                                <div class="pr-pole-code">{{ $row->pole->pole_code ?? '—' }}</div>
                            </td>

                            <td class="pr-photo-cell">
                                <div class="pr-photo-box">
                                    @if($row->before)
                                        <img
                                            src="{{ asset('storage/' . $row->before->image_path) }}"
                                            alt="Before"
                                            data-caption="BEFORE — {{ $row->pole->pole_code ?? 'N/A' }}"
                                            onclick="openLightbox(this)">
                                    @else
                                        <div class="pr-no-photo">No Photo</div>
                                    @endif
                                </div>
                            </td>

                            <td class="pr-photo-cell">
                                <div class="pr-photo-box">
                                    @if($row->after)
                                        <img
                                            src="{{ asset('storage/' . $row->after->image_path) }}"
                                            alt="After"
                                            data-caption="AFTER — {{ $row->pole->pole_code ?? 'N/A' }}"
                                            onclick="openLightbox(this)">
                                    @else
                                        <div class="pr-no-photo">No Photo</div>
                                    @endif
                                </div>
                            </td>

                            <td class="pr-photo-cell">
                                <div class="pr-photo-box">
                                    @if($row->pole_tag)
                                        <img
                                            src="{{ asset('storage/' . $row->pole_tag->image_path) }}"
                                            alt="Pole Tag"
                                            data-caption="POLE PIC — {{ $row->pole->pole_code ?? 'N/A' }}"
                                            onclick="openLightbox(this)">
                                    @else
                                        <div class="pr-no-photo">No Photo</div>
                                    @endif
                                </div>
                            </td>

                            <td class="pr-justification-cell">
                                <div class="pr-justification-box">
                                    @php
                                        $justification = data_get($row, 'justification');
                                    @endphp

                                    @if(filled($justification))
                                        {{ $justification }}
                                    @else
                                        <span class="pr-justification-empty">No justification provided.</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>

<div id="prLightbox" onclick="closeLightbox(event)">
    <button id="prLightboxClose" onclick="closeLightbox()">&#x2715; Close</button>
    <img id="prLightboxImg" src="" alt="">
    <div id="prLightboxCaption"></div>
</div>

@push('scripts')
<script>
function openLightbox(img) {
    document.getElementById('prLightboxImg').src = img.src;
    document.getElementById('prLightboxCaption').textContent = img.dataset.caption || '';
    document.getElementById('prLightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeLightbox(e) {
    if (e && e.target === document.getElementById('prLightboxImg')) return;
    document.getElementById('prLightbox').classList.remove('open');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLightbox();
});
</script>
@endpush

</x-layout>