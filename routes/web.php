<?php

use App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Route;

Route::get('/', [Frontend\LandingController::class, 'index'])->name('frontend.landing');
Route::get('/competition/{slug}', [Frontend\CompetitionController::class, 'show'])
    ->name('frontend.competition.show');

Route::middleware('guest')->group(function () {
    Route::get('/competition', [Frontend\CompetitionController::class, 'index'])
        ->name('frontend.competition.index');
});

foreach (glob(dirname(__FILE__).'/web/*.php', GLOB_NOSORT) as $route_file) {
    include_once $route_file;
}

// Don't disabled this for checking uptime and overriding default uptime status endpoint
Route::view('uptime', 'pages.health-up')->name('uptime');
