<?php

namespace App\Http\Resources\Reader;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReaderResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'date_birth' => $this->date_birth,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
        ];
    }
}
