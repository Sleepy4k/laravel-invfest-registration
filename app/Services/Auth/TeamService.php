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
        if (!isset($request['data']) || count($request['data']) == 0) return;

        $data['team_id'] = auth('web')->user()->leader->first()->team->first()->id;
        $total = count($request['data']) > 2 ? 2 : count($request['data']);

        for ($i=0; $i < $total; $i++) {
            if (!isset($request['data'][$i]['member'])) continue;

            $data['name'] = $request['data'][$i]['member'];
            $data['card'] = $request['data'][$i]['card'] ?? null;

            $this->teamMemberInterface->create($data);
        }
    }
}
