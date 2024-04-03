<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $tasks = Task::where('user_id', $user->id)->get(['Id', 'Status', 'Summary']);

        return response()->json($tasks, 200);
    }

    // public function store(Request $request)
    // {
    //     $task = new Task();
    //     $task->user_id = auth()->id();
    //     $task->project_id = $request->project_id;
    //     $task->task_id = $request->task_id;
    //     $task->Status = $request->Status;
    //     $task->Summary = $request->Summary;
    //     $task->save();

    //     return $task;
    // }

    // public function update(Request $request, Task $task)
    // {
    //     $task->update($request->all());
    //     return $task;
    // }

    // public function destroy(Task $task)
    // {
    //     $task->delete();
    //     return response()->noContent();
    // }
}
