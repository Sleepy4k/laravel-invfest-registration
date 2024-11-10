<!doctype html>
<html lang="en">

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

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description ?? '' }}">
    <meta property="og:image" content="{{ asset('opengraphimg.jpg') }}">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ url()->current() }}">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description ?? '' }}">
    <meta name="twitter:image" content="{{ asset('opengraphimg.jpg') }}">

    <link rel="shortcut icon" href="{{ asset(getWebConfiguration()->nav_logo) }}" type="image/x-icon">

    <style>
        :root {
            --primary: {{ getWebConfiguration()->primary_color }};
            --primaryHover: {{ getWebConfiguration()->primary_color_hover }};
            --secondary: {{ getWebConfiguration()->secondary_color }};
            --secondaryHover: {{ getWebConfiguration()->secondary_color_hover }};
        }
    </style>
    <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}?v={{ uniqid() }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/timeline.css') }}?v={{ uniqid() }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}?v={{ uniqid() }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />


    @stack('plugin-styles')

    @stack('styles')

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4R4YH0E86P"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-4R4YH0E86P');
    </script>
</head>

<body>

    <x-frontend.navbar />

    {{ $slot }}

    <x-frontend.mobile-navbar />



    <x-frontend.footer />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('frontend/js/app.js') }}?v={{ uniqid() }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}?v={{ uniqid() }}"></script>
    <script>
        $(document).ready(function() {
            $('.back-to-top').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });
    </script>

    @stack('plugin-scripts')

    @stack('custom-scripts')

</body>

</html>
