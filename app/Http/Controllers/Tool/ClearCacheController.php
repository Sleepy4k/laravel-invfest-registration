<?php

namespace App\Http\Controllers\Tool;

use Illuminate\Support\Facades\Artisan;

class ClearCacheController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.system-tools.clear-cache');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        try {
            Artisan::call('optimize:clear');
        } catch (\Exception) {}

        return redirect()->route('admin.tools.clear-cache.index');
    }
}
