<?php

use App\Http\Controllers\Team;
use Illuminate\Support\Facades\Route;

Route::prefix('team')->name('team.')->middleware(['auth', 'role:team', 'verified', 'ensure_registration_complete'])->group(function () {
    Route::get('/dashboard', Team\DashboardController::class)->name('dashboard');
    Route::get('/dashboard/export', [Team\DashboardController::class, 'export'])->name('dashboard.export');
    Route::resource('karya', Team\SubmissionController::class)
        ->only(['index', 'store'])
        ->names([
            'index' => 'work',
            'store' => 'work.store'
        ]);
});
