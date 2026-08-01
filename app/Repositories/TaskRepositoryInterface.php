<?php

namespace App\Repositories;

interface TaskRepositoryInterface extends RepositoryInterface
{
    public function getTasks(bool $count = false);
    public function getStatusTasks($status,bool $count = false);
    public function getOverDueTasks(bool $count = false);
    public function getOverdueTasksForNotification();
}
