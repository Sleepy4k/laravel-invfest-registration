<?php

namespace App\Observers;

use App\Models\Timeline;

class TimelineObserver
{
    /**
     * Handle the Timeline "creating" event.
     */
    public function creating(Timeline $timeline): void
    {
        $timeline->date = date('Y-m-d', strtotime($timeline->date ?? now()));
    }

    /**
     * Handle the Timeline "updating" event.
     */
    public function updating(Timeline $timeline): void
    {
        if ($timeline->isDirty('date')) {
            $timeline->date = date('Y-m-d', strtotime($timeline->date ?? now()));
        }
    }
}
