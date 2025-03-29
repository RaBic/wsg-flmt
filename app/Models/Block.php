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

    /**
     * The attributes that are used for validation.
     *
     * @var array<string, string>
     */
    public static $rules = [
        'purpose' => 'nullable|string',
        'title' => 'required|string',
        'content' => 'required|text',
        'user_id' => 'required|exists:user',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'purpose',
        'sort',
        'title',
        'content',
        'user_id',
        'updated_at',
    ];

    /**
     * @var list<string>
     */
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
     * Get the parent imageable model (user or post).
     *
     * @return MorphTo<Model, $this>
     */
    public function blockable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return MorphOne<Image, $this>
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
