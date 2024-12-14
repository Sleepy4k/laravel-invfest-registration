<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Facades\File;
use App\Models\TeamCompanion;

class TeamCompanionObserver
{
    /**
     * Handle the TeamCompanion "creating" event.
     */
    public function creating(TeamCompanion $teamCompanion): void
    {
        $teamCompanion->card = $teamCompanion->card
            ? File::saveSingleFile(UploadFileType::IMAGE, $teamCompanion->card)
            : null;
    }

    /**
     * Handle the TeamCompanion "updating" event.
     */
    public function updating(TeamCompanion $teamCompanion): void
    {
        if ($teamCompanion->isDirty('card')) {
            $oldCard = $teamCompanion->getOriginal('card', null);

            if ($oldCard == null) {
                $teamCompanion->card = $teamCompanion->card
                    ? File::saveSingleFile(UploadFileType::IMAGE, $teamCompanion->card)
                    : null;
            } else {
                $teamCompanion->card = $teamCompanion->card
                    ? File::updateSingleFile(UploadFileType::IMAGE, $teamCompanion->card, $oldCard)
                    : File::deleteFile(UploadFileType::IMAGE, $oldCard);
            }
        }
    }

    /**
     * Handle the TeamCompanion "deleting" event.
     */
    public function deleting(TeamCompanion $teamCompanion): void
    {
        $teamCompanion->card
            ? File::deleteFile(UploadFileType::IMAGE, $teamCompanion->card)
            : null;
    }
}
