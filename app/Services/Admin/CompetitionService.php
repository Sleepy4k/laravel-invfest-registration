<?php

namespace App\Services\Admin;

use App\Contracts\Models;
use App\Services\Service;

class CompetitionService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\CompetitionInterface $competitionInterface,
        private Models\CompetitionLevelInterface $competitionLevelInterface,
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
     * Show the form for creating a new resource.
     *
     * @return array
     */
    public function create(): array
    {
        $levels = $this->competitionLevelInterface->all(['id','display_as']);

        return compact('levels');
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
        $this->competitionInterface->create($request);

        toast('Kompetisi berhasil ditambahkan', 'success');
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
        $competition = $this->competitionInterface->findById($id, ['id', 'level_id', 'name', 'description', 'poster', 'guidebook', 'whatsapp_group', 'registration_fee'], ['level:id,display_as']);

        return compact('competition');
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
        $levels = $this->competitionLevelInterface->all(['id','display_as']);
        $competition = $this->competitionInterface->findById($id, ['id', 'level_id', 'name', 'description', 'poster', 'guidebook', 'whatsapp_group', 'registration_fee'], ['level:id,display_as']);

        return compact('levels', 'competition');
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
        $this->competitionInterface->update($id, $request);

        toast('Kompetisi berhasil diperbarui', 'success');
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
        $this->competitionInterface->deleteById($id);

        toast('Kompetisi berhasil dihapus', 'success');
    }
}
