<?php

namespace App\Services\Payment;

use App\Http\Requests\Order\CardRequest;
use App\Models\Order;
use Illuminate\Support\Facades\App;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripePayment
{
    public function __construct(readonly private string $clientSecret, readonly private Order $order)
    {
        Stripe::setApiKey($this->clientSecret);
        Stripe::setApiVersion('2022-08-01');
    }

    /**
     * Use Stripe checkout method
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout()
    {
        $discount = session('current-restaurant')->discount;
        $stripe = new StripeClient(env('STRIPE_SK'));
        if ($discount) {
            $stripe->coupons->create(['percent_off' => $discount]);
        }
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

    /**
     * Use stripe Card
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function stripe($data)
    {
        // Card informations for test purpose
        // 'number' => '4242424242424242',
        // 'exp_month' => 10,
        // 'exp_year' => 2023,
        // 'cvc' => '314',
        // $cardRequest = App::make(CardRequest::class);
        // $ccData = $cardRequest->validated();

        try {
            $stripe = new StripeClient(env('STRIPE_SK'));

            $token = $stripe->tokens->create([
                'card' => [
                    'currency' => 'eur',
                    'number' =>  $data['cc_informations']['cc_number'],
                    'exp_month' =>  $data['cc_informations']['cc_month'],
                    'exp_year' =>  $data['cc_informations']['cc_year'],
                    'cvc' =>  $data['cc_informations']['cc_cvc'],
                    'name' => $data['cc_informations']['cc_card']
                ],
            ]);

            $response = $stripe->charges->create([
                'amount' => $this->order->getAttributes()['total'] * 100,
                'currency' => 'eur',
                'source' => $token->id,
                'description' => $this->order->restaurant->name . ': Payment for order #' . $this->order->id,
            ]);
            // session()->flash('Your payment has been made successfully Thank you
            // Keep this identifier in case of complaint you will be asked
            // #' . $this->order->id . '
            // for using our app');
            $appUrl = env('APP_DEBUG') ? env('APP_URL') . ':8000' : env('APP_URL');
            return $response;
        } catch (\Throwable $th) {

            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}