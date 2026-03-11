<?php

namespace App\Services;

use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuthorService
{
    public function getAll(?string $search = null): LengthAwarePaginator
    {
        $query = Author::with('books');

        if ($search) {
            $query->whereHas('books', function ($subQuery) use ($search) {
                $subQuery->where('title', 'like', "%{$search}%");
            });
        }

        return $query->paginate(20);
    }

    public function getById(Author $author): Author
    {
        return $author->load('books');
    }
}
