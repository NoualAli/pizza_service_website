<?php

namespace App\Http\Requests\Ingredient;

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
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->has('id') ? request()->id : null;
        return [
            'name' => ['required', 'unique:ingredients,name,' . $id . ',id', 'max:255'],
            'extra_price' => ['nullable', 'numeric']
        ];
    }
}