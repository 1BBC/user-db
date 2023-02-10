<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class UserFilter extends AbstractFilter
{
    use FiltersQueries;

    public const ID = 'id';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const PHONE = 'phone';
    public const POSITION_ID = 'position_id';
    public const OFFSET = 'offset';
    public const POSITION = 'position';


    protected function getCallbacks(): array
    {
        return [
            self::ID => [$this, 'equals'],
            self::POSITION_ID => [$this, 'equals'],
            self::NAME => [$this, 'like'],
            self::EMAIL => [$this, 'like'],
            self::PHONE => [$this, 'like'],
            self::OFFSET => [$this, 'offset'],
            self::POSITION => [$this, 'position'],
        ];
    }

    protected function position(Builder $builder, $value, $param): void
    {
        $builder->whereHas('position', function($query) use ($value) {
            $query->where('name', 'like', "%{$value}%");
        });
    }
}
