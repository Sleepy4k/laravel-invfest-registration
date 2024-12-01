<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginRequest $request)
    {
        try {
            if (!auth('web')->attempt($request->validated())) {
                toast('Email atau password salah', 'error');
                return back();
            }

            toast('Authentikasi berhasil, selamat datang kembali', 'success');

            $user = auth('web')->user();
            $isUserAdmin = $user->hasRole('admin') || $user->hasRole('petugas');

            return redirect()->route($isUserAdmin ? 'admin.dashboard' : 'team.dashboard');
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
