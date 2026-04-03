<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\NodeController;
use App\Http\Controllers\Api\SubconController;
use App\Http\Controllers\Api\PoleController;
use App\Http\Controllers\Api\TeardownLogController;
use App\Http\Controllers\Api\TeardownImageController;
use App\Http\Controllers\Api\TeardownSubmissionController;
use App\Http\Controllers\Api\PoleSequenceController;
use App\Http\Controllers\Api\TransmittalController;
use App\Http\Controllers\Api\DeliveryController;
use App\Http\Controllers\Api\BulkUploadController;

// ─── Public: File proxy (serves storage files via API to bypass symlink issues) ──
Route::get('/files/{path}', function (string $path) {
    // Use Storage::disk('public') so this works regardless of whether
    // `php artisan storage:link` has been run. The disk root matches
    // where ImageProcessingService actually writes the files.
    if (! \Storage::disk('public')->exists($path)) {
        abort(404);
    }
    $fullPath = \Storage::disk('public')->path($path);
    return response()->file($fullPath);
})->where('path', '.*');

Route::prefix('v1')->group(function () {

    // ─── Public: App status (maintenance mode check) ─────────────
    Route::get('/status', function () {
        return response()->json([
            'maintenance' => (bool) env('APP_DOWN', false),
            'message'     => env('APP_DOWN_MESSAGE', 'The app is currently under maintenance. We\'ll be back shortly.'),
        ]);
    });

    // ─── Public: Auth ────────────────────────────────────────────
    Route::post('/login', [AuthController::class, 'login']);

    // ─── Protected: require Sanctum token ────────────────────────
    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);

        // Subcons — teams & employees (for mobile app)
        Route::get('/subcons/{subcon}/teams',         [SubconController::class, 'teams']);
        Route::get('/subcons/{subcon}/employees',     [SubconController::class, 'employees']);
        Route::post('/teams',                         [SubconController::class, 'storeTeam']);
        Route::post('/teams/{team}/employees',        [SubconController::class, 'assignEmployee']);

        // Projects
        Route::get('/projects', [ProjectController::class, 'index']);
        Route::get('/projects/{project}', [ProjectController::class, 'show']);

        // Nodes
        Route::get('/nodes', [NodeController::class, 'index']);
        Route::get('/nodes/{node}', [NodeController::class, 'show']);
        Route::get('/nodes/{node}/poles', [NodeController::class, 'poles']);
        Route::get('/nodes/{node}/spans', [NodeController::class, 'spans']);

        // ─── Planner app: project_manager, admin, executives only ────────────
        Route::middleware('planner')->group(function () {
            Route::post('/nodes',        [NodeController::class, 'store']);
            Route::post('/poles',        [PoleController::class, 'store']);
            Route::post('/pole-spans',   [\App\Http\Controllers\Api\PoleSpanController::class, 'store']);
            Route::post('/bulk-upload',  [BulkUploadController::class, 'store']);
        });

        // Daily pole sequence — read: any auth user | write/delete: pm/admin only
        Route::get('/nodes/{node}/sequence', [PoleSequenceController::class, 'index']);
        Route::post('/nodes/{node}/sequence', [PoleSequenceController::class, 'store']);
        Route::delete('/nodes/{node}/sequence', [PoleSequenceController::class, 'destroy']);

        // Poles
        Route::get('/poles', [PoleController::class, 'index']);
        Route::get('/poles/{pole}', [PoleController::class, 'show']);
        Route::get('/poles/{pole}/spans', [PoleController::class, 'spans']);
        Route::post('/poles/{pole}/gps',     [PoleController::class, 'updateGps']);
        Route::post('/poles/{pole}/sitemap', [PoleController::class, 'updateSitemap']);
        Route::post('/poles/{pole}/teardown', [PoleController::class, 'completeTeardown'])->middleware('lineman');

        // Pole Spans search
        Route::get('/pole-spans', [\App\Http\Controllers\Api\PoleSpanController::class, 'index']);

        // Lineman live locations
        Route::get('/lineman-locations',  [\App\Http\Controllers\Api\LinemanLocationController::class, 'index']);
        Route::post('/lineman-location',  [\App\Http\Controllers\Api\LinemanLocationController::class, 'ping']);

        // Teardown Logs — read: any authenticated user | write: lineman/admin/pm only
        Route::get('/teardown-logs', [TeardownLogController::class, 'index']);
        Route::get('/teardown-logs/{teardownLog}', [TeardownLogController::class, 'show']);
        Route::post('/teardown-logs', [TeardownLogController::class, 'store'])->middleware('lineman');
        Route::post('/teardown-logs/{teardownLog}/images', [TeardownImageController::class, 'store'])->middleware('lineman');

        // Teardown Submissions (Daily Reports)
        Route::get('/teardown-submissions/autofill', [TeardownSubmissionController::class, 'autoFill']);
        Route::get('/teardown-submissions', [TeardownSubmissionController::class, 'index']);
        Route::post('/teardown-submissions', [TeardownSubmissionController::class, 'store']);
        Route::get('/teardown-submissions/{teardownSubmission}', [TeardownSubmissionController::class, 'show']);
        Route::post('/teardown-submissions/{teardownSubmission}/submit', [TeardownSubmissionController::class, 'submit']);
        Route::get('/teardown-submissions/{teardownSubmission}/remarks', [TeardownSubmissionController::class, 'remarks']);

        // Transmittals — view: all warehouse roles | create: warehouse+subcon+pm | approve/reject: pm only
        Route::middleware('warehouse')->group(function () {
            Route::get('/transmittals',                        [TransmittalController::class, 'index']);
            Route::get('/transmittals/{transmittal}',          [TransmittalController::class, 'show']);
            Route::post('/transmittals',                       [TransmittalController::class, 'store']);
        });
        Route::middleware('pm')->group(function () {
            Route::post('/transmittals/{transmittal}/approve', [TransmittalController::class, 'approve']);
            Route::post('/transmittals/{transmittal}/reject',  [TransmittalController::class, 'reject']);
        });

        // Deliveries — view: all warehouse roles | depart/arrive/ping: subcon+warehouse | receive: warehouse only
        Route::middleware('warehouse')->group(function () {
            Route::get('/deliveries',                          [DeliveryController::class, 'index']);
            Route::get('/deliveries/{delivery}',               [DeliveryController::class, 'show']);
            Route::get('/deliveries/{delivery}/location',      [DeliveryController::class, 'location']);
            Route::post('/deliveries/{delivery}/depart',       [DeliveryController::class, 'depart']);
            Route::post('/deliveries/{delivery}/ping-location',[DeliveryController::class, 'pingLocation']);
            Route::post('/deliveries/{delivery}/arrive',       [DeliveryController::class, 'arrive']);
            Route::post('/deliveries/{delivery}/receive',      [DeliveryController::class, 'receive']);
        });
    });
});
