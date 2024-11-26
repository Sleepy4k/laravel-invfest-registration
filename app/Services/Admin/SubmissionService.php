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
        $competitions = $this->competitionInterface->all(['id', 'name']);

        return compact('competitions');
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
