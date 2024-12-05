<?php

namespace App\Http\Controllers\Frontend;

use App\Foundations\Controller;
use App\Services\Frontend\CompetitionService;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private CompetitionService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!$request->ajax() || !$request->acceptsJson()) return to_route('frontend.landing');

        try {
            $platform = request('platform', null);
            if ($platform == null || $platform != config('app.url')) return to_route('frontend.landing');

            return response()->json($this->service->index());
        } catch (\Throwable $th) {
            return response()->json(['competitions' => []]);
        }
    }

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
