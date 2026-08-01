<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\TaskRequest;
use Illuminate\Http\Request;
use App\Services\Api\TaskService;

class TaskController extends Controller
{
    public function __construct(private readonly TaskService $task)
    {
    }

    public function index()
    {
        return $this->task->index();
    }

    public function store(TaskRequest $request)
    {
        return $this->task->store($request);
    }

    public function show($id)
    {
        return $this->task->show($id);
    }

    public function update($id,TaskRequest $request)
    {
        return $this->task->update($id,$request);
    }

    public function destroy($id)
    {
        return $this->task->destroy($id);
    }
}
