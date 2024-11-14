<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private DashboardService $service
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        try {
            return view('pages.admin.dashboard', $this->service->invoke());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
