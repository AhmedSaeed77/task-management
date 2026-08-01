<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProjectOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        $projectId = $request->route('project');

        if (!$projectId)
        {
            $projectId = $request->route('id');
        }

        $project = Project::find($projectId);

        if (!$project)
        {
            return response()->json(['message' => 'Project not found'], 404);
        }

        if ($project->user_id != auth()->id())
        {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}