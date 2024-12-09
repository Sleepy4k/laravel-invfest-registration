<?php

namespace App\Services\Auth;

use App\Actions\SendOTPVerificationAction;
use App\Contracts\Models;
use App\Enums\OTPVerificationType;
use App\Foundations\Service;
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
        private SendOTPVerificationAction $sendOTPVerificationAction,
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
        $user = $this->userInterface->create([
            'email' => $request['email'],
            'password' => $request['password'],
        ]);

        if (!$user) {
            alert('Pendaftaran Gagal', 'system gagal memproses data pengguna', 'error');
            return false;
        }

        $team = $this->teamInterface->create([
            'competition_id' => $request['competition_id'],
            'name' => $request['team_name'],
            'institution' => $request['institution'],
        ]);

        if (!$team) {
            $this->userInterface->deleteById($user->id);
            alert('Pendaftaran Gagal', 'system gagal memproses data team', 'error');
            return false;
        }

        if (!is_null($request['companion_name'] ?? null) && !is_null($request['companion_card'] ?? null)) {
            $companion = $this->teamCompanionInterface->create([
                'team_id' => $team->id,
                'name' => $request['companion_name'] ?? '-',
                'card' => $request['companion_card'] ?? '-',
            ]);

            if (!$companion) {
                $this->teamInterface->deleteById($team->id);
                alert('Pendaftaran Gagal', 'system gagal memproses data pembimbing', 'error');
                return false;
            }
        }

        $leader = $this->teamLeaderInterface->create([
            'team_id' => $team->id,
            'user_id' => $user->id,
            'name' => $request['leader_name'],
            'phone' => $request['leader_phone'],
            'card' => $request['leader_card'] ?? null,
        ]);

        if (!$leader) {
            $this->teamInterface->deleteById($team->id);

            if (!is_null($request['companion_name'])) {
                $this->teamCompanionInterface->deleteById($companion->id);
            }

            alert('Pendaftaran Gagal', 'system gagal memproses data ketua team', 'error');
            return false;
        }

        Auth::login($user);

        $otp = $this->sendOTPVerificationAction->execute($user, OTPVerificationType::REGISTER);

        if (!$otp) {
            $this->teamLeaderInterface->deleteById($leader->id);
            alert('Pendaftaran Gagal', 'system gagal membuat kode otp', 'error');
            return false;
        }

        return $team;
    }
}
