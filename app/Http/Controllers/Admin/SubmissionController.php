<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SubmissionService;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private SubmissionService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('pages.admin.works.index', $this->service->index());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $status = $request->input('is_reviewed');
            if ($status == null || $status !== '1') {
                toast('Proses verifikasi gagal, silahkan coba lagi', 'error');
                return back()->withInput();
            }

            $this->service->update($id);

            return to_route('admin.work.index');
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
