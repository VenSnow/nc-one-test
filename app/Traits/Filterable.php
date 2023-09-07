<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param Builder $builder
     * @param $filter
     * @return Builder|mixed
     */
    public function scopeFilter(Builder $builder, $filter): mixed
    {
        if (is_object($filter)) {
            return $filter->apply($builder);
        }

        return $builder;
    }
}
