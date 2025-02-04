<?php

namespace App\Models;

use App\Observers\TeamObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperTeam
 */
#[ObservedBy(TeamObserver::class)]
class Team extends Model
{
    use HasTranslations;

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
     * @var array<int, string>
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
    ];

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

    public $translatable = ['title', 'excerpt', 'description'];

    /* relations */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Scope a query to only include published artists.
     */
    public function scopePublished($query): void
    {
        $query->where('published', true);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
