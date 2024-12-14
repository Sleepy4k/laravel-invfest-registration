<?php

namespace App\Services\Team;

use App\Contracts\Models;
use App\Exports\User\DashboardExport;
use App\Foundations\Service;
use Illuminate\Database\Eloquent\Model;

class DashboardService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\UserInterface $userInterface
    ) {}

    /**
     * Get the team data.
     *
     * @param int $uid
     *
     * @return Model
     */
    private function getTeam($uid): Model
    {
        return $this->userInterface->findById($uid, ['id', 'email'], [
            'leader:id,team_id,user_id,name,phone,card',
            'leader.team:id,competition_id,name,institution',
            'leader.team.members:id,team_id,name,card',
            'leader.team.companion:id,team_id,name,card',
            'leader.team.payment:id,team_id,method_id,proof,status',
            'leader.team.payment.method:id,name,number,owner',
            'leader.team.competition:id,name,level_id,whatsapp_group',
            'leader.team.competition.level:id,display_as'
        ]);
    }

    /**
     * Handle the incoming request.
     *
     * @return array
     */
    public function invoke(): array
    {
        $uid = auth('web')->id();
        $user = $this->getTeam($uid);

        return compact('user');
    }

    /**
     * Export the dashboard data.
     *
     * @return DashboardExport
     */
    public function export()
    {
        $uid = auth('web')->id();
        $user = $this->getTeam($uid);

        return new DashboardExport($user);
    }
}
