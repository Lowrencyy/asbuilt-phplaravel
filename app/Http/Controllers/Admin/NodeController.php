<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\Project;
use App\Models\Subcontractor;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    public function index(Project $project)
    {
        $nodes = $project->nodes()->with('subcontractor')->get()->map(fn ($n) => $this->transform($n));
        $subcontractors = Subcontractor::orderBy('name')->get();

        return view('dashboards.admin.projects.nodes.addnodes', compact('project', 'nodes', 'subcontractors'));
    }

    public function store(Request $request, Project $project)
    {
        $data = $request->validate([
            'node_code'         => ['required', 'string', 'max:100'],
            'region'            => ['nullable', 'string', 'max:255'],
            'city'              => ['nullable', 'string', 'max:255'],
            'subcon_id'         => ['nullable', 'integer', 'exists:subcons,id'],
            'status'            => ['required', 'string', 'max:100'],
            'approved_by'       => ['nullable', 'string', 'max:255'],
            'due_date'          => ['nullable', 'date'],
            'start_date'        => ['nullable', 'date'],
            'completed_date'    => ['nullable', 'date'],
            'strand_m'          => ['nullable', 'numeric', 'min:0'],
            'cable_m'           => ['nullable', 'numeric', 'min:0'],
            'actual_cable_m'    => ['nullable', 'numeric', 'min:0'],
            'extender_count'    => ['nullable', 'integer', 'min:0'],
            'tsc_count'         => ['nullable', 'integer', 'min:0'],
            'node_device_count' => ['nullable', 'integer', 'min:0'],
            'amp_count'         => ['nullable', 'integer', 'min:0'],
        ]);

        $node = $project->nodes()->create([
            'node_id'              => $data['node_code'],
            'province'             => $data['region'] ?? null,
            'city'                 => $data['city'] ?? null,
            'subcontractor_id'     => $data['subcon_id'] ?: null,
            'status'               => $data['status'],
            'approved_by'          => $data['approved_by'] ?? null,
            'due_date'             => $data['due_date'] ?? null,
            'date_start'           => $data['start_date'] ?? null,
            'date_finished'        => $data['completed_date'] ?? null,
            'total_strand_length'  => $data['strand_m'] ?? 0,
            'expected_cable'       => $data['cable_m'] ?? 0,
            'actual_cable'         => $data['actual_cable_m'] ?? 0,
            'extender'             => $data['extender_count'] ?? 0,
            'tsc'                  => $data['tsc_count'] ?? 0,
            'node_count'           => $data['node_device_count'] ?? 0,
            'amplifier'            => $data['amp_count'] ?? 0,
        ]);

        return response()->json(['success' => true, 'node' => $this->transform($node->load('subcontractor'))]);
    }

    public function update(Request $request, Project $project, Node $node)
    {
        $data = $request->validate([
            'node_code'         => ['required', 'string', 'max:100'],
            'region'            => ['nullable', 'string', 'max:255'],
            'city'              => ['nullable', 'string', 'max:255'],
            'subcon_id'         => ['nullable', 'integer', 'exists:subcons,id'],
            'status'            => ['required', 'string', 'max:100'],
            'approved_by'       => ['nullable', 'string', 'max:255'],
            'due_date'          => ['nullable', 'date'],
            'start_date'        => ['nullable', 'date'],
            'completed_date'    => ['nullable', 'date'],
            'strand_m'          => ['nullable', 'numeric', 'min:0'],
            'cable_m'           => ['nullable', 'numeric', 'min:0'],
            'actual_cable_m'    => ['nullable', 'numeric', 'min:0'],
            'extender_count'    => ['nullable', 'integer', 'min:0'],
            'tsc_count'         => ['nullable', 'integer', 'min:0'],
            'node_device_count' => ['nullable', 'integer', 'min:0'],
            'amp_count'         => ['nullable', 'integer', 'min:0'],
        ]);

        $node->update([
            'node_id'              => $data['node_code'],
            'province'             => $data['region'] ?? null,
            'city'                 => $data['city'] ?? null,
            'subcontractor_id'     => $data['subcon_id'] ?: null,
            'status'               => $data['status'],
            'approved_by'          => $data['approved_by'] ?? null,
            'due_date'             => $data['due_date'] ?? null,
            'date_start'           => $data['start_date'] ?? null,
            'date_finished'        => $data['completed_date'] ?? null,
            'total_strand_length'  => $data['strand_m'] ?? 0,
            'expected_cable'       => $data['cable_m'] ?? 0,
            'actual_cable'         => $data['actual_cable_m'] ?? 0,
            'extender'             => $data['extender_count'] ?? 0,
            'tsc'                  => $data['tsc_count'] ?? 0,
            'node_count'           => $data['node_device_count'] ?? 0,
            'amplifier'            => $data['amp_count'] ?? 0,
        ]);

        return response()->json(['success' => true, 'node' => $this->transform($node->fresh()->load('subcontractor'))]);
    }

    public function destroy(Project $project, Node $node)
    {
        $node->delete();

        return response()->json(['success' => true]);
    }

    private function transform(Node $n): array
    {
        return [
            'id'                => $n->id,
            'node_code'         => $n->node_id,
            'region'            => $n->province,
            'city'              => $n->city,
            'subcon_id'         => $n->subcontractor_id,
            'subcontractor'     => $n->subcontractor ? ['name' => $n->subcontractor->name] : null,
            'status'            => $n->status,
            'approved_by'       => $n->approved_by,
            'due_date'          => $n->due_date?->toDateString(),
            'start_date'        => $n->date_start?->toDateString(),
            'completed_date'    => $n->date_finished?->toDateString(),
            'strand_m'          => (float) $n->total_strand_length,
            'cable_m'           => (float) $n->expected_cable,
            'actual_cable_m'    => (float) $n->actual_cable,
            'extender_count'    => (int) $n->extender,
            'tsc_count'         => (int) $n->tsc,
            'node_device_count' => (int) $n->node_count,
            'amp_count'         => (int) $n->amplifier,
            'progress'          => (float) $n->progress_percentage,
        ];
    }
}
