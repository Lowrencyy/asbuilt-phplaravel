<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LinemanOnly
{
    public function handle(Request $request, Closure $next)
    {
        if (!in_array($request->user()?->role, ['lineman', 'admin', 'pm'])) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        return $next($request);
    }
}
