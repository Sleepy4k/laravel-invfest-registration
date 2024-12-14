<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Facades\File;
use App\Models\Sponsorship;

class SponsorshipObserver
{
    /**
     * Handle the Sponsorship "creating" event.
     */
    public function creating(Sponsorship $sponsorship): void
    {
        $sponsorship->logo = $sponsorship->logo
            ? File::saveSingleFile(UploadFileType::IMAGE, $sponsorship->logo)
            : null;
    }

    /**
     * Handle the Sponsorship "updating" event.
     */
    public function updating(Sponsorship $sponsorship): void
    {
        if ($sponsorship->isDirty('logo')) {
            $oldLogo = $sponsorship->getOriginal('logo', null);

            if ($oldLogo == null) {
                $sponsorship->logo = $sponsorship->logo
                    ? File::saveSingleFile(UploadFileType::IMAGE, $sponsorship->logo)
                    : null;
            } else {
                $sponsorship->logo = $sponsorship->logo
                    ? File::updateSingleFile(UploadFileType::IMAGE, $sponsorship->logo, $oldLogo)
                    : File::deleteFile(UploadFileType::IMAGE, $oldLogo);
            }
        }
    }

    /**
     * Handle the Sponsorship "deleting" event.
     */
    public function deleting(Sponsorship $sponsorship): void
    {
        $sponsorship->logo
            ? File::deleteFile(UploadFileType::IMAGE, $sponsorship->logo)
            : null;
    }
}
