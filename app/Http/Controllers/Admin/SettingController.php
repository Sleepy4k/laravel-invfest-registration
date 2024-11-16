<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Services\Admin\SettingService;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private SettingService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('pages.admin.website-configuration.index', $this->service->index());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $request)
    {
        try {
            $this->service->store($request->validated());

            return to_route('admin.website-configuration.index');
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
