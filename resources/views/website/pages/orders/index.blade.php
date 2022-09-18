@extends(backpack_view('blank'))
{{-- @extends('website.layouts.restaurer') --}}

@section('after_styles')
    <!-- DATA TABLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

    <!-- CRUD LIST CONTENT - crud_list_styles stack -->
    @stack('crud_list_styles')
@endsection

@section('content')
    <div id="app">
        <orders-list :restaurants="{{ $restaurants }}" :user="{{ $user }}"></orders-list>
    </div>
@endsection
{{-- @once
    @push('scripts')
        <script src="{{ env('APP_URL') }}:6001/socket.io/socket.io.js"></script>
        <script src="{{ asset(mix('website/js/orders.js')) }}"></script>
    @endpush
@endonce --}}


@once
    @push('after_scripts')
        <script src="{{ env('APP_URL') }}:6001/socket.io/socket.io.js"></script>
        <script src="{{ asset(mix('website/js/orders.js')) }}"></script>
        @stack('crud_list_scripts')
    @endpush
@endonce
