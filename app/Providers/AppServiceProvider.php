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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->runningInConsole()) return;

        JsonResource::withoutWrapping();

        RateLimiter::for('web', function (Request $request) {
            return Limit::perMinute(30)->by($request->ip())->response(function () {
                abort(429, 'Too Many Requests, Slow Down!');
            });
        });
    }
}
