<?php

namespace App\Services\Auth;

use App\Contracts\Models;
use App\Foundations\Service;
use App\Notifications\TeamOTPVerification;
use Illuminate\Support\Facades\Auth;

class VerificationService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\OtpInterface $otpInterface,
        private Models\UserInterface $userInterface,
    ) {}

    /**
     * Store a newly created resource in storage.
     *
     * @param array $request
     *
     * @return bool
     */
    public function store(array $request): bool
    {
        try {
            $user = Auth::user();
            $user = $this->userInterface->findById($user->id, ['*'], ['otp']);

            if ($user?->otp?->otp == null) {
                alert('OTP tidak ditemukan', '', 'error');
                return false;
            }

            if ($user?->otp?->otp != $request['otp']) {
                alert('OTP yang anda masukan salah', '', 'error');
                return false;
            }

            if ($user?->otp?->expired_at < now()) {
                alert('OTP yang anda masukan sudah kadaluarsa', '', 'error');
                $id = $this->otpInterface->findByCustomId([['otp', '=', $user->otp->otp]], ['id'])->id;
                $this->otpInterface->deleteById($id);

                $otpPayload = [
                    'user_id' => $user->id,
                    'otp' => generateOTPCode(8),
                    'expired_at' => now()->addHours(3)
                ];
                $otp = $this->otpInterface->create($otpPayload);

                if (!$otp) {
                    alert('Pendaftaran Gagal', 'system gagal membuat ulang kode otp', 'error');
                    return false;
                }

                alert('Kode OTP sudah dikirim ulang', 'Silahkan cek email anda', 'success');
                $user->notify(new TeamOTPVerification($otpPayload['otp']));

                return false;
            }

            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
            }

            $id = $this->otpInterface->findByCustomId([['otp', '=', $user->otp->otp]], ['id'])->id;
            $this->otpInterface->deleteById($id);

            toast('Verifikasi email berhasil, silahkan isi data anggota tim', 'success');

            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     *
     * @return bool
     */
    public function show(string $id, string $hash): bool
    {
        try {
            $user = $this->userInterface->findById($id);

            if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
                return false;
            }

            $user->markEmailAsVerified();

            Auth::login($user);

            toast('Verifikasi email berhasil, silahkan isi data anggota tim', 'success');

            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
