<?php

namespace App\Repositories\Models;

use App\Models\Submission;
use App\Contracts\Models\SubmissionInterface;
use App\Enums\ReportLogType;
use App\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Model;

class SubmissionRepository extends EloquentRepository implements SubmissionInterface
{
    /**
     * Base respository constructor
     *
     * @param  Model  $model
     */
    public function __construct(Submission $model)
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
            $payload['is_reviewed'] = false;
            $payload['file'] = $payload['zip_file'];
            unset($payload['zip_file']);

            $model = $this->model->query()->create($payload);

            return $model->fresh();
        });

        return $transaction;
    }
}
