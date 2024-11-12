<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\SubmissionRequest;
use App\Services\Team\SubmissionService;

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
        return view('pages.team.work', $this->service->index());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubmissionRequest $request)
    {
        try {
            $this->service->store($request->validated());

            toast('Berhasil', 'Karya berhasil ditambahkan, semoga sukses!', 'success');

            return back();
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
