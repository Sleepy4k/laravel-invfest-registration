<?php

use App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Route;

Route::get('/', [Frontend\LandingController::class, 'index'])->name('frontend.landing');
Route::controller(Frontend\CompetitionController::class)->name('frontend.competition.')->group(function () {
    Route::get('/competition', 'index')->middleware('guest')->name('index');
    Route::get('/competition/{slug}', 'show')->name('show');
});

// Instead of registering each route file, we can use glob to include all files in the directory
foreach (glob(dirname(__FILE__).'/web/*.php', GLOB_NOSORT) as $route_file) {
    include_once $route_file;
}

// Don't disabled this for checking uptime and overriding default uptime status endpoint
Route::view('uptime', 'pages.health-up')->name('uptime');
