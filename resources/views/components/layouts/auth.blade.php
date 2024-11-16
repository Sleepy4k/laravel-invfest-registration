<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $attributes->get('title') }}</title>

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

        <link rel="shortcut icon" type="image/png" href="{{ isset($appSettings['nav_logo']) ? asset($appSettings['nav_logo']) : '#' }}" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

        <link href="{{ asset('admin/assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" nonce="{{ csp_nonce() }}" />
        <link href="{{ asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" nonce="{{ csp_nonce() }}" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        @stack('plugin-styles')

        <style nonce="{{ csp_nonce() }}">
            :root {
                --primary: {{ $appSettings['primary_color'] }};
                --primaryHover: {{ $appSettings['primary_color_hover'] }};
                --secondary: {{$appSettings['secondary_color'] }};
                --secondaryHover: {{ $appSettings['secondary_color_hover'] }};
            }
        </style>

        <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet" nonce="{{ csp_nonce() }}" />
        <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}" nonce="{{ csp_nonce() }}">

        @stack('style')
    </head>
    <body>
        <div class="main-wrapper" id="app">
            <div class="page-wrapper full-page">
                @include('sweetalert::alert')

                {{ $slot }}
            </div>
        </div>

        <script src="{{ asset('js/warning.js') }}" nonce="{{ csp_nonce() }}"></script>
        <script src="{{ asset('admin/js/app.js') }}" nonce="{{ csp_nonce() }}"></script>
        <script src="{{ asset('admin/assets/plugins/feather-icons/feather.min.js') }}"></script>

        @stack('plugin-scripts')

        <script src="{{ asset('admin/assets/js/template.js') }}" nonce="{{ csp_nonce() }}"></script>

        @stack('custom-scripts')
    </body>
</html>
