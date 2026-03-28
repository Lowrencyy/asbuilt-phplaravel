<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsBuilt\AuthController;
use App\Http\Controllers\AsBuilt\NodeController;
use App\Http\Controllers\AsBuilt\PoleController;
use App\Http\Controllers\AsBuilt\SpanController;

Route::prefix('asbuilt/v1')->group(function () {

    // ─── Public: Auth ─────────────────────────────────────────────────────────
    Route::post('/login', [AuthController::class, 'login']);

    // ─── Protected: Sanctum + project manager role ────────────────────────────
    Route::middleware(['auth:sanctum', 'asbuilt'])->group(function () {

        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me',     [AuthController::class, 'me']);

        // ── Projects (read only — projects are managed from web admin) ─────────
        Route::get('/projects', fn () => response()->json(
            \App\Models\Project::orderBy('name')->get(['id', 'name', 'status'])
        ));

        // ── Nodes ──────────────────────────────────────────────────────────────
        Route::get( '/projects/{project}/nodes',      [NodeController::class, 'index']);
        Route::post('/projects/{project}/nodes',      [NodeController::class, 'store']);
        Route::post('/projects/{project}/nodes/bulk', [NodeController::class, 'bulkStore']);
        Route::get( '/projects/{project}/nodes/{node}', [NodeController::class, 'show']);

        // ── Poles ──────────────────────────────────────────────────────────────
        Route::get( '/nodes/{node}/poles',      [PoleController::class, 'index']);
        Route::post('/nodes/{node}/poles',      [PoleController::class, 'store']);
        Route::post('/nodes/{node}/poles/bulk', [PoleController::class, 'bulkStore']);

        // ── Spans ──────────────────────────────────────────────────────────────
        Route::get( '/nodes/{node}/spans',      [SpanController::class, 'index']);
        Route::post('/nodes/{node}/spans',      [SpanController::class, 'store']);
        Route::post('/nodes/{node}/spans/bulk', [SpanController::class, 'bulkStore']);

        // ── Span status sync (for AsBuilt IQ map coloring) ────────────────────
        Route::post('/spans/status', [SpanController::class, 'statusBulk']);
    });
});
