<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\TeamDataTable;
use App\Foundations\Controller;
use App\Http\Requests\Admin\TeamRequest;
use App\Services\Admin\TeamService;

class TeamController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private TeamService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(TeamDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.admin.teams.index', $this->service->index());
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
            return view('pages.admin.teams.show', $this->service->show($id));
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamRequest $request, string $id)
    {
        try {
            $this->service->update($request->validated(), $id);

            return to_route('admin.team.index');
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

            return to_route('admin.team.index');
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
