<?php

namespace App\Http\Resources;

use App\Http\Resources\Author\AuthorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->created_at,
            'authors' => AuthorResource::collection($this->whenLoaded('authors')),
        ];
    }
}
