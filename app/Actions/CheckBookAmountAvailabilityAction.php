<?php

namespace App\Actions;

use App\Models\Book;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
class CheckBookAmountAvailabilityAction
{
    public function __invoke(Book $book, int $amount): void
    {
        if ($book->copies < $amount) {
            throw new HttpResponseException(response()->json([
                    'message'   => "No $amount books",
                ])->setStatusCode(ResponseAlias::HTTP_OK));
        }
    }
}
