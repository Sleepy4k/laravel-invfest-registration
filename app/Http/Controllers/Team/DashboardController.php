<?php

namespace App\Http\Controllers\Team;

use App\Foundations\Controller;
use App\Services\Team\DashboardService;
use Maatwebsite\Excel\Facades\Excel;

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

    /**
     * Handle the incoming request for export.
     */
    public function export()
    {
        return Excel::download($this->service->export(), 'dashboard_team_'.date('Ymd_His').'.xlsx');
    }
}
