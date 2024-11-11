<?php

namespace App\Repositories\Models;

use App\Models\MediaPartner;
use App\Contracts\Models\MediaPartnerInterface;
use App\Repositories\EloquentRepository;

class MediaPartnerRepository extends EloquentRepository implements MediaPartnerInterface
{
    /**
     * Base respository constructor
     *
     * @param  Model  $model
     */
    public function __construct(MediaPartner $model)
    {
        $this->model = $model;
    }
}
