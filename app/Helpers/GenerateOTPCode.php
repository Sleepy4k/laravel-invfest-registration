<?php

if (!function_exists('generateOTPCode')) {
    /**
     * Generate a new OTP code.
     *
     * @param int $precision
     *
     * @return string
     */
    function generateOTPCode(int $precision = 6)
    {
        $payload = '0123456789abcdefghijklmnopqrstuvwxyz';

        return substr(str_shuffle($payload), 0, $precision);
    }
}
