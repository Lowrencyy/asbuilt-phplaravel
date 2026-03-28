<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\Project;
use App\Models\TeardownLog;
use App\Models\TeardownSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Project summary
        $projects = Project::withCount([
            'nodes as total_nodes',
            'nodes as done_nodes' => fn($q) => $q->where('status', 'done'),
            'nodes as pending_nodes' => fn($q) => $q->whereNotIn('status', ['done', 'cancelled']),
        ])->orderBy('project_name')->get();

        // All nodes with their first pole lat/lng for map pins
        $nodes = Node::with(['project:id,project_name', 'poles' => fn($q) => $q->whereNotNull('map_latitude')->limit(1)])
            ->select('id', 'project_id', 'node_id', 'node_name', 'city', 'province', 'status', 'progress_percentage')
            ->get()
            ->map(function ($node) {
                $pole = $node->poles->first();
                return [
                    'id'          => $node->id,
                    'node_id'     => $node->node_id,
                    'node_name'   => $node->node_name,
                    'city'        => $node->city,
                    'province'    => $node->province,
                    'status'      => $node->status,
                    'progress'    => (float)($node->progress_percentage ?? 0),
                    'project'     => $node->project?->project_name ?? '—',
                    'lat'         => $pole ? (float)$pole->map_latitude : null,
                    'lng'         => $pole ? (float)$pole->map_longitude : null,
                ];
            })
            ->filter(fn($n) => $n['lat'] && $n['lng'])
            ->values();

        // Summary stats
        $stats = [
            'total_projects'  => $projects->count(),
            'total_nodes'     => Node::count(),
            'done_nodes'      => Node::where('status', 'done')->count(),
            'pending_nodes'   => Node::whereNotIn('status', ['done', 'cancelled'])->count(),
            'reports_today'   => TeardownSubmission::whereDate('created_at', today())->count(),
            'pending_approval'=> TeardownSubmission::whereIn('status', ['submitted_to_pm', 'submitted_to_telcovantage', 'pm_approved'])->count(),
        ];

        // Recent alerts: teardown spans completed in last 24 hours
        $alerts = TeardownLog::with([
            'node:id,node_id,node_name,city',
            'poleSpan:id,pole_span_code,from_pole_id,to_pole_id,length_meters',
            'poleSpan.fromPole:id,pole_code',
            'poleSpan.toPole:id,pole_code',
            'submissionItem.submission:id',
            'images:id,teardown_log_id,photo_type,image_path',
        ])
            ->where(function ($q) {
                $q->where('finished_at', '>=', now()->subHours(24))
                  ->orWhere('synced_at_server', '>=', now()->subHours(24));
            })
            ->latest('finished_at')
            ->limit(20)
            ->get();

        // Node list for bottom panel (most recent activity)
        $nodeList = Node::with('project:id,project_name')
            ->select('id', 'project_id', 'node_id', 'node_name', 'city', 'province', 'status', 'progress_percentage', 'date_start', 'due_date')
            ->orderByDesc('updated_at')
            ->limit(50)
            ->get();

        return view('dashboard', compact('projects', 'nodes', 'stats', 'alerts', 'nodeList'));
    }
}
