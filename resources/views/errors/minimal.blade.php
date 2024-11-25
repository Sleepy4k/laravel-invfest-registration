<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="title" content="InvFest 9.0">
        <meta name="description" content="InvFest">
        <meta name="keywords" content="lomba, lomba ui/ux, lomba ngoding">
        <meta name="robots" content="index, follow">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="English">

        <title>@yield('code') @yield('title') - InvFest 9.0</title>

        @cspMetaTag(App\Support\CspPolicy::class)

        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="InvFest 9.0">
        <meta property="og:description" content="InvFest">

        <meta name="twitter:card" content="summary_large_image">
        <meta property="twitter:domain" content="{{ url()->current() }}">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta name="twitter:title" content="InvFest 9.0">
        <meta name="twitter:description" content="InvFest">

        <script src="https://cdn.tailwindcss.com"></script>

        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Figtree', 'ui-sans-serif', 'system-ui', 'sans-serif', "Apple Color Emoji", "Segoe UI Emoji"],
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="antialiased">
        <div class="flex items-center justify-center min-h-screen p-5 text-indigo-100 bg-gray-800">
            <div class="w-full max-w-md">
                <h1 class="text-3xl">@yield('code') @yield('title')</h1>
                <p class="mt-3 text-lg leading-tight">@yield('description')</p>
                <div class="mt-5">
                    <a href="{{ route('frontend.landing') }}" class="mt-5 btn-primary">
                        Back to home
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
