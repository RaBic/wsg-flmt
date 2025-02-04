<?php

namespace App\Listeners;

use App\Events\ModelSorted;
use App\Models\ChangeLog;
use Spatie\LaravelSettings\Events\SettingsSaved;

class AddToChangeLog
{
    /**
     * Handle the event.
     */
    public function handle(ModelSorted|SettingsSaved $event): void
    {
        $model = ($event instanceof ModelSorted) ? $event->model_name : 'settings';
        $action = ($event instanceof ModelSorted) ? 'reordered' : 'updated';
        ChangeLog::create([
            'model' => $model,
            'model_id' => null,
            'action' => $action,
        ]);
    }
}
