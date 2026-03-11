<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $authors = Author::factory(5)->create();

        Book::factory(10)->create()->each(function ($book) use ($authors) {
            $book->authors()->attach($authors->random(rand(1, 3)));
        });

        $authors->each(function ($author) {
            $lastBook = $author->books()->latest()->first();
            if ($lastBook) {
                $author->update(['last_book_title' => $lastBook->title]);
            }
        });

        Author::factory(2)->create();
    }
}
