<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->role === 'subcon' && $user->subcontractor_id) {
            $projects = Project::whereHas('nodes', function ($q) use ($user) {
                $q->where('subcontractor_id', $user->subcontractor_id);
            })->get();

            // If no projects matched (nodes not yet assigned to this subcon),
            // fall back to all projects so the app isn't blank
            if ($projects->isEmpty()) {
                $projects = Project::all();
            }

            return response()->json($projects);
        }

        return response()->json(Project::all());
    }

    public function show(Request $request, Project $project): JsonResponse
    {
        $user = $request->user();

        if ($user->role === 'subcon' && $user->subcontractor_id) {
            $nodes = $project->nodes()->where('subcontractor_id', $user->subcontractor_id)->get();
            return response()->json($project->setRelation('nodes', $nodes));
        }

        return response()->json($project->load('nodes'));
    }
}
