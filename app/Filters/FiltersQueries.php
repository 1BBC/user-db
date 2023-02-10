<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FiltersQueries
{
    protected function like(Builder $builder, $value, $param): void
    {
        $builder->where($param, 'like', "%{$value}%");
    }

    protected function equals(Builder $builder, $value, $param): void
    {
        $builder->where($param, $value);
    }

    protected function offset(Builder $builder, $value, $param): void
    {
        $builder->offset($value);
    }
}
