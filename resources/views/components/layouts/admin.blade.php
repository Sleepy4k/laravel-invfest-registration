<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin - {{ $title ?? '' }}</title>

        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $title }}">
        <meta property="og:description" content="{{ $description ?? '' }}">
        <meta property="og:image" content="{{ isset($appSettings['nav_logo']) ? asset($appSettings['nav_logo']) : '#' }}">

        <meta name="twitter:card" content="summary_large_image">
        <meta property="twitter:domain" content="{{ url()->current() }}">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta name="twitter:title" content="{{ $title }}">
        <meta name="twitter:description" content="{{ $description ?? '' }}">
        <meta name="twitter:image" content="{{ isset($appSettings['nav_logo']) ? asset($appSettings['nav_logo']) : '#' }}">

        <link rel="shortcut icon" type="image/png" href="{{ asset(getWebConfiguration()->nav_logo) }}" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

        <link href="{{ asset('admin/assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />

        @stack('plugin-styles')

        <style>
            :root {
                --primary: {{ getWebConfiguration()->primary_color }};
                --primaryHover: {{ getWebConfiguration()->primary_color_hover }};
                --secondary: {{ getWebConfiguration()->secondary_color }};
                --secondaryHover: {{ getWebConfiguration()->secondary_color_hover }};
            }
        </style>

        <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">

        @stack('style')
    </head>
    <body>
        <div class="main-wrapper" id="app">
            <x-admin.sidebar />

            <div class="page-wrapper">
                <x-admin.header />

                @include('sweetalert::alert')

                <div class="page-content">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <script src="{{ asset('frontend/js/script.js') }}"></script>
        <script src="{{ asset('admin/js/app.js') }}"></script>
        <script src="{{ asset('admin/assets/plugins/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

        @stack('plugin-scripts')

        <script src="{{ asset('admin/assets/js/template.js') }}"></script>

        @stack('custom-scripts')
    </body>
</html>
