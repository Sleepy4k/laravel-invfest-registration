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
     * Display a listing of the resource.
     */
    public function index(ModelLogDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.admin.model.index', $this->service->index());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return view('pages.admin.model.show', $this->service->show($id));
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
