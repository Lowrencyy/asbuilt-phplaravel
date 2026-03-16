<?php

use App\Http\Controllers\Admin\NodeController as AdminNodeController;
use App\Http\Controllers\Admin\PoleController as AdminPoleController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SpanController;
use App\Http\Controllers\Admin\SubcontractorController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\TeamController;
use App\Models\WarehouseReceipt;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

// ── Authenticated routes ──────────────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {

    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::resource('teams', TeamController::class);

    // ── Reports (stub) ────────────────────────────────────────────────────────
    Route::get('/reports', fn () => view('dashboard'))->name('exec.reports.index');


    // ── Subcon portal ─────────────────────────────────────────────────────────
    Route::get('/subcon/pm',              fn () => view('dashboard'))->name('subcon.pm.index');
    Route::get('/subcon/pm/{id}',         fn () => view('dashboard'))->name('subcon.pm.show');
    Route::get('/subcon/lineman/nodes',   fn () => view('dashboard'))->name('subcon.lineman.nodes');
    Route::get('/subcon/lineman/report',  fn () => view('dashboard'))->name('subcon.lineman.report');
    Route::get('/subcon/lineman/pole-report', fn () => view('dashboard'))->name('subcon.lineman.pole.report');

    // ── Warehouse (stub) ──────────────────────────────────────────────────────
    Route::get('/warehouse',          fn () => view('dashboard'))->name('warehouse.dashboard');
    Route::get('/warehouse/requests', fn () => view('dashboard'))->name('warehouse.requests.index');

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
        Route::post('/subcons/{subcon}/members',      [SubcontractorController::class, 'storeMember'])->name('subcons.members.store');
        Route::delete('/subcons/members/{user}',      [SubcontractorController::class, 'destroyMember'])->name('subcons.members.destroy');

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


        

        // Warehouses (stub)
        Route::get('/warehouses', fn () => view('dashboard'))->name('warehouses.index');
    });
});

require __DIR__.'/settings.php';
