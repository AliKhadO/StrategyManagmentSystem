<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - @yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/images/logo.png') }}">
    @include('partials.stylesheets')
    @yield('styles')
</head>

<body class="d-flex">
    @if (!Auth::guest())
        @include('partials.sidenav')
    @endif
    <div class="content {{ !Auth::guest() ? 'col-md-10' : 'col-md-12' }}">
        @include('partials.header')
        <main class="p-4">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    @include('partials.footer')
    @include('partials.notification')
    @include('partials.scripts')
    @yield('script')
</body>

</html>
