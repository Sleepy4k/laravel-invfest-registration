<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Facades\File;
use App\Models\TeamLeader;

class TeamLeaderObserver
{
    /**
     * Handle the TeamLeader "creating" event.
     */
    public function creating(TeamLeader $teamLeader): void
    {
        $teamLeader->card = $teamLeader->card
            ? File::saveSingleFile(UploadFileType::IMAGE, $teamLeader->card)
            : null;
    }

    /**
     * Handle the TeamLeader "updating" event.
     */
    public function updating(TeamLeader $teamLeader): void
    {
        if ($teamLeader->isDirty('card')) {
            $oldCard = $teamLeader->getOriginal('card', null);

            if ($oldCard == null) {
                $teamLeader->card = $teamLeader->card
                    ? File::saveSingleFile(UploadFileType::IMAGE, $teamLeader->card)
                    : null;
            } else {
                $teamLeader->card = $teamLeader->card
                    ? File::updateSingleFile(UploadFileType::IMAGE, $teamLeader->card, $oldCard)
                    : File::deleteFile(UploadFileType::IMAGE, $oldCard);
            }
        }
    }

    /**
     * Handle the TeamLeader "deleting" event.
     */
    public function deleting(TeamLeader $teamLeader): void
    {
        $teamLeader->card
            ? File::deleteFile(UploadFileType::IMAGE, $teamLeader->card)
            : null;
    }
}
