<?php

namespace App\Actions;

use App\Contracts\Models\OtpInterface;
use App\Enums\OTPVerificationType;
use App\Models\User;
use App\Notifications\TeamOTPVerification;

class SendOTPVerificationAction
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private OtpInterface $otpInterface
    ) {}

    /**
     * Execute the action.
     *
     * @param User $user
     * @param OTPVerificationType $type
     *
     * @return bool
     */
    public function execute(User $user, OTPVerificationType $type): bool
    {
        $length = match ($type) {
            OTPVerificationType::REGISTER => 6,
            OTPVerificationType::RESEND => 8,
        };

        $otpPayload = [
            'user_id' => $user->id ?? null,
            'otp' => $this->generateOTPCode($length),
            'expired_at' => now()->addHours(3)
        ];

        $otp = $this->otpInterface->create($otpPayload);

        if (!$otp) return false;

        $user->notify(new TeamOTPVerification($otpPayload['otp']));

        return true;
    }

    /**
     * Generate a new OTP code.
     *
     * @param int $precision
     *
     * @return string
     */
    private function generateOTPCode(int $precision = 6)
    {
        $payload = '0123456789abcdefghijklmnopqrstuvwxyz';
        $shuffled = str_shuffle($payload);

        return substr($shuffled, 0, $precision);
    }
}
