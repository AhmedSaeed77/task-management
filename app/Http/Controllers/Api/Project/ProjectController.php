<?php

namespace App\Http\Controllers\Api\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Project\ProjectRequest;
use Illuminate\Http\Request;
use App\Services\Api\ProjectService;

class ProjectController extends Controller
{
    public function __construct(private readonly ProjectService $project)
    {
    }

    public function index()
    {
        return $this->project->index();
    }

    public function store(ProjectRequest $request)
    {
        return $this->project->store($request);
    }

    public function show($id)
    {
        return $this->project->show($id);
    }

    public function update($id,ProjectRequest $request)
    {
        return $this->project->update($id,$request);
    }

    public function destroy($id)
    {
        return $this->project->destroy($id);
    }
}
