<?php

namespace App\Http\Resources\Author;

use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->first_name.' '.$this->last_name,
            'last_book_title' => $this->last_book_title,
            'created_at' => $this->created_at,
            'books' => BookResource::collection($this->whenLoaded('books')),
        ];
    }
}
