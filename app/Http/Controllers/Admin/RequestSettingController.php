<?php

namespace App\Http\Controllers\Admin;

use App\Foundations\Controller;
use App\Services\Admin\RequestSettingService;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        try {
            $this->service->store($request->all());

            return to_route('admin.request-settings.index');
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
