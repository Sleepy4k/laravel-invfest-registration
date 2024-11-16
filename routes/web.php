<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Frontend;
use App\Http\Controllers\Team;
use Illuminate\Support\Facades\Route;

Route::get('/', [Frontend\LandingController::class, 'index'])->name('frontend.landing');
Route::get('/competition/{slug}', [Frontend\CompetitionController::class, 'show'])->name('frontend.competition.show');

Route::middleware('guest')->group(function () {
    Route::resource('login', Auth\LoginController::class)
        ->only(['index', 'store'])
        ->name('index', 'login');

    Route::resource('register', Auth\RegisterController::class)
        ->only(['index', 'store'])
        ->name('index', 'register');

    Route::get('/competition/list', [Frontend\CompetitionController::class, 'index'])->name('frontend.competition.index');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', Auth\LogoutController::class)->name('logout');

    Route::middleware('role:team')->group(function () {
        Route::middleware('verification_email_access')->group(function () {
            Route::get('/email/verify', [Auth\VerificationController::class, 'index'])->name('verification.notice');
            Route::get('/email/verify/{id}/{hash}', [Auth\VerificationController::class, 'show'])->name('verification.verify');
            Route::post('/email/verification-check', [Auth\VerificationController::class, 'store'])->name('verification.send');
        });

        Route::middleware('verified')->group(function () {
            Route::resource('team-members', Auth\TeamController::class)
                ->only(['index', 'store'])
                ->name('index', 'team-members');

            Route::resource('payment-team', Auth\PaymentController::class)
                ->only(['index', 'store'])
                ->name('index', 'payment-team');

            Route::prefix('team')->name('team.')->group(function () {
                Route::get('/dashboard', Team\DashboardController::class)->name('dashboard');
                Route::resource('karya', Auth\PaymentController::class)
                    ->only(['index', 'store'])
                    ->names([
                        'index' => 'work',
                        'store' => 'work.store'
                    ]);
            });
        });
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::middleware('role:petugas|admin')->group(function () {
            Route::get('/dashboard', Admin\DashboardController::class)->name('dashboard');
            Route::resource('team', Admin\TeamController::class)->except(['create', 'store', 'edit']);
        });

        Route::middleware('role:admin')->group(function () {
            Route::resource('work', Admin\SubmissionController::class)->only(['index', 'update']);
            Route::resource('competition', Admin\TeamController::class);
            Route::resource('timeline', Admin\TimelineController::class);
            Route::resource('sponsor', Admin\SponsorshipController::class)->except('show');
            Route::resource('media-partner', Admin\MediaPartnerController::class)->except('show');
            Route::resource('payment-method', Admin\PaymentMethodController::class)->except('show');
            Route::resource('website-configuration', Admin\SettingController::class)
                ->only(['index', 'store'])
                ->parameter('website-configuration', 'id');
        });
    });
});
