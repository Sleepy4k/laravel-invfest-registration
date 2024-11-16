<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Models\MediaPartner;
use App\Traits\UploadFile;
use Illuminate\Support\Str;

class MediaPartnerObserver
{
    use UploadFile;

    /**
     * Handle the MediaPartner "creating" event.
     */
    public function creating(MediaPartner $mediaPartner): void
    {
        if ($mediaPartner->getKey() === null) {
            $mediaPartner->setAttribute($mediaPartner->getKeyName(), Str::uuid());
        }

        $mediaPartner->logo = $mediaPartner->logo
            ? $this->saveSingleFile(UploadFileType::IMAGE, $mediaPartner->logo)
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
                    ? $this->saveSingleFile(UploadFileType::IMAGE, $mediaPartner->logo)
                    : null;
            } else {
                $mediaPartner->logo = $mediaPartner->logo
                    ? $this->updateSingleFile(UploadFileType::IMAGE, $mediaPartner->logo, $oldLogo)
                    : $this->deleteFile(UploadFileType::IMAGE, $oldLogo);
            }
        }
    }

    /**
     * Handle the MediaPartner "deleting" event.
     */
    public function deleting(MediaPartner $mediaPartner): void
    {
        $mediaPartner->logo
            ? $this->deleteFile(UploadFileType::IMAGE, $mediaPartner->logo)
            : null;
    }
}
