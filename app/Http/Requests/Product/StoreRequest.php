<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'price' => ['required', 'numeric'],
            'description' => ['nullable', 'string', 'max:255'],
            'menu' => ['required', 'exists:menus,id'],
            'restaurant' => ['required', 'exists:restaurants,id'],
            'ingredients' => ['nullable', 'array', 'exists:ingredients,id'],
        ];
    }
}