<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\User;

describe('POST /api/books', function () {
    test('tworzy książkę z prawidłowymi danymi', function () {
        $user = User::factory()->create();
        $authors = Author::factory(2)->create();

        $response = $this->actingAs($user)->postJson('/api/books', [
            'title' => 'Testowa książka',
            'author_ids' => $authors->pluck('id')->toArray(),
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.title', 'Testowa książka')
            ->assertJsonCount(2, 'data.authors');

        $this->assertDatabaseHas('books', ['title' => 'Testowa książka']);
    });

    test('zwraca 401 bez uwierzytelnienia', function () {
        $response = $this->postJson('/api/books', [
            'title' => 'Testowa książka',
            'author_ids' => [1],
        ]);

        $response->assertStatus(401);
    });

    test('zwraca 401 z niepoprawnym tokenem', function () {
        $response = $this->withHeader('Authorization', 'Bearer niepoprawny-token')
            ->postJson('/api/books', [
                'title' => 'Testowa książka',
                'author_ids' => [1],
            ]);

        $response->assertStatus(401);
    });

    test('zwraca błąd walidacji bez tytułu', function () {
        $user = User::factory()->create();
        $author = Author::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/books', [
            'author_ids' => [$author->id],
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('title');
    });

    test('zwraca błąd walidacji bez autorów', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/books', [
            'title' => 'Testowa książka',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('author_ids');
    });

    test('zwraca błąd walidacji z nieistniejącym autorem', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/books', [
            'title' => 'Testowa książka',
            'author_ids' => [999],
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('author_ids.0');
    });
});

describe('DELETE /api/books/{id}', function () {
    test('usuwa istniejącą książkę', function () {
        $book = Book::factory()->create();

        $response = $this->deleteJson("/api/books/{$book->id}");

        $response->assertStatus(200)
            ->assertJsonPath('message', 'Książka usunięta pomyślnie.');

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    });

    test('usuwa książkę wraz z powiązaniami w tabeli pivot', function () {
        $book = Book::factory()->create();
        $author = Author::factory()->create();
        $book->authors()->attach($author);

        $this->deleteJson("/api/books/{$book->id}");

        $this->assertDatabaseMissing('author_book', [
            'book_id' => $book->id,
            'author_id' => $author->id,
        ]);
    });

    test('zwraca 404 dla nieistniejącej książki', function () {
        $response = $this->deleteJson('/api/books/999');

        $response->assertStatus(404);
    });
});
