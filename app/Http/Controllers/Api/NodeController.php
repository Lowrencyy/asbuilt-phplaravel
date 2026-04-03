<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Node;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Node::query();

        if ($request->has('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        if ($request->filled('search')) {
            $s = '%' . $request->search . '%';
            $query->where(function ($q) use ($s) {
                $q->where('node_id', 'like', $s)
                  ->orWhere('city', 'like', $s)
                  ->orWhere('sites', 'like', $s)
                  ->orWhere('province', 'like', $s)
                  ->orWhere('team', 'like', $s);
            });
        }

        $nodes = $query->with(['project', 'poles'])->limit(50)->get();

        // Append poles_bounds to each node
        $nodes->each(function ($node) {
            $poles = $node->poles->filter(
                fn($p) => $p->map_latitude && $p->map_longitude
            );

            if ($poles->isNotEmpty()) {
                $node->poles_bounds = [
                    'min_lat'    => (float) $poles->min('map_latitude'),
                    'max_lat'    => (float) $poles->max('map_latitude'),
                    'min_lng'    => (float) $poles->min('map_longitude'),
                    'max_lng'    => (float) $poles->max('map_longitude'),
                    'center_lat' => (float) $poles->avg('map_latitude'),
                    'center_lng' => (float) $poles->avg('map_longitude'),
                    'count'      => $poles->count(),
                ];
            } else {
                $node->poles_bounds = null;
            }

            $node->poles_progress = [
                'total'     => $node->poles->count(),
                'completed' => $node->poles->where('status', 'completed')->count(),
            ];

            unset($node->poles); // don't bloat the response
        });

        return response()->json($nodes);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'project_id'          => 'required|exists:projects,id',
            'node_id'             => 'required|string',
            'node_name'           => 'nullable|string',
            'sites'               => 'nullable|string',
            'province'            => 'nullable|string',
            'city'                => 'nullable|string',
            'team'                => 'nullable|string',
            'status'              => 'nullable|string',
            'date_start'          => 'nullable|date',
            'due_date'            => 'nullable|date',
            'total_strand_length' => 'nullable|numeric',
            'expected_cable'      => 'nullable|numeric',
            'extender'            => 'nullable|integer',
            'node_count'          => 'nullable|integer',
            'amplifier'           => 'nullable|integer',
            'tsc'                 => 'nullable|integer',
        ]);

        $node = Node::create($validated);

        return response()->json($node->load('project'), 201);
    }

    public function show(Node $node): JsonResponse
    {
        return response()->json($node->load(['project', 'poles']));
    }

    public function poles(Node $node): JsonResponse
    {
        return response()->json($node->poles()->get());
    }

    public function spans(Node $node): JsonResponse
    {
        return response()->json(
            $node->poleSpans()->with(['fromPole', 'toPole'])->get()
        );
    }
}
