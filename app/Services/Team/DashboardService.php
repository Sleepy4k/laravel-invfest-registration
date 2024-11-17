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
        $uid = auth('web')->user()->id;
        $user = $this->userInterface->findById($uid, ['id', 'email'], [
            'leader:id,team_id,user_id,name,phone,card',
            'leader.team:id,competition_id,name,institution',
            'leader.team.companion:id,team_id,name,card',
            'leader.team.payment:id,team_id,method_id,proof,status',
            'leader.team.payment.method:id,name,number,owner',
            'leader.team.competition:id,name,level_id,whatsapp_group',
            'leader.team.competition.level:id,display_as'
        ]);

        return compact('user');
    }
}
