<?php

namespace App\Repositories\Models;

use App\Models\Team;
use App\Contracts\Models\TeamInterface;
use App\Repositories\EloquentRepository;

class TeamRepository extends EloquentRepository implements TeamInterface
{
    /**
     * Base respository constructor
     *
     * @param  Model  $model
     */
    public function __construct(Team $model)
    {
        $this->model = $model;
    }
}
