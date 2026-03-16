<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Node;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Node::query();

        if ($request->has('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        return response()->json($query->with('project')->get());
    }

    public function show(Node $node): JsonResponse
    {
        return response()->json($node->load(['project', 'poles']));
    }

    public function poles(Node $node): JsonResponse
    {
        return response()->json($node->poles()->get());
    }

    public function spans(Node $node): JsonResponse
    {
        return response()->json(
            $node->poleSpans()->with(['fromPole', 'toPole'])->get()
        );
    }
}
