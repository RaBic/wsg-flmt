<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperUnit
 */
class Unit extends Model
{
    use HasTranslations;

    /**
     * The attributes that are used for validation.
     *
     * @var array<string, string>
     */
    public static $rules = [
        'name' => 'required|string',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'sort',
        'user_id',
    ];

    /**
     * @var list<string>
     */
    public $translatable = ['name'];

    /**
     * @return HasMany<Team, $this>
     */
    public function team(): HasMany
    {
        return $this->hasMany(Team::class);
    }
}
