<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function all()
    {
        $current_user = Auth::user()->id;
        $teams = Team::all();

        $filteredTeams = [];

        foreach ($teams as $team) {
            $members = json_decode($team->members);

            if (in_array($current_user, $members)) {
                $filteredTeams[] = [
                    'id' => $team->id,
                    'name' => $team->name,
                ];;
            }
        }

        return response()->json($filteredTeams);
    }
}
