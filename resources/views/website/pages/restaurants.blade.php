@extends('website.layouts.default')

@section('content')
    <section class="container">
        @include('website.includes.restaurant.restaurants')
    </section>
@endsection
@once
    @push('scripts')
        <script src="{{ mix('js/restaurants.js') }}"></script>
    @endpush
@endonce
