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
            'pole_code' => ['required', 'string', 'max:100'],
            'status'    => ['required', 'in:pending,completed'],
            'remarks'   => ['nullable', 'string', 'max:1000'],
        ]);

        $pole = $node->poles()->create([
            'pole_code' => $data['pole_code'],
            'status'    => $data['status'],
            'remarks'   => $data['remarks'] ?? null,
        ]);

        return response()->json(['success' => true, 'pole' => $this->transform($pole)]);
    }

    public function update(Request $request, Project $project, Node $node, Pole $pole)
    {
        $data = $request->validate([
            'pole_code' => ['required', 'string', 'max:100'],
            'status'    => ['required', 'in:pending,completed'],
            'remarks'   => ['nullable', 'string', 'max:1000'],
        ]);

        $pole->update([
            'pole_code' => $data['pole_code'],
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
            'status'       => $p->status,
            'remarks'      => $p->remarks,
            'map_latitude' => $p->map_latitude,
            'map_longitude'=> $p->map_longitude,
            'completed_at' => $p->completed_at?->toDateTimeString(),
        ];
    }
}
