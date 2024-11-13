<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Team;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Frontend;

Route::get('/', [Frontend\LandingController::class, 'index'])->name('frontend.landing');
Route::get('/competition/{slug}', [Frontend\CompetitionController::class, 'show'])->name('frontend.competition.show');

Route::get('/email/verify', [Auth\VerificationController::class, 'index'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [Auth\VerificationController::class, 'show'])->name('verification.verify');
Route::post('/email/verification-check', [Auth\VerificationController::class, 'store'])->name('verification.send');

Route::middleware('guest')->group(function () {
    Route::get('/login', [Auth\LoginController::class, 'index'])->name('login');
    Route::post('/login', [Auth\LoginController::class, 'store'])->name('login.store');

    Route::get('/register', [Auth\RegisterController::class, 'index'])->name('register');
    Route::post('/register', [Auth\RegisterController::class, 'store'])->name('register.store');

    Route::get('/competition', [Frontend\CompetitionController::class, 'index'])->name('frontend.competition.index');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', Auth\LogoutController::class)->name('logout');

    Route::middleware('role:team')->group(function () {
        Route::get('/team-members', [Auth\TeamController::class, 'index'])->name('team-members');
        Route::post('/team-members', [Auth\TeamController::class, 'store'])->name('team-members.store');

        Route::get('/payment-team', [Auth\PaymentController::class, 'index'])->name('payment-team');
        Route::post('/payment-team', [Auth\PaymentController::class, 'store'])->name('payment-team.store');

        Route::middleware('verified')->prefix('team')->name('team.')->group(function () {
            Route::get('/dashboard', Team\DashboardController::class)->name('dashboard');
            Route::get('/karya', [Team\SubmissionController::class, 'index'])->name('work');
            Route::post('/karya', [Team\SubmissionController::class, 'store'])->name('work.store');
        });
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () { return dd('admin dashboard'); })->name('dashboard');

        Route::middleware('role:petugas|admin')->group(function () {
            // Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
            // Route::resource('team', Admin\TeamController::class);
        });

        Route::middleware('role:admin')->group(function () {
            // Route::get('/website-configuration', [Admin\WebConfigurationController::class, 'index'])->name('website-configuration.index');
            // Route::put('/website-configuration/{id}', [Admin\WebConfigurationController::class, 'update'])->name('website-configuration.update');

            // Route::resource('competition', Admin\CompetitionController::class);
            // Route::resource('timeline', Admin\TimelineController::class);
            // Route::resource('payment-method', Admin\PaymentMethodController::class);
            // Route::resource('sponsor', Admin\SponsorController::class);
            // Route::resource('media-partner', Admin\MediaPartnerController::class);
            // Route::resource('work', Admin\WorkController::class);
        });
    });
});
