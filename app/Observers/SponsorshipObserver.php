<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Models\Sponsorship;
use App\Traits\UploadFile;

class SponsorshipObserver
{
    use UploadFile;

    /**
     * Handle the Sponsorship "creating" event.
     */
    public function creating(Sponsorship $sponsorship): void
    {
        $sponsorship->logo = $sponsorship->logo
            ? $this->saveSingleFile(UploadFileType::IMAGE, $sponsorship->logo)
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
                    ? $this->saveSingleFile(UploadFileType::IMAGE, $sponsorship->logo)
                    : null;
            } else {
                $sponsorship->logo = $sponsorship->logo
                    ? $this->updateSingleFile(UploadFileType::IMAGE, $sponsorship->logo, $oldLogo)
                    : $this->deleteFile(UploadFileType::IMAGE, $oldLogo);
            }
        }
    }

    /**
     * Handle the Sponsorship "deleting" event.
     */
    public function deleting(Sponsorship $sponsorship): void
    {
        $sponsorship->logo
            ? $this->deleteFile(UploadFileType::IMAGE, $sponsorship->logo)
            : null;
    }
}
