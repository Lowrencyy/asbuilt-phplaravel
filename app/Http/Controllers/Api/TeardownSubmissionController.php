<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeardownSubmission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeardownSubmissionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = TeardownSubmission::with(['project', 'node']);

        if ($request->has('node_id')) {
            $query->where('node_id', $request->node_id);
        }

        if ($request->has('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        return response()->json($query->get());
    }

    public function show(TeardownSubmission $teardownSubmission): JsonResponse
    {
        return response()->json(
            $teardownSubmission->load([
                'project',
                'node',
                'items.teardownLog.poleSpan.fromPole',
                'items.teardownLog.poleSpan.toPole',
                'items.teardownLog.images',
                'remarks',
            ])
        );
    }

    public function remarks(TeardownSubmission $teardownSubmission): JsonResponse
    {
        return response()->json(
            $teardownSubmission->remarks()->latest()->get()
        );
    }
}
