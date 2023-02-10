<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relation with user model
     *
     * @return HasMany
     */
    public function position(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function scopeIdDescending(Builder $query): Builder
    {
        return $query->orderBy('id','DESC');
    }
}
