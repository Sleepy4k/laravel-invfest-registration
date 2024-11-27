<?php

namespace App\Services\Admin;

use App\Contracts\Models;
use App\Services\Service;

class PaymentMethodService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\PaymentMethodInterface $paymentMethodInterface,
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
        $this->paymentMethodInterface->create($request);

        toast('Metode pembayaran berhasil ditambahkan', 'success');
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
        $method = $this->paymentMethodInterface->findById($id, ['id', 'name', 'logo', 'number', 'owner']);

        return compact('method');
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
        $this->paymentMethodInterface->update($id, $request);

        toast('Metode pembayaran berhasil diperbarui', 'success');
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
        $this->paymentMethodInterface->deleteById($id);

        toast('Metode pembayaran berhasil dihapus', 'success');
    }
}
