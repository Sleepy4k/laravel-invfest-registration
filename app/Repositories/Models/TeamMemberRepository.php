<?php

namespace App\Repositories\Models;

use App\Models\TeamMember;
use App\Contracts\Models\TeamMemberInterface;
use App\Repositories\EloquentRepository;

class TeamMemberRepository extends EloquentRepository implements TeamMemberInterface
{
    /**
     * Base respository constructor
     *
     * @param  Model  $model
     */
    public function __construct(TeamMember $model)
    {
        $this->model = $model;
    }
}
