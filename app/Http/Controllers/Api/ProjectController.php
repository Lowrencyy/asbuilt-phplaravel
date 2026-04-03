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

        if ($user->role === 'subcon') {
            $team = $user->team_id ? \App\Models\Team::find($user->team_id) : null;

            if (!$team) {
                return response()->json([]);
            }

            $projects = Project::whereHas('nodes', function ($q) use ($team) {
                $q->where('team', $team->team_name);
            })->get();

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
