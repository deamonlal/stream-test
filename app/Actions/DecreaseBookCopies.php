<?php

namespace App\Actions;

use App\Models\Book;

class DecreaseBookCopies
{
    public function __invoke(Book $book, int $count): void
    {
        $book->copies -= $count;
        $book->save();
    }
}
