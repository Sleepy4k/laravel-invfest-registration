<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $bindings = [
            'App\Contracts\EloquentInterface' => 'App\Repositories\EloquentRepository',
            'App\Contracts\Models\CompetitionInterface' => 'App\Repositories\Models\CompetitionRepository',
            'App\Contracts\Models\CompetitionLevelInterface' => 'App\Repositories\Models\CompetitionLevelRepository',
            'App\Contracts\Models\MediaPartnerInterface' => 'App\Repositories\Models\MediaPartnerRepository',
            'App\Contracts\Models\OtpInterface' => 'App\Repositories\Models\OtpRepository',
            'App\Contracts\Models\PaymentInterface' => 'App\Repositories\Models\PaymentRepository',
            'App\Contracts\Models\PaymentMethodInterface' => 'App\Repositories\Models\PaymentMethodRepository',
            'App\Contracts\Models\SettingInterface' => 'App\Repositories\Models\SettingRepository',
            'App\Contracts\Models\SponsorshipInterface' => 'App\Repositories\Models\SponsorshipRepository',
            'App\Contracts\Models\SponsorshipTierInterface' => 'App\Repositories\Models\SponsorshipTierRepository',
            'App\Contracts\Models\SubmissionInterface' => 'App\Repositories\Models\SubmissionRepository',
            'App\Contracts\Models\TeamCompanionInterface' => 'App\Repositories\Models\TeamCompanionRepository',
            'App\Contracts\Models\TeamInterface' => 'App\Repositories\Models\TeamRepository',
            'App\Contracts\Models\TeamLeaderInterface' => 'App\Repositories\Models\TeamLeaderRepository',
            'App\Contracts\Models\TeamMemberInterface' => 'App\Repositories\Models\TeamMemberRepository',
            'App\Contracts\Models\TimelineInterface' => 'App\Repositories\Models\TimelineRepository',
            'App\Contracts\Models\UserInterface' => 'App\Repositories\Models\UserRepository',
        ];

        foreach ($bindings as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
