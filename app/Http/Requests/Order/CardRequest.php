<?php

namespace App\Http\Requests\Order;

use App\Rules\IsMonth;
use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
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
        return [
            'cc_informations.cc_number' => ['required', 'numeric'],
            'cc_informations.cc_month' => ['required', new IsMonth],
            'cc_informations.cc_year' => ['required'],
            'cc_informations.cc_cvc' => ['required'],
            'cc_informations.cc_card' => ['nullable'],
        ];
    }
}