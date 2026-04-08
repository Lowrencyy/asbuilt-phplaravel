<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\Pole;
use App\Models\PoleSpan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BulkUploadController extends Controller
{
    /**
     * Accept a single JSON (or gzip-compressed JSON) file upload
     * containing one node + its poles + its pole spans.
     *
     * Accepts multipart/form-data with a "file" field,
     * or raw application/json body (no file).
     */
    public function store(Request $request): JsonResponse
    {
        // ── 1. Get JSON payload ───────────────────────────────────────────────
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $raw = file_get_contents($uploadedFile->getRealPath());

            // Detect gzip magic bytes: 1f 8b
            if (strlen($raw) >= 2 && ord($raw[0]) === 0x1f && ord($raw[1]) === 0x8b) {
                $raw = gzdecode($raw);
                if ($raw === false) {
                    return response()->json(['message' => 'Failed to decompress gzip file.'], 422);
                }
            }

            $payload = json_decode($raw, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json(['message' => 'Invalid JSON: ' . json_last_error_msg()], 422);
            }
        } else {
            // Raw JSON body
            $payload = $request->json()->all();
        }

        // ── 2. Top-level validation ───────────────────────────────────────────
        $topValidator = Validator::make($payload, [
            'project_id'         => 'required|exists:projects,id',
            'node'               => 'required|array',
            'node.node_id'       => 'required|string',
            'poles'              => 'nullable|array',
            'poles.*.pole_code'  => 'required|string',
            'pole_spans'         => 'nullable|array',
            'pole_spans.*.from_pole_code' => 'required|string',
            'pole_spans.*.to_pole_code'   => 'required|string',
        ]);

        if ($topValidator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors'  => $topValidator->errors(),
            ], 422);
        }

        // ── 3. Process inside a transaction ──────────────────────────────────
        try {
            $result = DB::transaction(function () use ($payload) {

                $projectId = $payload['project_id'];
                $nodeData  = $payload['node'];
                $polesData = $payload['poles']     ?? [];
                $spansData = $payload['pole_spans'] ?? [];

                // ── 3a. Node ─────────────────────────────────────────────────
                $nodeFields = array_merge($nodeData, ['project_id' => $projectId]);
                $node = Node::updateOrCreate(
                    ['project_id' => $projectId, 'node_id' => $nodeFields['node_id']],
                    collect($nodeFields)->except(['node_id', 'project_id'])->all()
                );
                $nodeCreated = $node->wasRecentlyCreated;

                // ── 3b. Poles ────────────────────────────────────────────────
                $poleMap     = [];   // pole_code => Pole instance
                $polesResult = [];
                $untaggedCodes = ['NPT', 'NT'];

                // Auto-generate sitemap_x/y for poles missing coordinates so
                // spans can still be created even without DXF geometry.
                // Uses a simple sequential grid (100 units apart).
                $gridIndex = 0;
                $gridSpacing = 100;

                foreach ($polesData as &$poleData) {
                    if (empty($poleData['sitemap_x']) && empty($poleData['sitemap_y'])) {
                        $col = $gridIndex % 10;
                        $row = intdiv($gridIndex, 10);
                        $poleData['sitemap_x'] = ($col + 1) * $gridSpacing;
                        $poleData['sitemap_y'] = ($row + 1) * $gridSpacing;
                        $gridIndex++;
                    }
                }
                unset($poleData);

                foreach ($polesData as $poleData) {
                    $poleData['node_id'] = $node->id;
                    $code = strtoupper($poleData['pole_code']);

                    if (in_array($code, $untaggedCodes)) {
                        $pole = Pole::create($poleData);
                        $created = true;
                    } else {
                        $pole = Pole::updateOrCreate(
                            ['node_id' => $node->id, 'pole_code' => $poleData['pole_code']],
                            collect($poleData)->except(['node_id', 'pole_code'])->all()
                        );
                        $created = $pole->wasRecentlyCreated;
                    }

                    $poleMap[$poleData['pole_code']] = $pole;
                    $polesResult[] = [
                        'pole_code' => $pole->pole_code,
                        'id'        => $pole->id,
                        'action'    => $created ? 'created' : 'updated',
                    ];
                }

                // ── 3c. Pole Spans ───────────────────────────────────────────
                $spansResult = [];

                foreach ($spansData as $spanData) {
                    $fromCode = $spanData['from_pole_code'];
                    $toCode   = $spanData['to_pole_code'];

                    if (!isset($poleMap[$fromCode])) {
                        throw new \InvalidArgumentException(
                            "from_pole_code \"{$fromCode}\" not found in the uploaded poles list."
                        );
                    }
                    if (!isset($poleMap[$toCode])) {
                        throw new \InvalidArgumentException(
                            "to_pole_code \"{$toCode}\" not found in the uploaded poles list."
                        );
                    }
                    if ($fromCode === $toCode) {
                        throw new \InvalidArgumentException(
                            "from_pole_code and to_pole_code must be different (got \"{$fromCode}\")."
                        );
                    }

                    $fromId = $poleMap[$fromCode]->id;
                    $toId   = $poleMap[$toCode]->id;

                    $spanFields = collect($spanData)
                        ->except(['from_pole_code', 'to_pole_code'])
                        ->merge([
                            'node_id'      => $node->id,
                            'from_pole_id' => $fromId,
                            'to_pole_id'   => $toId,
                        ])
                        ->all();

                    $span = PoleSpan::updateOrCreate(
                        ['from_pole_id' => $fromId, 'to_pole_id' => $toId],
                        collect($spanFields)->except(['from_pole_id', 'to_pole_id'])->all()
                    );

                    $spansResult[] = [
                        'pole_span_code' => $span->pole_span_code,
                        'from_pole_code' => $fromCode,
                        'to_pole_code'   => $toCode,
                        'id'             => $span->id,
                        'action'         => $span->wasRecentlyCreated ? 'created' : 'updated',
                    ];
                }

                return [
                    'node'       => ['id' => $node->id, 'node_id' => $node->node_id, 'action' => $nodeCreated ? 'created' : 'updated'],
                    'poles'      => $polesResult,
                    'pole_spans' => $spansResult,
                    'summary'    => [
                        'poles_count'      => count($polesResult),
                        'pole_spans_count' => count($spansResult),
                    ],
                ];
            });

            return response()->json([
                'message' => 'Bulk upload successful.',
                'data'    => $result,
            ], 201);

        } catch (\InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Upload failed: ' . $e->getMessage()], 500);
        }
    }
}
