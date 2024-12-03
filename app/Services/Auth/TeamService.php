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
     * @return bool
     */
    public function store(array $request): bool
    {
        if (!isset($request['data']) || count($request['data']) == 0) return false;

        $data['team_id'] = auth('web')->user()?->leader?->team?->id;
        if ($data['team_id'] == null) return false;

        $total = count($request['data']) > 2 ? 2 : count($request['data']);

        for ($i = 0; $i < $total; $i++) {
            $name = htmlspecialchars($request['data'][$i]['member'] ?? '', ENT_QUOTES, 'UTF-8');
            $card = $request['data'][$i]['card'] ?? null;

            if (empty($name) || empty($card)) continue;

            $data['name'] = $name;
            $data['card'] = $card;

            $this->teamMemberInterface->create($data);
        }

        return true;
    }
}
