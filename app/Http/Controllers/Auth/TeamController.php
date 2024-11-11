<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TeamRequest;
use App\Services\Auth\TeamService;

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
    public function index()
    {
        return view('pages.auth.team-member');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamRequest $request)
    {
        try {
            $this->service->store($request->validated());

            alert('Pendaftaran berhasil', 'silahkan melakukan pembayaran untuk menyelesaikan pendaftaran', 'success');

            return to_route('payment-team');
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
