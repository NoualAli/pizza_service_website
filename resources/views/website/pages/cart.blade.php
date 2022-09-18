@extends('website.layouts.default')

@section('content')
    <hero-component src="{{ asset('assets/heros/payment.jpg') }}">
        <div class="text-center">
            <img class="d-block mx-auto mb-4" src="assets/brand.png" alt="{{ env('APP_NAME') }} logo" height="57">
            <h1>{{ __('Checkout') }}</h1>
        </div>
    </hero-component>
    <div class="container-fluid p-lg-5 my-2">
        <Cart :user="{{ backpack_user() }}" />
    </div>
@endsection

@once
    @push('scripts')
        <script src="{{ env('APP_URL') }}:6001/socket.io/socket.io.js"></script>
        <script src="{{ asset(mix('website/js/cart.js')) }}"></script>
    @endpush
@endonce
