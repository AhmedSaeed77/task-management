<?php

namespace App\Repositories\Eloquent;

use App\Repositories\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class ProjectRepository extends Repository  implements ProjectRepositoryInterface
{

    protected Model $model;

    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    public function getProjects()
    {
        return $this->model->where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->paginate(20);
    }

    public function getProjectsCount()
    {
        return $this->model->where('user_id',auth()->user()->id)->count();
    }

    public function getProjectsStatusCount(bool $count = false)
    {
        $query = $this->model
            ->where('user_id', auth()->id())
            ->where('status', 'active');

        return $count ? $query->count() : $query->paginate(20);
    }

    public function getProjectsId()
    {
        return $this->model->where('user_id',auth()->user()->id)->pluck('id');
    }
}
