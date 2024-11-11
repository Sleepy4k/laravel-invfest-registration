<?php

namespace App\Repositories\Models;

use App\Models\Payment;
use App\Contracts\Models\PaymentInterface;
use App\Repositories\EloquentRepository;

class PaymentRepository extends EloquentRepository implements PaymentInterface
{
    /**
     * Base respository constructor
     *
     * @param  Model  $model
     */
    public function __construct(Payment $model)
    {
        $this->model = $model;
    }
}
