<?php

namespace Database\Factories;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ApartmentFactory extends Factory
{
    protected $model = Apartment::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'bedrooms' => $this->faker->randomNumber(1),
            'bathrooms' => $this->faker->randomNumber(1),
            'storeys' => $this->faker->randomNumber(1),
            'garages' => $this->faker->randomNumber(1),
            'price' => $this->faker->randomFloat(2),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
