<?php

namespace App\Services\Admin;

use App\Contracts\Models;
use App\Services\Service;

class MediaPartnerService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\MediaPartnerInterface $mediaPartnerInterface,
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
        $this->mediaPartnerInterface->create($request);

        toast('Media partner berhasil ditambahkan', 'success');
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
        $mediaPartner = $this->mediaPartnerInterface->findById($id);

        return compact('mediaPartner');
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
        $this->mediaPartnerInterface->update($id, $request);

        toast('Media partner berhasil diperbarui', 'success');
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
        $this->mediaPartnerInterface->deleteById($id);

        toast('Media partner berhasil dihapus', 'success');
    }
}
