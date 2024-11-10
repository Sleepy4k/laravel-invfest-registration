<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ $title ?? '' }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset(getWebConfiguration()->nav_logo) }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- plugin css -->
    <link href="{{ asset('admin/assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
    <!-- end plugin css -->

    @stack('plugin-styles')


    <style>
        :root {
            --primary: {{ getWebConfiguration()->primary_color }};
            --primaryHover: {{ getWebConfiguration()->primary_color_hover }};
            --secondary: {{ getWebConfiguration()->secondary_color }};
            --secondaryHover: {{ getWebConfiguration()->secondary_color_hover }};
        }
    </style>

    <!-- common css -->
    <link href="{{ asset('admin/css/app.css') }}?v={{ uniqid() }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}?v={{ uniqid() }}">
    <!-- end common css -->

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

    <!-- base js -->
    <script src="{{ asset('frontend/js/script.js') }}"></script>
    <script src="{{ asset('admin/js/app.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('admin/assets/js/template.js') }}"></script>
    <!-- end common js -->

    @stack('custom-scripts')
</body>

</html>
