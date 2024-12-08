<?php

namespace App\Services\Admin;

use App\Contracts\Models\CompetitionLevelInterface;
use App\Foundations\Service;

class CompetitionLevelService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private CompetitionLevelInterface $competitionLevelInterface,
    ) {}

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
     * Store a newly created resource in storage.
     *
     * @param array $request
     *
     * @return void
     */
    public function store(array $request): void
    {
        $this->competitionLevelInterface->create($request);

        toast('Level kompetisi berhasil ditambahkan', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     *
     * @return array
     */
    public function edit(string $id): array
    {
        $data = $this->competitionLevelInterface->findById($id, ['id', 'level', 'display_as']);

        return compact('data');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array $request
     * @param string $id
     *
     * @return void
     */
    public function update(array $request, string $id): void
    {
        $this->competitionLevelInterface->update($id, $request);

        toast('Level kompetisi berhasil diperbarui', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     *
     * @return void
     */
    public function destroy(string $id): void
    {
        $this->competitionLevelInterface->deleteById($id);

        toast('Level kompetisi berhasil dihapus', 'success');
    }
}
