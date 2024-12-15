<?php

use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('honeypot')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::resource('login', Auth\LoginController::class)
            ->only(['index', 'store'])
            ->name('index', 'login');

        Route::resource('register', Auth\RegisterController::class)
            ->only(['index', 'store'])
            ->name('index', 'register');
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', Auth\LogoutController::class)->name('logout');

        Route::middleware('role:team')->group(function () {
            Route::middleware('verification_email_access')->controller(Auth\VerificationController::class)->group(function () {
                Route::get('/email/verify', 'index')->name('verification.notice');
                Route::get('/email/verify/{id}/{hash}', 'show')->name('verification.verify');
                Route::post('/email/verification-check', 'store')->name('verification.send');
            });

            Route::middleware(['verified', 'ensure_registration_complete'])->group(function () {
                Route::resource('team-members', Auth\TeamController::class)
                    ->only(['index', 'store'])
                    ->name('index', 'team-members');

                Route::resource('payment-team', Auth\PaymentController::class)
                    ->only(['index', 'store'])
                    ->name('index', 'payment-team');
            });
        });
    });
});
