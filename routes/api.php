<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;

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
Route::get('/project/tasks/{id}', [TaskController::class, 'projectTasks'])->middleware('auth:sanctum');

Route::post('/project/tasks/insert', [TaskController::class, 'projectTasksInsert'])->middleware('auth:sanctum')->name('project.task.create');
Route::put('/project/tasks/update', [TaskController::class, 'projectTasksUpdate'])->middleware('auth:sanctum')->name('project.task.update');
Route::delete('/project/tasks/remove', [TaskController::class, 'projectTasksDelete'])->middleware('auth:sanctum')->name('project.task.delete');

Route::put('/project/tasks/{id}', [TaskController::class, 'projectTasksUpdate'])->middleware('auth:sanctum');
// Route::put('/project/tasks/{id}/{task_id}', [TaskController::class, 'projectTasks'])->middleware('auth:sanctum');

Route::delete('/project/tasks/{id}/{task_id}', [TaskController::class, 'projectTasksDelete'])->middleware('auth:sanctum');

Route::get('/projects', [ProjectController::class, 'all'])->middleware('auth:sanctum')->name('projects.get');
Route::post('/projects', [ProjectController::class, 'insert'])->middleware('auth:sanctum')->name('projects.make');
Route::post('/teams/new', [TeamController::class, 'newTeam'])->name('teams.new');
// Route::post('/teams/new', [TeamController::class, 'newTeam'])->middleware('auth:sanctum')->name('teams.new');
Route::post('/teams/add', [TeamController::class, 'addMember'])->middleware('auth:sanctum')->name('member.add');
Route::post('/teams/remove', [TeamController::class, 'removeMember'])->middleware('auth:sanctum')->name('member.remove');
Route::get('/teams', [TeamController::class, 'all'])->middleware('auth:sanctum')->name('teams.get');

Route::post('/message/send', [ChatController::class, 'submitMessage'])->middleware('auth:sanctum')->name('message.submit');
Route::post('/message/get', [ChatController::class, 'mount'])->middleware('auth:sanctum')->name('message.get');
