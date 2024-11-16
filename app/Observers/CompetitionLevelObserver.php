<?php

namespace App\Observers;

use App\Models\CompetitionLevel;
use Illuminate\Support\Str;

class CompetitionLevelObserver
{
    /**
     * Handle the CompetitionLevel "creating" event.
     */
    public function creating(CompetitionLevel $competitionLevel): void
    {
        if ($competitionLevel->getKey() === null) {
            $competitionLevel->setAttribute($competitionLevel->getKeyName(), Str::uuid());
        }
    }
}
