<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\BookWriteOff;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookWriteOffTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_add_write_off(): void
    {
        $book = Book::factory(1)->create()[0];
        $writeOff = BookWriteOff::create([
            'book_id' => $book->id,
            'copies' => 1,
            'reason' => 'just for a test',
            'date' => '2024-02-02',
        ]);
        $this->assertDatabaseHas('book_write_offs', [
            'book_id' => $book->id,
            'copies' => 1,
            'reason' => 'just for a test',
            'date' => '2024-02-02',
        ]);
    }
}
