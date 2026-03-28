<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            \Illuminate\Support\Facades\Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/asbuilt.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');
        $middleware->append(\App\Http\Middleware\AddServerTimeHeader::class);
        $middleware->alias([
            'lineman'   => \App\Http\Middleware\LinemanOnly::class,
            'admin'     => \App\Http\Middleware\AdminOnly::class,
            'asbuilt'   => \App\Http\Middleware\AsBuiltOnly::class,
            'warehouse' => \App\Http\Middleware\WarehouseAccess::class,
            'pm'        => \App\Http\Middleware\PmAccess::class,
            'planner'   => \App\Http\Middleware\PlannerAccess::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

    
