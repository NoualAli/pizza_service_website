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
    @if (env('APP_ENV') == 'local')
        <meta name="app-url" content="{{ env('APP_URL') }}:8000">
    @else
        <meta name="app-url" content="{{ env('APP_URL') }}">
    @endif

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
    @if (env('APP_ENV') !== 'local')
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css"
            integrity="sha512-5PV92qsds/16vyYIJo3T/As4m2d8b6oWYfoqV+vtizRB6KhF1F9kYzWzQmsO6T3z3QG2Xdhrx7FQ+5R1LiQdUA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet"
            href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    @endif

    @stack('stylesheets')

    <title>{{ env('APP_NAME') . $title }}</title>
</head>

<body>
    @include('website.includes.preloader')
    @include('website.includes.main_nav')
    <div id="app">
        {{-- Main content --}}
        <main class="pb-5">
            @yield('content')
        </main>
    </div>

    @include('website.includes.footer')
    @include('website.includes.scroll_top')

    @stack('before_scripts')
    {{-- <script src="{{ asset(mix('js/website/app.js')) }}"></script> --}}
    @stack('scripts')
</body>

</html>
