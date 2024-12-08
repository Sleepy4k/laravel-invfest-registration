<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDataTable;
use App\Foundations\Controller;
use App\Services\Admin\UserService;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private UserService $service
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UserDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.admin.user.index', $this->service->invoke());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
