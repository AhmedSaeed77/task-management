<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->description,
            'status'        => $this->status,
            'created_at'    => \Carbon\Carbon::parse($this->created_at)->format('D - d M Y'),
            'user'          => new UserResource($this->user),
        ];
    }
}
