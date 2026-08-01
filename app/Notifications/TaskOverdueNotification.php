<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TaskOverdueNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public $task)
    {
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'task_id'   => $this->task->id,
            'title'     => $this->task->title,
            'message'   => 'Task is overdue.',
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Task Overdue')
            ->line("Task {$this->task->title} is overdue.");
    }
}