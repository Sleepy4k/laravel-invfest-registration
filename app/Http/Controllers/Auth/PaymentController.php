<?php

namespace App\Http\Controllers\Auth;

use App\Foundations\Controller;
use App\Http\Requests\Auth\PaymentRequest;
use App\Services\Auth\PaymentService;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private PaymentService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (!is_null(auth('web')->user()->leader?->payment)) {
                toast('Pembayaran sudah dilakukan, silahkan menunggu konfirmasi dari admin', 'success');

                return to_route('team.dashboard');
            }

            return view('pages.auth.payment', $this->service->index());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        try {
            $this->service->store($request->validated());

            toast('Pembayaran berhasil, silahkan menunggu konfirmasi dari admin', 'success');

            return redirect()->intended(route('team.dashboard', absolute: false));
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
