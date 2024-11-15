<?php

namespace App\Services\Admin;

use App\Contracts\Models;
use App\Services\Service;

class SponsorshipService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\SponsorshipInterface $sponsorshipInterface,
        private Models\SponsorshipTierInterface $sponsorshipTierInterface,
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $sponsorships = $this->sponsorshipInterface->all(['id', 'name', 'link', 'logo', 'tier_id'], ['tier:id,tier']);

        return compact('sponsorships');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array
     */
    public function create(): array
    {
        $tiers = $this->sponsorshipTierInterface->all(['id', 'tier']);

        return compact('tiers');
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
        $this->sponsorshipInterface->create($request);

        toast('Sponsorship berhasil ditambahkan', 'success');
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
        $tiers = $this->sponsorshipTierInterface->all(['id', 'tier']);
        $sponsorship = $this->sponsorshipInterface->findById($id, ['id', 'name', 'link', 'logo', 'tier_id'], ['tier:id,tier']);

        return compact('tiers', 'sponsorship');
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
        $this->sponsorshipInterface->update($id, $request);

        toast('Sponsorship berhasil diperbarui', 'success');
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
        $this->sponsorshipInterface->deleteById($id);

        toast('Sponsorship berhasil dihapus', 'success');
    }
}
