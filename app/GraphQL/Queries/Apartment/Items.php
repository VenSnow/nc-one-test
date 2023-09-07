<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Apartment;


use App\Models\Apartment;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class Items extends Query
{
    protected $attributes = [
        'name' => 'Apartments',
    ];

    public function type(): Type
    {
        return GraphQL::type('[Apartment!]');
    }

    public function args(): array
    {
        return [
            'name' => [
                'type' => Type::string(),
            ],
            'bedrooms' => [
                'type' => Type::int(),
            ],
            'bathrooms' => [
                'type' => Type::int(),
            ],
            'storeys' => [
                'type' => Type::int(),
            ],
            'garages' => [
                'type' => Type::int(),
            ],
            'price_from' => [
                'type' => Type::int(),
            ],
            'price_to' => [
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        $items = Apartment::query();

        if (isset($args['name'])) {
            $items->where('name', 'LIKE', '%'.$args['name'].'%');
        }
        if (isset($args['bedrooms'])) {
            $items->where('bedrooms', $args['bedrooms']);
        }
        if (isset($args['bathrooms'])) {
            $items->where('bathrooms', $args['bathrooms']);
        }
        if (isset($args['storeys'])) {
            $items->where('storeys', $args['storeys']);
        }
        if (isset($args['garages'])) {
            $items->where('garages', $args['garages']);
        }
        if (isset($args['price_from'])) {
            $items->where('price', '>=', $args['price_from']);
        }
        if (isset($args['price_to'])) {
            $items->where('price', '<=', $args['price_to']);
        }

        return $items->get();
    }
}
