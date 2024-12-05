<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Models\TeamCompanion;
use App\Traits\UploadFile;

class TeamCompanionObserver
{
    use UploadFile;

    /**
     * Handle the TeamCompanion "creating" event.
     */
    public function creating(TeamCompanion $teamCompanion): void
    {
        $teamCompanion->card = $teamCompanion->card
            ? $this->saveSingleFile(UploadFileType::IMAGE, $teamCompanion->card)
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
                    ? $this->saveSingleFile(UploadFileType::IMAGE, $teamCompanion->card)
                    : null;
            } else {
                $teamCompanion->card = $teamCompanion->card
                    ? $this->updateSingleFile(UploadFileType::IMAGE, $teamCompanion->card, $oldCard)
                    : $this->deleteFile(UploadFileType::IMAGE, $oldCard);
            }
        }
    }

    /**
     * Handle the TeamCompanion "deleting" event.
     */
    public function deleting(TeamCompanion $teamCompanion): void
    {
        $teamCompanion->card
            ? $this->deleteFile(UploadFileType::IMAGE, $teamCompanion->card)
            : null;
    }
}
