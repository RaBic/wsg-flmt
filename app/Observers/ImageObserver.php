<?php

namespace App\Observers;

use App\Models\ChangeLog;
use App\Models\Image;

class ImageObserver
{
    /**
     * Handle the Image "created" event.
     */
    public function created(Image $image): void
    {
        $relationClass = '\\' . $image->imageable_type;
        $relationClass::find($image->imageable_id)->update([
            'updated_at' => now(),
        ]);

        ChangeLog::create([
            'model' => 'image',
            'model_id' => $image->id,
            'action' => 'created',
        ]);
    }

    /**
     * Handle the Image "updated" event.
     */
    public function updated(Image $image): void
    {
        $relationClass = '\\' . $image->imageable_type;
        $relationClass::find($image->imageable_id)->update([
            'updated_at' => now(),
        ]);

        ChangeLog::create([
            'model' => 'image',
            'model_id' => $image->id,
            'action' => 'updated',
        ]);
    }

    /**
     * Handle the Image "deleted" event.
     */
    public function deleted(Image $image): void
    {
        $relationClass = '\\' . $image->imageable_type;
        $relationClass::find($image->imageable_id)->update([
            'updated_at' => now(),
        ]);

        ChangeLog::create([
            'model' => 'image',
            'model_id' => $image->id,
            'action' => 'deleted',
        ]);
    }

    /**
     * Handle the Image "restored" event.
     */
    public function restored(Image $image): void
    {
        // do something grateful
    }

    /**
     * Handle the Image "force deleted" event.
     */
    public function forceDeleted(Image $image): void
    {
        // do something grateful
    }
}
