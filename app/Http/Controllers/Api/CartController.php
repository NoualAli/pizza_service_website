<?php

namespace App\Http\Controllers\Api;

use App\Services\Payment\StripePayment;
use App\Events\OrderCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\UpdateRequest;
use App\Http\Requests\Cart\StoreRequest;
use App\Http\Requests\Order\StoreRequest as CheckoutRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Jackiedo\Cart\Facades\Cart;

class CartController extends Controller
{
    /**
     * @var collection
     */
    private $cart;

    public function __construct()
    {
        $this->cart = Cart::name('ps-cart');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant = session('current-restaurant');
        abort_if(!$restaurant || !$restaurant->is_open || !count($this->cart->getDetails()->items), 401);
        $this->cart->setExtraInfo('delivery_fee', $restaurant?->delivery_fee);
        $this->cart->setExtraInfo('discount', $restaurant?->discount);
        return view('website.pages.cart', ['cart' => $this->cart->getDetails()]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function cart()
    {
        $restaurant = session('current-restaurant');
        $this->cart->setExtraInfo('delivery_fee', $restaurant?->delivery_fee);
        $this->cart->setExtraInfo('discount', $restaurant?->discount);
        return response()->json([
            'cart' => $this->cart->getDetails()
        ]);
    }

    /**
     * Add new item to cart
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(StoreRequest $request)
    {
        $product = Product::findOrFail($request->product);
        $data = $request->validated();
        $settings = json_decode($data['settings'], true);
        try {
            $product->addToCart($this->cart->getName(), [
                'id'       => $product->id,
                'title'    => $product->name,
                'quantity' => $data['quantity'],
                'price'    => $this->getPriceFromSettings($settings),
                'options' => $settings,
                'extra_info' => ['additional_informations' => $data['additional_informations']]
            ]);
            return response()->json([
                'success' => true,
                'message' => __('Product added to cart successfully'),
                'cart' => $this->cart->getDetails(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Update item quantity
     *
     * @param UpdateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request)
    {
        $data = $request->validated();
        $settings = $data['settings'];
        $extra_info = isset($data['additional_informations']) ? ['additional_informations' => $data['additional_informations']] : [];
        try {
            $this->cart->updateItem($request->item_hash, [
                'quantity' => $data['quantity'],
                'price'    => $this->getPriceFromSettings($settings),
                'options' => $settings,
                'extra_info' => $extra_info
            ]);
            return response()->json([
                'success' => true,
                'message' => __('Cart update successfully'),
                'cart' => $this->cart->getDetails(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove item from cart
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        try {
            $this->cart->removeItem($request->product);
            return response()->json([
                'success' => true,
                'message' => __('Product successfully removed from cart'),
                'cart' => $this->cart->getDetails(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Create new order
     *
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(CheckoutRequest $request)
    {
        $details = $this->cart->getDetails();
        $restaurant = session()->get('current-restaurant');

        // Check if cart is not empty
        if (!count($details->items)) {
            return response()->json([
                'success' => false,
                'message' =>  'You cannot submit an empty cart'
            ]);
        }

        // Check if restaurant is open
        if (!$restaurant->is_open && env('APP_DEBUG') == false) {
            return response()->json([
                'success' => false,
                'message' =>  'The restaurant is currently closed, you cannot place an order at the moment'
            ]);
        }

        // Check if total price is greater than restaurant minimum order price
        if ($details->total < $restaurant->minimum_order) {
            return response()->json([
                'success' => false,
                'message' => __('Orders below ' . $restaurant->minimum_order . ' € are not accepted for this restaurant.')
            ]);
        }

        // Sanitize data and create new order
        $data = $this->sanitizedData($request, $details, $restaurant);
        $order = $this->createOrder($data, $details);
        if ($data['payment_method'] == 'Bank Card' || $data['payment_method'] == 'Cash') {
            $this->dispatchEvent($order);

            // Reset cart
            $this->cart->destroy();
            $this->cart = Cart::name('ps-cart');
            session()->remove('current-restaurant');
            session()->remove('order-type');

            if ($order->wasRecentlyCreated) {
                return response()->json([
                    'payment_type' => 'on delivery',
                    'success' => true,
                    'message' => __('Your order has been launched successfully')
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => __('An error has occurred when trying to register your order, please try later.')
                ]);
            }
        }
        if ($data['payment_method'] == 'Online Banking') {
            return 'Online Banking';
        }
        if ($data['payment_method'] == 'Credit / Debit card') {
            try {
                return $this->stripePayment($order);
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }
    }

    private function stripePayment($order)
    {
        $payment = new StripePayment(env('STRIPE_SK'), $order);
        return $payment->proceed();
    }

    /**
     * @param array|null $settings
     *
     * @return integer
     */
    public function getPriceFromSettings(?array $settings = null, ?int $quantity = null)
    {
        $settings = $settings ?: request()->settings;
        if (isset($settings['extras'])) {
            $price = $settings['price'];
            foreach ($settings['extras'] as $name => $value) {
                if (!is_null($value)) {
                    $price = ($price + $value);
                }
            }

            return $price;
        }
        return $settings['price'];
    }

    private function dispatchEvent($order)
    {
        // Dispatch event
        $event = new OrderCreatedEvent($order);
        broadcast($event);
    }

    private function sanitizedData($request, $details, $restaurant)
    {
        $data = $request->validated();
        $data['restaurant_id'] = $restaurant->id;
        $data['tax'] = $this->calculateTax($details);
        $data['subtotal'] = $this->calculateSubtotal($details);
        $data['total'] = $this->calculateTotal($details);
        $data['delivery_fee'] = $details->extra_info['delivery_fee'];
        if (backpack_user()?->id) {
            $data['user_id'] = backpack_user()->id;
        }
        foreach ($data['client'] as $key => $value) {
            if ($key == 'location') {
                if ($data['order_type'] == 'delivery') {
                    $data[$key] = json_encode($value);
                }
            } else {
                $data[$key] = $value;
            }
        }
        unset($data['client']);
        if ($data['payment_method'] !== 'Online banking' || $data['payment_method'] !== 'Credit / Debit card') {
            $data['payed'] = true;
        }

        return $data;
    }

    private function createOrder($data, $details)
    {
        $order = Order::create($data); // create new order
        // Create order lines
        foreach ($details->items as $item) {
            $order->lines()->create([
                'product_id' => $item->id,
                'price' => $item->total_price,
                'quantity' => $item->quantity,
                'extras' => json_encode($item->options['extras']),
                'size' => $item->options['size'],
                'additional_informations' => isset($item->extra_info['additional_informations']) ? $item->extra_info['additional_informations'] : null,
            ]);
        };
        return $order;
    }

    private function calculateSubtotal($details)
    {
        return number_format($details->total - $this->calculateTax($details), 2);
    }

    private function calculateTax($details)
    {
        return ($details->total * 14) / 100;
    }

    private function calculateTotal($details)
    {
        $price = $details->total;
        if (isset($details->extra_info['delivery_fee'])) {
            $price += $details->extra_info['delivery_fee'];
        }
        if (isset($details->extra_info['discount']) && $details->extra_info['discount'] > 0) {
            $price = ($price * $details->extra_info['discount']) / 100;
        }
        return number_format($price, 2);
    }
}