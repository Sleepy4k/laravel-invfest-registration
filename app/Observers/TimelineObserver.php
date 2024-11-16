<?php

namespace App\Observers;

use App\Models\Timeline;
use Illuminate\Support\Str;

class TimelineObserver
{
    /**
     * Handle the Timeline "creating" event.
     */
    public function creating(Timeline $timeline): void
    {
        if ($timeline->getKey() === null) {
            $timeline->setAttribute($timeline->getKeyName(), Str::uuid());
        }

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
