@php
$title = $__env->yieldContent('title') ? ' | ' . $__env->yieldContent('title') : null;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets/favicons/safari-pinned-tab.svg') }}" color="#ea2f28">
    <meta name="msapplication-TileColor" content="#00a300">
    <meta name="theme-color" content="#ffffff">

    @stack('before_stylesheets')
    <link rel="stylesheet" href="{{ asset(mix('website/css/app.css')) }}">
    @stack('stylesheets')

    <title>{{ env('APP_NAME') . $title }}</title>
</head>

<body>
    @include('website.includes.preloader')
    <div id="app">
        {{-- Main content --}}
        <main>
            @yield('content')
        </main>
    </div>

    @include('website.includes.footer')
    @include('website.includes.scroll_top')

    @stack('before_scripts')
    @stack('scripts')
</body>

</html>
