<?php

namespace App\Http\Controllers\Tool;

use Illuminate\Support\Facades\Artisan;

class OptimizeController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.system-tools.optimize');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        try {
            Artisan::call('naka:re-cache');
        } catch (\Exception) {}

        return redirect()->route('admin.tools.optimize.index');
    }
}
