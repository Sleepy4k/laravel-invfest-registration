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
        if (auth('web')->attempt($request->validated())) {
            alert('Authentikasi Berhasil', 'Selamat datang '.auth('web')->user()->email, 'success');
        } else {
            alert('Authentikasi Gagal', 'Email atau password salah', 'error');
        }

        return redirect()->back();
    }
}
