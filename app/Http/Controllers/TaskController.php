<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function dataSource()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function insert(Request $request)
    {
        $task = new Task();
        $task->Status = $request->input('Status');
        $task->Summary = $request->input('Summary');
        $task->save();

        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $task->Status = $request->input('Status');
        $task->Summary = $request->input('Summary');
        $task->save();

        return response()->json($task);
    }

    public function delete($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
