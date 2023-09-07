<?php

namespace App\Http\Resources\Apartment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($apartment) {
                return new Resource($apartment);
            }),
        ];
    }

    /**
     * @param Request $request
     * @return array[]
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'total' => $this->count(),
            ]
        ];
    }
}
