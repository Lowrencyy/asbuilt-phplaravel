<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\Project;
use App\Models\PoleSpan;
use Illuminate\Http\Request;

class SpanController extends Controller
{
    public function create(Project $project, Node $node)
    {
        $poles = $node->poles()->orderBy('pole_code')->get();
        $spans = $node->spans()->with(['fromPole', 'toPole'])->orderBy('id')->get()
            ->map(fn($s) => $this->transform($s));

        return view(
            'dashboards.admin.projects.nodes.spans.create',
            compact('project', 'node', 'poles', 'spans')
        );
    }

    public function store(Request $request, Project $project, Node $node)
    {
        $data = $request->validate([
            'from_pole_id'       => ['required', 'integer', 'exists:poles,id', 'different:to_pole_id'],
            'to_pole_id'         => ['required', 'integer', 'exists:poles,id'],
            'length_meters'      => ['required', 'numeric', 'min:0'],
            'runs'               => ['required', 'integer', 'min:1'],
            'expected_cable'     => ['nullable', 'numeric', 'min:0'],
            'expected_node'      => ['nullable', 'integer', 'min:0'],
            'expected_amplifier' => ['nullable', 'integer', 'min:0'],
            'expected_extender'  => ['nullable', 'integer', 'min:0'],
            'expected_tsc'       => ['nullable', 'integer', 'min:0'],
            'status'             => ['required', 'string', 'in:pending,in_progress,completed,blocked'],
        ]);

        // Check unique pair before hitting the DB constraint
        $exists = PoleSpan::where('from_pole_id', $data['from_pole_id'])
            ->where('to_pole_id', $data['to_pole_id'])
            ->exists();
        if ($exists) {
            return response()->json(['success' => false, 'message' => 'A span between these two poles already exists.'], 422);
        }

        $span = $node->spans()->create($data);
        $span->load(['fromPole', 'toPole']);

        return response()->json(['success' => true, 'span' => $this->transform($span)]);
    }

    public function update(Request $request, Project $project, Node $node, PoleSpan $span)
    {
        $data = $request->validate([
            'from_pole_id'       => ['required', 'integer', 'exists:poles,id', 'different:to_pole_id'],
            'to_pole_id'         => ['required', 'integer', 'exists:poles,id'],
            'length_meters'      => ['required', 'numeric', 'min:0'],
            'runs'               => ['required', 'integer', 'min:1'],
            'expected_cable'     => ['nullable', 'numeric', 'min:0'],
            'expected_node'      => ['nullable', 'integer', 'min:0'],
            'expected_amplifier' => ['nullable', 'integer', 'min:0'],
            'expected_extender'  => ['nullable', 'integer', 'min:0'],
            'expected_tsc'       => ['nullable', 'integer', 'min:0'],
            'status'             => ['required', 'string', 'in:pending,in_progress,completed,blocked'],
        ]);

        $span->update($data);
        $span->load(['fromPole', 'toPole']);

        return response()->json(['success' => true, 'span' => $this->transform($span->fresh(['fromPole', 'toPole']))]);
    }

    public function destroy(Project $project, Node $node, PoleSpan $span)
    {
        $span->delete();
        return response()->json(['success' => true]);
    }

    private function transform(PoleSpan $s): array
    {
        return [
            'id'                 => $s->id,
            'from_pole_id'       => $s->from_pole_id,
            'to_pole_id'         => $s->to_pole_id,
            'from_pole_code'     => $s->fromPole?->pole_code ?? '—',
            'to_pole_code'       => $s->toPole?->pole_code ?? '—',
            'from_pole_name'     => $s->fromPole?->pole_name ?: ($s->fromPole?->pole_code ?? '—'),
            'to_pole_name'       => $s->toPole?->pole_name   ?: ($s->toPole?->pole_code   ?? '—'),
            'length_meters'      => (float) $s->length_meters,
            'runs'               => (int) $s->runs,
            'expected_cable'     => (float) $s->expected_cable,
            'expected_node'      => (int) $s->expected_node,
            'expected_amplifier' => (int) $s->expected_amplifier,
            'expected_extender'  => (int) $s->expected_extender,
            'expected_tsc'       => (int) $s->expected_tsc,
            'status'             => $s->status,
            'completed_at'       => $s->completed_at?->toDateString(),
        ];
    }
}
