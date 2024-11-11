<?php

namespace App\Repositories\Models;

use App\Models\Competition;
use App\Contracts\Models\CompetitionInterface;
use App\Enums\ReportLogType;
use App\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class CompetitionRepository extends EloquentRepository implements CompetitionInterface
{
    /**
     * Base respository constructor
     *
     * @param  Model  $model
     */
    public function __construct(Competition $model)
    {
        $this->model = $model;
    }

    /**
     * Get all models.
     *
     * @param  array  $columns
     * @param  int  $limit
     * @param  array  $relations
     * @param  array  $wheres
     * @param  string  $orderBy
     * @param  bool  $latest
     * @param  array  $roles
     * @return Collection|Model
     */
    public function getWithLimit(array $columns = ['*'], int $limit = 3, array $relations = [], array $wheres = [], string $orderBy = 'created_at', bool $latest = true, array $roles = []): Collection|Model
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

                if (!$isOrCase) $model->where($wheres);
                else {
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

            $model->limit($limit);

            return $model->select($columns)->get();
        } catch (\Throwable $th) {
            $this->sendReportLog(ReportLogType::ERROR, $th->getMessage());
            return false;
        }
    }
}
