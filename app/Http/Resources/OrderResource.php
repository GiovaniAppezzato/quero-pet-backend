<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'status' => $this->status,
            'pet' => $this->pet ? new PetResource($this->pet) : null,
            'adopter' => $this->adopter ? new AdopterResource($this->adopter) : null,
            'ong' => $this->ong ? new OngResource($this->ong) : null,
        ];
    }
}
