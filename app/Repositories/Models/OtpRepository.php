<?php

namespace App\Repositories\Models;

use App\Models\Otp;
use App\Contracts\Models\OtpInterface;
use App\Repositories\EloquentRepository;

class OtpRepository extends EloquentRepository implements OtpInterface
{
    /**
     * Base respository constructor
     *
     * @param  Model  $model
     */
    public function __construct(Otp $model)
    {
        $this->model = $model;
    }
}
