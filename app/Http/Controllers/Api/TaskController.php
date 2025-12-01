<?php

namespace App\Http\Controllers\Api;

use App\Enums\TaskStatusEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskAddRequest;
use App\Http\Requests\Api\TaskEditRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', $request->user()->id)->get();

        return $tasks->toJson();
    }

    /**
     * Display the task resource.
     */
    public function show(Request $request, string $uuid)
    {
        $task = Task::where('user_id', $request->user()->id)
            ->where('uuid', $uuid)
            ->firstOrFail();

        return $task;
    }

     /**
     * Store a newly created task in storage.
     */
    public function store(TaskAddRequest $request)
    {
        $user = $request->user();
        $taskData = $request->only('title', 'content', 'category_id', 'expired_at');
        $taskData['user_id'] = $user->id;
        $taskData['status'] = TaskStatusEnum::OPEN;
 
        $task = Task::create($taskData);
        
        return $task;
    }

    /**
     * Update the task in storage.
     */
    public function update(TaskEditRequest $request, string $uuid)
    {
        $user = $request->user();
        $updateTaskData = array_filter($request->only('title', 'content', 'status', 'category_id', 'expired_at'));

        $task = Task::where('user_id', $request->user()->id)
            ->where('uuid', $uuid)
            ->firstOrFail();

        $task->update($updateTaskData);
        
        return $task;
    }

    /**
     * Remove the task from storage.
     */
    public function destroy(Request $request, string $uuid)
    {
        $task = Task::where('user_id', $request->user()->id)
            ->where('uuid', $uuid)
            ->firstOrFail();

        $task->delete();

        return response('Ok', 200);
    }
}
