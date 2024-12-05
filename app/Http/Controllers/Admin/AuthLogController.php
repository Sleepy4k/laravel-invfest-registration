<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AuthLogDataTable;
use App\Foundations\Controller;
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
     * Display a listing of the resource.
     */
    public function index(AuthLogDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.admin.auth.index', $this->service->index());
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
            return view('pages.admin.auth.show', $this->service->show($id));
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
