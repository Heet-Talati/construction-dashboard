<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tasks', function () {
    return Inertia::render('Tasks');
})->middleware(['auth', 'verified'])->name('tasks');

Route::get('/chat', function () {
    return Inertia::render('Chat');
})->middleware(['auth', 'verified'])->name('chat');

Route::get('/settings', function () {
    return Redirect::to('settings/profile');
})->middleware(['auth', 'verified'])->name('settings');

Route::prefix('/settings')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', function () {
        return Inertia::render('Settings/Profile');
    })->name('settings');
});

Route::get('/help', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('help');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('project/{id}')->group(function () {

    Route::get('dashboard', function ($id) {
        return Inertia::render('Project/Dashboard');
        // return '<h1>Project ' . $id . ' works!!</h1>';
    })->name('project.dashboard');

    Route::get('tasks', function ($id) {
        return Inertia::render('Project/Dashboard');
        // return '<h1>Project ' . $id . ' works!!</h1>';
    })->name('project.tasks');

    Route::get('chat', function ($id) {
        return Inertia::render('Project/Dashboard');
        // return '<h1>Project ' . $id . ' works!!</h1>';
    })->name('project.chat');

    Route::get('timeline', function ($id) {
        return Inertia::render('Project/Dashboard');
        // return '<h1>Project ' . $id . ' works!!</h1>';
    })->name('project.timeline');

    Route::get('documents', function ($id) {
        return Inertia::render('Project/Dashboard');
        // return '<h1>Project ' . $id . ' works!!</h1>';
    })->name('project.documents');
});

Route::fallback(function () {
    return Inertia::render('Errors/404');
});


require __DIR__ . '/auth.php';
