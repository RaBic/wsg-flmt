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

    public static $rules = [
        'name' => 'required|string',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'sort',
        'user_id',
    ];

    public $translatable = ['name'];

    public function team(): HasMany
    {
        return $this->hasMany(Team::class);
    }
}
