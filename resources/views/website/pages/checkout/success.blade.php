@extends('website.layouts.default')

@section('title', 'Checkout success')
@section('content')
    <div class="container-fluid">
        <div class="container d-flex justify-content-center align-items-center">
            <img src="{{ asset('assets/purchase-success.svg') }}" alt="" height="450">
        </div>
        <div class="container my-5">
            <div class="container my-5 text-center">
                <h2>Order #{{ $order->id }}</h2>
                <p>
                    Go
                    <a href="{{ route('home') }}">Home</a>
                </p>
            </div>
            <table
                class="ps-responsive-table bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2 dataTable dtr-inline relation_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Size</th>
                        <th>Extras</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->lines as $line)
                        <tr>
                            <td data-th="#">{{ $line->id }}</td>
                            <td data-th="Product">{{ $line->product->name }}</td>
                            <td data-th="Size">{{ $line->size }}</td>
                            <td data-th="Extras">{{ $line->extra_str }}</td>
                            <td data-th="Quantity">{{ $line->quantity }}</td>
                            <td data-th="Price">{{ $line->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">Subtotal</th>
                        <td colspan="1">{{ $order->subtotal }}</td>
                    </tr>
                    <tr>
                        <th colspan="5">VAT tax (14%)</th>
                        <td colspan="1">{{ $order->tax }}</td>
                    </tr>
                    <tr>
                        <th colspan="5">Delivery fee</th>
                        <td colspan="1">{{ $order->delivery_fee }} €</td>
                    </tr>
                    <tr>
                        <th colspan="5">Total</th>
                        <td colspan="1">{{ $order->total }}</td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection
@once
    @push('scripts')
        <script src="{{ asset(mix('website/js/default.js')) }}"></script>
    @endpush
@endonce
