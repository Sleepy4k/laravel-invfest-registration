<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Facades\File;
use App\Models\TeamMember;

class TeamMemberObserver
{
    /**
     * Handle the TeamMember "creating" event.
     */
    public function creating(TeamMember $teamMember): void
    {
        $teamMember->card = $teamMember->card
            ? File::saveSingleFile(UploadFileType::IMAGE, $teamMember->card)
            : null;
    }

    /**
     * Handle the TeamMember "updating" event.
     */
    public function updating(TeamMember $teamMember): void
    {
        if ($teamMember->isDirty('card')) {
            $oldCard = $teamMember->getOriginal('card', null);

            if ($oldCard == null) {
                $teamMember->card = $teamMember->card
                    ? File::saveSingleFile(UploadFileType::IMAGE, $teamMember->card)
                    : null;
            } else {
                $teamMember->card = $teamMember->card
                    ? File::updateSingleFile(UploadFileType::IMAGE, $teamMember->card, $oldCard)
                    : File::deleteFile(UploadFileType::IMAGE, $oldCard);
            }
        }
    }

    /**
     * Handle the TeamMember "deleting" event.
     */
    public function deleting(TeamMember $teamMember): void
    {
        $teamMember->card
            ? File::deleteFile(UploadFileType::IMAGE, $teamMember->card)
            : null;
    }
}
