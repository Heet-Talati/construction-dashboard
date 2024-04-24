<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/teams', function () {
        return Inertia::render('Settings/Team');
    })->name('settings.team');
});

Route::get('/help', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('help');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('project/{id}')->group(function () {

    Route::get('dashboard', function ($id) {
        if (!canSeeProject($id)) abort(404);
        // if (Project::findOrFail($id) && Project::find($id)->team_id == Auth::user()->id) {
        return Inertia::render('Project/Dashboard');
        // }
    })->name('project.dashboard');

    Route::get('tasks', function ($id) {
        if (!canSeeProject($id)) abort(404);
        // if (Project::findOrFail($id) && Project::find($id)->team_id == Auth::user()->id) {
        return Inertia::render('Project/Tasks');
        // }
    })->name('project.tasks');

    Route::get('chat', function ($id) {
        if (!canSeeProject($id)) abort(404);
        // if (Project::findOrFail($id) && Project::find($id)->team_id == Auth::user()->id) {
        return Inertia::render('Project/Chat');
        // }
    })->name('project.chat');

    Route::get('timeline', function ($id) {
        if (!canSeeProject($id)) abort(404);
        // if (Project::findOrFail($id) && Project::find($id)->team_id == Auth::user()->id) {
        return Inertia::render('Project/Timeline');
        // }
    })->name('project.timeline');

    Route::get('documents', function ($id) {
        if (!canSeeProject($id)) abort(404);
        // if (Project::findOrFail($id) && Project::find($id)->team_id == Auth::user()->id) {
        return Inertia::render('Project/Documents');
        // }
    })->name('project.documents');
});

Route::fallback(function () {
    return Inertia::render('Errors/404');
})->name('fallback.route');


// functions
function canSeeProject($id)
{
    $user = Auth::user()->id;
    $teamId = Project::find($id)->team_id;
    $members = json_decode(Team::find($teamId)->members, true);

    return (in_array($user, $members));
}

require __DIR__ . '/auth.php';
