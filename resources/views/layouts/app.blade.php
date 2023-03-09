<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Go Strategy') }}</title>
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/images/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/images/logo.png') }}">
    @include('partials.stylesheets')
    @yield('styles')
    <!-- Scripts -->
</head>

<body>
    @include('partials.navbar')
    <main class="py-4 d-flex align-items-center">
        @yield('content')
    </main>
    @include('partials.footer')
    @include('partials.scripts')
    @yield('scripts')
</body>

</html>
