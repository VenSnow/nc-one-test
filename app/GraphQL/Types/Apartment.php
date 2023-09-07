<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class Apartment extends GraphQLType
{
    protected $attributes = [
        'name' => 'Apartment',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'bedrooms' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'bathrooms' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'storeys' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'garages' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'price' => [
                'type' => Type::nonNull(Type::int()),
            ],
        ];
    }

}
