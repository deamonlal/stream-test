<?php

namespace App\Http\Controllers\API;

use App\Actions\CheckBookAmountAvailabilityAction;
use App\Actions\DecreaseBookCopies;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookDistribution\StoreRequest;
use App\Http\Resources\BookDistribution\BookDistributionResource;
use App\Models\Book;
use App\Models\BookDistribution;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BookDistributionController extends Controller
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
    public function store(StoreRequest $request, CheckBookAmountAvailabilityAction $bookAmountAvailabilityAction, DecreaseBookCopies $decreaseBookCopies)
    {
        $data = $request->validated();

        return DB::transaction(function () use ($decreaseBookCopies, $bookAmountAvailabilityAction, $data) {
            try {
                $distributedBook = Book::findOrFail($data['book_id']);
                $bookAmountAvailabilityAction($distributedBook, 1);
                $distribution = BookDistribution::create($data);
                $decreaseBookCopies($distributedBook, 1);
                return BookDistributionResource::make($distribution)
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
