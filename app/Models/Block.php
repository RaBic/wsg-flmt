<?php

namespace App\Models;

use App\Observers\BlockObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperBlock
 */
#[ObservedBy(BlockObserver::class)]

class Block extends Model
{
    use HasTranslations;

    public static $rules = [
        'purpose' => 'nullable|string',
        'title' => 'required|string',
        'content' => 'required|text',
        'user_id' => 'required|exists:user',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'purpose',
        'sort',
        'title',
        'content',
        'user_id',
    ];

    public $translatable = ['title', 'content', 'image'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'title' => 'array',
            'content' => 'array',
        ];
    }

    /**
     * Get the parent blockable model (page, study, ...).
     */
    public function blockable(): MorphTo
    {
        return $this->morphTo();
    }

    /* relations */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
