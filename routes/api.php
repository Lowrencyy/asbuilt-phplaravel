<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\NodeController;
use App\Http\Controllers\Api\PoleController;
use App\Http\Controllers\Api\TeardownLogController;
use App\Http\Controllers\Api\TeardownImageController;
use App\Http\Controllers\Api\TeardownSubmissionController;

Route::prefix('v1')->group(function () {

    // ─── Public: Auth ────────────────────────────────────────────
    Route::post('/login', [AuthController::class, 'login']);

    // ─── Protected: require Sanctum token ────────────────────────
    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);

        // Projects
        Route::get('/projects', [ProjectController::class, 'index']);
        Route::get('/projects/{project}', [ProjectController::class, 'show']);

        // Nodes
        Route::get('/nodes', [NodeController::class, 'index']);
        Route::get('/nodes/{node}', [NodeController::class, 'show']);
        Route::get('/nodes/{node}/poles', [NodeController::class, 'poles']);
        Route::get('/nodes/{node}/spans', [NodeController::class, 'spans']);

        // Poles
        Route::get('/poles/{pole}', [PoleController::class, 'show']);
        Route::get('/poles/{pole}/spans', [PoleController::class, 'spans']);
        Route::post('/poles/{pole}/gps', [PoleController::class, 'updateGps']);

        // Teardown Logs — read: any authenticated user | write: lineman/admin/pm only
        Route::get('/teardown-logs', [TeardownLogController::class, 'index']);
        Route::get('/teardown-logs/{teardownLog}', [TeardownLogController::class, 'show']);
        Route::post('/teardown-logs', [TeardownLogController::class, 'store'])->middleware('lineman');
        Route::post('/teardown-logs/{teardownLog}/images', [TeardownImageController::class, 'store'])->middleware('lineman');

        // Teardown Submissions
        Route::get('/teardown-submissions', [TeardownSubmissionController::class, 'index']);
        Route::get('/teardown-submissions/{teardownSubmission}', [TeardownSubmissionController::class, 'show']);
        Route::get('/teardown-submissions/{teardownSubmission}/remarks', [TeardownSubmissionController::class, 'remarks']);
    });
});
