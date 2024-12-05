<?php

namespace App\Http\Controllers\Admin;

use App\Foundations\Controller;
use App\Services\Admin\DashboardService;
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
        try {
            return view('pages.admin.dashboard', $this->service->invoke());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Handle the incoming request for export.
     */
    public function export()
    {
        return Excel::download($this->service->export(), 'dashboard_'.date('YmdHis').'.xlsx');
    }
}
