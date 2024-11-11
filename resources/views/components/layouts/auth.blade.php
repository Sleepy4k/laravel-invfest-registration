<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $attributes->get('title') }}</title>
        <link rel="shortcut icon" type="image/png" href="{{ isset($appSettings['nav_logo']) ? asset($appSettings['nav_logo']) : '#' }}" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

        <link href="{{ asset('admin/assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        @stack('plugin-styles')

        <style>
            :root {
                --primary: {{ $appSettings['primary_color'] }};
                --primaryHover: {{ $appSettings['primary_color_hover'] }};
                --secondary: {{$appSettings['secondary_color'] }};
                --secondaryHover: {{ $appSettings['secondary_color_hover'] }};
            }
        </style>

        <link href="{{ asset('admin/css/app.css') }}?v={{ uniqid() }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}?v={{ uniqid() }}">

        @stack('style')
    </head>
    <body>
        <div class="main-wrapper" id="app">
            <div class="page-wrapper full-page">
                @include('sweetalert::alert')

                {{ $slot }}
            </div>
        </div>

        <script src="{{ asset('js/warning.js') }}"></script>
        <script src="{{ asset('admin/js/app.js') }}"></script>
        <script src="{{ asset('admin/assets/plugins/feather-icons/feather.min.js') }}"></script>

        @stack('plugin-scripts')

        <script src="{{ asset('admin/assets/js/template.js') }}"></script>

        @stack('custom-scripts')
    </body>
</html>