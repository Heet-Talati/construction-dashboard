<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function all()
    {
        $current_user = Auth::user()->id;
        $projects = Project::where('team_id', $current_user)->get();
        return response()->json($projects);
    }
}
