<?php

use App\Http\Controllers\Team;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:team', 'verified', 'ensure_registration_complete'])->group(function () {
    Route::prefix('team')->name('team.')->group(function () {
        Route::controller(Team\DashboardController::class)->group(function () {
            Route::get('/', 'index')->name('dashboard');
            Route::get('export', 'export')->name('dashboard.export');
        });

        Route::resource('karya', Team\SubmissionController::class)
            ->only(['index', 'store'])
            ->names([
                'index' => 'work',
                'store' => 'work.store'
            ]);
    });
});
