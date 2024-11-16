<?php

namespace App\Services\Admin;

use App\Contracts\Models;
use App\Models\Setting;
use App\Services\Service;

class SettingService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\SettingInterface $settingInterface,
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $settings = $this->settingInterface->all(['key', 'value'])->pluck('value', 'key');

        return compact('settings');
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
        foreach ($request as $key => $value) {
            Setting::where('key', $key)->get()->first()->update(['value' => $value]);
        }

        toast('Konfigurasi website berhasil diperbaruin', 'success');
    }
}
