<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Tool;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::middleware('role:petugas|admin')->group(function () {
        Route::get('/dashboard', Admin\DashboardController::class)->name('dashboard');
        Route::get('/dashboard/export', [Admin\DashboardController::class, 'export'])->name('dashboard.export');
        Route::resource('team', Admin\TeamController::class)->except(['create', 'store', 'edit']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/user', Admin\UserController::class)->name('user');
        Route::get('/otp', Admin\OtpController::class)->name('otp');
        Route::resource('work', Admin\SubmissionController::class)->only(['index', 'update']);
        Route::resource('competition', Admin\CompetitionController::class);
        Route::resource('level', Admin\CompetitionLevelController::class)->except('show');
        Route::resource('timeline', Admin\TimelineController::class);
        Route::resource('sponsor', Admin\SponsorshipController::class)->except('show');
        Route::resource('tier', Admin\SponsorshipTierController::class)->except('show');
        Route::resource('media-partner', Admin\MediaPartnerController::class)->except('show');
        Route::resource('payment-method', Admin\PaymentMethodController::class)->except('show');
        Route::resource('website-configuration', Admin\SettingController::class)
            ->only(['index', 'store'])
            ->parameter('website-configuration', 'id');

        Route::resource('request-settings', Admin\RequestSettingController::class)
            ->only(['index', 'store']);

        Route::prefix('log')->group(function () {
            Route::resource('auth', Admin\AuthLogController::class)->only(['index', 'show']);
            Route::resource('model', Admin\ModelLogController::class)->only(['index', 'show']);
            Route::resource('system', Admin\SystemLogController::class)->only(['index', 'show']);
        });

        Route::prefix('tools')->name('tools.')->group(function () {
            Route::resource('clear-cache', Tool\ClearCacheController::class)->only(['index', 'store']);
            Route::resource('optimize', Tool\OptimizeController::class)->only(['index', 'store']);
            Route::resource('sitemap', Tool\SitemapController::class)->only(['index', 'store']);
        });
    });
});
