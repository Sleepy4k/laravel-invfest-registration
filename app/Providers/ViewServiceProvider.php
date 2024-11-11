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
            'pages.auth.login',
            'pages.auth.register',

            'components.layouts.auth',
            'components.layouts.frontend',

            'components.frontend.footer',
            'components.frontend.navbar',
            'components.frontend.timeline',
            'components.frontend.card.hero',
            'components.frontend.card.information',
        ], Composers\AppSettingComposer::class);

        view()->composer('components.frontend.footer', Composers\LatestCompetitionComposer::class);
    }
}
