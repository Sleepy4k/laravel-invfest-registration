<?php

namespace App\Repositories\Models;

use App\Models\CompetitionLevel;
use App\Contracts\Models\CompetitionLevelInterface;
use App\Repositories\EloquentRepository;

class CompetitionLevelRepository extends EloquentRepository implements CompetitionLevelInterface
{
    /**
     * Base respository constructor
     *
     * @param  Model  $model
     */
    public function __construct(CompetitionLevel $model)
    {
        $this->model = $model;
    }
}
