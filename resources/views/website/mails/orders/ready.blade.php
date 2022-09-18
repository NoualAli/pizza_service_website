@php
if ($order->order_type == 'Delivery') {
    $response = 'and will be delivered to you in a few minutes.';
} elseif ($order->order_type == 'Pickup') {
    $response = 'and you can pick it up at ' . $order->restaurant->name;
} else {
    $response = 'and you can enjoy it now at the restaurant ' . $order->restaurant->name;
}
@endphp
@component('mail::message')
    # {{ $order->firstname }} {{ $order->lastname }},
    Your order #{{ $order->id }} is ready {{ $response }}

    Thank you for using our application,

    {{ env('APP_NAME') }}.
@endcomponent
