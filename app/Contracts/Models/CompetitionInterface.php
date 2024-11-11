<?php

namespace App\Contracts\Models;

use App\Contracts\EloquentInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface CompetitionInterface extends EloquentInterface
{
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
    public function getWithLimit(array $columns = ['*'], int $limit = 3, array $relations = [], array $wheres = [], string $orderBy = 'created_at', bool $latest = true, array $roles = []): Collection|Model;
}
