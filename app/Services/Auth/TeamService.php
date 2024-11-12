<?php

namespace App\Services\Auth;

use App\Contracts\Models;
use App\Services\Service;

class TeamService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\TeamMemberInterface $teamMemberInterface,
    ) {}

    /**
     * Store a newly created resource in storage.
     *
     * @param array $request
     *
     * @return void
     */
    public function store(array $request): void
    {
        $data['team_id'] = auth('web')->user()->leader->first()->team->first()->id;

        for ($i=0; $i < 2; $i++) {
            $data['name'] = $request['data'][$i]['member'];
            $data['card'] = $request['data'][$i]['card'];

            $this->teamMemberInterface->create($data);
        }
    }
}
