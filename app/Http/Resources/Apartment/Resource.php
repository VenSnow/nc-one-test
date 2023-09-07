<?php

namespace App\Http\Resources\Apartment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'bedrooms'   => $this->bedrooms,
            'bathrooms'  => $this->bathrooms,
            'storeys'    => $this->storeys,
            'garages'    => $this->garages,
            'price'      => $this->price,
        ];
    }
}
