<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\Pole;
use App\Models\PoleSequence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PoleSequenceController extends Controller
{
    /**
     * GET /nodes/{node}/sequence?date=YYYY-MM-DD
     *
     * Returns the day's pole sequence for a node.
     * If no sequence is set for the requested date, falls back to
     * all poles in the node ordered by pole_code.
     */
    public function index(Request $request, Node $node): JsonResponse
    {
        $date = $request->get('date', today()->toDateString());

        $sequences = PoleSequence::with([
                'pole:id,pole_code,pole_name,status,map_latitude,map_longitude,completed_at',
            ])
            ->where('node_id', $node->id)
            ->where('sequence_date', $date)
            ->orderBy('sort_order')
            ->get();

        // Return the sequence rows (each has pole relationship + sort_order + date)
        return response()->json([
            'date'          => $date,
            'node_id'       => $node->id,
            'node_code'     => $node->node_id,
            'sequence_set'  => $sequences->isNotEmpty(),
            'data'          => $sequences,
        ]);
    }

    /**
     * POST /nodes/{node}/sequence
     *
     * PM saves (or replaces) the sequence for a given date.
     * Body: { date?: "YYYY-MM-DD", poles: [{ id, sort_order }] }
     */
    public function store(Request $request, Node $node): JsonResponse
    {
        $validated = $request->validate([
            'date'               => 'nullable|date_format:Y-m-d',
            'poles'              => 'required|array|min:1',
            'poles.*.id'         => 'required|integer|exists:poles,id',
            'poles.*.sort_order' => 'required|integer|min:0',
        ]);

        $date = $validated['date'] ?? today()->toDateString();

        // Wipe the existing sequence for this node+date and replace it
        PoleSequence::where('node_id', $node->id)
            ->where('sequence_date', $date)
            ->delete();

        $rows = collect($validated['poles'])->map(fn ($item) => [
            'node_id'       => $node->id,
            'pole_id'       => $item['id'],
            'sort_order'    => $item['sort_order'],
            'sequence_date' => $date,
            'assigned_by'   => auth()->id(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        PoleSequence::insert($rows->all());

        return response()->json([
            'message' => 'Sequence saved.',
            'date'    => $date,
            'count'   => $rows->count(),
        ], 201);
    }

    /**
     * DELETE /nodes/{node}/sequence?date=YYYY-MM-DD
     *
     * Clears the sequence for a given date (PM can reset and redo).
     */
    public function destroy(Request $request, Node $node): JsonResponse
    {
        $date = $request->get('date', today()->toDateString());

        $deleted = PoleSequence::where('node_id', $node->id)
            ->where('sequence_date', $date)
            ->delete();

        return response()->json([
            'message' => 'Sequence cleared.',
            'date'    => $date,
            'deleted' => $deleted,
        ]);
    }
}
