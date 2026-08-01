<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\TaskOverdueNotification;
use App\Repositories\TaskRepositoryInterface;

class CheckOverdueTasks extends Command
{
    protected $signature = 'tasks:check-overdue';

    protected $description = 'Send notifications for overdue tasks';

    public function __construct(protected TaskRepositoryInterface $taskRepository)
    {
        parent::__construct();
    }

    public function handle()
    {
        $tasks = $this->taskRepository->getOverdueTasksForNotification();

        foreach ($tasks as $task)
        {
            $task->project->user->notify(new TaskOverdueNotification($task));
            $task->update(['is_notified' => true]);
        }

        $this->info('Overdue tasks checked successfully.');
    }
}