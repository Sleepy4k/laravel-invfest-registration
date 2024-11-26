<?php

namespace App\Repositories\Models;

use App\Models\Submission;
use App\Contracts\Models\SubmissionInterface;
use App\Enums\ReportLogType;
use App\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Collection;
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
     * Get all models.
     *
     * @param  array  $columns
     * @param  array  $relations
     * @param  array  $wheres
     * @param  string  $orderBy
     * @param  bool  $latest
     * @param  array  $roles
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = [], array $wheres = [], string $orderBy = 'created_at', bool $latest = true, array $roles = []): Collection
    {
        try {
            $model = $this->model->with($relations);

            if (!empty($orderBy)) $model->orderBy($orderBy, $latest ? 'desc' : 'asc');

            if (!empty($wheres)) {
                $isOrCase = false;

                foreach ($wheres as $key => $value) {
                    if ($value[0] !== 'whereMode') continue;

                    $isOrCase = $value[1] === 'or';
                    unset($wheres[$key]);
                }

                if (!$isOrCase) {
                    $model->where(function ($query) use ($wheres) {
                        foreach ($wheres as $key => $where) {
                            if ($where[0] == 'competition_id') {
                                $query->whereHas('team', function($q) use ($where) {
                                    $q->where($where[0], $where[1], $where[2]);
                                });
                            } else {
                                if (count($where) === 2) {
                                    $query->where($where[0], $where[1]);
                                } else {
                                    $query->where($where[0], $where[1], $where[2]);
                                }
                            }
                        }
                    });
                } else {
                    $model->where(function ($query) use ($wheres) {
                        foreach ($wheres as $key => $where) {
                            if (count($where) === 2) {
                                $query->orWhere($where[0], $where[1]);
                            } else {
                                $query->orWhere($where[0], $where[1], $where[2]);
                            }
                        }
                    });
                }
            }

            if (!empty($roles)) $model->role($roles);

            return $model->get($columns);
        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            return false;
        }
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
