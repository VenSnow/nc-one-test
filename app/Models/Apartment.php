<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory, Filterable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'bedrooms',
        'bathrooms',
        'storeys',
        'garages',
        'price',
    ];
}
