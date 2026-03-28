<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PoleSpan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PoleSpanController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // Check if a span already exists for this from→to pair (for upsert ignore)
        $existing = PoleSpan::where('from_pole_id', $request->from_pole_id)
            ->where('to_pole_id', $request->to_pole_id)
            ->first();

        $validated = $request->validate([
            'node_id'                      => 'required|exists:nodes,id',
            'from_pole_id'                 => 'required|exists:poles,id',
            'to_pole_id'                   => 'required|exists:poles,id|different:from_pole_id',
            'pole_span_code'               => [
                'nullable', 'string',
                \Illuminate\Validation\Rule::unique('pole_spans', 'pole_span_code')
                    ->ignore($existing?->id),
            ],
            'length_meters'                => 'nullable|numeric|min:0',
            'runs'                         => 'nullable|integer|min:1',
            'expected_cable'               => 'nullable|numeric|min:0',
            'expected_node'                => 'nullable|integer|min:0',
            'expected_amplifier'           => 'nullable|integer|min:0',
            'expected_extender'            => 'nullable|integer|min:0',
            'expected_tsc'                 => 'nullable|integer|min:0',
            'expected_powersupply'         => 'nullable|integer|min:0',
            'expected_powersupply_housing' => 'nullable|integer|min:0',
        ]);

        $span = PoleSpan::updateOrCreate(
            ['from_pole_id' => $validated['from_pole_id'], 'to_pole_id' => $validated['to_pole_id']],
            collect($validated)->except(['from_pole_id', 'to_pole_id'])->all()
        );

        return response()->json($span->load(['fromPole', 'toPole', 'node']), $span->wasRecentlyCreated ? 201 : 200);
    }

    public function index(Request $request): JsonResponse
    {
        $query = PoleSpan::query()->with(['fromPole', 'toPole', 'node']);

        if ($request->filled('node_id')) {
            $query->where('node_id', $request->node_id);
        }

        if ($request->filled('search')) {
            $s = '%' . $request->search . '%';
            $query->where(function ($q) use ($s) {
                $q->whereHas('fromPole', fn($p) => $p->where('pole_code', 'like', $s))
                  ->orWhereHas('toPole',   fn($p) => $p->where('pole_code', 'like', $s))
                  ->orWhereHas('node',     fn($n) => $n->where('node_id',   'like', $s));
            });
        }

        return response()->json($query->limit(50)->get());
    }
}
