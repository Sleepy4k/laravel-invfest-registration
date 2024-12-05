<?php

namespace App\Providers;

use App\Models;
use App\Observers;
use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Models\Competition::observe(Observers\CompetitionObserver::class);
        Models\MediaPartner::observe(Observers\MediaPartnerObserver::class);
        Models\PaymentMethod::observe(Observers\PaymentMethodObserver::class);
        Models\Payment::observe(Observers\PaymentObserver::class);
        Models\Setting::observe(Observers\SettingObserver::class);
        Models\Sponsorship::observe(Observers\SponsorshipObserver::class);
        Models\Submission::observe(Observers\SubmissionObserver::class);
        Models\TeamCompanion::observe(Observers\TeamCompanionObserver::class);
        Models\TeamLeader::observe(Observers\TeamLeaderObserver::class);
        Models\TeamMember::observe(Observers\TeamMemberObserver::class);
        Models\Timeline::observe(Observers\TimelineObserver::class);
    }
}
