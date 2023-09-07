<?php

namespace App\Http\Controllers\Api;

use App\Filters\ApartmentFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Apartment\Collection;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * @param Request $request
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        $filter = new ApartmentFilter($request);
        $apartments = Apartment::filter($filter)->get();

        return (new Collection($apartments));
    }
}
