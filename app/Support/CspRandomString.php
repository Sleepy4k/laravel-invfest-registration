<?php

namespace App\Support;

use Illuminate\Support\Str;
use Spatie\Csp\Nonce\NonceGenerator;

class CspRandomString implements NonceGenerator
{
    /**
     * Generate csp no once key
     *
     * @return string
     */
    public function generate(): string
    {
        return Str::random(48);
    }
}
