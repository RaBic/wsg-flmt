<?php

namespace App\Observers;

use App\Models\ChangeLog;
use App\Models\Page;

class PageObserver
{
    /**
     * Handle the Page "created" event.
     */
    public function created(Page $page): void
    {
        ChangeLog::create([
            'model' => 'page',
            'model_id' => $page->id,
            'action' => 'created',
        ]);
    }

    /**
     * Handle the Page "updated" event.
     */
    public function updated(Page $page): void
    {
        ChangeLog::create([
            'model' => 'page',
            'model_id' => $page->id,
            'action' => 'updated',
        ]);
    }

    /**
     * Handle the Page "deleted" event.
     */
    public function deleted(Page $page): void
    {
        ChangeLog::create([
            'model' => 'page',
            'model_id' => $page->id,
            'action' => 'deleted',
        ]);
    }

    /**
     * Handle the Page "restored" event.
     */
    public function restored(Page $page): void
    {
        // do something grateful
    }

    /**
     * Handle the Page "force deleted" event.
     */
    public function forceDeleted(Page $page): void
    {
        // do something grateful
    }
}
