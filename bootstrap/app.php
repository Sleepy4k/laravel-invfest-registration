<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: null, // disabled due we want to override this
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \Spatie\Csp\AddCspHeaders::class,
            \Bepsvpt\SecureHeaders\SecureHeadersMiddleware::class,

            // Start page speed
            \RenatoMarinho\LaravelPageSpeed\Middleware\InlineCss::class,
            \RenatoMarinho\LaravelPageSpeed\Middleware\ElideAttributes::class,
            \RenatoMarinho\LaravelPageSpeed\Middleware\InsertDNSPrefetch::class,
            \RenatoMarinho\LaravelPageSpeed\Middleware\RemoveComments::class,
            \RenatoMarinho\LaravelPageSpeed\Middleware\CollapseWhitespace::class,
        ]);

        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'verification_email_access' => \App\Http\Middleware\VerificationEmailAccess::class,
            'ensure_registration_complete' => \App\Http\Middleware\EnsureRegistrationComplete::class,
        ]);

        $middleware->redirectGuestsTo('/');
        $middleware->redirectTo(function (Request $request) {
            $user = $request->user('web');
            if ($user == null) return url('/');

            $isUserAdmin = $user->hasRole('admin') || $user->hasRole('petugas');

            return redirect()->route($isUserAdmin ? 'admin.dashboard' : 'team.dashboard');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
