<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function submitMessage(Request $req)
    {
        MessageEvent::dispatch(Auth::user()->id, $req->msg, $req->project_id);
        return response()->json(['message' => 'done']);
    }

    public function mount(Request $req)
    {
        $current_user = Auth::user()->id;

        $messages = Message::where('project_id', $req->project_id)
            ->join('users', 'messages.user_id', '=', 'users.id')
            ->select('users.name as username', 'messages.message')
            ->selectRaw("CASE WHEN messages.user_id = $current_user THEN 1 ELSE 0 END as current")
            ->get();


        return response()->json($messages);
    }
}
