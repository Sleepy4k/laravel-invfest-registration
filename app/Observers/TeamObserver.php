<?php

namespace App\Observers;

use App\Models\Team;
use Illuminate\Support\Str;

class TeamObserver
{
    /**
     * Handle the Team "creating" event.
     */
    public function creating(Team $team): void
    {
        if ($team->getKey() === null) {
            $team->setAttribute($team->getKeyName(), Str::uuid());
        }
    }
}
