<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AsBuiltOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! in_array($user->role, ['admin', 'pm', 'project_manager'])) {
            return response()->json(['message' => 'Access denied. AsBuilt IQ requires project manager role.'], 403);
        }

        return $next($request);
    }
}
