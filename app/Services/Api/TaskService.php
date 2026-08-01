<?php

namespace App\Services\Api;

use App\Http\Traits\Responser;
use App\Http\Resources\Api\TaskResource;
use App\Http\Resources\Api\TaskCollection;
use Illuminate\Support\Facades\DB;
use App\Repositories\TaskRepositoryInterface;

class TaskService
{
    use Responser;

    public function __construct(private readonly TaskRepositoryInterface $taskRepository)
    {
    }

    public function index()
    {
        $tasks = $this->taskRepository->getTasks();
        return $this->responseSuccess( message: '' , data: new TaskCollection($tasks));
    }

    public function store($request)
    {
        try
        {
            $data = $request->validated();
            $task = $this->taskRepository->create($data);
            return $this->responseSuccess(message: 'Task added Successfully',data: new TaskResource($task));
        }
        catch (Exception $e)
        {
            return $this->responseFail(message: 'Something went wrong');
        }
    }

    public function show($id)
    {
        $task = $this->taskRepository->find($id);
        return $this->responseSuccess(message: '',data: new TaskResource($task));
    }

    public function update($id,$request)
    {
        try
        {
            $data = $request->validated();
            $task = $this->taskRepository->update($id,$data);
            return $this->responseSuccess(message: 'Task updated Successfully',data: new TaskResource($task));
        }
        catch (Exception $e)
        {
            return $this->responseFail(message: 'Something went wrong');
        }
    }

    public function destroy($id)
    {
        try
        {
            $this->taskRepository->delete($id);
            return $this->responseSuccess(message: 'Task deleted Successfully',data: '');
        }
        catch (Exception $e)
        {
            return $this->responseFail(message: 'Something went wrong');
        }
    }
}
