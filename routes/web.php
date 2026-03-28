<?php

use App\Http\Controllers\Admin\NodeController as AdminNodeController;
use App\Http\Controllers\Admin\PoleController as AdminPoleController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SpanController;
use App\Http\Controllers\Admin\SubcontractorController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\WarehousePortalController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

// ── Authenticated routes ──────────────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // ── Pole GPS Planner ──────────────────────────────────────────────────────
    Route::prefix('planner')->name('planner.')->group(function () {
        Route::get('/',                              [\App\Http\Controllers\PoleGpsController::class, 'index'])->name('index');
        Route::get('/nodes/{node}',                  [\App\Http\Controllers\PoleGpsController::class, 'node'])->name('node');
        Route::post('/poles/{pole}/gps',             [\App\Http\Controllers\PoleGpsController::class, 'updateGps'])->name('poles.gps');
    });
    Route::resource('teams', TeamController::class);

    // ── Daily Reports ─────────────────────────────────────────────────────────
    Route::middleware('pm')->prefix('reports')->name('reports.')->group(function () {
        Route::get('/',                                        [DailyReportController::class, 'index'])->name('index');
        Route::get('/export',                                  [DailyReportController::class, 'export'])->name('export');
        Route::get('/live-teardown-feed',                      [DailyReportController::class, 'liveTeardownFeed'])->name('live-teardown-feed');
        Route::get('/new-submissions-count',                   [DailyReportController::class, 'newSubmissionsCount'])->name('new-submissions-count');
        Route::get('/teardown-logs',                           [DailyReportController::class, 'teardownLogs'])->name('teardown-logs.index');
        Route::get('/teardown-logs/{teardownLog}',             [DailyReportController::class, 'showLog'])->name('teardown-log.show');
        Route::get('/{submission}',                            [DailyReportController::class, 'show'])->name('show');
        Route::post('/{submission}/approve',                   [DailyReportController::class, 'approve'])->name('approve');
        Route::post('/{submission}/reject',                    [DailyReportController::class, 'reject'])->name('reject');
        Route::post('/{submission}/mark-delivery',             [DailyReportController::class, 'markDelivery'])->name('mark-delivery');
    });

    // ── PM Projects & Nodes ───────────────────────────────────────────────────
    Route::middleware('pm')->prefix('pm')->name('pm.')->group(function () {
        Route::get('/projects',              [ProjectController::class, 'index'])->name('projects.index');
        Route::post('/projects',             [ProjectController::class, 'store'])->name('projects.store');
        Route::post('/projects/{project}',   [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

        Route::get('/projects/{project}/nodes',               [AdminNodeController::class, 'index'])->name('projects.nodes.index');
        Route::post('/projects/{project}/nodes',              [AdminNodeController::class, 'store'])->name('projects.nodes.store');
        Route::post('/projects/{project}/nodes/{node}',       [AdminNodeController::class, 'update'])->name('projects.nodes.update');
        Route::delete('/projects/{project}/nodes/{node}',     [AdminNodeController::class, 'destroy'])->name('projects.nodes.destroy');

        Route::get('/projects/{project}/nodes/{node}/poles',               [AdminPoleController::class, 'index'])->name('projects.nodes.poles.index');
        Route::post('/projects/{project}/nodes/{node}/poles',              [AdminPoleController::class, 'store'])->name('projects.nodes.poles.store');
        Route::post('/projects/{project}/nodes/{node}/poles/{pole}',       [AdminPoleController::class, 'update'])->name('projects.nodes.poles.update');
        Route::delete('/projects/{project}/nodes/{node}/poles/{pole}',     [AdminPoleController::class, 'destroy'])->name('projects.nodes.poles.destroy');
    });


    // ── Subcon portal ─────────────────────────────────────────────────────────
    Route::get('/subcon/pm',              fn () => view('dashboard'))->name('subcon.pm.index');
    Route::get('/subcon/pm/{id}',         fn () => view('dashboard'))->name('subcon.pm.show');
    Route::get('/subcon/lineman/nodes',   fn () => view('dashboard'))->name('subcon.lineman.nodes');
    Route::get('/subcon/lineman/report',  fn () => view('dashboard'))->name('subcon.lineman.report');
    Route::get('/subcon/lineman/pole-report', fn () => view('dashboard'))->name('subcon.lineman.pole.report');

    // ── Warehouse portal ──────────────────────────────────────────────────────
    Route::prefix('warehouse')->name('warehouse.')->group(function () {
        Route::get('/',                                        [WarehousePortalController::class, 'dashboard'])->name('dashboard');
        Route::get('/transmittals',                            [WarehousePortalController::class, 'transmittals'])->name('transmittals.index');
        Route::post('/transmittals',                           [WarehousePortalController::class, 'storeTransmittal'])->name('transmittals.store');
        Route::post('/transmittals/{transmittal}/approve',     [WarehousePortalController::class, 'approveTransmittal'])->name('transmittals.approve');
        Route::post('/transmittals/{transmittal}/reject',      [WarehousePortalController::class, 'rejectTransmittal'])->name('transmittals.reject');
        Route::get('/deliveries',                              [WarehousePortalController::class, 'deliveries'])->name('deliveries.index');
        Route::post('/warehouses',                                            [WarehousePortalController::class, 'warehouseStore'])->name('warehouses.store');
        Route::get('/inventory',                                              [WarehousePortalController::class, 'inventory'])->name('inventory.index');
        Route::post('/inventory/adjust',                                      [WarehousePortalController::class, 'adjustStock'])->name('inventory.adjust');
        Route::get('/inventory/{warehouse}',                                  [WarehousePortalController::class, 'warehouseShow'])->name('inventory.show');
        Route::post('/receipts/{receipt}/receive',                            [WarehousePortalController::class, 'receiveReceipt'])->name('receipts.receive');
        Route::post('/receipts/{receipt}/proof',                              [WarehousePortalController::class, 'receiptProof'])->name('receipts.proof');
        Route::post('/inventory/{warehouse}/incharge',                        [WarehousePortalController::class, 'assignIncharge'])->name('inventory.incharge.assign');
        Route::delete('/inventory/{warehouse}/incharge/{user}',               [WarehousePortalController::class, 'removeIncharge'])->name('inventory.incharge.remove');
        Route::post('/inventory/{warehouse}/items',                           [WarehousePortalController::class, 'stockStore'])->name('inventory.items.store');
        Route::post('/inventory/{warehouse}/items/{stock}/adjust',            [WarehousePortalController::class, 'stockUpdate'])->name('inventory.items.update');
        Route::delete('/inventory/{warehouse}/items/{stock}',                 [WarehousePortalController::class, 'stockDestroy'])->name('inventory.items.destroy');
    });

    // ── Admin-only routes ─────────────────────────────────────────────────────
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    

      Route::prefix('projects/{project}/nodes/{node}/spans')->name('projects.nodes.spans.')->group(function () {
        Route::get('/create',      [SpanController::class, 'create'])->name('create');
        Route::post('/',           [SpanController::class, 'store'])->name('store');
        Route::post('/{span}',     [SpanController::class, 'update'])->name('update');
        Route::delete('/{span}',   [SpanController::class, 'destroy'])->name('destroy');
    });


   
    


        // Internal employees (non-subcon)
        Route::get('/users',                          [AdminUserController::class, 'index'])->name('users.index');
        Route::post('/users',                         [AdminUserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}',                   [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}',                [AdminUserController::class, 'destroy'])->name('users.destroy');
        Route::patch('/users/{user}/reset-password',  [AdminUserController::class, 'resetPassword'])->name('users.reset-password');

        // Subcontractor companies
        Route::get('/subcons',                        [SubcontractorController::class, 'index'])->name('subcons.index');
        Route::post('/subcons',                       [SubcontractorController::class, 'store'])->name('subcons.store');
        Route::get('/subcons/{subcon}',               [SubcontractorController::class, 'show'])->name('subcons.show');
        Route::post('/subcons/{subcon}',              [SubcontractorController::class, 'update'])->name('subcons.update');
        Route::delete('/subcons/{subcon}',            [SubcontractorController::class, 'destroy'])->name('subcons.destroy');

        // Subcon members (lineman/pm)
        Route::post('/subcons/{subcon}/members',                    [SubcontractorController::class, 'storeMember'])->name('subcons.members.store');
        Route::delete('/subcons/members/{user}',                    [SubcontractorController::class, 'destroyMember'])->name('subcons.members.destroy');

        // Subcon teams
        Route::post('/subcons/{subcon}/teams',                      [SubcontractorController::class, 'storeTeam'])->name('subcons.teams.store');
        Route::delete('/subcons/teams/{team}',                      [SubcontractorController::class, 'destroyTeam'])->name('subcons.teams.destroy');
        Route::post('/subcons/teams/{team}/members',                [SubcontractorController::class, 'assignTeamMember'])->name('subcons.teams.members.assign');
        Route::delete('/subcons/teams/{team}/members/{user}',       [SubcontractorController::class, 'removeTeamMember'])->name('subcons.teams.members.remove');

        // Projects
        Route::get('/projects',              [ProjectController::class, 'index'])->name('projects.index');
        Route::post('/projects',             [ProjectController::class, 'store'])->name('projects.store');
        Route::post('/projects/{project}',   [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

        // Nodes (under a project)
        Route::get('/projects/{project}/nodes',               [AdminNodeController::class, 'index'])->name('projects.nodes.index');
        Route::post('/projects/{project}/nodes',              [AdminNodeController::class, 'store'])->name('projects.nodes.store');
        Route::post('/projects/{project}/nodes/{node}',       [AdminNodeController::class, 'update'])->name('projects.nodes.update');
        Route::delete('/projects/{project}/nodes/{node}',     [AdminNodeController::class, 'destroy'])->name('projects.nodes.destroy');

        // Poles (under a node)
        Route::get('/projects/{project}/nodes/{node}/poles',               [AdminPoleController::class, 'index'])->name('projects.nodes.poles.index');
        Route::post('/projects/{project}/nodes/{node}/poles',              [AdminPoleController::class, 'store'])->name('projects.nodes.poles.store');
        Route::post('/projects/{project}/nodes/{node}/poles/{pole}',       [AdminPoleController::class, 'update'])->name('projects.nodes.poles.update');
        Route::delete('/projects/{project}/nodes/{node}/poles/{pole}',     [AdminPoleController::class, 'destroy'])->name('projects.nodes.poles.destroy');


        

        // Warehouses
        Route::get('/warehouses', [WarehousePortalController::class, 'warehouseCreate'])->name('warehouses.index');
    });
});

require __DIR__.'/settings.php';
