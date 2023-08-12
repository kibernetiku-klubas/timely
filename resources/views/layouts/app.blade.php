<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')
    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
<footer class="footer footer-center p-4 bg-white text-black">
    <div>
        <div class="flex items-center space-x-2">
            <div class="text-black text-lg font-bold p-2">Timely</div>
            <div class="text-sm p-2">v1.1.1-beta</div>
            <div class="p-2">&copy; 2023 Kibernetiku klubas</div>
            <div><a href="mailto:support@timely.lt" class="p-2 rounded-lg btn-ghost">support@timely.lt</a></div>
        </div>
        <div class="flex items-center space-x-2 mt-2">
            <div>| <a href="/privacy-policy" target="_blank" class="p-2 rounded-lg btn-ghost">{{ __('app.privacy') }}</a> |</div>
            <div><a href="/terms-of-service" target="_blank" class="p-2 rounded-lg btn-ghost">{{ __('app.terms') }}</a> |</div>
            <div><a href="https://github.com/kibernetiku-klubas/timely/blob/main/SECURITY.md" target="_blank" class="p-2 rounded-lg btn-ghost">{{ __('app.report') }}</a> |</div>
        </div>
    </div>
</footer>

</body>
</html>
