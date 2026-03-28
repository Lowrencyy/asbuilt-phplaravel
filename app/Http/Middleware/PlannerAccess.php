<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Planner Access — project_manager, admin, executives only.
 * Used for creating/managing nodes, poles, and pole spans via the Planner app API.
 */
class PlannerAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowed = ['project_manager', 'admin', 'executives'];

        if (! in_array($request->user()?->role, $allowed)) {
            return response()->json(['message' => 'Access denied. This action requires project manager, admin, or executive role.'], 403);
        }

        return $next($request);
    }
}
