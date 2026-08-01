<?php

namespace App\Services\Api;

use App\Http\Traits\Responser;
use App\Http\Resources\Api\ProjectResource;
use App\Http\Resources\Api\ProjectCollection;
use Illuminate\Support\Facades\DB;
use App\Repositories\ProjectRepositoryInterface;

class ProjectService
{
    use Responser;

    public function __construct(private readonly ProjectRepositoryInterface $projectRepository)
    {
    }

    public function index()
    {
        $projects = $this->projectRepository->getProjects();
        return $this->responseSuccess( message: '' , data: new ProjectCollection($projects));
    }

    public function store($request)
    {
        try
        {
            $data = $request->validated();
            $data['user_id'] = auth()->user()->id;
            $project = $this->projectRepository->create($data);
            return $this->responseSuccess(message: 'Project added Successfully',data: new ProjectResource($project));
        }
        catch (Exception $e)
        {
            return $this->responseFail(message: 'Something went wrong');
        }
    }

    public function show($id)
    {
        $project = $this->projectRepository->find($id);
        return $this->responseSuccess(message: '',data: new ProjectResource($project));
    }

    public function update($id,$request)
    {
        try
        {
            $data = $request->validated();
            $project = $this->projectRepository->update($id,$data);
            return $this->responseSuccess(message: 'Project updated Successfully',data: new ProjectResource($project));
        }
        catch (Exception $e)
        {
            return $this->responseFail(message: 'Something went wrong');
        }
    }

    public function destroy($id)
    {
        try
        {
            $this->projectRepository->find($id);
            return $this->responseSuccess(message: 'Project deleted Successfully',data: '');
        }
        catch (Exception $e)
        {
            return $this->responseFail(message: 'Something went wrong');
        }
    }
}
