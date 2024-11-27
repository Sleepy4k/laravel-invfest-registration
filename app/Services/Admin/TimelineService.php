<?php

namespace App\Services\Admin;

use App\Contracts\Models;
use App\Services\Service;

class TimelineService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\TimelineInterface $timelineInterface,
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
        $this->timelineInterface->create($request);

        toast('Timeline berhasil ditambahkan', 'success');
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
        $timeline = $this->timelineInterface->findById($id, ['title', 'date', 'description']);

        return compact('timeline');
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
        $timeline = $this->timelineInterface->findById($id, ['id', 'title', 'date', 'description']);

        return compact('timeline');
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
        $this->timelineInterface->update($id, $request);

        toast('Timeline berhasil diperbarui', 'success');
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
        $this->timelineInterface->deleteById($id);

        toast('Timeline berhasil dihapus', 'success');
    }
}
