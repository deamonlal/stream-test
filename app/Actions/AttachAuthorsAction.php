<?php

namespace App\Actions;

use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\Book;

class AttachAuthorsAction
{
    public function __invoke(Book $book, array $authors): void
    {
        foreach ($authors as $authorFullName) {
            $author = Author::firstOrNew(['full_name' => $authorFullName]);
            if (!$author->exists) {
                $author->save();
            }
            AuthorBook::create([
                'author_id' => $author->id,
                'book_id' => $book->id
            ]);
        }
    }
}
