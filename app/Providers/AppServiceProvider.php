<?php

namespace App\Providers;

use App\View\Composers;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singletonIf(Composers\AppSettingComposer::class);
        $this->app->singletonIf(Composers\LatestCompetitionComposer::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();

        RateLimiter::for('web', function (Request $request) {
            return Limit::perMinute(30)->by(optional($request->user())->id ?: $request->ip())->response(function () use ($request) {
                abort(429, 'Too Many Requests');
            });
        });
    }
}
