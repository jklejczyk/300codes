<?php

namespace App\Http\Resources\Author;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AuthorCollection extends ResourceCollection
{
    public $collects = AuthorResource::class;

    public function toArray(Request $request): array
    {
        return $this->collection->toArray();
    }
}
