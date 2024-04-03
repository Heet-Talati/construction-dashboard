<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks')->middleware('auth');
// Route::get('/tasks', [TaskController::class, 'store']);

// Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/tasks', [TaskController::class, 'index'])->name('tasks ');
    //     Route::post('/tasks', [TaskController::class, 'store']);
    //     Route::put('/tasks/{task}', [TaskController::class, 'update']);
    //     Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
// });
