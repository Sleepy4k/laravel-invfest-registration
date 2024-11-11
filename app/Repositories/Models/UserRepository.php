<?php

namespace App\Repositories\Models;

use App\Models\User;
use App\Contracts\Models\UserInterface;
use App\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends EloquentRepository implements UserInterface
{
    /**
     * Base respository constructor
     *
     * @param  Model  $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Create a model.
     *
     * @param  array  $payload
     * @return Model|bool
     */
    public function create(array $payload): Model|bool
    {
        $transaction = $this->wrapIntoTransaction(function () use ($payload) {
            $model = $this->model->query()->create($payload);
            $model->assignRole('team');

            return $model->fresh();
        });

        return $transaction;
    }
}
