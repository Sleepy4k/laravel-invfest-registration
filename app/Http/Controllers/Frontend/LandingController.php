<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\LandingService;

class LandingController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private LandingService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('pages.landing', $this->service->index());
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
