<?php

namespace App\Observers;

use App\Models\Otp;
use Illuminate\Support\Str;

class OtpObserver
{
    /**
     * Handle the Otp "creating" event.
     */
    public function creating(Otp $otp): void
    {
        if ($otp->getKey() === null) {
            $otp->setAttribute($otp->getKeyName(), Str::uuid());
        }
    }
}
