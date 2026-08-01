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

    public function getTasks(bool $count = false)
    {
        $query = $this->model::query()
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
            });
            return $count ? $query->count() : $query->orderBy('created_at', 'desc')->paginate(20);
    }

    public function getStatusTasks($status,bool $count = false)
    {
        $query = $this->model::query()
            ->whereHas('project',function($q){
                $q->where('user_id',auth()->id());
            })->where('status',$status);
        return $count ? $query->count() : $query->orderBy('created_at', 'desc')->paginate(20);
    }
    
    public function getOverDueTasks(bool $count = false)
    {
        $query = $this->model::query()
            ->whereHas('project',function($q){
                $q->where('user_id',auth()->id());
            })->whereDate('due_date', '<', now())->where('status', '!=', 'done');
            
        return $count ? $query->count() : $query->orderBy('created_at', 'desc')->paginate(20);
    }

    public function getOverdueTasksForNotification()
    {
        return $this->model
            ->whereDate('due_date', '<', now())
            ->where('status', '!=', 'done')
            ->where('is_notified', false)
            ->with(['project.user'])
            ->get();
    }
}
