<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\PoleSequence;
use Illuminate\Http\Request;

class PolePlannerController extends Controller
{
    public function index()
    {
        $nodes = Node::with('project:id,project_name')
            ->withCount(['poles', 'spans'])
            ->orderBy('node_id')
            ->get()
            ->map(fn($n) => [
                'id'          => $n->id,
                'node_id'     => $n->node_id,
                'node_name'   => $n->node_name,
                'city'        => $n->city,
                'province'    => $n->province,
                'project'     => $n->project?->project_name,
                'project_id'  => $n->project_id,
                'poles_count' => $n->poles_count,
                'spans_count' => $n->spans_count,
                'status'      => $n->status,
            ])
            ->values();

        return view('planner.pole-planner-nodes', compact('nodes'));
    }

    public function show(Request $request, Node $node)
    {
        $date  = $request->get('date', today()->toDateString());
        $poles = $node->poles()
            ->orderBy('pole_code')
            ->get(['id','pole_code','pole_name','status','completed_at','map_latitude','map_longitude']);

        $sequences = PoleSequence::where('node_id', $node->id)
            ->where('sequence_date', $date)
            ->orderBy('sort_order')
            ->pluck('pole_id')
            ->toArray();

        return view('planner.pole-planner', compact('node', 'poles', 'sequences', 'date'));
    }

    public function save(Request $request, Node $node)
    {
        $validated = $request->validate([
            'date'   => 'required|date_format:Y-m-d',
            'poles'  => 'required|array|min:1',
            'poles.*'=> 'integer|exists:poles,id',
        ]);

        PoleSequence::where('node_id', $node->id)
            ->where('sequence_date', $validated['date'])
            ->delete();

        $rows = collect($validated['poles'])->values()->map(fn($poleId, $i) => [
            'node_id'       => $node->id,
            'pole_id'       => $poleId,
            'sort_order'    => $i,
            'sequence_date' => $validated['date'],
            'assigned_by'   => auth()->id(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        PoleSequence::insert($rows->all());

        return back()->with('success', count($validated['poles']) . ' poles planned for ' . $validated['date'] . '.');
    }

    public function clear(Request $request, Node $node)
    {
        $date = $request->get('date', today()->toDateString());
        PoleSequence::where('node_id', $node->id)
            ->where('sequence_date', $date)
            ->delete();

        return back()->with('success', 'Sequence cleared for ' . $date . '.');
    }
}
