<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Observers\StudyObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperStudy
 */
#[ObservedBy(StudyObserver::class)]
class Study extends Model
{
    /** @use HasFactory<\Database\Factories\StudyFactory> */
    // use HasFactory;
    use HasTranslations;

    public static $rules = [
        'title' => 'required|string',
        'shortcode' => 'required|string|max:32',
        'type' => 'required|string|in:recruiting,followup',
        'content' => 'nullable|string',
        'sort' => 'nullable|integer',
        'published_at' => 'nullable|datetime',
        'user_id' => 'required|exists:user',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'shortcode',
        'type',
        'content',
        'sort',
        'published_at',
        'user_id',
    ];

    public $translatable = ['title', 'content'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'content' => 'array',
        ];
    }

    /* relations */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function blocks(): MorphMany
    {
        return $this->morphMany(Block::class, 'blockable');
    }

    public function centres(): BelongsToMany
    {
        return $this->belongsToMany(Centre::class, 'study_centre', 'study_id', 'centre_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query): void
    {
        $query->whereNotNull('published_at')->where('published_at', '<', now());
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
