<?php

namespace App\Http\Controllers\Auth;

use App\Foundations\Controller;
use App\Http\Requests\Auth\VerificationRequest;
use App\Services\Auth\VerificationService;

class VerificationController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private VerificationService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.auth.verification-email');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VerificationRequest $request)
    {
        try {
            $result = $this->service->store($request->validated());

            return $result ? to_route('team-members') : back();
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, string $hash)
    {
        try {
            $result = $this->service->show($id, $hash);

            return $result ? to_route('team-members') : abort(404);
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
