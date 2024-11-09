<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        Vite::useIntegrityKey(hash('sha512', Str::slug(config('app.name')).'|x|'.config('app.key')));

        JsonResource::withoutWrapping();

        RateLimiter::for('web', function (Request $request) {
            return Limit::perMinute(30)->by(optional($request->user())->id ?: $request->ip())->response(function () use ($request) {
                if ($request->inertia()) return inertia('Error', ['status' => 429])
                    ->toResponse($request)
                    ->setStatusCode(429);

                abort(429, 'Too Many Requests');
            });
        });
    }
}
