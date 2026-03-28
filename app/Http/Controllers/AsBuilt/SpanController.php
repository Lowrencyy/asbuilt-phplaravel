<?php

namespace App\Http\Controllers\AsBuilt;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\Pole;
use App\Models\PoleSpan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SpanController extends Controller
{
    public function index(Node $node): JsonResponse
    {
        $spans = $node->poleSpans()
            ->with(['fromPole:id,pole_code', 'toPole:id,pole_code'])
            ->orderBy('id')
            ->get()
            ->map(fn ($s) => $this->transform($s));

        return response()->json($spans);
    }

    public function store(Request $request, Node $node): JsonResponse
    {
        $data = $request->validate([
            'from_pole_code'               => 'required|string|max:100',
            'to_pole_code'                 => 'required|string|max:100',
            'pole_span_code'               => 'nullable|string|max:100',
            'length_meters'                => 'nullable|numeric|min:0',
            'runs'                         => 'nullable|integer|min:0',
            'expected_powersupply'         => 'nullable|integer|min:0',
            'expected_powersupply_housing' => 'nullable|integer|min:0',
            'expected_cable'               => 'nullable|numeric|min:0',
            'expected_node'                => 'nullable|integer|min:0',
            'expected_amplifier'           => 'nullable|integer|min:0',
            'expected_extender'            => 'nullable|integer|min:0',
            'expected_tsc'                 => 'nullable|integer|min:0',
            'status'                       => 'nullable|string|max:50',
        ]);

        $fromPole = $node->poles()->where('pole_code', $data['from_pole_code'])->first();
        $toPole   = $node->poles()->where('pole_code', $data['to_pole_code'])->first();

        if (! $fromPole) {
            return response()->json(['message' => "from_pole_code '{$data['from_pole_code']}' not found in this node."], 422);
        }
        if (! $toPole) {
            return response()->json(['message' => "to_pole_code '{$data['to_pole_code']}' not found in this node."], 422);
        }

        // Prevent exact duplicate span (same from → to in same node)
        $exists = $node->poleSpans()
            ->where('from_pole_id', $fromPole->id)
            ->where('to_pole_id', $toPole->id)
            ->first();

        if ($exists) {
            return response()->json(['message' => 'Span already exists between these two poles.', 'span' => $this->transform($exists->load(['fromPole', 'toPole']))], 409);
        }

        $span = $node->poleSpans()->create([
            'from_pole_id'                 => $fromPole->id,
            'to_pole_id'                   => $toPole->id,
            'pole_span_code'               => $data['pole_span_code'] ?? null,
            'length_meters'                => $data['length_meters'] ?? null,
            'runs'                         => $data['runs'] ?? null,
            'expected_powersupply'         => $data['expected_powersupply'] ?? null,
            'expected_powersupply_housing' => $data['expected_powersupply_housing'] ?? null,
            'expected_cable'               => $data['expected_cable'] ?? null,
            'expected_node'                => $data['expected_node'] ?? null,
            'expected_amplifier'           => $data['expected_amplifier'] ?? null,
            'expected_extender'            => $data['expected_extender'] ?? null,
            'expected_tsc'                 => $data['expected_tsc'] ?? null,
            'status'                       => $data['status'] ?? 'pending',
        ]);

        return response()->json(['span' => $this->transform($span->load(['fromPole', 'toPole']))], 201);
    }

    public function bulkStore(Request $request, Node $node): JsonResponse
    {
        $request->validate([
            'spans'                               => 'required|array|min:1',
            'spans.*.from_pole_code'              => 'required|string|max:100',
            'spans.*.to_pole_code'                => 'required|string|max:100',
            'spans.*.pole_span_code'              => 'nullable|string|max:100',
            'spans.*.length_meters'               => 'nullable|numeric|min:0',
            'spans.*.runs'                        => 'nullable|integer|min:0',
            'spans.*.expected_powersupply'        => 'nullable|integer|min:0',
            'spans.*.expected_powersupply_housing'=> 'nullable|integer|min:0',
            'spans.*.expected_cable'              => 'nullable|numeric|min:0',
            'spans.*.expected_node'               => 'nullable|integer|min:0',
            'spans.*.expected_amplifier'          => 'nullable|integer|min:0',
            'spans.*.expected_extender'           => 'nullable|integer|min:0',
            'spans.*.expected_tsc'                => 'nullable|integer|min:0',
        ]);

        // Pre-load all poles in this node as a lookup map (code → id)
        $poleMap = $node->poles()->pluck('id', 'pole_code')->toArray();

        $created = [];
        $skipped = [];
        $errors  = [];

        foreach ($request->spans as $idx => $item) {
            $fromCode = $item['from_pole_code'];
            $toCode   = $item['to_pole_code'];

            if (! isset($poleMap[$fromCode])) {
                $errors[] = "Row {$idx}: from_pole_code '{$fromCode}' not found.";
                continue;
            }
            if (! isset($poleMap[$toCode])) {
                $errors[] = "Row {$idx}: to_pole_code '{$toCode}' not found.";
                continue;
            }

            $fromId = $poleMap[$fromCode];
            $toId   = $poleMap[$toCode];

            $exists = $node->poleSpans()
                ->where('from_pole_id', $fromId)
                ->where('to_pole_id', $toId)
                ->exists();

            if ($exists) {
                $skipped[] = "{$fromCode} → {$toCode}";
                continue;
            }

            $span = $node->poleSpans()->create([
                'from_pole_id'                 => $fromId,
                'to_pole_id'                   => $toId,
                'pole_span_code'               => $item['pole_span_code'] ?? null,
                'length_meters'                => $item['length_meters'] ?? null,
                'runs'                         => $item['runs'] ?? null,
                'expected_powersupply'         => $item['expected_powersupply'] ?? null,
                'expected_powersupply_housing' => $item['expected_powersupply_housing'] ?? null,
                'expected_cable'               => $item['expected_cable'] ?? null,
                'expected_node'                => $item['expected_node'] ?? null,
                'expected_amplifier'           => $item['expected_amplifier'] ?? null,
                'expected_extender'            => $item['expected_extender'] ?? null,
                'expected_tsc'                 => $item['expected_tsc'] ?? null,
                'status'                       => $item['status'] ?? 'pending',
            ]);

            $created[] = [
                'id'              => $span->id,
                'from_pole_code'  => $fromCode,
                'to_pole_code'    => $toCode,
                'pole_span_code'  => $span->pole_span_code,
                'status'          => $span->status,
            ];
        }

        return response()->json([
            'created'  => count($created),
            'skipped'  => count($skipped),
            'errors'   => count($errors),
            'skipped_spans' => $skipped,
            'error_details' => $errors,
            'spans'    => $created,
        ], 201);
    }

    public function statusBulk(Request $request): JsonResponse
    {
        $request->validate([
            'pole_span_codes'   => 'required|array|min:1',
            'pole_span_codes.*' => 'required|string',
        ]);

        $spans = PoleSpan::whereIn('pole_span_code', $request->pole_span_codes)
            ->with('teardownLogs:pole_span_id,status,created_at')
            ->get();

        $result = $spans->map(function ($s) {
            $completed = $s->teardownLogs->where('status', 'submitted')->count() > 0;
            return [
                'pole_span_code' => $s->pole_span_code,
                'status'         => $completed ? 'completed' : ($s->status ?? 'pending'),
                'date_finished'  => $s->completed_at?->toDateString(),
            ];
        });

        return response()->json(['spans' => $result]);
    }

    private function transform(PoleSpan $s): array
    {
        return [
            'id'                           => $s->id,
            'node_id'                      => $s->node_id,
            'pole_span_code'               => $s->pole_span_code,
            'from_pole_code'               => $s->fromPole?->pole_code,
            'to_pole_code'                 => $s->toPole?->pole_code,
            'length_meters'                => $s->length_meters ? (float) $s->length_meters : null,
            'runs'                         => $s->runs,
            'expected_powersupply'         => $s->expected_powersupply,
            'expected_powersupply_housing' => $s->expected_powersupply_housing,
            'expected_cable'               => $s->expected_cable ? (float) $s->expected_cable : null,
            'expected_node'                => $s->expected_node,
            'expected_amplifier'           => $s->expected_amplifier,
            'expected_extender'            => $s->expected_extender,
            'expected_tsc'                 => $s->expected_tsc,
            'status'                       => $s->status,
            'completed_at'                 => $s->completed_at?->toDateString(),
        ];
    }
}
