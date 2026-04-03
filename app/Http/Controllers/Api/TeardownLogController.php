<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PoleSpan;
use App\Models\TeardownLog;
use App\Services\ImageProcessingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeardownLogController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user  = $request->user();
        $query = TeardownLog::with([
            'poleSpan.fromPole',
            'poleSpan.toPole',
            'node',
            'project',
            'images',
        ]);

        // ── Role-based visibility ────────────────────────────────────────────
        if ($user->role === 'subcon') {
            if ($user->subcon_role === 'lineman') {
                // Lineman: logs from their own team (by team name) OR
                // any log under a node belonging to their subcontractor
                // (covers older logs submitted before team field was populated)
                $team            = $user->team_id ? \App\Models\Team::find($user->team_id) : null;
                $subcontractorId = $user->subcontractor_id;

                if (!$team && !$subcontractorId) {
                    return response()->json([]);
                }

                $query->where(function ($q) use ($team, $subcontractorId) {
                    if ($team) {
                        $q->where('team', $team->team_name);
                    }
                    if ($subcontractorId) {
                        $q->orWhereHas('node', fn ($nq) =>
                            $nq->where('subcontractor_id', $subcontractorId)
                        );
                    }
                });
            } else {
                // Subcon PM: all logs under their subcontractor's nodes
                $subcontractorId = $user->subcontractor_id;

                if (!$subcontractorId) {
                    return response()->json([]);
                }

                $query->whereHas('node', function ($q) use ($subcontractorId) {
                    $q->where('subcontractor_id', $subcontractorId);
                });
            }
        }
        // Admins / project_manager / other internal roles see everything

        if ($request->has('node_id')) {
            $query->where('node_id', $request->node_id);
        }

        // Filter by node_id string (node_code) — used by mobile node-logs screen
        if ($request->filled('node_code')) {
            $query->whereHas('node', fn ($q) => $q->where('node_id', $request->node_code));
        }

        if ($request->has('pole_span_id')) {
            $query->where('pole_span_id', $request->pole_span_id);
        }

        return response()->json($query->orderBy('created_at', 'desc')->get());
    }

    public function show(TeardownLog $teardownLog): JsonResponse
    {
        return response()->json(
            $teardownLog->load(['project', 'node', 'poleSpan.fromPole', 'poleSpan.toPole', 'images'])
        );
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'node_id'                    => 'required|exists:nodes,id',
            'pole_span_id'               => 'required|exists:pole_spans,id',
            'team'                       => 'nullable|string',
            'did_collect_all_cable'      => 'required|boolean',
            'collected_cable'            => 'required|numeric|min:0',
            'unrecovered_cable'          => 'nullable|numeric|min:0',
            'unrecovered_reason'         => 'nullable|string',
            'did_collect_components'     => 'required|boolean',
            'collected_node'             => 'nullable|integer|min:0',
            'collected_amplifier'        => 'nullable|integer|min:0',
            'collected_extender'         => 'nullable|integer|min:0',
            'collected_tsc'              => 'nullable|integer|min:0',
            'started_at'                 => 'nullable|date',
            'finished_at'                => 'nullable|date',
            'submitted_by'               => 'nullable|string',
            // GPS audit (shared / form-level) — mobile sends as gps_latitude or captured_latitude
            'gps_latitude'               => 'nullable|numeric',
            'gps_longitude'              => 'nullable|numeric',
            'captured_latitude'          => 'nullable|numeric',
            'captured_longitude'         => 'nullable|numeric',
            'gps_accuracy_meters'        => 'nullable|numeric',
            'gps_source'                 => 'nullable|string',
            'offline_mode'               => 'nullable|boolean',
            'location_notes'             => 'nullable|string',
            'captured_at_device'         => 'nullable|date',
            // per-pole GPS (captured at photo-take time)
            'from_pole_latitude'         => 'nullable|numeric',
            'from_pole_longitude'        => 'nullable|numeric',
            'from_pole_gps_captured_at'  => 'nullable|string',
            'from_pole_gps_accuracy'     => 'nullable|string',
            'to_pole_latitude'           => 'nullable|numeric',
            'to_pole_longitude'          => 'nullable|numeric',
            'to_pole_gps_captured_at'    => 'nullable|string',
            'to_pole_gps_accuracy'       => 'nullable|string',
            // per-photo capture timestamps
            'from_before_captured_at'    => 'nullable|string',
            'from_after_captured_at'     => 'nullable|string',
            'from_tag_captured_at'       => 'nullable|string',
            'to_before_captured_at'      => 'nullable|string',
            'to_after_captured_at'       => 'nullable|string',
            'to_tag_captured_at'         => 'nullable|string',
            'before_span_captured_at'    => 'nullable|string',
            // photos sent alongside the log (field names match mobile app)
            'from_before'                => 'nullable|image|max:10240',
            'from_after'                 => 'nullable|image|max:10240',
            'from_tag'                   => 'nullable|image|max:10240',
            'to_before'                  => 'nullable|image|max:10240',
            'to_after'                   => 'nullable|image|max:10240',
            'to_tag'                     => 'nullable|image|max:10240',
            'before_span'                => 'nullable|image|max:10240',
        ]);

        // Prevent duplicate submission for the same span
        $existing = TeardownLog::where('pole_span_id', $validated['pole_span_id'])->first();
        if ($existing) {
            return response()->json([
                'message' => 'Teardown log already submitted for this span.',
                'log'     => $existing->load(['poleSpan.fromPole', 'poleSpan.toPole', 'images']),
            ], 409);
        }

        // pull project_id from the span — eager load relationships needed for file paths
        $span = PoleSpan::with(['fromPole', 'toPole', 'node.project'])->findOrFail($validated['pole_span_id']);

        // Normalise: mobile sends gps_latitude/gps_longitude; map to captured_latitude/captured_longitude
        if (!empty($validated['gps_latitude']) && empty($validated['captured_latitude'])) {
            $validated['captured_latitude']  = $validated['gps_latitude'];
            $validated['captured_longitude'] = $validated['gps_longitude'];
        }
        unset($validated['gps_latitude'], $validated['gps_longitude']);

        $log = TeardownLog::create(array_merge($validated, [
            'project_id'                 => $span->node->project_id,
            'status'                     => 'submitted',
            'received_at_server'         => now(),
            // snapshot expected values from span
            'expected_cable_snapshot'    => $span->expected_cable,
            'expected_node_snapshot'     => $span->expected_node,
            'expected_amplifier_snapshot'=> $span->expected_amplifier,
            'expected_extender_snapshot' => $span->expected_extender,
            'expected_tsc_snapshot'      => $span->expected_tsc,
        ]));

        \Illuminate\Support\Facades\Log::info('Teardown files received', [
            'log_id' => $log->id,
            'files'  => array_keys($request->allFiles()),
            'has_from_before' => $request->hasFile('from_before'),
            'has_to_before'   => $request->hasFile('to_before'),
        ]);

        $processor   = new ImageProcessingService();
        $safeName    = fn($v) => preg_replace('/[:\\\\\/\*\?"<>\|]/', '-', (string) $v);
        $projectCode = $safeName($span->node->project->project_code ?? $span->node->project_id);
        $nodeId      = $safeName($span->node->node_id ?? $span->node_id);
        $fromCode    = $safeName($span->fromPole->pole_code ?? $span->from_pole_id);
        $toCode      = $safeName($span->toPole->pole_code   ?? $span->to_pole_id);

        // Per-pole GPS for stamp overlay
        $fromGps = [
            'lat'         => $request->input('from_pole_latitude')        ?? $request->input('captured_latitude'),
            'lng'         => $request->input('from_pole_longitude')       ?? $request->input('captured_longitude'),
            'captured_at' => $request->input('from_pole_gps_captured_at') ?? $request->input('captured_at_device'),
        ];
        $toGps = [
            'lat'         => $request->input('to_pole_latitude')          ?? $request->input('captured_latitude'),
            'lng'         => $request->input('to_pole_longitude')         ?? $request->input('captured_longitude'),
            'captured_at' => $request->input('to_pole_gps_captured_at')   ?? $request->input('captured_at_device'),
        ];

        // Map each photo field to its pole (from or to)
        $fromDir = "{$projectCode}/{$nodeId}/{$fromCode}";
        $toDir   = "{$projectCode}/{$nodeId}/{$toCode}";
        $photoMap = [
            'from_before' => ['pole_id' => $span->from_pole_id, 'dir' => $fromDir, 'filename' => "{$fromCode}_before.jpg",    'gps' => $fromGps, 'type' => 'BEFORE'],
            'from_after'  => ['pole_id' => $span->from_pole_id, 'dir' => $fromDir, 'filename' => "{$fromCode}_to_{$toCode}_after.jpg", 'gps' => $fromGps, 'type' => 'AFTER'],
            'from_tag'    => ['pole_id' => $span->from_pole_id, 'dir' => $fromDir, 'filename' => "{$fromCode}_tag.jpg",       'gps' => $fromGps, 'type' => 'POLE TAG'],
            'to_before'   => ['pole_id' => $span->to_pole_id,   'dir' => $toDir,   'filename' => "{$toCode}_before.jpg",      'gps' => $toGps,   'type' => 'BEFORE'],
            'to_after'    => ['pole_id' => $span->to_pole_id,   'dir' => $toDir,   'filename' => "{$toCode}_after.jpg",       'gps' => $toGps,   'type' => 'AFTER'],
            'to_tag'      => ['pole_id' => $span->to_pole_id,   'dir' => $toDir,   'filename' => "{$toCode}_tag.jpg",         'gps' => $toGps,   'type' => 'POLE TAG'],
            'before_span' => ['pole_id' => $span->from_pole_id, 'dir' => $fromDir, 'filename' => "{$fromCode}_cable.jpg",     'gps' => $fromGps, 'type' => 'CABLE'],
        ];

        foreach ($photoMap as $field => $info) {
            if ($request->hasFile($field)) {
                // Use per-photo capture time if sent, fall back to pole GPS time, then device time
                $photoCapturedAt = $request->input("{$field}_captured_at")
                    ?? $info['gps']['captured_at']
                    ?? $request->input('captured_at_device');

                $meta = [
                    'latitude'      => $info['gps']['lat'],
                    'longitude'     => $info['gps']['lng'],
                    'captured_at'   => $photoCapturedAt,
                    'location_name' => $request->input('location_notes'),
                    'from_pole'     => $fromCode,
                    'to_pole'       => $toCode,
                    'pole_type'     => $info['type'],
                    'node_code'     => $nodeId,
                ];
                $path = $processor->process(
                    $request->file($field),
                    $info['dir'],
                    $info['filename'],
                    $meta
                );
                $log->images()->create([
                    'pole_id'    => $info['pole_id'],
                    'photo_type' => $field,
                    'image_path' => $path,
                ]);
            }
        }

        // ── Update span status to completed ──────────────────────────────────
        $span->update(['status' => 'completed', 'completed_at' => now()]);

        // ── Update pole statuses ──────────────────────────────────────────────
        $this->syncPoleStatus($span->fromPole);
        $this->syncPoleStatus($span->toPole);

        // ── Update node actual_cable = sum of all collected_cable for this node ──
        $actualCable = TeardownLog::where('node_id', $log->node_id)->sum('collected_cable');
        \App\Models\Node::where('id', $log->node_id)->update(['actual_cable' => $actualCable]);

        return response()->json($log->load(['poleSpan.fromPole', 'poleSpan.toPole', 'images']), 201);
    }

    private function syncPoleStatus(\App\Models\Pole $pole): void
    {
        $totalSpans = $pole->outgoingSpans()->count() + $pole->incomingSpans()->count();

        if ($totalSpans === 0) return;

        $completedSpans = $pole->outgoingSpans()->where('status', 'completed')->count()
                        + $pole->incomingSpans()->where('status', 'completed')->count();

        if ($completedSpans >= $totalSpans) {
            $pole->update(['status' => 'completed', 'completed_at' => now()]);
        }
    }
}
