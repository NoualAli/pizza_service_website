<?php

namespace App\Services\Payment;

use App\Models\Order;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripePayment
{
    public function __construct(readonly private string $clientSecret, readonly private Order $order)
    {
        Stripe::setApiKey($this->clientSecret);
        Stripe::setApiVersion('2022-08-01');
    }

    public function proceed()
    {
        $items = $this->order->lines->map(function ($line) {
            return [
                'price_data' => [
                    'unit_amount' => ($line->getAttributes()['price'] / $line->quantity) * 100,
                    'currency' => 'EUR',
                    'product_data' => [
                        'name' => $line->product->name,
                    ],
                ],
                'quantity' => $line->quantity,
            ];
        })->toArray();

        $session = Session::create([
            'mode' => 'payment',
            'success_url' => env('APP_URL') . '/checkout/stripe/success?order_id=' . $this->order->id,
            'cancel_url' => env('APP_URL'),
            'client_reference_id' => $this->order->id,
            'customer_email' => $this->order->email,
            'line_items' => $items,
            'payment_method_types' => ['card'],
            'currency' => 'EUR',
            'locale' => 'fi',
            'metadata' => [
                'delivery_fee' => 10
            ]
        ]);

        $data['stripe']['checkout_session'] = $session->id;

        session($data);

        return response()->json([
            'success' => true,
            'payment_type' => 'stripe',
            'url_redirection' => $session->url
        ]);
    }
}