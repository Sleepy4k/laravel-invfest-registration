<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Facades\File;
use App\Models\MediaPartner;

class MediaPartnerObserver
{
    /**
     * Handle the MediaPartner "creating" event.
     */
    public function creating(MediaPartner $mediaPartner): void
    {
        $mediaPartner->logo = $mediaPartner->logo
            ? File::saveSingleFile(UploadFileType::IMAGE, $mediaPartner->logo)
            : null;
    }

    /**
     * Handle the MediaPartner "updating" event.
     */
    public function updating(MediaPartner $mediaPartner): void
    {
        if ($mediaPartner->isDirty('logo')) {
            $oldLogo = $mediaPartner->getOriginal('logo', null);

            if ($oldLogo == null) {
                $mediaPartner->logo = $mediaPartner->logo
                    ? File::saveSingleFile(UploadFileType::IMAGE, $mediaPartner->logo)
                    : null;
            } else {
                $mediaPartner->logo = $mediaPartner->logo
                    ? File::updateSingleFile(UploadFileType::IMAGE, $mediaPartner->logo, $oldLogo)
                    : File::deleteFile(UploadFileType::IMAGE, $oldLogo);
            }
        }
    }

    /**
     * Handle the MediaPartner "deleting" event.
     */
    public function deleting(MediaPartner $mediaPartner): void
    {
        $mediaPartner->logo
            ? File::deleteFile(UploadFileType::IMAGE, $mediaPartner->logo)
            : null;
    }
}
