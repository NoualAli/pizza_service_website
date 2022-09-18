<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $order_type = request()->order_type;
        $isOrderTypeDelivery = $order_type == 'delivery';

        return [
            'order_type' => ['required', 'string', 'in:delivery,pickup,on-the-spot'],
            'client.lastname' => ['required', 'string', 'max:255'],
            'client.firstname' => ['required', 'string', 'max:255'],
            'client.email' => ['nullable', 'email'],
            'client.phone' => ['required', 'string', 'max:255', 'regex:' . PHONE_REGEX],
            'client.location.street' => ['nullable', Rule::requiredIf($isOrderTypeDelivery), 'string', 'max:255'],
            'client.location.entrance' => ['nullable', Rule::requiredIf($isOrderTypeDelivery), 'string', 'max:255'],
            'client.location.appartment_number' => ['nullable', Rule::requiredIf($isOrderTypeDelivery), 'string', 'max:255'],
            'client.location.postal_code' => ['nullable', Rule::requiredIf($isOrderTypeDelivery), 'string', 'max:255'],
            'client.location.city' => ['nullable', Rule::requiredIf($isOrderTypeDelivery), 'string', 'max:255'],
            'payment_method' => ['required', 'in:Online Banking,Credit / Debit card,Bank Card,Cash']
        ];
    }
}