<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center">
<div class="backdrop"></div>
@if (Route::has('login'))
    <div class="main">
        <h1>Key Storage</h1>
        <p>This is the most security way to save credentials.</p>
        <div class="links d-flex justify-content-center mt-5">
            @auth
                <a href="{{ url('/home') }}" class="home-link">Home</a>
            @else
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="home-link register">Register</a>
                @endif

                <a href="{{ route('login') }}" class="home-link login">Login</a>
            @endauth
        </div>
    </div>
@endif
</body>
</html>
