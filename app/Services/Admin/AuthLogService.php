<?php

namespace App\Services\Admin;

use App\Services\Service;
use Spatie\Activitylog\Models\Activity;

class AuthLogService extends Service
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        return [];
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     *
     * @return array
     */
    public function show(string $id): array
    {
        $activity = Activity::findOrfail($id);

        return compact('activity');
    }
}
