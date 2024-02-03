<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\Book;
use App\Models\BookDistribution;
use App\Models\Reader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookDistributionTest extends TestCase
{
    public function test_can_add_new_book_with_author()
    {
        $book = Book::factory(1)->create()[0];
        $author = Author::factory(1)->create()[0];
        AuthorBook::create([
            'book_id' => $book->id,
            'author_id' => $author->id
        ]);
        $reader = Reader::factory(1)->create()[0];
        if($book->copies > 0) {
            $book->copies -= 1;
            $book->save();
            $bookDistribution = BookDistribution::create([
                'book_id' => $book->id,
                'reader_id' => $reader->id,
                'distribution_date' => '2024-02-02',
                'must_be_returned_at' => '2024-04-02',
                'return_date' => null,
            ]);
        }
        $this->assertDatabaseHas('book_distributions', [
            'book_id' => $book->id,
            'reader_id' => $reader->id,
            'distribution_date' => '2024-02-02',
            'must_be_returned_at' => '2024-04-02',
            'return_date' => null,
        ]);
    }
}
