<?php

namespace App\Http\Controllers\API;

use App\Actions\CheckBookAmountAvailabilityAction;
use App\Actions\DecreaseBookCopies;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookWriteOff\StoreRequest;
use App\Http\Resources\BookWriteOff\BookWriteOffResource;
use App\Models\Book;
use App\Models\BookWriteOff;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BookWriteOffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, DecreaseBookCopies $decreaseBookCopies, CheckBookAmountAvailabilityAction $bookAmountAvailabilityAction)
    {
        $data = $request->validated();

        return DB::transaction(function () use ($bookAmountAvailabilityAction, $decreaseBookCopies, $data) {
            try {
                $writeOffBook = Book::findOrFail($data['book_id']);
                $bookAmountAvailabilityAction($writeOffBook, $data['copies']);
                $writeOff = BookWriteOff::create($data);
                $decreaseBookCopies($writeOffBook, $data['copies']);
                return BookWriteOffResource::make($writeOff)
                    ->response()
                    ->setStatusCode(ResponseAlias::HTTP_CREATED);
            } catch (ModelNotFoundException $e) {
                return response()
                    ->json(['message' => 'Book not found'], ResponseAlias::HTTP_NOT_FOUND);
            }

        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
