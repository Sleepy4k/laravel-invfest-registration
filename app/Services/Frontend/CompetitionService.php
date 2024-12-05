<?php

namespace App\Services\Frontend;

use App\Contracts\Models;
use App\Foundations\Service;
use ErrorException;

class CompetitionService extends Service
{
    public function __construct(
        private Models\CompetitionInterface $competitionInterface,
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $level = request('level', '####');
        $competitions = $this->competitionInterface->all(['id', 'name'], wheres: [['level_id', '=', $level]]);

        return compact('competitions');
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     *
     * @return array
     */
    public function show(string $slug): array
    {
        $competition = $this->competitionInterface->findByCustomId([['slug', '=', $slug]], ['name', 'slug', 'level_id', 'poster', 'registration_fee', 'guidebook', 'description'], ['level:id,display_as']);

        if (empty($competition) || $competition == null) throw new ErrorException('Data not found, please make sure data is valid');

        return compact('competition');
    }
}
