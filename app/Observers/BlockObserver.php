<?php

namespace App\Observers;

use App\Models\Block;
use App\Models\ChangeLog;

class BlockObserver
{
    /**
     * Handle the Block "created" event.
     */
    public function created(Block $block): void
    {
        $relationClass = '\\' . $block->blockable_type;
        $relationClass::find($block->blockable_id)->update([
            'updated_at' => now(),
        ]);

        ChangeLog::create([
            'model' => 'block',
            'model_id' => $block->id,
            'action' => 'created',
        ]);
    }

    /**
     * Handle the Block "updated" event.
     */
    public function updated(Block $block): void
    {
        $relationClass = '\\' . $block->blockable_type;
        $relationClass::find($block->blockable_id)->update([
            'updated_at' => now(),
        ]);

        ChangeLog::create([
            'model' => 'block',
            'model_id' => $block->id,
            'action' => 'updated',
        ]);
    }

    /**
     * Handle the Block "deleted" event.
     */
    public function deleted(Block $block): void
    {
        $relationClass = '\\' . $block->blockable_type;
        $relationClass::find($block->blockable_id)->update([
            'updated_at' => now(),
        ]);

        ChangeLog::create([
            'model' => 'block',
            'model_id' => $block->id,
            'action' => 'deleted',
        ]);
    }

    /**
     * Handle the Block "restored" event.
     */
    public function restored(Block $block): void
    {
        // do something grateful
    }

    /**
     * Handle the Block "force deleted" event.
     */
    public function forceDeleted(Block $block): void
    {
        // do something grateful
    }
}
