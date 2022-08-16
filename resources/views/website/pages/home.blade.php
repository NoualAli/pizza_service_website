@extends('website.layouts.default')

@once
    @push('stylesheets')
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.css' rel='stylesheet' />
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.css' rel='stylesheet' />
    @endpush
@endonce

@section('content')
    <map-header></map-header>
    <div class="container">
        @include('website.includes.home.service-choice')
        @include('website.includes.restaurant.restaurants')
    </div>
@endsection

@once
    @push('scripts')
        <script src="{{ mix('js/home.js') }}"></script>
        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
        <link rel="stylesheet"
            href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
            type="text/css">
        <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css'
            type='text/css' />
    @endpush
@endonce

@once
    @push('before_scripts')
        <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'></script>
        <script src='https://npmcdn.com/@turf/turf/turf.min.js'></script>
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.js'></script>
    @endpush
@endonce
