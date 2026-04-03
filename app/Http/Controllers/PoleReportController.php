<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\Project;
use App\Models\TeardownLogImage;

class PoleReportController extends Controller
{
    /**
     * List all nodes grouped by project with pole/completed counts.
     */
    public function index()
    {
        $projects = Project::with(['nodes' => function ($q) {
            $q->withCount('poles');
        }])->orderBy('project_name')->get();

        // Compute completed_pole_count per node (poles with images stored under the node's own folder)
        $allNodes    = $projects->flatMap(fn ($p) => $p->nodes)->keyBy('id');
        $allNodeIds  = $allNodes->keys()->all();

        $completedByNode = [];
        if (! empty($allNodeIds)) {
            $rows = \Illuminate\Support\Facades\DB::table('teardown_log_images')
                ->join('poles', 'teardown_log_images.pole_id', '=', 'poles.id')
                ->join('teardown_logs', 'teardown_log_images.teardown_log_id', '=', 'teardown_logs.id')
                ->whereIn('poles.node_id', $allNodeIds)
                ->whereColumn('teardown_logs.node_id', 'poles.node_id')
                ->select('poles.node_id', 'poles.id as pole_id',
                         \Illuminate\Support\Facades\DB::raw("teardown_log_images.image_path"))
                ->distinct()
                ->get();

            foreach ($rows as $row) {
                $node   = $allNodes->get($row->node_id);
                $nodeId = $node?->node_id ?? '';
                // Only count images stored under this node's own folder
                if (! $nodeId || ! str_contains($row->image_path, '/' . $nodeId . '/')) {
                    continue;
                }
                $completedByNode[$row->node_id] = ($completedByNode[$row->node_id] ?? 0) + 1;
            }

            // Deduplicate: count distinct poles, not images
            // Re-aggregate per pole (above counted per image, deduplicate by pole)
            $poleCountByNode = [];
            foreach ($rows as $row) {
                $node   = $allNodes->get($row->node_id);
                $nodeId = $node?->node_id ?? '';
                if (! $nodeId || ! str_contains($row->image_path, '/' . $nodeId . '/')) {
                    continue;
                }
                $poleCountByNode[$row->node_id][$row->pole_id] = true;
            }
            $completedByNode = [];
            foreach ($poleCountByNode as $nid => $poles) {
                $completedByNode[$nid] = count($poles);
            }
        }

        return view('reports.pole-reports.index', compact('projects', 'completedByNode'));
    }

    /**
     * Show pole photos report for a single node.
     */
    public function show(Node $node)
    {
        $node->load('project');
        $poleRows = $this->buildPoleRows($node);
        return view('reports.pole-reports.show', compact('node', 'poleRows'));
    }

