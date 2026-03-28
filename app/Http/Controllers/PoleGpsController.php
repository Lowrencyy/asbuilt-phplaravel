<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\Pole;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PoleGpsController extends Controller
{
    private function authorizeAccess(): void
    {
        $allowed = ['admin', 'pm', 'project_manager', 'executives', 'subcon'];
        if (! in_array(auth()->user()?->role, $allowed)) {
            abort(403);
        }
    }

    private function scopedNodes()
    {
        $user = auth()->user();
        $query = Node::with('project:id,project_name');

        // Subcon: only their assigned nodes
        if ($user->role === 'subcon' && $user->subcontractor_id) {
            $query->where('subcontractor_id', $user->subcontractor_id);
        }
        // All other allowed roles see everything

        return $query;
    }

    public function index()
    {
        $this->authorizeAccess();

        // Projects with node + pole GPS coverage stats
        $projects = Project::orderBy('project_name')
            ->withCount('nodes')
            ->get();

        $user = auth()->user();

        // Pole GPS stats per project
        $nodeQuery = $this->scopedNodes()
            ->select('id', 'project_id', 'node_id', 'node_name', 'city', 'province', 'status');

        $nodes = $nodeQuery->get();
        $nodeIds = $nodes->pluck('id');

        // Count total poles and poles with GPS per node
        $poleCounts = DB::table('poles')
            ->whereIn('node_id', $nodeIds)
            ->select(
                'node_id',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN map_latitude IS NOT NULL AND map_longitude IS NOT NULL THEN 1 ELSE 0 END) as with_gps')
            )
            ->groupBy('node_id')
            ->get()
            ->keyBy('node_id');

        // Group nodes by project
        $nodesByProject = $nodes->groupBy('project_id');

        return view('planner.index', compact('projects', 'nodesByProject', 'poleCounts'));
    }

    public function node(Node $node)
    {
        $this->authorizeAccess();

        $user = auth()->user();

        // Subcon scope check
        if ($user->role === 'subcon' && $user->subcontractor_id) {
            if ($node->subcontractor_id !== $user->subcontractor_id) {
                abort(403);
            }
        }

        $node->load('project:id,project_name');
        $poles = $node->poles()->orderBy('pole_code')->get();

        // Build map data: poles with GPS
        $mapPoles = $poles->map(fn($p) => [
            'id'        => $p->id,
            'code'      => $p->pole_code ?? "Pole #{$p->id}",
            'status'    => $p->status,
            'lat'       => $p->map_latitude  ? (float)$p->map_latitude  : null,
            'lng'       => $p->map_longitude ? (float)$p->map_longitude : null,
            'has_gps'   => $p->map_latitude && $p->map_longitude,
        ]);

        return view('planner.node', compact('node', 'poles', 'mapPoles'));
    }

    public function updateGps(Request $request, Pole $pole)
    {
        $this->authorizeAccess();

        $data = $request->validate([
            'map_latitude'  => ['required', 'numeric', 'between:-90,90'],
            'map_longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);

        $pole->update($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'pole' => $pole->only(['id','pole_code','map_latitude','map_longitude'])]);
        }

        return back()->with('success', "GPS location saved for {$pole->pole_code}.");
    }
}
