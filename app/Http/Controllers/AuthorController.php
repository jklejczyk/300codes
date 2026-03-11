<?php

namespace App\Http\Controllers;

use App\Http\Resources\Author\AuthorCollection;
use App\Http\Resources\Author\AuthorResource;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct(
        private readonly AuthorService $authorService,
    ) {}

    public function index(Request $request): AuthorCollection
    {
        $authors = $this->authorService->getAll($request->search);

        return (new AuthorCollection($authors))->additional([
            'message' => 'Lista autorów pobrana pomyślnie.',
        ]);
    }

    public function show(Author $author): AuthorResource
    {
        $author = $this->authorService->getById($author);

        return (new AuthorResource($author))->additional([
            'message' => 'Autor pobrany pomyślnie.',
        ]);
    }
}
