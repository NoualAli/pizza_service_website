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
            'slug' => ['required', 'string', 'min:5', 'max:255', 'unique:restaurants,slug,' . $id],
            'description' => ['nullable', 'string', 'max:255'],
            'cover' => ['nullable', 'string'],
            'users' => ['nullable', 'array', 'exists:users,id'],
            'address' => ['required', 'string', 'max:255'],
            'longitude' => ['required', 'numeric'],
            'latitude' => ['required', 'numeric'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['nullable', 'string', 'exists:categories,id'],
            'menus' => ['nullable', 'array'],
            'menus.*' => ['nullable', 'string', 'exists:menus,id'],
            'time_slots.*.week_day' => ['required', 'string', 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'],
            'time_slots.*.opening' => ['required', 'string', 'date_format:H:i'],
            'time_slots.*.closing' => ['required', 'string', 'date_format:H:i'],
            'delivery_time' => ['required', 'numeric'],
            'delivery_fee' => ['nullable', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'phone' => ['required', 'regex:/^((04[0-9]{1})(\s?|-?)|050(\s?|-?)|0457(\s?|-?)|[+]?358(\s?|-?)50|0358(\s?|-?)50|00358(\s?|-?)50|[+]?358(\s?|-?)4[0-9]{1}|0358(\s?|-?)4[0-9]{1}|00358(\s?|-?)4[0-9]{1})(\s?|-?)(([0-9]{3,4})(\s|\-)?[0-9]{1,4})$/'],
            'email' => ['nullable', 'string', 'max:255', 'email'],
            'delivery' => ['nullable', 'boolean'],
            'pickup' => ['nullable', 'boolean'],
            'on_the_spot' => ['nullable', 'boolean'],
        ];
    }
}