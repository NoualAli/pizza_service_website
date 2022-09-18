@component('mail::message')
    # {{ $order->firstname }} {{ $order->lastname }},

    Your order has been delivered successfully.

    You can print your invoice at any time from our platform if you have an account attached to this order.

    Thank you for using our application,

    {{ env('APP_NAME') }}.
@endcomponent
