<?php

namespace App\Services\Dashboard;

use App\Http\Traits\Responser;
use App\Http\Resources\Api\ProjectCollection;
use App\Http\Resources\Api\TaskCollection;
use Illuminate\Support\Facades\DB;
use App\Repositories\ProjectRepositoryInterface;
use App\Repositories\TaskRepositoryInterface;

class DashboardService
{
    use Responser;

    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository,
        private readonly TaskRepositoryInterface $taskRepository,
    )
    {
    }

    public function index()
    {
        $total_projects_count   = $this->projectRepository->getProjectsCount();
        $active_projects_count  = $this->projectRepository->getProjectsStatusCount(true);
        $total_tasks_count      = $this->taskRepository->getTasks(true);
        $completed_tasks_count  = $this->taskRepository->getStatusTasks('done',true);
        $pending_tasks_count    = $this->taskRepository->getStatusTasks('todo',true);
        $overdue_tasks_count    = $this->taskRepository->getOverDueTasks(true);

        return $this->responseSuccess( 
                                        message: '' , 
                                        data: [
                                                'total_projects_count'  => $total_projects_count,
                                                'active_projects_count' => $active_projects_count,
                                                'total_tasks_count'     => $total_tasks_count,
                                                'completed_tasks_count' => $completed_tasks_count,
                                                'pending_tasks_count'   => $pending_tasks_count,
                                                'overdue_tasks_count'   => $overdue_tasks_count,
                                            ]
                                    );
    }
}
