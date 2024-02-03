<?php

namespace App\Http\Resources\BookWriteOff;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookWriteOffResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'book_id' => $this->book_id,
            'copies' => $this->copies,
            'reason' => $this->reason,
            'date' => $this->date,
        ];
    }
}
