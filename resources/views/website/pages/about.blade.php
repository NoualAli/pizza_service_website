@extends('website.layouts.default')

@section('title', 'Privacy policy')

@section('content')
    {{-- <hero-component height="30vh" background="#00922E">
        <h1>About us</h1>
    </hero-component> --}}
    <hero-component height="30vh" src="{{ asset('assets/heros/about-us.jpg') }}">
        <h1>About us</h1>
    </hero-component>
@endsection

@once
    @push('scripts')
        <script src="{{ asset(mix('website/js/default.js')) }}"></script>
    @endpush
@endonce
