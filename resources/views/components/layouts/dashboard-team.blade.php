<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="title" content="{{ $title }}">
        <meta name="description" content="{{ $description ?? '' }}">
        <meta name="keywords" content="lomba, lomba ui/ux, lomba ngoding">
        <meta name="robots" content="index, follow">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="English">

        <title>{{ $title }}</title>

        @cspMetaTag(App\Support\CspPolicy::class)

        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $title }}">
        <meta property="og:description" content="{{ $description ?? '' }}">
        <meta property="og:image" content="{{ asset('images/banner.png') }}">

        <meta name="twitter:card" content="summary_large_image">
        <meta property="twitter:domain" content="{{ url()->current() }}">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta name="twitter:title" content="{{ $title }}">
        <meta name="twitter:description" content="{{ $description ?? '' }}">
        <meta name="twitter:image" content="{{ asset('images/banner.png') }}">

        <link rel="shortcut icon" href="{{ isset($appSettings['nav_logo']) ? asset($appSettings['nav_logo']) : '#' }}" type="image/x-icon">

        <style>
            :root {
                --primary: {{ $appSettings['primary_color'] }};
                --primaryHover: {{ $appSettings['primary_color_hover'] }};
                --secondary: {{$appSettings['secondary_color'] }};
                --secondaryHover: {{ $appSettings['secondary_color_hover'] }};
            }
        </style>
        <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />

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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="{{ asset('frontend/js/app.js') }}"></script>
        <script src="{{ asset('js/warning.js') }}"></script>

        @stack('plugin-scripts')

        @stack('custom-scripts')
    </body>
</html>
