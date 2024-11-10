<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
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
            \RenatoMarinho\LaravelPageSpeed\Middleware\CollapseWhitespace::class, // Note: This middleware invokes "RemoveComments::class" before it runs.
            \RenatoMarinho\LaravelPageSpeed\Middleware\DeferJavascript::class,
        ]);

        $middleware->redirectGuestsTo('/');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
