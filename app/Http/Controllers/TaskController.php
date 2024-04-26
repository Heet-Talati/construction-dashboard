<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function dataSource()
    {
        $current_user = Auth::user()->id;
        $tasks = Task::where('user_id', $current_user)->get();
        return response()->json($tasks);
    }

    public function getStatusWordCounts()
    {
        $current_user = Auth::user()->id;

        $tasks = Task::where('user_id', $current_user)->get();

        $statusCounts = [
            'Open' => 0,
            'Review' => 0,
            'Done' => 0,
            'InProgress' => 0
        ];

        foreach ($tasks as $task) {
            foreach ($statusCounts as $word => $count) {
                if (strpos(strtolower($task->Status), strtolower($word)) !== false) {
                    $statusCounts[$word]++;
                }
            }
        }

        return response()->json($statusCounts);
    }


    public function projectTasks($id)
    {
        // $current_user = Auth::user()->id;
        $tasks = Task::where('project_id', $id)->get();
        // ->where('user_id', $current_user)->get();
        return response()->json($tasks);
    }

    public function projectTasksInsert(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'Status' => 'required',
                'Summary' => 'required',
                'project_id' => 'required',
                'task_id' => 'required',
            ]);

            $task = new Task();
            $task->Status = $validatedData['Status'];
            $task->Summary = $validatedData['Summary'];
            $task->project_id = $validatedData['project_id'];
            $task->task_id = $validatedData['task_id'];
            $task->user_id = Auth::user()->id;
            $task->save();

            return response()->json($task);
        } catch (\Exception $e) {
            // return response()->json(['error' => 'Internal Server Error'], 500);
            // return response()->json();
        }
    }

    public function projectTasksUpdate($task_id, Request $request)
    {
        $task = Task::find($request->id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $task->Status = $request->input('Status');
        $task->Summary = $request->input('Summary');
        $task->save();

        return response()->json($task);
    }

    public function projectTasksDelete($task_id)
    {
        $task = Task::find($task_id);
        $task->forceDelete();
    }

    public function insert(Request $request)
    {
        $validatedData = $request->validate([
            'Status' => 'required',
            'Summary' => 'required',
            'task_id' => 'required',
        ]);

        $task = new Task();
        $task->Status = $validatedData['Status'];
        $task->Summary = $validatedData['Summary'];
        $task->task_id = $validatedData['task_id'];
        $task->user_id = Auth::user()->id;
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
