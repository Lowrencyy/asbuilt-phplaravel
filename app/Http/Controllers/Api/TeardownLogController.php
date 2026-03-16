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
        $query = TeardownLog::with(['poleSpan.fromPole', 'poleSpan.toPole', 'images']);

        if ($request->has('node_id')) {
            $query->where('node_id', $request->node_id);
        }

        if ($request->has('pole_span_id')) {
            $query->where('pole_span_id', $request->pole_span_id);
        }

        return response()->json($query->get());
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
            // GPS audit (shared / form-level)
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
            // photos sent alongside the log
            'from_pole_before'           => 'nullable|image|max:10240',
            'from_pole_after'            => 'nullable|image|max:10240',
            'from_pole_tag'              => 'nullable|image|max:10240',
            'to_pole_before'             => 'nullable|image|max:10240',
            'to_pole_after'              => 'nullable|image|max:10240',
            'to_pole_tag'                => 'nullable|image|max:10240',
            'cable_photo'                => 'nullable|image|max:10240',
        ]);

        // pull project_id from the span — eager load relationships needed for file paths
        $span = PoleSpan::with(['fromPole', 'toPole', 'node.project'])->findOrFail($validated['pole_span_id']);

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

        $processor   = new ImageProcessingService();
        $projectCode = $span->node->project->project_code ?? $span->node->project_id;
        $nodeId      = $span->node->node_id ?? $span->node_id;
        $fromCode    = $span->fromPole->pole_code ?? $span->from_pole_id;
        $toCode      = $span->toPole->pole_code   ?? $span->to_pole_id;

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
        $photoMap = [
            'from_pole_before' => ['pole_id' => $span->from_pole_id, 'dir' => "{$projectCode}/{$nodeId}/{$fromCode}", 'filename' => "{$fromCode}_{$toCode}_before.jpg", 'gps' => $fromGps, 'type' => 'BEFORE'],
            'from_pole_after'  => ['pole_id' => $span->from_pole_id, 'dir' => "{$projectCode}/{$nodeId}/{$fromCode}", 'filename' => "{$fromCode}_{$toCode}_after.jpg",  'gps' => $fromGps, 'type' => 'AFTER'],
            'from_pole_tag'    => ['pole_id' => $span->from_pole_id, 'dir' => "{$projectCode}/{$nodeId}/{$fromCode}", 'filename' => "{$fromCode}_{$toCode}_tag.jpg",    'gps' => $fromGps, 'type' => 'POLE TAG'],
            'to_pole_before'   => ['pole_id' => $span->to_pole_id,   'dir' => "{$projectCode}/{$nodeId}/{$toCode}",   'filename' => "{$toCode}_{$fromCode}_before.jpg", 'gps' => $toGps,   'type' => 'BEFORE'],
            'to_pole_after'    => ['pole_id' => $span->to_pole_id,   'dir' => "{$projectCode}/{$nodeId}/{$toCode}",   'filename' => "{$toCode}_{$fromCode}_after.jpg",  'gps' => $toGps,   'type' => 'AFTER'],
            'to_pole_tag'      => ['pole_id' => $span->to_pole_id,   'dir' => "{$projectCode}/{$nodeId}/{$toCode}",   'filename' => "{$toCode}_{$fromCode}_tag.jpg",    'gps' => $toGps,   'type' => 'POLE TAG'],
            'cable_photo'      => ['pole_id' => $span->from_pole_id, 'dir' => "{$projectCode}/{$nodeId}/{$fromCode}", 'filename' => "{$fromCode}_{$toCode}_cable.jpg",  'gps' => $fromGps, 'type' => 'CABLE'],
        ];

        foreach ($photoMap as $field => $info) {
            if ($request->hasFile($field)) {
                $meta = [
                    'latitude'      => $info['gps']['lat'],
                    'longitude'     => $info['gps']['lng'],
                    'captured_at'   => $info['gps']['captured_at'],
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

        return response()->json($log->load(['poleSpan.fromPole', 'poleSpan.toPole', 'images']), 201);
    }
}
