<?php

namespace App\Repositories\Models;

use App\Models\Sponsorship;
use App\Contracts\Models\SponsorshipInterface;
use App\Repositories\EloquentRepository;

class SponsorshipRepository extends EloquentRepository implements SponsorshipInterface
{
    /**
     * Base respository constructor
     *
     * @param  Model  $model
     */
    public function __construct(Sponsorship $model)
    {
        $this->model = $model;
    }
}
