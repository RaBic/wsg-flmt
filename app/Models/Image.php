<?php

namespace App\Models;

use App\Observers\ImageObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperImage
 */
#[ObservedBy(ImageObserver::class)]
class Image extends Model
{
    use HasTranslations;

    /**
     * The attributes that are used for validation.
     *
     * @var array<string, string>
     */
    public static $rules = [
        'path' => 'required|string',
        'meta' => 'nullable|array',
        'user_id' => 'required|exists:user',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'path',
        'purpose',
        'sort',
        'meta',
        'user_id',
    ];

    /**
     * @var list<string>
     */
    public $translatable = ['path'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'meta' => AsArrayObject::class,
        ];
    }

    /**
     * Get the parent imageable model (user or post).
     *
     * @return MorphTo<Model, $this>
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
