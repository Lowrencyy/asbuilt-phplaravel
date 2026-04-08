<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Vicinity Map — {{ $node->node_id }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/assets/libs/leaflet/leaflet.css"/>
  <style>
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    body{font-family:'Segoe UI',Arial,sans-serif;background:#f1f5f9;min-height:100vh;}

    /* ── Toolbar ── */
    .toolbar{
      position:fixed;top:0;left:0;right:0;z-index:9999;
      background:#1e293b;color:#fff;
      display:flex;align-items:center;gap:.6rem;
      padding:.55rem 1.1rem;box-shadow:0 2px 12px rgba(0,0,0,.25);
    }
    .toolbar-title{font-size:.85rem;font-weight:700;flex:1;}
    .toolbar-title span{font-size:.72rem;font-weight:400;color:#94a3b8;margin-left:.5rem;}
    .tb-btn{
      display:inline-flex;align-items:center;gap:.4rem;
      padding:.38rem .85rem;border:none;border-radius:7px;
      font-size:.78rem;font-weight:700;cursor:pointer;
      transition:opacity .15s,transform .12s;white-space:nowrap;
    }
    .tb-btn:hover{opacity:.88;transform:translateY(-1px);}
    .tb-btn:disabled{opacity:.45;cursor:not-allowed;transform:none;}
    .tb-img {background:#0ea5e9;color:#fff;}
    .tb-pdf {background:#ef4444;color:#fff;}
    .tb-word{background:#2563eb;color:#fff;}
    .tb-back{background:rgba(255,255,255,.1);color:#fff;border:1px solid rgba(255,255,255,.18);}
    .tb-sep{width:1px;height:22px;background:rgba(255,255,255,.12);margin:0 .15rem;}

    /* ── Page wrapper ── */
    .page-wrap{
      padding:72px 1.5rem 2rem;
      display:flex;justify-content:center;
    }

    /* ── Print area (what gets captured/exported) ── */
    #printArea{
      background:#fff;
      width:860px;
      border-radius:6px;
      box-shadow:0 4px 32px rgba(0,0,0,.13);
      overflow:hidden;
    }

    /* ── Map header ── */
    .vm-header{
      text-align:center;
      padding:1rem 1rem .75rem;
      border-bottom:1px solid #e2e8f0;
    }
    .vm-header .vm-title{
      font-size:1.05rem;font-weight:900;
      letter-spacing:.12em;text-transform:uppercase;
      color:#0f172a;
    }
    .vm-header .vm-sub{
      font-size:.82rem;color:#475569;margin-top:.18rem;
      font-weight:600;
    }

    /* ── Map container ── */
    #vicinityMap{
      width:100%;
      height:560px;
      display:block;
    }

    /* ── Map footer ── */
    .vm-footer{
      padding:.55rem 1rem;
      display:flex;align-items:center;justify-content:space-between;
      border-top:1px solid #e2e8f0;
      font-size:.7rem;color:#64748b;
    }

    /* ── No GPS notice ── */
    .no-gps-notice{
      display:flex;flex-direction:column;align-items:center;justify-content:center;
      height:560px;gap:.6rem;color:#64748b;font-size:.9rem;
    }
    .no-gps-notice i-svg{font-size:2.5rem;display:block;margin-bottom:.4rem;}

    /* ── Loading overlay ── */
    #loadingOverlay{
      position:fixed;inset:0;z-index:99999;
      background:rgba(15,23,42,.72);
      display:flex;flex-direction:column;align-items:center;justify-content:center;
      gap:1rem;color:#fff;font-size:.9rem;font-weight:600;
    }
    .spinner{
      width:36px;height:36px;border:3px solid rgba(255,255,255,.2);
      border-top-color:#fff;border-radius:50%;
      animation:spin .7s linear infinite;
    }
    @keyframes spin{to{transform:rotate(360deg);}}

    @media print{
      .toolbar,.no-print{display:none!important;}
      body{background:#fff;}
      .page-wrap{padding:0;}
      #printArea{box-shadow:none;border-radius:0;width:100%;}
    }
  </style>
</head>
<body>

<!-- Loading overlay (shown during export) -->
<div id="loadingOverlay" style="display:none;">
  <div class="spinner"></div>
  <span id="loadingMsg">Preparing export…</span>
</div>

<!-- Toolbar -->
<div class="toolbar no-print">
  <div class="toolbar-title">
    Vicinity Map
    <span>{{ $node->node_id }}{{ $node->node_name ? ' — '.$node->node_name : '' }}</span>
  </div>
  <button class="tb-btn tb-back" onclick="window.close()">← Close</button>
  <div class="tb-sep"></div>
  <button class="tb-btn tb-img"  id="btnImg" >⬇ Image (PNG)</button>
  <button class="tb-btn tb-pdf"  id="btnPdf" >⬇ PDF</button>
  <button class="tb-btn tb-word" id="btnWord">⬇ Word (.doc)</button>
</div>

<!-- Print / Export Area -->
<div class="page-wrap">
  <div id="printArea">

    <div class="vm-header">
      <div class="vm-title">Vicinity Map</div>
      <div class="vm-sub">
        {{ $node->node_id }}{{ $node->node_name ? ' — '.$node->node_name : '' }}
        @if($node->province || $node->city)
          &nbsp;·&nbsp; {{ implode(', ', array_filter([$node->city, $node->province])) }}
        @endif
      </div>
    </div>

    @if($poles->isEmpty())
      <div class="no-gps-notice">
        <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="#94a3b8" stroke-width="1.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
        </svg>
        <div>No poles with GPS coordinates found for this node.</div>
        <div style="font-size:.78rem;color:#94a3b8;">Add GPS coordinates to poles first to generate the vicinity map.</div>
      </div>
    @else
      <div id="vicinityMap"></div>
    @endif

    <div class="vm-footer">
      <span>{{ $poles->count() }} pole(s) plotted</span>
      <span>Project: {{ $project->project_name ?? $project->name ?? '—' }}</span>
      <span>Generated: {{ now()->format('M d, Y') }}</span>
    </div>

  </div>
</div>

@if($poles->isNotEmpty())
<script src="/assets/libs/leaflet/leaflet.js"></script>
@endif
<!-- html2canvas & jsPDF from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
(function(){
  const POLES = @json($poles->map(fn($p) => [
    'id'     => $p->id,
    'code'   => $p->pole_name ?: $p->pole_code,
    'lat'    => (float)$p->map_latitude,
    'lng'    => (float)$p->map_longitude,
    'status' => $p->status,
  ]));

  const NODE_LABEL = "{{ addslashes(($node->node_id ?? '') . ($node->node_name ? ' — '.$node->node_name : '')) }}";

  // ── Build Leaflet map ──────────────────────────────────────────────────────
  if (POLES.length && document.getElementById('vicinityMap')) {
    const map = L.map('vicinityMap', { zoomControl: true, attributionControl: true });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors',
      maxZoom: 20,
      crossOrigin: true,
    }).addTo(map);

    // Red Google-Maps-style drop pin
    function redPin(label) {
      return L.divIcon({
        className: '',
        html: `<div style="position:relative;width:24px;height:36px;">
          <svg width="24" height="36" viewBox="0 0 24 36" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 0C5.373 0 0 5.373 0 12c0 9 12 24 12 24S24 21 24 12C24 5.373 18.627 0 12 0z" fill="#e53935"/>
            <circle cx="12" cy="11" r="5" fill="white"/>
          </svg>
          <div style="position:absolute;top:-20px;left:50%;transform:translateX(-50%);background:rgba(0,0,0,.72);color:#fff;font-size:9px;font-weight:700;padding:1px 4px;border-radius:3px;white-space:nowrap;">${label}</div>
        </div>`,
        iconSize: [24, 36],
        iconAnchor: [12, 36],
        popupAnchor: [0, -38],
      });
    }

    const latLngs = POLES.map(p => [p.lat, p.lng]);

    // Plot markers
    POLES.forEach(p => {
      L.marker([p.lat, p.lng], { icon: redPin(p.code) })
        .addTo(map)
        .bindPopup(`<b>${p.code}</b><br>Status: ${p.status}`);
    });

    // Fit map to poles bounds
    const bounds = L.latLngBounds(latLngs);
    map.fitBounds(bounds, { padding: [50, 50] });

    // Black bounding rectangle around poles
    map.on('load moveend zoomend', drawRect);
    function drawRect() {}  // Rectangle is static on the data bounds

    const rect = L.rectangle(bounds, {
      color: '#000000',
      weight: 2.5,
      fill: false,
      dashArray: null,
    }).addTo(map);
  }

  // ── Export helpers ─────────────────────────────────────────────────────────
  function showLoading(msg) {
    document.getElementById('loadingMsg').textContent = msg || 'Preparing export…';
    document.getElementById('loadingOverlay').style.display = 'flex';
    ['btnImg','btnPdf','btnWord'].forEach(id => {
      const el = document.getElementById(id);
      if (el) el.disabled = true;
    });
  }

  function hideLoading() {
    document.getElementById('loadingOverlay').style.display = 'none';
    ['btnImg','btnPdf','btnWord'].forEach(id => {
      const el = document.getElementById(id);
      if (el) el.disabled = false;
    });
  }

  function captureArea() {
    const el = document.getElementById('printArea');
    return html2canvas(el, {
      allowTaint: true,
      useCORS: true,
      scale: 2,
      backgroundColor: '#ffffff',
      logging: false,
    });
  }

  function filename(ext) {
    return `vicinity-map-{{ $node->node_id }}-{{ now()->format('Ymd') }}.${ext}`;
  }

  // Image export
  document.getElementById('btnImg').addEventListener('click', async () => {
    showLoading('Capturing map…');
    try {
      const canvas = await captureArea();
      const link = document.createElement('a');
      link.download = filename('png');
      link.href = canvas.toDataURL('image/png');
      link.click();
    } catch(e) { alert('Export failed: ' + e.message); }
    finally { hideLoading(); }
  });

  // PDF export
  document.getElementById('btnPdf').addEventListener('click', async () => {
    showLoading('Generating PDF…');
    try {
      const canvas = await captureArea();
      const imgData = canvas.toDataURL('image/png');
      const { jsPDF } = window.jspdf;
      const pdf = new jsPDF({ orientation: 'landscape', unit: 'mm', format: 'a4' });
      const pdfW = pdf.internal.pageSize.getWidth();
      const pdfH = pdf.internal.pageSize.getHeight();
      const ratio = Math.min(pdfW / canvas.width, pdfH / canvas.height);
      const imgW = canvas.width * ratio;
      const imgH = canvas.height * ratio;
      const x = (pdfW - imgW) / 2;
      const y = (pdfH - imgH) / 2;
      pdf.addImage(imgData, 'PNG', x, y, imgW, imgH);
      pdf.save(filename('pdf'));
    } catch(e) { alert('Export failed: ' + e.message); }
    finally { hideLoading(); }
  });

  // Word (.doc) export — embeds map image into Word-compatible HTML
  document.getElementById('btnWord').addEventListener('click', async () => {
    showLoading('Generating Word document…');
    try {
      const canvas = await captureArea();
      const base64 = canvas.toDataURL('image/png');
      const html = `<html xmlns:o='urn:schemas-microsoft-com:office:office'
        xmlns:w='urn:schemas-microsoft-com:office:word'
        xmlns='http://www.w3.org/TR/REC-html40'>
        <head>
          <meta charset='utf-8'>
          <title>Vicinity Map</title>
          <style>
            body { font-family: Arial, sans-serif; margin: 1cm; }
            h2 { text-align: center; font-size: 16pt; letter-spacing: 2px; margin-bottom: 4pt; }
            p.sub { text-align: center; font-size: 10pt; color: #444; margin-bottom: 12pt; }
            .map-img { display: block; margin: 0 auto; max-width: 100%; border: 1px solid #ccc; }
            .footer { margin-top: 8pt; font-size: 8pt; color: #666; display: flex; justify-content: space-between; }
          </style>
        </head>
        <body>
          <h2>VICINITY MAP</h2>
          <p class='sub'>${NODE_LABEL}</p>
          <img class='map-img' src='${base64}'/>
          <div class='footer'>
            <span>${POLES.length} pole(s) plotted</span>
            <span>Generated: {{ now()->format('F d, Y') }}</span>
          </div>
        </body>
      </html>`;
      const blob = new Blob(['\ufeff', html], { type: 'application/msword' });
      const link = document.createElement('a');
      link.href = URL.createObjectURL(blob);
      link.download = filename('doc');
      link.click();
      setTimeout(() => URL.revokeObjectURL(link.href), 5000);
    } catch(e) { alert('Export failed: ' + e.message); }
    finally { hideLoading(); }
  });

})();
</script>
</body>
</html>
