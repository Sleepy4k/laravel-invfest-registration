<?php

namespace App\Repositories\Models;

use App\Models\Setting;
use App\Contracts\Models\SettingInterface;
use App\Repositories\EloquentRepository;

class SettingRepository extends EloquentRepository implements SettingInterface
{
    /**
     * Base respository constructor
     *
     * @param  Model  $model
     */
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }
}
