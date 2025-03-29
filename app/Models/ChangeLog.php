<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperChangeLog
 */
final class ChangeLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'model',
        'model_id',
        'action',
    ];

    /** @param Builder<$this> $query */
    public function scopeOfModel(Builder $query, string $model): void
    {
        $query->where('model', $model);
    }
}
