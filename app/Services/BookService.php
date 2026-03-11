<?php

namespace App\Services;

use App\Jobs\UpdateAuthorLastBookTitleJob;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BookService
{
    public function getAll(): LengthAwarePaginator
    {
        return Book::with('authors')->paginate(20);
    }

    public function getById(Book $book): Book
    {
        return $book->load('authors');
    }

    public function store(array $data): Book
    {
        $book = Book::create(['title' => $data['title']]);

        $book->authors()->attach($data['author_ids']);

        $authors = Author::whereIn('id', $data['author_ids'])->get();

        foreach ($authors as $author) {
            UpdateAuthorLastBookTitleJob::dispatch($author, $book->title);
        }

        return $book->load('authors');
    }

    public function update(Book $book, array $data): Book
    {
        $book->update($data);

        return $book;
    }

    public function destroy(Book $book): void
    {
        $book->delete();
    }
}
