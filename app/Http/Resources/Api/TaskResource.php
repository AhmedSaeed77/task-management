<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'priority'      => $this->priority,
            'status'        => $this->status,
            'created_at'    => \Carbon\Carbon::parse($this->created_at)->format('D - d M Y'),
            'due_date'      => \Carbon\Carbon::parse($this->due_date)->format('D - d M Y'),
            'project'       => new ProjectResource($this->project),
        ];
    }
}
