<?php

namespace App\Support;

use Closure;
use Illuminate\Http\Request;
use Spatie\Honeypot\SpamResponder\SpamResponder;

class HoneyPotResponse implements SpamResponder
{
    /**
     * Generate csp no once key
     *
     * @return string
     */
    public function respond(Request $request, Closure $next)
    {
        return response()->json([
            'code' => 403,
            'error' => 'You are not allowed to submit this form.',
            'message' => 'Please try again later.'
        ], 403);
    }
}
