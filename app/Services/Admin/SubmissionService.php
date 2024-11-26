<?php

namespace App\Services\Admin;

use App\Contracts\Models;
use App\Services\Service;

class SubmissionService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\SubmissionInterface $submissionInterface,
        private Models\CompetitionInterface $competitionInterface,
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $filtered = request()->get('filter') ?? null;

        if (isset($filtered) && !empty($filtered)) {
            $filtered = [['competition_id', '=', $filtered]];
        } else {
            $filtered = [];
        }

        $competitions = $this->competitionInterface->all(['id', 'name']);
        $works = $this->submissionInterface->all(['id', 'team_id', 'title', 'file', 'is_reviewed'], ['team:id,competition_id,name,institution', 'team.competition:id,name'], $filtered);

        return compact('works', 'competitions');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $id
     *
     * @return void
     */
    public function update(string $id): void
    {
        $this->submissionInterface->update($id, ['is_reviewed' => true]);

        alert('Berhasil', 'Karya berhasil diverifikasi', 'success');
    }
}
