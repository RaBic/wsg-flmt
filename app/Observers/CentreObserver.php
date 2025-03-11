<?php

namespace App\Observers;

use App\Models\Centre;
use App\Models\ChangeLog;
use Spatie\Geocoder\Facades\Geocoder;

use function Illuminate\Support\defer;

class CentreObserver
{
    /**
     * Handle the Centre "created" event.
     */
    public function created(Centre $centre): void
    {
        defer(fn () => $centre->update([
            'geocode' => Geocoder::getCoordinatesForAddress($centre->address),
        ]));

        ChangeLog::create([
            'model' => 'centre',
            'model_id' => $centre->id,
            'action' => 'created',
        ]);
    }

    /**
     * Handle the Centre "updated" event.
     */
    public function updated(Centre $centre): void
    {
        defer(fn () => $centre->update([
            'geocode' => Geocoder::getCoordinatesForAddress($centre->address),
        ]));

        ChangeLog::create([
            'model' => 'centre',
            'model_id' => $centre->id,
            'action' => 'updated',
        ]);
    }

    /**
     * Handle the Centre "deleted" event.
     */
    public function deleted(Centre $centre): void
    {
        ChangeLog::create([
            'model' => 'centre',
            'model_id' => $centre->id,
            'action' => 'deleted',
        ]);
    }

    /**
     * Handle the Centre "restored" event.
     */
    public function restored(Centre $centre): void
    {
        // do something grateful
    }

    /**
     * Handle the Centre "force deleted" event.
     */
    public function forceDeleted(Centre $centre): void
    {
        // do something grateful
    }
}
