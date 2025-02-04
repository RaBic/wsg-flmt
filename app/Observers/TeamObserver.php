<?php

namespace App\Observers;

use App\Models\ChangeLog;
use App\Models\Team;

class TeamObserver
{
    /**
     * Handle the Team "created" event.
     */
    public function created(Team $team): void
    {
        ChangeLog::create([
            'model' => 'team',
            'model_id' => $team->id,
            'action' => 'created',
        ]);
    }

    /**
     * Handle the Team "updated" event.
     */
    public function updated(Team $team): void
    {
        ChangeLog::create([
            'model' => 'team',
            'model_id' => $team->id,
            'action' => 'updated',
        ]);
    }

    /**
     * Handle the Team "deleted" event.
     */
    public function deleted(Team $team): void
    {
        ChangeLog::create([
            'model' => 'team',
            'model_id' => $team->id,
            'action' => 'deleted',
        ]);
    }

    /**
     * Handle the Team "restored" event.
     */
    public function restored(Team $team): void
    {
        // do something grateful
    }

    /**
     * Handle the Team "force deleted" event.
     */
    public function forceDeleted(Team $team): void
    {
        // do something grateful
    }
}
