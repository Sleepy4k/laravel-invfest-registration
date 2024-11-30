<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AuthLogDataTable;
use App\Http\Controllers\Controller;
use App\Services\Admin\AuthLogService;

class AuthLogController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private AuthLogService $service
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(AuthLogDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.admin.auth.index', $this->service->invoke());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
