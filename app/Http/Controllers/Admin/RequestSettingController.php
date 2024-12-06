<?php

namespace App\Http\Controllers\Admin;

use App\Foundations\Controller;
use App\Http\Requests\Admin\RequestSettingRequest;
use App\Services\Admin\RequestSettingService;

class RequestSettingController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private RequestSettingService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('pages.admin.request-settings.index', $this->service->index());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestSettingRequest $request)
    {
        try {
            $this->service->store($request->validated());

            return to_route('admin.request-settings.index');
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
