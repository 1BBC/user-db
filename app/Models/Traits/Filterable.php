<?php
namespace App\Models\Traits;


use App\Filters\FilterContract;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param Builder $builder
     * @param FilterContract $filter
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, FilterContract $filter): Builder
    {
        $filter->apply($builder);

        return $builder;
    }
}
