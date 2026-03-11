<?php

namespace App\Jobs;

use App\Models\Author;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateAuthorLastBookTitleJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly Author $author,
        private readonly string $bookTitle,
    ) {}

    public function handle(): void
    {
        $this->author->update([
            'last_book_title' => $this->bookTitle,
        ]);
    }
}