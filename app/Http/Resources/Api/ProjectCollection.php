<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectCollection extends ResourceCollection
{

    public function toArray(Request $request): array
    {
        return [
            'content'       => $this->collection,
            'pagination'    => new PaginationResource($this),
        ];
    }
}
