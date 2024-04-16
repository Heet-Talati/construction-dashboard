<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/tasks', [TaskController::class, 'index'])->name('tasks')->middleware('auth');
// Route::get('/tasks', [TaskController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
    // Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.create');
    // Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    // Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.delete');
    Route::get('/tasks', [TaskController::class, 'dataSource']);
    Route::post('/tasks', [TaskController::class, 'insert'])->name('tasks.create');
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'delete']);
});

Route::get('/projects', [ProjectController::class, 'all'])->middleware('auth:sanctum')->name('projects.get');
