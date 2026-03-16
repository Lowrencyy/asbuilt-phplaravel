<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || auth()->user()->role !== \App\Models\User::ROLE_ADMIN) {
            abort(403, 'Unauthorized.');
        }
        return $next($request);
    }
}
