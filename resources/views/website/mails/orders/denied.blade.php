@component('mail::message')
    # {{ $order->firstname }} {{ $order->lastname }},
    We are sorry to inform you of the refusal of your order #{{ $order->id }}

    For more information please contact us at contact@pizzaservice.fi

    Thank you for using our application,

    {{ env('APP_NAME') }}.
@endcomponent
