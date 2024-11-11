<?php

namespace App\Services\Auth;

use App\Contracts\Models;
use App\Notifications\TeamOTPVerification;
use App\Services\Service;
use Illuminate\Support\Facades\Auth;

class RegisterService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\UserInterface $userInterface,
        private Models\OtpInterface $otpInterface,
        private Models\TeamInterface $teamInterface,
        private Models\TeamLeaderInterface $teamLeaderInterface,
        private Models\CompetitionInterface $competitionInterface,
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $competitions = $this->competitionInterface->all(['id', 'name']);

        return compact('competitions');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $request
     *
     * @return mixed
     */
    public function store(array $request): mixed
    {
        $userPayload = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];
        $user = $this->userInterface->create($userPayload);

        if (!$user) {
            alert('Pendaftaran Gagal', 'system gagal memproses data pengguna', 'error');
            return false;
        }

        $teamPayload = [
            'competition_id' => $request['competition_id'],
            'name' => $request['team_name'],
            'institution' => $request['institution'],
        ];
        $team = $this->teamInterface->create($teamPayload);

        if (!$team) {
            alert('Pendaftaran Gagal', 'system gagal memproses data team', 'error');
            return false;
        }

        $leaderPayload = [
            'team_id' => $team->id,
            'user_id' => $user->id,
            'name' => $request['leader_name'],
            'phone' => $request['leader_phone'],
            'card' => $request['leader_card'],
        ];
        $leader = $this->teamLeaderInterface->create($leaderPayload);

        if (!$leader) {
            alert('Pendaftaran Gagal', 'system gagal memproses data ketua team', 'error');
            return false;
        }

        Auth::login($user);

        $otpPayload = [
            'user_id' => $user->id,
            'otp' => substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 6),
            'expired_at' => now()->addMinutes(5),
        ];
        $otp = $this->otpInterface->create($otpPayload);

        if (!$otp) $otp = '91b4ax';

        $user->notify(new TeamOTPVerification($otp));

        return $team;
    }
}
