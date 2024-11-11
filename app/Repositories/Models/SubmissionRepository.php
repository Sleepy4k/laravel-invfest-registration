<?php

namespace App\Repositories\Models;

use App\Models\Submission;
use App\Contracts\Models\SubmissionInterface;
use App\Repositories\EloquentRepository;

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
}
