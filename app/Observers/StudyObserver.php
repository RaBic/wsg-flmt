<?php

namespace App\Observers;

use App\Models\ChangeLog;
use App\Models\Study;

class StudyObserver
{
    /**
     * Handle the Study "created" event.
     */
    public function created(Study $study): void
    {
        ChangeLog::create([
            'model' => 'study',
            'model_id' => $study->id,
            'action' => 'created',
        ]);
    }

    /**
     * Handle the Study "updated" event.
     */
    public function updated(Study $study): void
    {
        ChangeLog::create([
            'model' => 'study',
            'model_id' => $study->id,
            'action' => 'updated',
        ]);
    }

    /**
     * Handle the Study "deleted" event.
     */
    public function deleted(Study $study): void
    {
        ChangeLog::create([
            'model' => 'study',
            'model_id' => $study->id,
            'action' => 'deleted',
        ]);
    }

    /**
     * Handle the Study "restored" event.
     */
    public function restored(Study $study): void
    {
        // do something grateful
    }

    /**
     * Handle the Study "force deleted" event.
     */
    public function forceDeleted(Study $study): void
    {
        // do something grateful
    }
}
