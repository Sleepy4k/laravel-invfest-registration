<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PaymentMethodDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentMethod\StoreRequest;
use App\Http\Requests\Admin\PaymentMethod\UpdateRequest;
use App\Services\Admin\PaymentMethodService;

class PaymentMethodController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private PaymentMethodService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(PaymentMethodDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.admin.payment-methods.index', $this->service->index());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.payment-methods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $this->service->store($request->validated());

            return to_route('admin.payment-method.index');
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            return view('pages.admin.payment-methods.edit', $this->service->edit($id));
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        try {
            $this->service->update($request->validated(), $id);

            return to_route('admin.payment-method.index');
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->service->destroy($id);

            return to_route('admin.payment-method.index');
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
