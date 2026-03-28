<?php

namespace App\Http\Controllers\AsBuilt;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    public function index(Project $project): JsonResponse
    {
        $nodes = $project->nodes()->orderBy('node_id')->get()->map(fn ($n) => $this->transform($n));

        return response()->json($nodes);
    }

    public function store(Request $request, Project $project): JsonResponse
    {
        $data = $request->validate([
            'node_id'   => 'required|string|max:100',
            'node_name' => 'nullable|string|max:255',
            'city'      => 'nullable|string|max:255',
            'province'  => 'nullable|string|max:255',
            'status'    => 'nullable|string|max:100',
        ]);

        $exists = $project->nodes()->where('node_id', $data['node_id'])->first();
        if ($exists) {
            return response()->json(['message' => 'Node ID already exists.', 'node' => $this->transform($exists)], 409);
        }

        $node = $project->nodes()->create([
            'node_id'   => $data['node_id'],
            'node_name' => $data['node_name'] ?? null,
            'city'      => $data['city'] ?? null,
            'province'  => $data['province'] ?? null,
            'status'    => $data['status'] ?? 'ON GOING IMPLEMENTATION',
        ]);

        return response()->json(['node' => $this->transform($node)], 201);
    }

    public function bulkStore(Request $request, Project $project): JsonResponse
    {
        $request->validate([
            'nodes'             => 'required|array|min:1',
            'nodes.*.node_id'   => 'required|string|max:100',
            'nodes.*.node_name' => 'nullable|string|max:255',
            'nodes.*.city'      => 'nullable|string|max:255',
            'nodes.*.province'  => 'nullable|string|max:255',
        ]);

        $created = [];
        $skipped = [];

        foreach ($request->nodes as $item) {
            $exists = $project->nodes()->where('node_id', $item['node_id'])->first();

            if ($exists) {
                $skipped[] = $item['node_id'];
                continue;
            }

            $node = $project->nodes()->create([
                'node_id'   => $item['node_id'],
                'node_name' => $item['node_name'] ?? null,
                'city'      => $item['city'] ?? null,
                'province'  => $item['province'] ?? null,
                'status'    => $item['status'] ?? 'ON GOING IMPLEMENTATION',
            ]);

            $created[] = $this->transform($node);
        }

        return response()->json([
            'created' => count($created),
            'skipped' => count($skipped),
            'skipped_ids' => $skipped,
            'nodes'   => $created,
        ], 201);
    }

    public function show(Project $project, Node $node): JsonResponse
    {
        return response()->json($this->transform($node));
    }

    private function transform(Node $n): array
    {
        return [
            'id'        => $n->id,
            'node_id'   => $n->node_id,
            'node_name' => $n->node_name,
            'city'      => $n->city,
            'province'  => $n->province,
            'status'    => $n->status,
        ];
    }
}
