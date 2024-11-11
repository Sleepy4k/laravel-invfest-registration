<?php

namespace App\Repositories\Models;

use App\Models\TeamCompanion;
use App\Contracts\Models\TeamCompanionInterface;
use App\Repositories\EloquentRepository;

class TeamCompanionRepository extends EloquentRepository implements TeamCompanionInterface
{
    /**
     * Base respository constructor
     *
     * @param  Model  $model
     */
    public function __construct(TeamCompanion $model)
    {
        $this->model = $model;
    }
}
