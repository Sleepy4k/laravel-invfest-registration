<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\CompetitionService;

class CompetitionController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private CompetitionService $service
    ) {}

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        try {
            $slug = htmlspecialchars($slug, ENT_QUOTES, 'UTF-8');

            return view('pages.frontend.competition.show', $this->service->show($slug));
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
