<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function all()
    {
        $projects = Project::all();
        return response()->json($projects);
    }
}
