<?php

namespace App\Models;

use App\Observers\TeamObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperTeam
 */
#[ObservedBy(TeamObserver::class)]
class Team extends Model
{
    use HasTranslations;

    /**
     * The attributes that are used for validation.
     *
     * @var array<string, string>
     */
    public static $rules = [
        'name' => 'required|string',
        'slug' => 'required|string',
        'title' => 'nullable|string',
        'excerpt' => 'required|string',
        'description' => 'nullable|string',
        'email' => 'nullable|email',
        'phone' => 'nullable|string',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'title',
        'excerpt',
        'description',
        'email',
        'phone',
        'published',
        'user_id',
        'unit_id',
        'updated_at',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var list<string>
     */
    protected $with = ['image', 'unit'];

    /**
     * @var list<string>
     */
    public $translatable = ['title', 'excerpt', 'description'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published' => 'boolean',
            'excerpt' => 'array',
            'description' => 'array',
        ];
    }

    /**
     * @return MorphMany<Image, $this>
     */
    public function image(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * @return BelongsTo<Unit, $this>
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @param Builder<$this> $query */
    public function scopePublished(Builder $query): void
    {
        $query->where('published', true);
    }
}
