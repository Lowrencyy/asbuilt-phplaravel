<?php

namespace App\Http\Controllers;

use App\Exports\RtdReportExport;
use App\Models\Node;
use App\Models\Project;
use App\Models\TeardownLog;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class RtdReportController extends Controller
{
    public function index()
    {
        $projects = Project::with(['nodes' => function ($q) {
            $q->withCount('teardownLogs')
              ->withMax('teardownLogs', 'finished_at')
              ->orderByDesc('teardown_logs_max_finished_at'); // nodes with latest activity first
        }])->orderBy('project_name')->get();

        return view('reports.rtd.index', compact('projects'));
    }

    public function show(Node $node)
    {
        $node->load('project');
        $rows = $this->buildRows($node);
        return view('reports.rtd.show', compact('node', 'rows'));
    }

    public function exportExcel(Node $node)
    {
        $node->load('project');
        $rows = $this->buildRows($node);

        $date     = now()->format('Ymd_His');
        $nodeId   = preg_replace('/\s+/', '_', $node->node_id);
        $filename = "RTD_{$nodeId}_{$date}.xlsx";

        return Excel::download(new RtdReportExport($node, $rows), $filename);
    }

    private function buildRows(Node $node): \Illuminate\Support\Collection
    {
        return TeardownLog::where('node_id', $node->id)
            ->with(['poleSpan.fromPole', 'poleSpan.toPole'])
            ->orderBy('finished_at')   // earliest teardown first
            ->get()
            ->map(function ($log) {
                $span     = $log->poleSpan;
                $fromPole = $span?->fromPole;
                $toPole   = $span?->toPole;

                // Pole number — from_pole preferred
                $poleNumber = $fromPole?->pole_code ?? $toPole?->pole_code ?? '—';

                // Location: lat,lng : (pole_code)
                $lat = $log->from_pole_latitude  ? number_format((float) $log->from_pole_latitude,  8) : null;
                $lng = $log->from_pole_longitude ? number_format((float) $log->from_pole_longitude, 8) : null;
                $location = '';
                if ($lat && $lng) {
                    $location = "{$lat},{$lng}";
                    if ($fromPole?->pole_code) {
                        $location .= ' : (' . $fromPole->pole_code . ')';
                    }
                }

                // Detachment date + time (Asia/Manila)
                $ts = $log->finished_at ?? $log->created_at;
                $detachDate = $ts
                    ? Carbon::parse($ts)->setTimezone('Asia/Manila')->format('d-M-Y H:i:s')
                    : '';

                // Remarks: runs
                $runs    = (int) ($span?->runs ?? 1);
                $remarks = 'TEARDOWN ' . $runs . ' RUN' . ($runs > 1 ? 'S' : '');

                return (object) [
                    'pole_number'    => $poleNumber,
                    'location'       => $location,
                    'cable_position' => '',        // intentionally blank
                    'detach_date'    => $detachDate,
                    'remarks'        => $remarks,
                    'finished_at'    => $log->finished_at, // kept for sorting reference
                ];
            });
    }

}
