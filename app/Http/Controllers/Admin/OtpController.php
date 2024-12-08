<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\OtpDataTable;
use App\Foundations\Controller;
use App\Services\Admin\OtpService;

class OtpController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private OtpService $service
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(OtpDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.admin.otp.index', $this->service->invoke());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
