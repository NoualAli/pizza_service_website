<?php

namespace App\Concerns;

// use Carbon\Carbon;
// use Illuminate\Support\Facades\Hash;
// use Paytrail\SDK\Request\PaymentRequest;

// class Paytrail
// {
//     private $account = '375917';
//     private $secret = 'SAIPPUAKAUPPIAS';
//     private $method = 'POST';
//     private $order;


//     public function __construct($order)
//     {
//         $this->order = $order;
//     }

//     public function proceed()
//     {
//         // string(64) "3708f6497ae7cc55a2e6009fc90aa10c3ad0ef125260ee91b19168750f6d74f6"
//         $headers = $this->getHeaders();
//         $headers['signature'] = $this->calculateHmac($this->secret, $headers, $this->getBody());

//         $client = new \GuzzleHttp\Client(['headers' => $headers]);
//         $response = null;
//         try {
//             $response = $client->post('https://services.paytrail.com', ['body' => $this->getBody()]);
//         } catch (\GuzzleHttp\Exception\ClientException $e) {
//             return $e->getMessage();
//             if ($e->hasResponse()) {
//                 $response = $e->getResponse();
//                 return "Unexpected HTTP status code: {$response->getStatusCode()}\n\n";
//             }
//         }

//         $responseBody = $response->getBody()->getContents();
//         // Flatten Guzzle response headers
//         $responseHeaders = array_column(array_map(function ($key, $value) {
//             return [$key, $value[0]];
//         }, array_keys($response->getHeaders()), array_values($response->getHeaders())), 1, 0);

//         $responseHmac = $this->calculateHmac($this->secret, $responseHeaders, $responseBody);
//         if ($responseHmac !== $response->getHeader('signature')[0]) {
//             return "Response HMAC signature mismatch!";
//         } else {
//             return (json_encode(json_decode($responseBody), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
//         }
//         return "\n\nRequest ID: {$response->getHeader('cof-request-id')[0]}\n\n";
//     }

//     /**
//      * Calculate Checkout HMAC
//      *
//      * @param string                $secret Merchant shared secret key
//      * @param array[string]string   $params HTTP headers or query string
//      * @param string                $body HTTP request body, empty string for GET requests
//      * @return string SHA-256 HMAC
//      */
//     private function calculateHmac($secret, $params, $body = '')
//     {
//         // Keep only checkout- params, more relevant for response validation. Filter query
//         // string parameters the same way - the signature includes only checkout- values.
//         $includedKeys = array_filter(array_keys($params), function ($key) {
//             return preg_match('/^checkout-/', $key);
//         });

//         // Keys must be sorted alphabetically
//         sort($includedKeys, SORT_STRING);

//         $hmacPayload =
//             array_map(
//                 function ($key) use ($params) {
//                     return join(':', [$key, $params[$key]]);
//                 },
//                 $includedKeys
//             );

//         array_push($hmacPayload, $body);

//         return hash_hmac('sha256', join("\n", $hmacPayload), $secret);
//     }

//     // Note: nonce and timestamp hardcoded for the expected HMAC output in comments below
//     public function getHeaders()
//     {
//         $timestamps = (string) now();
//         return [
//             'checkout-account' => $this->account,
//             'checkout-algorithm' => 'sha256',
//             'checkout-method' => $this->method,
//             'checkout-nonce' => Hash::make(random_int(1, 10000)),
//             'checkout-timestamp' => $timestamps,
//             'content-type' => 'application/json; charset=utf-8',
//         ];
//     }

//     // $body = '' for GET requests
//     public function getBody()
//     {
//         $items = collect($this->order->lines)->map(function ($line) {
//             return [
//                 'unitPrice' => $line->getAttributes()['price'] / $line->quantity,
//                 'units' => $line->quantity,
//                 'vatPercentage' => 14,
//                 'productCode' => $line->product_id,
//             ];
//         });
//         return json_encode(
//             [
//                 "stamp" => Hash::make($this->account),
//                 "reference" => $this->order->id,
//                 "amount" => floatval($this->order->getAttributes()['total']),
//                 "currency" => "EUR",
//                 "language" => "FI",
//                 "items" => $items,
//                 "customer" => [
//                     'email' => $this->order->email,
//                     'firstName' => $this->order->firstname,
//                     'lastName' => $this->order->lastname,
//                     'phone' => $this->order->phone
//                 ],
//                 "redirectUrls" => [
//                     "success" => "https://example.org/51/success",
//                     "cancel" => "https://example.org/51/cancel"
//                 ],
//                 "callbackUrls" => [
//                     "success" => "https://example.org/51/success",
//                     "cancel" => "https://example.org/51/cancel"
//                 ]
//             ],
//             JSON_UNESCAPED_SLASHES
//         );
//     }
// }
use Paytrail\SDK\Client;
use Paytrail\SDK\Exception\HmacException;
use Paytrail\SDK\Exception\ValidationException;
use Paytrail\SDK\Model\CallbackUrl;
use Paytrail\SDK\Request\PaymentRequest;
use Paytrail\SDK\Model\Customer;
use Paytrail\SDK\Model\Address;
use Paytrail\SDK\Model\Item;
use Paytrail\SDK\Response\PaymentResponse;
use Paytrail\SDK\Exception\RequestException;

