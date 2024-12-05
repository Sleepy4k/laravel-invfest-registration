<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Models\TeamLeader;
use App\Traits\UploadFile;

class TeamLeaderObserver
{
    use UploadFile;

    /**
     * Handle the TeamLeader "creating" event.
     */
    public function creating(TeamLeader $teamLeader): void
    {
        $teamLeader->card = $teamLeader->card
            ? $this->saveSingleFile(UploadFileType::IMAGE, $teamLeader->card)
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
                    ? $this->saveSingleFile(UploadFileType::IMAGE, $teamLeader->card)
                    : null;
            } else {
                $teamLeader->card = $teamLeader->card
                    ? $this->updateSingleFile(UploadFileType::IMAGE, $teamLeader->card, $oldCard)
                    : $this->deleteFile(UploadFileType::IMAGE, $oldCard);
            }
        }
    }

    /**
     * Handle the TeamLeader "deleting" event.
     */
    public function deleting(TeamLeader $teamLeader): void
    {
        $teamLeader->card
            ? $this->deleteFile(UploadFileType::IMAGE, $teamLeader->card)
            : null;
    }
}
