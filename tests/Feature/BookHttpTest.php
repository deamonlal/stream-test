<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookHttpTest extends TestCase
{
    public function test_get_200_http_status_store_book(): void
    {
        $response = $this->post('/api/book', [
            'title' => "beautiful",
            'publication_year' => "2024-02-02",
            'copies' => 5,
            'authors' => ["Ser bennedickt", "Israel Govnojuev"]
        ]);

        $response->assertStatus(201);
    }

    public function test_get_200_http_status_get_all_books(): void
    {
        $response = $this->get('/api/book');

        $response->assertStatus(200);
    }
}