/**
 * Class Payment
 */
class Payment
{
    /** @var array $exampleItems  */
    protected $exampleItems = array(
        array(
            'title' => 'Example 1',
            'amount' => 1,
            'price' => 5.0,
            'code' => 'example01',
            'vat' => 24
        ),
        array(
            'title' => 'Example 2',
            'amount' => 2,
            'price' => 2.5,
            'code' => 'example02',
            'vat' => 24
        )
    );

    private $base_url;

    /**
     * Handle payment data and create payment with SDK client
     *
     * @param $data
     *
     * @return PaymentResponse|string
     */
    public function processPayment($data)
    {

        try {
            $this->base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
            $response['error'] = null;
            $client = new Client(
                375917,
                'SAIPPUAKAUPPIAS',
                'php-sdk-test'
            );

            $payment = new PaymentRequest();

            $this->setPaymentData($payment, $data);

            $response['data'] = $client->createPayment($payment);

            return $response;
        } catch (RequestException $e) {
            $response['error'] = $e->getMessage();
        } catch (HmacException $e) {
            $response['error'] = $e->getMessage();
        } catch (ValidationException $e) {
            $response['error'] = $e->getMessage();
        }
        return $response;
    }

    /**
     * Set data for Payment Request
     *
     * @param PaymentRequest $payment
     * @param array $data
     *
     * @return PaymentRequest
     */
    public function setPaymentData($payment, $data)
    {

        $payment->setStamp(hash('sha256', hrtime(true)));

        $payment->setAmount($data['amount'] * 100);

        $payment->setReference('your order reference');

        $payment->setCurrency('EUR');

        $payment->setLanguage($data['country']);

        $customer = $this->createCustomer($data);

        $payment->setCustomer($customer);

        $invoicingAddress = $this->createAddress($data);

        $payment->setInvoicingAddress($invoicingAddress);
        $payment->setDeliveryAddress($invoicingAddress);

        $items = $this->mapOrderItems();

        $payment->setItems($items);

        $payment->setRedirectUrls($this->createRedirectUrl());

        $payment->setCallbackUrls($this->createCallbackUrl());

        return $payment;
    }

    /**
     * Set data for Customer model
     *
     * @param array $data
     *
     * @return Customer
     */
    private function createCustomer($data)
    {

        $customer = new Customer();

        $customer->setEmail($data['email'])
            ->setFirstName($data['firstName'])
            ->setLastName($data['lastName'])
            ->setPhone($data['phone']);

        return $customer;
    }

    /**
     * Set data for Address model
     *
     * @param array $data
     *
     * @return Address
     */
    private function createAddress($data)
    {

        $address = new Address();

        $address->setStreetAddress($data['address'])
            ->setPostalCode($data['postalCode'])
            ->setCity($data['city'])
            ->setCounty($data['county'])
            ->setCountry($data['country']);

        return $address;
    }

    /**
     * Set order items data.
     * The actual order items must exist or this function does nothing.
     *
     * return array
     */
    private function mapOrderItems()
    {

        //Mockup array exampleItems containing order item data
        $orderItems = $this->exampleItems;

        //Loop through and map all order items
        $items = array_map(
            function ($item) {
                return $this->createItems($item);
            },
            $orderItems
        );

        return $items;
    }

    /**
     * Set data for Item model
     */
    private function createItems($item)
    {

        $orderItem = new Item();

        $orderItem->setUnitPrice(floatval($item['price']) * 100)
            ->setUnits($item['amount'])
            ->setVatPercentage($item['vat'])
            ->setProductCode($item['code'])
            ->setDeliveryDate(date('Y-m-d'))
            ->setDescription($item['title']);

        return $orderItem;
    }

    /**
     * Set redirect urls
     */
    private function createRedirectUrl()
    {

        $callback = new CallbackUrl();

        $callback->setSuccess($this->base_url . '/response.php');
        $callback->setCancel($this->base_url . '/response.php');

        return $callback;
    }

    /**
     * Set callback urls
     */
    private function createCallbackUrl()
    {

        $callback = new CallbackUrl();

        $callback->setSuccess($this->base_url . '/response.php');
        $callback->setCancel($this->base_url . '/response.php');

        return $callback;
    }
}