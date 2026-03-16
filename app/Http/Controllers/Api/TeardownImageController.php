<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeardownLog;
use App\Models\TeardownLogImage;
use App\Services\ImageProcessingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeardownImageController extends Controller
{
    public function store(Request $request, TeardownLog $teardownLog): JsonResponse
    {
        $teardownLog->loadMissing(['poleSpan.fromPole', 'poleSpan.node.project', 'node']);
        $request->validate([
            'pole_id'    => 'required|exists:poles,id',
            'photo_type' => 'required|in:before,after,pole_tag,supporting,missing_cable',
            'image'      => 'required|image|max:10240',
        ]);

        $processor   = new ImageProcessingService();
        $filename    = $request->photo_type . '_' . time() . '.jpg';
        $projectCode = $teardownLog->poleSpan->node->project->project_code ?? $teardownLog->project_id;
        $nodeId      = $teardownLog->node->node_id ?? $teardownLog->node_id;
        $poleCode    = $teardownLog->poleSpan->fromPole->pole_code ?? $teardownLog->poleSpan->from_pole_id;
        $storageDir  = "{$projectCode}/{$nodeId}/{$poleCode}";

        $path = $processor->process(
            $request->file('image'),
            $storageDir,
            $filename,
            [
                'pole_id'  => $request->pole_id,
                'node_id'  => $teardownLog->node_id,
                'latitude' => $request->input('latitude'),
                'longitude'=> $request->input('longitude'),
                'captured_at' => $request->input('captured_at'),
            ]
        );

        $image = TeardownLogImage::create([
            'teardown_log_id' => $teardownLog->id,
            'pole_id'         => $request->pole_id,
            'photo_type'      => $request->photo_type,
            'image_path'      => $path,
        ]);

        return response()->json([
            'id'         => $image->id,
            'photo_type' => $image->photo_type,
            'url'        => asset('storage/' . $path),
        ], 201);
    }
}
