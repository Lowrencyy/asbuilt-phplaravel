<?php

namespace App\Http\Controllers\AsBuilt;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\Pole;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PoleController extends Controller
{
    public function index(Node $node): JsonResponse
    {
        $poles = $node->poles()->orderBy('pole_code')->get()->map(fn ($p) => $this->transform($p));

        return response()->json($poles);
    }

    public function store(Request $request, Node $node): JsonResponse
    {
        $data = $request->validate([
            'pole_code'     => 'required|string|max:20',
            'pole_name'     => 'nullable|string|max:100',
            'map_latitude'  => 'nullable|numeric|between:-90,90',
            'map_longitude' => 'nullable|numeric|between:-180,1                                                                                                                                                                                                             80',
            'slot'          => 'nullable|string|max:5',
            'remarks'       => 'nullable|string|max:250',


            'status'        => 'nullable|string|max:50',
        ]);

        $exists = $node->poles()->where('pole_code', $data['pole_code'])->first();
        if ($exists) {
            return response()->json(['message' => 'Pole code already exists in this node.', 'pole' => $this->transform($exists)], 409);
        }

        $pole = $node->poles()->create([
            'pole_code'     => $data['pole_code'],
            'pole_name'     => $data['pole_name'] ?? null,
            'map_latitude'  => $data['map_latitude'] ?? null,
            'map_longitude' => $data['map_longitude'] ?? null,
            'slot'          => $data['slot'] ?? null,
            'remarks'       => $data['remarks'] ?? null,
            'status'        => $data['status'] ?? 'active',
        ]);

        return response()->json(['pole' => $this->transform($pole)], 201);
    }

    public function bulkStore(Request $request, Node $node): JsonResponse
    {
        $request->validate([
            'poles'                 => 'required|array|min:1',
            'poles.*.pole_code'     => 'required|string|max:20',
            'poles.*.pole_name'     => 'nullable|string|max:100',
            'poles.*.map_latitude'  => 'nullable|numeric|between:-90,90',
            'poles.*.map_longitude' => 'nullable|numeric|between:-180,180',
            'poles.*.slot'          => 'nullable|string|max:20',
            'poles.*.remarks'       => 'nullable|string|max:500',
        ]);

        $created = [];
        $skipped = [];

        foreach ($request->poles as $item) {
            $exists = $node->poles()->where('pole_code', $item['pole_code'])->first();

            if ($exists) {
                $skipped[] = $item['pole_code'];
                continue;
            }

            $pole = $node->poles()->create([
                'pole_code'     => $item['pole_code'],
                'pole_name'     => $item['pole_name'] ?? null,
                'map_latitude'  => $item['map_latitude'] ?? null,
                'map_longitude' => $item['map_longitude'] ?? null,
                'slot'          => $item['slot'] ?? null,
                'remarks'       => $item['remarks'] ?? null,
                'status'        => $item['status'] ?? 'active',
            ]);

            $created[] = $this->transform($pole);
        }

        return response()->json([
            'created'      => count($created),
            'skipped'      => count($skipped),
            'skipped_codes' => $skipped,
            'poles'        => $created,
        ], 201);
    }

    private function transform(Pole $p): array
    {
        return [
            'id'            => $p->id,
            'node_id'       => $p->node_id,
            'pole_code'     => $p->pole_code,
            'pole_name'     => $p->pole_name ?? null,
            'map_latitude'  => $p->map_latitude ? (float) $p->map_latitude : null,
            'map_longitude' => $p->map_longitude ? (float) $p->map_longitude : null,
            'slot'          => $p->slot ?? null,
            'remarks'       => $p->remarks ?? null,
            'status'        => $p->status,
        ];
    }
}
