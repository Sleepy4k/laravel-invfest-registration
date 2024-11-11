<?php

namespace App\Services\Auth;

use App\Contracts\Models;
use App\Services\Service;
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
        $user = Auth::user();

        if ($user->otp == null) {
            alert('OTP tidak ditemukan', '', 'error');

            return false;
        }

        if ($user->otp != $request['otp']) {
            alert('OTP yang anda masukan salah', '', 'error');

            return false;
        }

        if ($user->otp_expiration < now()) {
            alert('OTP yang anda masukan sudah kadaluarsa', '', 'error');
            $id = $this->otpInterface->findByCustomId([['otp', '=', $request['otp']]], ['id'])->id;
            $this->otpInterface->deleteById($id);

            return false;
        }

        $user->markEmailAsVerified();

        toast('Verifikasi email berhasil, silahkan isi data anggota tim', 'success');

        return true;
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
        $user = $this->userInterface->findById($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return false;
        }

        $user->markEmailAsVerified();

        Auth::login($user);

        toast('Verifikasi email berhasil, silahkan isi data anggota tim', 'success');

        return true;
    }
}
