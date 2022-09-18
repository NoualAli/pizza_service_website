@extends('website.layouts.default')

@section('content')
    <hero-component src="{{ asset('assets/heros/restaurant.jpg') }}">
        <h1 class="text-white text-center">
            Restaurants
        </h1>
    </hero-component>
    <section class="container-fluid">
        <restaurants-list></restaurants-list>
    </section>
@endsection
@once
    @push('scripts')
        <script src="{{ asset(mix('website/js/restaurants.js')) }}"></script>
    @endpush
@endonce
