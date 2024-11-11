<?php

namespace App\Repositories\Models;

use App\Models\SponsorshipTier;
use App\Contracts\Models\SponsorshipTierInterface;
use App\Repositories\EloquentRepository;

class SponsorshipTierRepository extends EloquentRepository implements SponsorshipTierInterface
{
    /**
     * Base respository constructor
     *
     * @param  Model  $model
     */
    public function __construct(SponsorshipTier $model)
    {
        $this->model = $model;
    }
}
