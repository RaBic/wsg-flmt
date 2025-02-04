<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @mixin IdeHelperStudyCentre
 */
class StudyCentre extends Pivot
{
    public function study(): BelongsTo
    {
        return $this->belongsTo(Study::class);
    }

    public function centre(): BelongsTo
    {
        return $this->belongsTo(Centre::class);
    }
}
