<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Facades\File;
use App\Models\Payment;

class PaymentObserver
{
    /**
     * Handle the Payment "creating" event.
     */
    public function creating(Payment $payment): void
    {
        $payment->proof = $payment->proof
            ? File::saveSingleFile(UploadFileType::IMAGE, $payment->proof)
            : null;
    }

    /**
     * Handle the Payment "updating" event.
     */
    public function updating(Payment $payment): void
    {
        if ($payment->isDirty('proof')) {
            $oldProof = $payment->getOriginal('proof', null);

            if ($oldProof == null) {
                $payment->proof = $payment->proof
                    ? File::saveSingleFile(UploadFileType::IMAGE, $payment->proof)
                    : null;
            } else {
                $payment->proof = $payment->proof
                    ? File::updateSingleFile(UploadFileType::IMAGE, $payment->proof, $oldProof)
                    : File::deleteFile(UploadFileType::IMAGE, $oldProof);
            }
        }
    }

    /**
     * Handle the Payment "deleting" event.
     */
    public function deleting(Payment $payment): void
    {
        $payment->proof
            ? File::deleteFile(UploadFileType::IMAGE, $payment->proof)
            : null;
    }
}
