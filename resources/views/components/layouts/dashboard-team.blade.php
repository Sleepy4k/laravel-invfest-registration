<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="title" content="{{ $title }}">
        <meta name="description" content="{{ $description ?? '' }}">
        <meta name="author" content="Benjamin4k">
        <meta name="coverage" content="Worldwide">
        <meta name="distribution" content="Global">
        <meta name="robots" content="index, follow">
        <meta name="keywords" content="lomba, lomba ui/ux, lomba web, lomba ngoding, invfest, 9.0, invfest 9.0">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <link rel="canonical" href="{{ config('app.url') }}">
        <link rel="apple-touch-icon" href="{{ asset($appSettings['nav_logo'] ?? '#') }}" />
        <link rel="icon" type="image/png" href="{{ asset($appSettings['nav_logo'] ?? '#') }}" />
        <link rel="icon" type="image/x-icon" href="{{ asset($appSettings['nav_logo'] ?? '#') }}">
        <link rel="shortcut icon" type="image/png" href="{{ asset($appSettings['nav_logo'] ?? '#') }}" />
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset($appSettings['nav_logo'] ?? '#') }}">

        <title>{{ $title }}</title>

        @cspMetaTag(App\Support\CspPolicy::class)

        <meta property="csp-nonce" content="{{ csp_nonce() }}">

        <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ $appSettings['title'] ?? '#' }}">
        <meta property="og:title" content="{{ $title }}">
        <meta property="og:description" content="{{ $description ?? '' }}">
        <meta property="og:image" content="{{ asset('images/banner.png') }}">
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />

        <meta name="twitter:card" content="summary_large_image">
        <meta property="twitter:domain" content="{{ url()->current() }}">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta name="twitter:title" content="{{ $title }}">
        <meta name="twitter:description" content="{{ $description ?? '' }}">
        <meta name="twitter:image" content="{{ asset('images/banner.png') }}">

        <style nonce="{{ csp_nonce() }}">
            :root {
                --primary: {{ $appSettings['primary_color'] }};
                --primaryHover: {{ $appSettings['primary_color_hover'] }};
                --secondary: {{$appSettings['secondary_color'] }};
                --secondaryHover: {{ $appSettings['secondary_color_hover'] }};
            }
        </style>
        <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}" nonce="{{ csp_nonce() }}" />
        <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}" nonce="{{ csp_nonce() }}" />

        <link rel="stylesheet" href="{{ asset('frontend/plugins/bootstrap-icons/font/bootstrap-icons.min.css') }}" nonce="{{ csp_nonce() }}" />
        <link rel="stylesheet" href="{{ asset('frontend/plugins/fontawesome/css/all.min.css') }}" nonce="{{ csp_nonce() }}" />

        @stack('plugin-styles')

        @stack('styles')
    </head>
    <body>
        <x-frontend.navbar />

        <div class="container mt-5">
            <div class="row">
                @include('sweetalert::alert')

                <div class="col-sm-12 col-lg-3 col-md-4">
                    <x-frontend.sidebar-team />
                </div>

                <div class="col-sm-12 col-lg-9 col-md-8 mt-5 mt-lg-0">
                    <div class="card border-0 shadow-sm  mt-lg-0 mt-md-0">
                        <div class="card-header">
                            {{ $title }}
                        </div>
                        <div class="card-body">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-frontend.mobile-navbar />

        <script src="{{ asset('js/jquery.min.js') }}" nonce="{{ csp_nonce() }}"></script>
        <script src="{{ asset('frontend/js/app.js') }}" nonce="{{ csp_nonce() }}"></script>
        <script src="{{ asset('js/warning.js') }}" nonce="{{ csp_nonce() }}"></script>

        @stack('plugin-scripts')

        @stack('custom-scripts')
    </body>
</html>
