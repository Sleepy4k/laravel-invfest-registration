<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\RegisterService;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private RegisterService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('pages.auth.register', $this->service->index());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        try {
            $result = $this->service->store($request->validated());

            if ($result) {
                toast('Pendaftaran berhasil, silahkan cek email untuk melakukan verifikasi');

                return to_route('verification.notice');
            }
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
