<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Models\PaymentMethod;
use App\Traits\UploadFile;
use Illuminate\Support\Str;

class PaymentMethodObserver
{
    use UploadFile;

    /**
     * Handle the PaymentMethod "creating" event.
     */
    public function creating(PaymentMethod $paymentMethod): void
    {
        if ($paymentMethod->getKey() === null) {
            $paymentMethod->setAttribute($paymentMethod->getKeyName(), Str::uuid());
        }

        $paymentMethod->logo = $paymentMethod->logo
            ? $this->saveSingleFile(UploadFileType::IMAGE, $paymentMethod->logo)
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
                    ? $this->saveSingleFile(UploadFileType::IMAGE, $paymentMethod->logo)
                    : null;
            } else {
                $paymentMethod->logo = $paymentMethod->logo
                    ? $this->updateSingleFile(UploadFileType::IMAGE, $paymentMethod->logo, $oldLogo)
                    : $this->deleteFile(UploadFileType::IMAGE, $oldLogo);
            }
        }
    }

    /**
     * Handle the PaymentMethod "deleting" event.
     */
    public function deleting(PaymentMethod $paymentMethod): void
    {
        $paymentMethod->logo
            ? $this->deleteFile(UploadFileType::IMAGE, $paymentMethod->logo)
            : null;
    }
}
