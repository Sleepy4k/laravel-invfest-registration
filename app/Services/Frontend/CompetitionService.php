<?php

namespace App\Services\Frontend;

use App\Contracts\Models;
use App\Services\Service;
use ErrorException;

class CompetitionService extends Service
{
    public function __construct(
        private Models\CompetitionInterface $competitionInterface,
    ) {}

    /**
     * Display the specified resource.
     *
     * @param string $slug
     *
     * @return array
     */
    public function show(string $slug): array
    {
        $competition = $this->competitionInterface->findByCustomId([['slug', '=', $slug]], ['name', 'slug', 'level_id', 'registration_fee'], ['level']);

        if (empty($competition) || $competition == null) throw new ErrorException('Data not found, please make sure data is valid');

        return compact('competition');
    }
}
