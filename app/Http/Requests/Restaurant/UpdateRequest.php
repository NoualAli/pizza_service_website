<?php

namespace App\Http\Requests\Restaurant;

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
        $id = $this->get('id') ?? request()->route('id');

        return [
            'name' => ['required', 'string', 'min:5', 'max:255', 'unique:restaurants,name,' . $id],
            'description' => ['nullable', 'string', 'max:255'],
            'thumbnail' => ['nullable', 'string'],
            'users' => ['nullable', 'array', 'exists:users,id'],
            'locations' => ['nullable', 'array'],
            'locations.*.address' => ['nullable', 'string'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['nullable', 'string', 'exists:categories,id'],
            'menus' => ['nullable', 'array'],
            'menus.*' => ['nullable', 'string', 'exists:menus,id'],
            'opening' => ['required', 'string', 'date_format:H:i'],
            'closing' => ['required', 'string', 'date_format:H:i'],
            'minimum_order' => ['required', 'numeric']
        ];
    }
}