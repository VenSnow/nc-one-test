<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Apartment;

use App\Models\Apartment;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class Item extends Query
{
    protected $attributes = [
        'name' => 'Apartment',
    ];

    public function type(): Type
    {
        return GraphQL::type('Apartment!');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
        ];
    }

    public function resolve($root, array $args): Apartment
    {
        return Apartment::findOrFail($args['id']);
    }
}

