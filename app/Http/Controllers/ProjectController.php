<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function all()
    {
        $current_user = Auth::user()->id;
        // $projects = Project::where('team_id', $current_user)->get();
        $teams = Team::whereJsonContains('members', $current_user)->pluck('id');
        $projects = Project::whereIn('team_id', $teams)->get();

        return response()->json($projects);
    }

    public function insert(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'project_id' => 'required',
        ]);

        $task = new Project();
        $task->name = $validatedData['name'];
        $task->team_id = $validatedData['project_id'];
        $task->save();

        return response()->json($task);
    }
}
