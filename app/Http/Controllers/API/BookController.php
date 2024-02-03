<?php

namespace App\Http\Controllers\API;

use App\Actions\AttachAuthorsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreRequest;
use App\Http\Resources\Book\BookResource;
use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\Book;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $books = Book::with('authors')->get();
        return BookResource::collection($books)
            ->response()
            ->setStatusCode(ResponseAlias::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, AttachAuthorsAction $attachAuthorsAction)
    {
        $data = $request->validated();
        return DB::transaction(function () use ($attachAuthorsAction, $data) {
            $authors = $data['authors'];
            unset($data['authors']);
            $book = Book::create($data);
            $attachAuthorsAction($book, $authors);
            return BookResource::make($book)
                ->response()
                ->setStatusCode(ResponseAlias::HTTP_CREATED);
        });
    }
}
