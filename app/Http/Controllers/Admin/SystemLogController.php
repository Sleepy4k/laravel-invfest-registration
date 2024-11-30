<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SystemLogDataTable;
use App\DataTables\Admin\SystemLogDetailDataTable;
use App\Http\Controllers\Controller;
use App\Services\Admin\SystemLogService;

class SystemLogController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private SystemLogService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(SystemLogDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.admin.system.index', $this->service->index());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SystemLogDetailDataTable $dataTable, string $id)
    {
        try {
            return $dataTable->render('pages.admin.system.show', $this->service->show($id));
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
