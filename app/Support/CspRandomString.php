<?php

namespace App\Support;

use Illuminate\Support\Str;
use Spatie\Csp\Nonce\NonceGenerator;
use Illuminate\Support\Facades\Vite;

class CspRandomString implements NonceGenerator
{
    /**
     * Generate csp no once key
     *
     * @return string
     */
    public function generate(): string
    {
        $myNonce = Str::random(48);

        Vite::useCspNonce($myNonce);

        return $myNonce;
    }
}
