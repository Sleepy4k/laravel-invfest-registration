<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Services\Team\DashboardService;

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
        return view('pages.team.dashboard', $this->service->invoke());
    }
}
