<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'settings' => ['required', 'array'],
            'settings.size' => ['required', 'string', 'in:norm,pannu,perhe'],
            'settings.price' => ['required', 'numeric'],
            'settings.extras' => ['nullable', 'array'],
            'additional_informations' => ['nullable', 'string', 'max:255'],
            'quantity' => ['required', 'numeric']
        ];
    }
}