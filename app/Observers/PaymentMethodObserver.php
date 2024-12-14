<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Facades\File;
use App\Models\PaymentMethod;

class PaymentMethodObserver
{
    /**
     * Handle the PaymentMethod "creating" event.
     */
    public function creating(PaymentMethod $paymentMethod): void
    {
        $paymentMethod->logo = $paymentMethod->logo
            ? File::saveSingleFile(UploadFileType::IMAGE, $paymentMethod->logo)
            : null;
    }

    /**
     * Handle the PaymentMethod "updating" event.
     */
    public function updating(PaymentMethod $paymentMethod): void
    {
        if ($paymentMethod->isDirty('logo')) {
            $oldLogo = $paymentMethod->getOriginal('logo', null);

            if ($oldLogo == null) {
                $paymentMethod->logo = $paymentMethod->logo
                    ? File::saveSingleFile(UploadFileType::IMAGE, $paymentMethod->logo)
                    : null;
            } else {
                $paymentMethod->logo = $paymentMethod->logo
                    ? File::updateSingleFile(UploadFileType::IMAGE, $paymentMethod->logo, $oldLogo)
                    : File::deleteFile(UploadFileType::IMAGE, $oldLogo);
            }
        }
    }

    /**
     * Handle the PaymentMethod "deleting" event.
     */
    public function deleting(PaymentMethod $paymentMethod): void
    {
        $paymentMethod->logo
            ? File::deleteFile(UploadFileType::IMAGE, $paymentMethod->logo)
            : null;
    }
}
