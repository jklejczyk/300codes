<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequests\StoreBookRequest;
use App\Http\Requests\BookRequests\UpdateBookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function __construct(
        private readonly BookService $bookService,
    ) {}

    public function index(): BookCollection
    {
        $books = $this->bookService->getAll();

        return (new BookCollection($books))->additional([
            'message' => 'Lista książek pobrana pomyślnie.',
        ]);
    }

    public function show(Book $book): BookResource
    {
        $book = $this->bookService->getById($book);

        return (new BookResource($book))->additional([
            'message' => 'Książka pobrana pomyślnie.',
        ]);
    }

    public function store(StoreBookRequest $request): BookResource
    {
        $book = $this->bookService->store($request->validated());

        return (new BookResource($book))->additional([
            'message' => 'Książka utworzona pomyślnie.',
        ]);
    }

    public function update(UpdateBookRequest $request, Book $book): BookResource
    {
        $book = $this->bookService->update($book, $request->validated());

        return (new BookResource($book))->additional([
            'message' => 'Książka zaktualizowana pomyślnie.',
        ]);
    }

    public function destroy(Book $book): JsonResponse
    {
        $this->bookService->destroy($book);

        return response()->json([
            'message' => 'Książka usunięta pomyślnie.',
        ]);
    }
}
