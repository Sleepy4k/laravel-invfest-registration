<?php

namespace App\Repositories\Models;

use App\Models\TeamLeader;
use App\Contracts\Models\TeamLeaderInterface;
use App\Repositories\EloquentRepository;

class TeamLeaderRepository extends EloquentRepository implements TeamLeaderInterface
{
    /**
     * Base respository constructor
     *
     * @param  Model  $model
     */
    public function __construct(TeamLeader $model)
    {
        $this->model = $model;
    }
}
