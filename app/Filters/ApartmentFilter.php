<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ApartmentFilter
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected Request $request;

    /**
     * @param Builder $builder
     * @return void
     */
    public function apply(Builder $builder): void
    {
        if ($this->request->has('name')) {
            $this->filterByName($builder, $this->request->query('name'));
        }

        if ($this->request->has('bedrooms')) {
            $this->filterByBedrooms($builder, $this->request->query('bedrooms'));
        }

        if ($this->request->has('bathrooms')) {
            $this->filterByBathrooms($builder, $this->request->query('bathrooms'));
        }

        if ($this->request->has('storeys')) {
            $this->filterByStoreys($builder, $this->request->query('storeys'));
        }

        if ($this->request->has('garages')) {
            $this->filterByGarages($builder, $this->request->query('garages'));
        }

        if ($this->request->has('price_from')) {
            $this->filterByPriceFrom($builder, $this->request->query('price_from'));
        }

        if ($this->request->has('price_to')) {
            $this->filterByPriceTo($builder, $this->request->query('price_to'));
        }

        if ($this->request->has('price_order')) {
            $this->orderByPrice($builder, $this->request->query('price_order'));
        }
    }

    /**
     * @param Builder $builder
     * @param $name
     * @return Builder
     */
    protected function filterByName(Builder $builder, $name): Builder
    {
        return $builder->where('name', 'LIKE', '%'.$name.'%');
    }

    /**
     * @param Builder $builder
     * @param $bedrooms
     * @return Builder
     */
    protected function filterByBedrooms(Builder $builder, $bedrooms): Builder
    {
        return $builder->where('bedrooms', $bedrooms);
    }

    /**
     * @param Builder $builder
     * @param $bathrooms
     * @return Builder
     */
    protected function filterByBathrooms(Builder $builder, $bathrooms): Builder
    {
        return $builder->where('bathrooms', $bathrooms);
    }

    /**
     * @param Builder $builder
     * @param $storeys
     * @return Builder
     */
    protected function filterByStoreys(Builder $builder, $storeys): Builder
    {
        return $builder->where('storeys', $storeys);
    }

    /**
     * @param Builder $builder
     * @param $garages
     * @return Builder
     */
    protected function filterByGarages(Builder $builder, $garages): Builder
    {
        return $builder->where('garages', $garages);
    }

    /**
     * @param Builder $builder
     * @param $priceFrom
     * @return Builder
     */
    protected function filterByPriceFrom(Builder $builder, $priceFrom): Builder
    {
        return $builder->where('price', '>=', $priceFrom);
    }

    /**
     * @param Builder $builder
     * @param $priceTo
     * @return Builder
     */
    protected function filterByPriceTo(Builder $builder, $priceTo): Builder
    {
        return $builder->where('price', '<=', $priceTo);
    }

    /**
     * @param Builder $builder
     * @param $price
     * @return Builder
     */
    protected function orderByPrice(Builder $builder, $price): Builder
    {
        // I did this, because user can send incorrect value and server will return 500
        $order = $price == 'desc' ? 'desc' : 'asc';

        return $builder->orderBy('price', $order);
    }
}
