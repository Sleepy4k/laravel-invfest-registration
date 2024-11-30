<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ModelLogDataTable;
use App\Http\Controllers\Controller;
use App\Services\Admin\ModelLogService;

class ModelLogController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private ModelLogService $service
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(ModelLogDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.admin.model.index', $this->service->invoke());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
