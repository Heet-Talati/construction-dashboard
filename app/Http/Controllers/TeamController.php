<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
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

    public function newTeam(Request $req)
    {
        $current_user = Auth::user()->id;

        $team = new Team();
        $team->name = $req->name;
        $team->members = json_encode([$current_user]);
        $team->save();

        return response()->json(['message' => 'New team has been added.'], 200);
        // return response()->json(['message' => $team]);
    }

    public function addMember(Request $req)
    {
        $current_user = Auth::user()->id;
        $user = User::where('email', $req->email)->first()->id;
        $team_id = $req->team;
        $team = Team::find($team_id);

        if ($user == $current_user) {
            return response()->json(['error' => 'You cannot add yourself in the team again'], 400);
        }

        if ($team && $user) {
            $members = json_decode($team->members, true);

            if (!in_array($user, $members)) {
                $members[] = $user;
                $team->members = json_encode($members);
                $team->save();
            } else {

                return response()->json(['error' => 'User is already in the team'], 400);
            }
        } else {
            return response()->json(['error' => 'Missing details, fill the form'], 400);
        }
        return response()->json(['message' => 'User has been added to the team'], 200);
    }

    public function removeMember(Request $req)
    {
        $user = Auth::user()->id;
        $team_id = $req->id;
        $team = Team::find($team_id);


        if ($team) {
            $members = json_decode($team->members, true);
            $key = array_search($user, $members);

            if (sizeof($members) == 1) return response()->json(['error' => 'You are the only team member'], 400);

            if (in_array($user, $members)) {
                unset($members[$key]);
                $members = array_values($members);
                $team->members = json_encode($members);
                $team->save();
            } else {

                return response()->json(['error' => 'User is not in the team'], 400);
            }
        } else {
            return response()->json(['error' => 'Team does not exist'], 400);
        }
        return response()->json(['message' => "$key has been removed from the team"], 200);
    }
}
