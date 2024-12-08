<?php

namespace App\Services\Admin;

use App\Contracts\Models\SponsorshipTierInterface;
use App\Foundations\Service;

class SponsorshipTierService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private SponsorshipTierInterface $competitionLevelInterface,
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

        toast('Level sponsorship berhasil ditambahkan', 'success');
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
        $data = $this->competitionLevelInterface->findById($id, ['id', 'tier']);

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

        toast('Level sponsorship berhasil diubah', 'success');
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

        toast('Level sponsorship berhasil dihapus', 'success');
    }
}
