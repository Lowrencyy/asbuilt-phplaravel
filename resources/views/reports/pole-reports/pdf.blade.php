<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Generating PDF…</title>
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

body{
    font-family:"Segoe UI","Helvetica Neue",Arial,sans-serif;
    font-size:11px;
    background:#fff;
    color:#111827;
}

:root{
    --line:#cfd8e3;
    --line-strong:#bcc8d6;
    --head:#183153;
    --sb-green:#00704A;
    --sb-green-line:#8fc9b4;
    --sb-green-soft:#dff2eb;
}

/* ── Header table ──────────────────────────────────────────── */
.doc-header{
    width:100%;
    border-collapse:collapse;
    margin-bottom:6px;
}
.doc-header td{
    border:1px solid var(--line-strong);
    padding:10px 12px;
    font-size:11.5px;
    font-weight:800;
    text-align:center;
    vertical-align:middle;
}
.hdr-left{
    background:var(--head);
    color:#fff;
    width:44%;
    text-transform:uppercase;
    letter-spacing:.03em;
}
.hdr-right{
    background:#fff;
    color:var(--head);
    width:56%;
    text-align:left;
    font-size:12px;
}

/* ── Data table ─────────────────────────────────────────────── */
.data-table{
    width:100%;
    border-collapse:collapse;
    table-layout:fixed;
}

.data-table th{
    border:1px solid var(--line-strong);
    padding:6px 4px;
    background:#fff;
    color:#17304f;
    font-size:9.5px;
    font-weight:800;
    text-align:center;
    letter-spacing:.05em;
    text-transform:uppercase;
}

.data-table td{
    border:1px solid var(--line);
    padding:2px;
    text-align:center;
    vertical-align:top;
    background:#fff;
}

.col-num  { width:34px; }
.col-code { width:72px; }
.col-img  { width:148px; }
.col-just { width:150px; }

.num-cell{
    font-size:11px;
    font-weight:800;
    color:#17304f;
    padding-top:10px !important;
}

.code-cell{
    font-size:10px;
    font-weight:800;
    color:#17304f;
    padding-top:9px !important;
    word-break:break-word;
}

/* ── Photo card ─────────────────────────────────────────────── */
.photo-cell{
    padding:2px !important;
}

