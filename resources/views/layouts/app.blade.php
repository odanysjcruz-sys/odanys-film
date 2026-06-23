<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" type="image/png" href="/images/odanys_logo_final.png">
    <link rel="apple-touch-icon" href="/images/odanys_logo_final.png">
    <link rel="preload" as="image" href="/images/hero.webp" fetchpriority="high">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')

</body>
</html>
