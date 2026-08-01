<?php

namespace App\Http\Middleware;

use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTaskOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        $taskId = $request->route('task');

        if ($taskId instanceof Task)
        {
            $task = $taskId;
        }
        else
        {
            $task = Task::with('project')->find($taskId);
        }

        if (!$task)
        {
            return response()->json(['message' => 'Task not found'], 404);
        }

        if ($task->project->user_id !== auth()->id())
        {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}