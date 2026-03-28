<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * PM Access — pm, project_manager, admin only
 * Used for approve/reject transmittals and other PM-gated actions.
 */
class PmAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowed = ['pm', 'project_manager', 'admin', 'executives', 'accounting'];

        if (! in_array($request->user()?->role, $allowed)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Access denied. This action requires project manager role.'], 403);
            }
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        return $next($request);
    }
}
