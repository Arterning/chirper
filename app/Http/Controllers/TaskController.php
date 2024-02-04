<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{


    private TaskService $taskService;
 
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }



    public function all() {
        return Task::all();
    }

    public function index(Request $request)
    {
        return $this->taskService->pageQuery($request);
    }

    public function store(Request $request)
    {
        return Task::create($request->all());
    }

    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->all());
        return $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}