.photo-card{
    background:#fff;
    border:1px solid var(--sb-green-line);
    border-radius:6px;
    padding:2px;              /* 2px lang */
    min-height:192px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.photo-card img{
    width:auto;               /* para hindi makapal left/right */
    max-width:100%;
    height:182px;
    object-fit:contain;
    background:#fff;
    display:block;
    margin:0 auto;
    border:1px solid var(--sb-green-soft);
    border-radius:4px;
    padding:1px;
}

.no-photo{
    width:100%;
    min-height:182px;
    display:flex;
    align-items:center;
    justify-content:center;
    border:1px dashed var(--sb-green-line);
    border-radius:4px;
    background:#fff;
    color:#7d9a91;
    font-size:9px;
    font-style:italic;
}

/* ── Justification ──────────────────────────────────────────── */
.just-box{
    min-height:192px;
    border:1px dashed #d7e0ea;
    border-radius:6px;
    background:#fff;
    padding:8px 7px;
    text-align:left;
    font-size:9.5px;
    line-height:1.45;
    color:#475569;
    word-break:break-word;
}
.just-empty{
    color:#94a3b8;
    font-style:italic;
}

.gen-date{
    font-size:8.5px;
    color:#64748b;
    text-align:right;
    margin-bottom:6px;
}
</style>
</head>
<body>

{{-- ─── Overlay shown while generating ─────────────────────── --}}
<div id="genOverlay" style="
    position:fixed;inset:0;background:#fff;z-index:9999;
    display:flex;flex-direction:column;align-items:center;justify-content:center;
    font-family:Arial,sans-serif;gap:14px;">
    <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
         style="animation:spin 1s linear infinite;">
        <circle cx="22" cy="22" r="18" stroke="#e5e7eb" stroke-width="4"/>
        <path d="M22 4a18 18 0 0 1 18 18" stroke="#183153" stroke-width="4" stroke-linecap="round"/>
    </svg>
    <div style="font-size:15px;font-weight:700;color:#183153;">Generating PDF…</div>
    <div id="genNote" style="font-size:12px;color:#6b7280;">Loading images, please wait.</div>
</div>

<style>
@keyframes spin { to { transform:rotate(360deg); } }
</style>

{{-- ─── Actual printable content ───────────────────────────── --}}
<div id="pdfContent" style="width:760px;padding:14px 16px;background:#fff;">

    <div class="gen-date">Generated: {{ now()->format('F d, Y') }}</div>

    <table class="doc-header">
        <tr>
            <td class="hdr-left">POLE PICTURE BEFORE AND AFTER</td>
            <td class="hdr-right">NODE ID: {{ $node->node_id }} &mdash; {{ $node->node_name }}</td>
        </tr>
    </table>

    @if($poleRows->isEmpty())
        <p style="padding:20px;text-align:center;color:#94a3b8;">No pole photos found for this node.</p>
    @else
    <table class="data-table">
        <thead>
            <tr>
                <th class="col-num">PIC #</th>
                <th class="col-code">POLE TAG</th>
                <th class="col-img">BEFORE</th>
                <th class="col-img">AFTER</th>
                <th class="col-img">POLE PIC</th>
                <th class="col-just">JUSTIFICATION</th>
            </tr>
        </thead>
        <tbody>
            @foreach($poleRows as $i => $row)
            <tr>
                <td class="num-cell">{{ $i + 1 }}</td>

                <td class="code-cell">
                    {{ $row->pole->pole_code ?? '—' }}
                </td>

                <td class="photo-cell">
                    <div class="photo-card">
                        @if($row->before)
                            <img
                                src="{{ asset('storage/' . $row->before->image_path) }}"
                                crossorigin="anonymous"
                                alt="Before">
                        @else
                            <div class="no-photo">No photo</div>
                        @endif
                    </div>
                </td>

                <td class="photo-cell">
                    <div class="photo-card">
                        @if($row->after)
                            <img
                                src="{{ asset('storage/' . $row->after->image_path) }}"
                                crossorigin="anonymous"
                                alt="After">
                        @else
                            <div class="no-photo">No photo</div>
                        @endif
                    </div>
                </td>

                <td class="photo-cell">
                    <div class="photo-card">
                        @if($row->pole_tag)
                            <img
                                src="{{ asset('storage/' . $row->pole_tag->image_path) }}"
                                crossorigin="anonymous"
                                alt="Pole Tag">
                        @else
                            <div class="no-photo">No photo</div>
                        @endif
                    </div>
                </td>

                <td>
                    <div class="just-box">
                        @php
                            $justification = data_get($row, 'justification');
                        @endphp

                        @if(filled($justification))
                            {{ $justification }}
                        @else
                            <span class="just-empty">No justification provided.</span>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

</div><!-- #pdfContent -->

{{-- ─── jsPDF + html2canvas ─────────────────────────────────── --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
(async function () {
    const nodeId   = @json($node->node_id);
    const date     = @json(now()->format('Y-m-d'));
    const filename = `pole_reports_${nodeId}_${date}.pdf`;

    const imgs = Array.from(document.querySelectorAll('#pdfContent img'));
    document.getElementById('genNote').textContent = `Loading ${imgs.length} image(s)…`;

    await Promise.all(imgs.map(img =>
        img.complete
            ? Promise.resolve()
            : new Promise(res => { img.onload = res; img.onerror = res; })
    ));

    document.getElementById('genNote').textContent = 'Rendering…';

    const canvas = await html2canvas(document.getElementById('pdfContent'), {
        scale: 2,
        useCORS: true,
        allowTaint: false,
        logging: false,
        backgroundColor: '#ffffff',
    });

    const { jsPDF } = window.jspdf;
    const pgW = 297;
    const pgH = 210;

    const pdf = new jsPDF({
        orientation: 'landscape',
        unit: 'mm',
        format: 'a4'
    });

    const pageHeightPx = canvas.width * (pgH / pgW);
    let yPx = 0;

    while (yPx < canvas.height) {
        if (yPx > 0) pdf.addPage();

        const sliceH = Math.min(pageHeightPx, canvas.height - yPx);
        const sliceCv = document.createElement('canvas');
        sliceCv.width = canvas.width;
        sliceCv.height = sliceH;

        sliceCv.getContext('2d').drawImage(
            canvas,
            0, yPx, canvas.width, sliceH,
            0, 0, canvas.width, sliceH
        );

        const sliceData = sliceCv.toDataURL('image/jpeg', 0.92);
        const sliceH_mm = sliceH / canvas.width * pgW;
        pdf.addImage(sliceData, 'JPEG', 0, 0, pgW, sliceH_mm);

        yPx += pageHeightPx;
    }

    pdf.save(filename);

    document.getElementById('genOverlay').style.display = 'none';
    setTimeout(() => window.close(), 400);
})();
</script>
</body>
</html>