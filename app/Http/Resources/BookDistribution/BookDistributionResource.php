<?php

namespace App\Http\Resources\BookDistribution;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookDistributionResource extends JsonResource
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
            'reader_id' => $this->reader_id,
            'distribution_date' => $this->distribution_date,
            'must_be_returned_at' => $this->must_be_returned_at,
        ];
    }
}
