@component('mail::message')
    # {{ $order->firstname }} {{ $order->lastname }},
    Your order #{{ $order->id }} has been accepted.
    An email will be sent to you once the order is ready.

    Thank you for using our application,

    {{ env('APP_NAME') }}.
@endcomponent
