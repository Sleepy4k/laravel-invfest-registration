<?php

namespace App\Http\Controllers\Tool;

use Illuminate\Support\Facades\Artisan;

class SitemapController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.system-tools.sitemap');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        try {
            Artisan::call('make:sitemap');
        } catch (\Exception) {}

        return redirect()->route('admin.tools.sitemap.index');
    }
}
