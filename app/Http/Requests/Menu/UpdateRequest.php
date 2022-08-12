<?php

namespace App\Http\Requests\Menu;

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
            'name' => ['unique:menus,name,' . $id . ',id'],
            'restaurants' => ['nullable', 'array'],
            'restaurants.*' => ['nullable', 'exists:restaurants,id']
        ];
    }
}