    /**
     * Export as a Word-compatible HTML document (.doc).
     */
    public function exportWord(Node $node)
    {
        $node->load('project');
        $poleRows = $this->buildPoleRows($node);

        $date     = now()->format('Y-m-d');
        $nodeId   = $node->node_id;
        $filename = "pole_reports_{$nodeId}_{$date}.doc";

        $html = $this->buildWordHtml($node, $poleRows);

        return response($html, 200, [
            'Content-Type'        => 'application/vnd.ms-word',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    /**
     * Render a print/PDF-optimised page (no layout chrome).
     */
    public function exportPdf(Node $node)
    {
        $node->load('project');
        $poleRows = $this->buildPoleRows($node);
        return view('reports.pole-reports.pdf', compact('node', 'poleRows'));
    }

    /**
     * Normalize photo_type to one of: before | after | tag
     * DB stores: from_before, from_after, from_tag, to_before, to_after, to_tag, before_span …
     */
    private function normalizePhotoType(string $type): ?string
    {
        if (str_contains($type, 'before')) return 'before';
        if (str_contains($type, 'after'))  return 'after';
        if (str_contains($type, 'tag'))    return 'tag';
        return null;
    }

    /**
     * Build poleRows for both show() and exportWord().
     * Only includes poles that belong to this node.
     */
    private function buildPoleRows(Node $node): \Illuminate\Support\Collection
    {
        // All images for teardown logs belonging to this node,
        // and whose storage path is under this node's folder (e.g. …/BGC-225/…)
        $allImages = TeardownLogImage::whereHas('teardownLog', fn ($q) => $q->where('node_id', $node->id))
            ->where('image_path', 'like', '%/' . $node->node_id . '/%')
            ->get();

        if ($allImages->isEmpty()) {
            return collect();
        }

        // Build grouped PHP array: int pole_id => ['before'|'after'|'tag' => img|null]
        $grouped = [];
        foreach ($allImages as $img) {
            $pid  = (int) $img->pole_id;
            $norm = $this->normalizePhotoType($img->photo_type);
            if (! $norm) continue;
            if (! isset($grouped[$pid])) {
                $grouped[$pid] = ['before' => null, 'after' => null, 'tag' => null];
            }
            if ($grouped[$pid][$norm] === null) {
                $grouped[$pid][$norm] = $img;
            }
        }

        if (empty($grouped)) {
            return collect();
        }

        // Only load poles that belong to this node (prevents cross-node contamination)
        $polesMap = \App\Models\Pole::whereIn('id', array_keys($grouped))
            ->where('node_id', $node->id)
            ->orderBy('pole_code')
            ->get()
            ->keyBy(fn ($p) => (int) $p->id);

        $rows = collect();
        foreach ($polesMap as $poleId => $pole) {
            $data = $grouped[(int) $poleId] ?? null;
            if (! $data) continue;
            $rows->push((object) [
                'pole'     => $pole,
                'before'   => $data['before'],
                'after'    => $data['after'],
                'pole_tag' => $data['tag'],
            ]);
        }

        return $rows->sortBy(fn ($r) => $r->pole?->pole_code ?? 'zzz')->values();
    }

    /**
     * Build the Word-export HTML string.
     */
    private function buildWordHtml(Node $node, $poleRows): string
    {
        $nodeId   = e($node->node_id);
        $nodeName = e($node->node_name);
        $date     = now()->format('F d, Y');

        $rows = '';
        foreach ($poleRows as $i => $row) {
            $num    = $i + 1;
            $code   = e($row->pole->pole_code ?? '—');

            $before  = $row->before   ? asset('storage/' . $row->before->image_path)   : '';
            $after   = $row->after    ? asset('storage/' . $row->after->image_path)     : '';
            $poleTag = $row->pole_tag ? asset('storage/' . $row->pole_tag->image_path)  : '';

            // Images fill the cell — contain so the coordinate overlay is not cropped
            $imgStyle = 'width:148px;height:111px;object-fit:contain;background:#000;display:block;margin:0 auto;';

            $beforeImg  = $before  ? "<img src=\"{$before}\"  style=\"{$imgStyle}\" />" : '<span style="color:#aaa;font-size:9px;">No photo</span>';
            $afterImg   = $after   ? "<img src=\"{$after}\"   style=\"{$imgStyle}\" />" : '<span style="color:#aaa;font-size:9px;">No photo</span>';
            $poleTagImg = $poleTag ? "<img src=\"{$poleTag}\" style=\"{$imgStyle}\" />" : '<span style="color:#aaa;font-size:9px;">No photo</span>';

            $tdStyle  = 'border:1px solid #bbb;padding:4px;text-align:center;vertical-align:middle;font-family:Arial,sans-serif;font-size:11px;';
            $imgTd    = $tdStyle . 'width:156px;';

            $rows .= "
            <tr>
                <td style=\"{$tdStyle}width:36px;\">{$num}</td>
                <td style=\"{$tdStyle}width:80px;font-weight:bold;\">{$code}</td>
                <td style=\"{$imgTd}\">{$beforeImg}</td>
                <td style=\"{$imgTd}\">{$afterImg}</td>
                <td style=\"{$imgTd}\">{$poleTagImg}</td>
                <td style=\"{$tdStyle}width:160px;\">&nbsp;</td>
            </tr>";
        }

        $thStyle   = 'border:1px solid #bbb;padding:6px 4px;background:#1e3a5f;color:#fff;font-family:Arial,sans-serif;font-size:11px;font-weight:bold;text-align:center;';
        $hdrTdLeft = 'border:1px solid #bbb;padding:8px 10px;font-family:Arial,sans-serif;font-size:12px;font-weight:bold;text-align:center;vertical-align:middle;';

        return <<<HTML
<!DOCTYPE html>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:w="urn:schemas-microsoft-com:office:word"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta charset="UTF-8">
<meta name="ProgId" content="Word.Document">
<meta name="Generator" content="Microsoft Word 15">
<meta name="Originator" content="Microsoft Word 15">
<!--[if gte mso 9]>
<xml>
 <w:WordDocument>
  <w:View>Normal</w:View>
  <w:Zoom>100</w:Zoom>
  <w:DoNotOptimizeForBrowser/>
 </w:WordDocument>
</xml>
<![endif]-->
<style>
  body  { margin:20px; font-family:Arial,sans-serif; }
  table { border-collapse:collapse; width:100%; }
  @page { size:A4 landscape; margin:1.5cm; }
</style>
</head>
<body>

<p style="font-family:Arial,sans-serif;font-size:11px;color:#555;margin-bottom:12px;">
    Generated: {$date}
</p>

<!-- Header table -->
<table style="border-collapse:collapse;width:100%;margin-bottom:8px;">
  <tr>
    <td style="{$hdrTdLeft}width:50%;background:#e8f0fe;">POLE PICTURE BEFORE AND AFTER</td>
    <td style="{$hdrTdLeft}width:50%;background:#e8f0fe;">NODE ID: {$nodeId} — {$nodeName}</td>
  </tr>
</table>

<!-- Main data table -->
<table style="border-collapse:collapse;width:100%;">
  <thead>
    <tr>
      <th style="{$thStyle}">PICTURE #</th>
      <th style="{$thStyle}">POLE TAG</th>
      <th style="{$thStyle}">BEFORE</th>
      <th style="{$thStyle}">AFTER</th>
      <th style="{$thStyle}">POLE PIC</th>
      <th style="{$thStyle}">JUSTIFICATION</th>
    </tr>
  </thead>
  <tbody>
    {$rows}
  </tbody>
</table>

</body>
</html>
HTML;
    }
}
