<?php

namespace App\Repositories\Eloquent;

use App\Repositories\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class TaskRepository extends Repository  implements TaskRepositoryInterface
{

    protected Model $model;

    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function getTasks()
    {
        return $this->model::query()
            ->whereHas('project',function($q){
                $q->where('user_id',auth()->id());
            })
            ->when(request()->project_id, function ($q) {
                $q->where('project_id', request()->project_id);
            })
            ->when(request()->status, function ($q) {
                $q->where('status', request()->status);
            })
            ->when(request()->priority, function ($q) {
                $q->where('priority', request()->priority);
            })
            ->when(request()->search, function ($q) {
                $q->where('title', 'like', '%' . request()->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }
}
