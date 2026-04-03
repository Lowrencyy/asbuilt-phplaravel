<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\TeardownSubmission;
use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    private function canSeeAll(): bool
    {
        return in_array(auth()->user()->role, ['admin', 'pm', 'project_manager', 'executives']);
    }

    public function index(Request $request)
    {
        $user     = auth()->user();
        $canSeeAll = $this->canSeeAll();

        $query = TeardownSubmission::with(['node', 'project'])
            ->orderByDesc('report_date')
            ->orderByDesc('created_at');

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }
        if ($request->filled('node_id')) {
            $query->where('node_id', $request->node_id);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('report_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('report_date', '<=', $request->date_to);
        }

        $submissions = $query->paginate(30)->withQueryString();
        $projects    = Project::orderBy('project_name')->get(['id', 'project_name']);

        // Resolve submitted_by / telcovantage_reviewed_by if stored as numeric IDs
        $allUserRefs = $submissions->flatMap(fn ($s) => [
            $s->submitted_by, $s->pm_reviewed_by, $s->telcovantage_reviewed_by,
        ])->filter(fn ($v) => is_numeric($v))->unique()->values()->all();

        $userNameMap = [];
        if (! empty($allUserRefs)) {
            $userNameMap = \App\Models\User::whereIn('id', $allUserRefs)
                ->get(['id', 'name'])->keyBy('id')->map(fn ($u) => $u->name)->all();
        }

        // Batch-compute strand totals from pole_spans.length_meters for each submission's node+date
        // Key: "{node_id}_{date}" => total_strand
        $strandMap = [];
        if ($submissions->count()) {
            $pairs = $submissions->map(fn($s) => [
                'node_id' => $s->node_id,
                'date'    => \Carbon\Carbon::parse($s->report_date)->toDateString(),
            ])->unique()->values();

            $rows = \Illuminate\Support\Facades\DB::table('teardown_logs')
                ->join('pole_spans', 'teardown_logs.pole_span_id', '=', 'pole_spans.id')
                ->whereIn('teardown_logs.node_id', $pairs->pluck('node_id')->unique()->all())
                ->select(
                    'teardown_logs.node_id',
                    \Illuminate\Support\Facades\DB::raw('DATE(COALESCE(teardown_logs.finished_at, teardown_logs.synced_at_server)) as log_date'),
                    \Illuminate\Support\Facades\DB::raw('SUM(pole_spans.length_meters) as total_strand')
                )
                ->groupBy('teardown_logs.node_id', \Illuminate\Support\Facades\DB::raw('DATE(COALESCE(teardown_logs.finished_at, teardown_logs.synced_at_server))'))
                ->get();

            foreach ($rows as $row) {
                $strandMap[$row->node_id . '_' . $row->log_date] = (float) $row->total_strand;
            }
        }

        $statuses    = [
            'draft'                     => 'Draft',
            'submitted_to_pm'           => 'Pending PM',
            'pm_for_rework'             => 'For Rework (PM)',
            'pm_approved'               => 'PM Approved',
            'submitted_to_telcovantage' => 'Pending TelcoVantage',
            'telcovantage_for_rework'   => 'For Rework (TV)',
            'telcovantage_approved'     => 'TV Approved',
            'ready_for_delivery'        => 'For Delivery',
            'delivered'                 => 'Delivered',
            'closed'                    => 'Closed',
        ];

        // Summary counts
        $summary = TeardownSubmission::selectRaw('status, count(*) as cnt')
            ->groupBy('status')
            ->pluck('cnt', 'status');

        return view('reports.index', compact('submissions', 'projects', 'statuses', 'summary', 'canSeeAll', 'userNameMap', 'strandMap'));
    }

    public function export(Request $request)
    {
        $query = TeardownSubmission::with(['node', 'project'])
            ->orderByDesc('report_date')
            ->orderByDesc('created_at');

        if ($request->filled('status'))     $query->where('status', $request->status);
        if ($request->filled('project_id')) $query->where('project_id', $request->project_id);
        if ($request->filled('date_from'))  $query->whereDate('report_date', '>=', $request->date_from);
        if ($request->filled('date_to'))    $query->whereDate('report_date', '<=', $request->date_to);

        $rows = $query->with(['items.teardownLog.poleSpan'])->get();

        // Resolve numeric user IDs → names
        $allRefs = $rows->flatMap(fn($s) => [$s->submitted_by, $s->telcovantage_reviewed_by])
            ->filter(fn($v) => is_numeric($v))->unique()->values()->all();
        $nameMap = [];
        if (!empty($allRefs)) {
            $nameMap = \App\Models\User::whereIn('id', $allRefs)->get(['id','name'])->keyBy('id')->map(fn($u) => $u->name)->all();
        }

        $itemStatusLabels = [
            'onfield'            => 'On Field',
            'ready_for_delivery' => 'For Delivery',
            'ongoing_delivery'   => 'In Transit',
            'delivered'          => 'Delivered',
            'delivery_onhold'    => 'On Hold',
        ];

        $filename = 'daily-reports-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($rows, $nameMap, $itemStatusLabels) {
            $out = fopen('php://output', 'w');

            // UTF-8 BOM so Excel recognises encoding correctly
            fwrite($out, "\xEF\xBB\xBF");

            fputcsv($out, [
                'Date', 'Node ID', 'Node Name', 'City', 'Province', 'Area', 'Project',
                'Strand Length (m)', 'Actual Cable (m)', 'Amplifiers', 'Extenders', 'Nodes', 'TSC',
                'Power Supply', 'PS Housing', 'Item Status', 'Submitted By', 'Approved By', 'Submission Status',
            ]);

            foreach ($rows as $sub) {
                $node = $sub->node;
                $proj = $sub->project;

                $submittedBy = is_numeric($sub->submitted_by)
                    ? ($nameMap[$sub->submitted_by] ?? "User #{$sub->submitted_by}")
                    : ($sub->submitted_by ?? '');
                $approvedBy = is_numeric($sub->telcovantage_reviewed_by)
                    ? ($nameMap[$sub->telcovantage_reviewed_by] ?? "User #{$sub->telcovantage_reviewed_by}")
                    : ($sub->telcovantage_reviewed_by ?? '');

                fputcsv($out, [
                    $sub->report_date ? \Carbon\Carbon::parse($sub->report_date)->format('Y-m-d') : '',
                    $node?->node_id ?? '',
                    $node?->node_name ?? '',
                    $node?->city ?? '',
                    $node?->province ?? '',
                    $node?->area ?? $node?->sites ?? $node?->region ?? '',
                    $proj?->project_name ?? '',
                    (float) $sub->items->sum(fn($i) => (float) ($i->teardownLog?->poleSpan?->length_meters ?? 0)),
                    (float) ($sub->total_cable ?? 0),
                    (int)   ($sub->total_amplifier ?? 0),
                    (int)   ($sub->total_extender ?? 0),
                    (int)   ($sub->total_node ?? 0),
                    (int)   ($sub->total_tsc ?? 0),
                    (int)   ($sub->total_powersupply ?? 0),
                    (int)   ($sub->total_powersupply_housing ?? 0),
                    $itemStatusLabels[$sub->item_status] ?? ($sub->item_status ?? ''),
                    $submittedBy,
                    $approvedBy,
                    ucwords(str_replace('_', ' ', $sub->status ?? '')),
                ]);
            }

            fclose($out);
        }, $filename, [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    public function approve(Request $request, TeardownSubmission $submission)
    {
        $user = auth()->user();

        $pendingStatuses = [
            'submitted_to_pm', 'pm_for_rework', 'pm_approved',
            'submitted_to_telcovantage', 'telcovantage_for_rework',
        ];

        if (! in_array($submission->status, $pendingStatuses)) {
            return back()->with('error', 'Report is already approved or cannot be approved at this stage.');
        }

        $submission->update([
            'status'                   => 'telcovantage_approved',
            'telcovantage_reviewed_by' => $user->name,
            'telcovantage_reviewed_at' => now(),
            'item_status'              => 'ready_for_delivery',
        ]);

        return back()->with('success', "Report approved by {$user->name}. Items marked for delivery.");
    }

    public function reject(Request $request, TeardownSubmission $submission)
    {
        $request->validate(['reason' => 'nullable|string|max:500']);
        $user = auth()->user();
        $role = $user->role;

        if ($role === 'subcon' && $submission->status === 'submitted_to_pm') {
            $submission->update(['status' => 'pm_for_rework', 'pm_reviewed_by' => $user->name, 'pm_reviewed_at' => now()]);
            return back()->with('success', 'Report sent back for rework.');
        }

        if (in_array($role, ['admin', 'pm', 'project_manager', 'executives'])) {
            $newStatus = in_array($submission->status, ['submitted_to_pm', 'pm_approved'])
                ? 'pm_for_rework'
                : 'telcovantage_for_rework';

            $submission->update([
                'status'                   => $newStatus,
                'telcovantage_reviewed_by' => $user->name,
                'telcovantage_reviewed_at' => now(),
            ]);
            return back()->with('success', 'Report sent back for rework.');
        }

        return back()->with('error', 'Cannot reject at this stage.');
    }

    public function show(TeardownSubmission $submission)
    {
        $submission->load(['project', 'node', 'items.teardownLog', 'remarks']);

        // Build log list: prefer items relationship, fallback to direct query by node+date
        if ($submission->items->isNotEmpty()) {
            $logs = $submission->items->pluck('teardownLog')->filter()->values();
            $logIds = $logs->pluck('id')->all();
            // Eager load relations on those specific logs
            \App\Models\TeardownLog::with(['poleSpan.fromPole', 'poleSpan.toPole', 'images'])
                ->whereIn('id', $logIds)->get()
                ->each(function ($l) use ($logs) {
                    $match = $logs->firstWhere('id', $l->id);
                    if ($match) {
                        $match->setRelation('poleSpan', $l->poleSpan);
                        $match->setRelation('images', $l->images);
                    }
                });
        } else {
            $reportDate = \Carbon\Carbon::parse($submission->report_date)->toDateString();
            $logs = \App\Models\TeardownLog::where('node_id', $submission->node_id)
                ->with(['poleSpan.fromPole', 'poleSpan.toPole', 'images'])
                ->where(function ($q) use ($reportDate) {
                    $q->whereDate('finished_at', $reportDate)
                      ->orWhereDate('synced_at_server', $reportDate);
                })
                ->orderBy('finished_at')
                ->get();
        }

        // Resolve user names
        $userRefs = array_filter([
            $submission->submitted_by,
            $submission->pm_reviewed_by,
            $submission->telcovantage_reviewed_by,
        ], 'is_numeric');

        $userNameMap = [];
        if (! empty($userRefs)) {
            $userNameMap = \App\Models\User::whereIn('id', $userRefs)
                ->get(['id', 'name'])->keyBy('id')->map(fn ($u) => $u->name)->all();
        }

        // Build map data for Leaflet
        $mapData = $logs->map(function ($log) {
            $span = $log->poleSpan;
            $fromP = $span?->fromPole;
            $toP   = $span?->toPole;
            $fromLat = $log->from_pole_latitude ?? $fromP?->latitude;
            $fromLng = $log->from_pole_longitude ?? $fromP?->longitude;
            $toLat   = $log->to_pole_latitude   ?? $toP?->latitude;
            $toLng   = $log->to_pole_longitude  ?? $toP?->longitude;

            return [
                'log_id'       => $log->id,
                'span_code'    => $span?->pole_span_code,
                'from_code'    => $fromP?->pole_code ?? 'From',
                'to_code'      => $toP?->pole_code   ?? 'To',
                'cable'        => (float) $log->collected_cable,
                'from_lat'     => $fromLat ? (float)$fromLat : null,
                'from_lng'     => $fromLng ? (float)$fromLng : null,
                'to_lat'       => $toLat   ? (float)$toLat   : null,
                'to_lng'       => $toLng   ? (float)$toLng   : null,
            ];
        })->filter(fn($d) => $d['from_lat'] || $d['to_lat'])->values();

        return view('reports.show', compact('submission', 'userNameMap', 'logs', 'mapData'));
    }

    public function markDelivery(Request $request, TeardownSubmission $submission)
    {
        $request->validate(['status' => 'required|in:ready_for_delivery,delivered,closed']);
        $submission->update(['status' => $request->status]);
        return back()->with('success', 'Status updated to ' . str_replace('_', ' ', $request->status) . '.');
    }

    public function updateDeliveryStatus(Request $request, TeardownSubmission $submission)
    {
        $request->validate(['item_status' => 'required|in:onfield,ongoing_delivery,delivered,delivery_onhold']);
        $submission->update(['item_status' => $request->item_status]);
        return back()->with('success', 'Delivery status updated.');
    }

    /** List of all teardown logs (live teardown index). */
    public function teardownLogs(\Illuminate\Http\Request $request)
    {
        $logs = \App\Models\TeardownLog::with([
            'node:id,node_id,node_name,city',
            'poleSpan:id,pole_span_code,from_pole_id,to_pole_id,length_meters',
            'poleSpan.fromPole:id,pole_code',
            'poleSpan.toPole:id,pole_code',
            'images:id,teardown_log_id,photo_type,image_path',
        ])
        ->orderByDesc('created_at')
        ->paginate(30)
        ->withQueryString();

        return view('teardown.index', compact('logs'));
    }

    /** Dedicated page for a single teardown log. */
    public function showLog(\App\Models\TeardownLog $teardownLog)
    {
        $teardownLog->load([
            'node',
            'project',
            'poleSpan.fromPole',
            'poleSpan.toPole',
            'images',
            'submissionItem.submission',
        ]);

        $images = $teardownLog->images->keyBy('photo_type');

        return view('teardown.show', compact('teardownLog', 'images'));
    }

    /** Live teardown feed — returns the 30 most-recent teardown_logs as JSON. */
    public function liveTeardownFeed(Request $request)
    {
        $since = $request->query('since');

        $query = \App\Models\TeardownLog::with(['node', 'poleSpan.fromPole', 'poleSpan.toPole'])
            ->orderByDesc('created_at')
            ->limit(30);

        if ($since) {
            $query->where('created_at', '>', $since);
        }

        $logs = $query->get()->map(function ($log) {
            $span  = $log->poleSpan;
            $from  = $span?->fromPole;
            $to    = $span?->toPole;
            return [
                'id'            => $log->id,
                'node_id'       => $log->node?->node_id,
                'node_name'     => $log->node?->node_name,
                'span_code'     => $span?->pole_span_code,
                'from_pole'     => $from?->pole_code,
                'to_pole'       => $to?->pole_code,
                'team'          => $log->team,
                'submitted_by'  => $log->submitted_by,
                'cable'         => (float) $log->collected_cable,
                'status'        => $log->status,
                'finished_at'   => $log->finished_at?->toDateTimeString(),
                'created_at'    => $log->created_at->toDateTimeString(),
                'offline_mode'  => (bool) $log->offline_mode,
            ];
        });

        return response()->json([
            'logs'       => $logs,
            'server_now' => now()->toDateTimeString(),
        ]);
    }

    /** New-submissions alert — returns count of submissions created after ?since= timestamp. */
    public function newSubmissionsCount(Request $request)
    {
        $since = $request->query('since', now()->subMinutes(1)->toDateTimeString());

        $count = TeardownSubmission::where('created_at', '>', $since)->count();

        return response()->json([
            'count'      => $count,
            'server_now' => now()->toDateTimeString(),
        ]);
    }

    /** Sequence Tracker — page view. */
    public function sequenceTracker()
    {
        return view('reports.sequence-tracker');
    }

    /** Sequence Tracker — list of all nodes with teardown progress summary. */
    public function sequenceNodes()
    {
        // Single aggregated query instead of N+1 per-node poles fetch
        $poleCounts = \Illuminate\Support\Facades\DB::table('poles')
            ->select('node_id', 'status', \Illuminate\Support\Facades\DB::raw('count(*) as cnt'))
            ->groupBy('node_id', 'status')
            ->get()
            ->groupBy('node_id');

        $nodes = \App\Models\Node::with(['project:id,project_name'])
            ->withCount('spans')
            ->get()
            ->map(function ($node) use ($poleCounts) {
                $rows      = $poleCounts->get($node->id, collect());
                $total     = (int) $rows->sum('cnt');
                $completed = (int)($rows->firstWhere('status', 'completed')?->cnt ?? 0);
                $pending   = (int) $rows->whereIn('status', ['active', 'pending'])->sum('cnt');

                return [
                    'id'          => $node->id,
                    'node_id'     => $node->node_id,
                    'node_name'   => $node->node_name,
                    'city'        => $node->city,
                    'province'    => $node->province,
                    'project'     => $node->project?->project_name,
                    'total_poles' => $total,
                    'completed'   => $completed,
                    'pending'     => $pending,
                    'not_started' => max(0, $total - $completed - $pending),
                    'spans_count' => $node->spans_count,
                    'pct'         => $total > 0 ? round(($completed / $total) * 100) : 0,
                    'status'      => $node->status,
                ];
            })
            ->sortByDesc('pct')
            ->values();

        return response()->json($nodes);
    }

    /** Sequence Tracker — poles + spans map data for a single node. */
    public function sequenceNodeMap(\App\Models\Node $node)
    {
        $polesRaw = $node->poles()
            ->get(['id','pole_code','pole_name','status','completed_at','map_latitude','map_longitude']);

        $spans = $node->spans()
            ->with(['fromPole:id,pole_code,pole_name,map_latitude,map_longitude',
                    'toPole:id,pole_code,pole_name,map_latitude,map_longitude',
                    'teardownLogs:id,pole_span_id,collected_cable,collected_node,collected_amplifier,collected_extender,collected_tsc,status,submitted_by,finished_at'])
            ->get()
            ->map(function ($s) {
                $log = $s->teardownLogs->sortByDesc('finished_at')->first();
                $spanStatus = 'not_started';
                if ($s->completed_at) $spanStatus = 'completed';
                elseif ($s->teardownLogs->isNotEmpty()) $spanStatus = 'pending';

                return [
                    'id'            => $s->id,
                    'code'          => $s->pole_span_code ?? ('SP-'.$s->id),
                    'from_pole_id'  => $s->from_pole_id,
                    'to_pole_id'    => $s->to_pole_id,
                    'from_lat'      => (float)($s->fromPole?->map_latitude  ?? 0),
                    'from_lng'      => (float)($s->fromPole?->map_longitude ?? 0),
                    'to_lat'        => (float)($s->toPole?->map_latitude    ?? 0),
                    'to_lng'        => (float)($s->toPole?->map_longitude   ?? 0),
                    'len'           => (float)$s->length_meters,
                    'status'        => $spanStatus,
                    'completed_at'  => $s->completed_at?->format('M d, Y g:i A'),
                    'finished_at_raw' => $log?->finished_at?->toIso8601String(),
                    'submitted_by'  => $log?->submitted_by,
                    'collected'     => (float)($log?->collected_cable ?? 0),
                    'col_node'      => (int)($log?->collected_node ?? 0),
                    'col_amp'       => (int)($log?->collected_amplifier ?? 0),
                    'col_ext'       => (int)($log?->collected_extender ?? 0),
                    'col_tsc'       => (int)($log?->collected_tsc ?? 0),
                    'exp_node'      => (int)($s->expected_node ?? 0),
                    'exp_amp'       => (int)($s->expected_amplifier ?? 0),
                    'exp_ext'       => (int)($s->expected_extender ?? 0),
                    'exp_tsc'       => (int)($s->expected_tsc ?? 0),
                ];
            });

        // Assign sequence numbers per-pole:
        // Completed spans sorted by finished_at → span #1: from_pole=1, to_pole=2; span #2: from_pole=3, to_pole=4 …
        $poleSeq = [];  // pole_id => sequence number
        $counter = 1;
        $spans->sortBy(fn($s) => $s['finished_at_raw'] ?? 'zzz')->values()
            ->each(function ($s) use (&$poleSeq, &$counter) {
                if ($s['status'] !== 'completed' || !$s['finished_at_raw']) return;
                if ($s['from_pole_id'] && !isset($poleSeq[$s['from_pole_id']])) {
                    $poleSeq[$s['from_pole_id']] = $counter++;
                }
                if ($s['to_pole_id'] && !isset($poleSeq[$s['to_pole_id']])) {
                    $poleSeq[$s['to_pole_id']] = $counter++;
                }
            });

        $spans = $spans->sortBy(fn($s) => $poleSeq[$s['from_pole_id']] ?? 9999)->values()
            ->map(function ($s) {
                $s['seq'] = null;
                return $s;
            });

        // Build poles array now that poleSeq is ready
        $poles = $polesRaw->map(fn($p) => [
            'id'           => $p->id,
            'code'         => $p->pole_name ?: $p->pole_code,
            'raw_code'     => $p->pole_code,
            'status'       => $p->status ?? 'not_started',
            'completed_at' => $p->completed_at?->format('M d, Y g:i A'),
            'lat'          => (float)($p->map_latitude  ?? 0),
            'lng'          => (float)($p->map_longitude ?? 0),
            'seq'          => $poleSeq[$p->id] ?? null,
        ]);

        return response()->json([
            'node'  => [
                'id'       => $node->id,
                'node_id'  => $node->node_id,
                'name'     => $node->node_name,
                'city'     => $node->city,
                'province' => $node->province,
            ],
            'poles' => $poles->values(),
            'spans' => $spans->values(),
        ]);
    }
}
