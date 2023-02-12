<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * @method Builder idDescending(Builder $query)
 */
class User extends Model
{
    use HasFactory, Filterable;

    protected const PHOTO_PATH = 'images/users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'position_id'
    ];

    /**
     * Relation with position model
     *
     * @return BelongsTo
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function scopeIdDescending(Builder $query): Builder
    {
        return $query->orderBy('id','DESC');
    }

    public function setPhotoAttribute($value): void
    {
        $this->attributes['photo'] = \str($value)->afterLast('/');
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return (empty($this->photo))
            ? null
            : Storage::url(\str(self::photoPath())->finish('/').$this->photo);
    }

    public static function photoPath(): string
    {
        return self::PHOTO_PATH;
    }
}
