<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Models\Payment;
use App\Traits\UploadFile;
use Illuminate\Support\Str;

class PaymentObserver
{
    use UploadFile;

    /**
     * Handle the Payment "creating" event.
     */
    public function creating(Payment $payment): void
    {
        if ($payment->getKey() === null) {
            $payment->setAttribute($payment->getKeyName(), Str::uuid());
        }

        $payment->proof = $payment->proof
            ? $this->saveSingleFile(UploadFileType::IMAGE, $payment->proof)
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
                    ? $this->saveSingleFile(UploadFileType::IMAGE, $payment->proof)
                    : null;
            } else {
                $payment->proof = $payment->proof
                    ? $this->updateSingleFile(UploadFileType::IMAGE, $payment->proof, $oldProof)
                    : $this->deleteFile(UploadFileType::IMAGE, $oldProof);
            }
        }
    }

    /**
     * Handle the Payment "deleting" event.
     */
    public function deleting(Payment $payment): void
    {
        $payment->proof
            ? $this->deleteFile(UploadFileType::IMAGE, $payment->proof)
            : null;
    }
}
