<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    public function test_can_add_new_book_with_author()
    {
        $book = Book::factory(1)->create()[0];
        $author = Author::factory(1)->create()[0];
        $authorBookRelation = AuthorBook::create([
            'book_id' => $book->id,
            'author_id' => $author->id
        ]);
        $this->assertDatabaseHas('author_books', [
            'book_id' => $book->id,
            'author_id' => $author->id
        ]);
    }
}
