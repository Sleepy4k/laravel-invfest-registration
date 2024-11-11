<?php

namespace App\Repositories\Models;

use App\Models\PaymentMethod;
use App\Contracts\Models\PaymentMethodInterface;
use App\Repositories\EloquentRepository;

class PaymentMethodRepository extends EloquentRepository implements PaymentMethodInterface
{
    /**
     * Base respository constructor
     *
     * @param  Model  $model
     */
    public function __construct(PaymentMethod $model)
    {
        $this->model = $model;
    }
}
