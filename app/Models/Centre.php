<?php

namespace App\Models;

use App\Observers\CentreObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperCentre
 */
#[ObservedBy([CentreObserver::class])]
class Centre extends Model
{
    use HasTranslations;

    protected $table = 'centres';

    protected $rules = [
        'centre' => 'required|string',
        'unit' => 'required|string',
        'address' => 'required|string',
        'leader' => 'nullable|string',
        'leader_position' => 'nullable|string',
        'excerpt' => 'nullable|text',
        'url' => 'nullable|url',
        'phone' => 'nullable|string',
        'email' => 'nullable|email',
    ];

    protected $fillable = [
        'centre',
        'unit',
        'address',
        'geocode',
        'leader',
        'leader_position',
        'excerpt',
        'url',
        'phone',
        'email',
        'user_id',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['studies'];

    public $translatable = ['leader_position', 'excerpt'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'geocode' => 'array',
            'excerpt' => 'array',
        ];
    }

    /* relations */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function studies(): BelongsToMany
    {
        return $this->belongsToMany(Study::class, 'study_centre', 'centre_id', 'study_id');
    }
}
