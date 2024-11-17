<?php

namespace App\Providers;

use App\View\Composers;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        view()->composer([
            'pages.landing',
            'pages.health-up',
            'pages.auth.login',
            'pages.auth.register',
            'pages.team.dashboard',
            'pages.team.work',

            'components.layouts.admin',
            'components.layouts.auth',
            'components.layouts.frontend',
            'components.layouts.dashboard-team',

            'components.admin.sidebar',
            'components.frontend.footer',
            'components.frontend.navbar',
            'components.frontend.timeline',
            'components.frontend.card.hero',
            'components.frontend.card.information',

            'vendor.mail.html.header',
        ], Composers\AppSettingComposer::class);

        view()->composer('components.frontend.footer', Composers\LatestCompetitionComposer::class);
    }
}
