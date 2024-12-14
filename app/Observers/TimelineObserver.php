<?php

namespace App\Observers;

use App\Facades\Format;
use App\Models\Timeline;

class TimelineObserver
{
    /**
     * Handle the Timeline "creating" event.
     */
    public function creating(Timeline $timeline): void
    {
        $timeline->date = Format::formatDate($timeline->date ?? now(), 'Y-m-d');
    }

    /**
     * Handle the Timeline "updating" event.
     */
    public function updating(Timeline $timeline): void
    {
        if ($timeline->isDirty('date')) {
            $timeline->date = Format::formatDate($timeline->date, 'Y-m-d');
        }
    }
}
