@php
$title = $__env->yieldContent('title') ? ' | ' . $__env->yieldContent('title') : null;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @stack('before_stylesheets')
    <link rel="stylesheet" href="{{ asset(mix('css/website/app.css')) }}">
    @stack('stylesheets')

    <title>{{ env('APP_NAME') . $title }}</title>
</head>

<body>
    <div id="app">
        {{-- @include('website.includes.preloader') --}}
        <main-navbar></main-navbar>
        <main>
            @yield('content')
        </main>
        {{-- @include('website.includes.scroll_top') --}}

    </div>
    @stack('before_scripts')
    @stack('scripts')
</body>

</html>
