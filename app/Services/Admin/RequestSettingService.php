<?php

namespace App\Services\Admin;

use App\Foundations\Service;
use Illuminate\Support\Facades\File;

class RequestSettingService extends Service
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $content = [];
        $path = storage_path('app/request-settings.json');

        if (File::exists($path)) {
            $content =  json_decode(File::get($path), true);
        }

        return compact('content');
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
        $path = storage_path('app/request-settings.json');

        File::put($path, json_encode($request));
    }
}
