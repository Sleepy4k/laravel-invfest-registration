<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SponsorshipDataTable;
use App\Foundations\Controller;
use App\Http\Requests\Admin\Sponsorship\StoreRequest;
use App\Http\Requests\Admin\Sponsorship\UpdateRequest;
use App\Services\Admin\SponsorshipService;

class SponsorshipController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private SponsorshipService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(SponsorshipDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.admin.sponsors.index', $this->service->index());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('pages.admin.sponsors.create', $this->service->create());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $this->service->store($request->validated());

            return to_route('admin.sponsor.index');
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
            return view('pages.admin.sponsors.edit', $this->service->edit($id));
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

            return to_route('admin.sponsor.index');
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

            return to_route('admin.sponsor.index');
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
