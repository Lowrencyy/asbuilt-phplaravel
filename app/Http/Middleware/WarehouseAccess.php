<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Warehouse Access — subcon, warehouse, pm, project_manager, admin
 * Lineman is excluded — teardown only.
 */
class WarehouseAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowed = ['subcon', 'warehouse', 'pm', 'project_manager', 'admin'];

        if (! in_array($request->user()?->role, $allowed)) {
            return response()->json(['message' => 'Access denied. Warehouse access requires subcon, warehouse, or PM role.'], 403);
        }

        return $next($request);
    }
}
