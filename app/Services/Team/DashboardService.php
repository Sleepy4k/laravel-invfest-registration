<?php

namespace App\Services\Team;

use App\Contracts\Models;
use App\Services\Service;

class DashboardService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\UserInterface $userInterface
    ) {}

    /**
     * Handle the incoming request.
     *
     * @return array
     */
    public function invoke(): array
    {
        $user = $this->userInterface->findById(auth('web')->user()->id, ['*'], ['leader.team.payment', 'leader.team.competition.level', 'leader.team.payment.method']);

        return compact('user');
    }
}
