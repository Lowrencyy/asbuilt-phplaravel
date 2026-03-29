<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\Pole;
use App\Models\Project;
use Illuminate\Http\Request;

class PoleController extends Controller
{
    public function index(Project $project, Node $node)
    {
        $poles = $node->poles()->orderBy('pole_code')->get();
        return view('dashboards.admin.projects.nodes.addpole.addpole', compact('project', 'node', 'poles'));
    }

    public function store(Request $request, Project $project, Node $node)
    {
        $data = $request->validate([
            'pole_name' => ['required', 'string', 'max:100'],
            'status'    => ['required', 'in:pending,completed'],
            'remarks'   => ['nullable', 'string', 'max:1000'],
        ]);

        $poleCode = strtoupper($data['pole_name']);
        $untagged = ['NPT', 'NT'];
        $isUntagged = in_array($poleCode, $untagged);

        if (!$isUntagged) {
            // Named poles: pole_name must be unique per node
            if ($node->poles()->where('pole_name', $data['pole_name'])->exists()) {
                return response()->json(['success' => false, 'message' => 'A pole with this name already exists in this node.'], 422);
            }
        }
        // NPT/NT poles allow multiple — no uniqueness check

        $pole = $node->poles()->create([
            'pole_code' => $poleCode,
            'pole_name' => $data['pole_name'],
            'status'    => $data['status'],
            'remarks'   => $data['remarks'] ?? null,
        ]);

        return response()->json(['success' => true, 'pole' => $this->transform($pole)]);
    }

    public function update(Request $request, Project $project, Node $node, Pole $pole)
    {
        $data = $request->validate([
            'pole_name' => ['required', 'string', 'max:100'],
            'status'    => ['required', 'in:pending,completed'],
            'remarks'   => ['nullable', 'string', 'max:1000'],
        ]);

        $poleCode = strtoupper($data['pole_name']);
        $untagged = ['NPT', 'NT'];
        $isUntagged = in_array($poleCode, $untagged);

        if (!$isUntagged) {
            // Named poles: pole_name must be unique per node (excluding self)
            if ($node->poles()->where('pole_name', $data['pole_name'])->where('id', '!=', $pole->id)->exists()) {
                return response()->json(['success' => false, 'message' => 'A pole with this name already exists in this node.'], 422);
            }
        }

        $pole->update([
            'pole_code' => $poleCode,
            'pole_name' => $data['pole_name'],
            'status'    => $data['status'],
            'remarks'   => $data['remarks'] ?? null,
        ]);

        return response()->json(['success' => true, 'pole' => $this->transform($pole->fresh())]);
    }

    public function destroy(Project $project, Node $node, Pole $pole)
    {
        $pole->delete();
        return response()->json(['success' => true]);
    }

    private function transform(Pole $p): array
    {
        return [
            'id'           => $p->id,
            'pole_code'    => $p->pole_code,
            'pole_name'    => $p->pole_name,
            'status'       => $p->status,
            'remarks'      => $p->remarks,
            'map_latitude' => $p->map_latitude,
            'map_longitude'=> $p->map_longitude,
            'completed_at' => $p->completed_at?->toDateTimeString(),
        ];
    }
}
