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
        private Models\TeamCompanionInterface $teamCompanionInterface,
        private Models\CompetitionInterface $competitionInterface,
        private Models\CompetitionLevelInterface $competitionLevelInterface,
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $levels = $this->competitionLevelInterface->all(['id', 'level', 'display_as']);

        return compact('levels');
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

        if ($request['companion_name'] != null) {
            $companionPayload = [
                'team_id' => $team->id,
                'name' => $request['companion_name'],
                'card' => $request['companion_card'],
            ];
            $companion = $this->teamCompanionInterface->create($companionPayload);

            if (!$companion) {
                alert('Pendaftaran Gagal', 'system gagal memproses data pembimbing', 'error');
                return false;
            }
        }

        $leaderPayload = [
            'team_id' => $team->id,
            'user_id' => $user->id,
            'name' => $request['leader_name'],
            'phone' => $request['leader_phone'],
            'card' => $request['leader_card'] ?? null,
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
            'expired_at' => now()->addHours(3)
        ];
        $otp = $this->otpInterface->create($otpPayload);

        if (!$otp) $otpPayload['otp'] = '91b4ax';

        $user->notify(new TeamOTPVerification($otpPayload['otp']));

        return $team;
    }
}
