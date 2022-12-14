<?php

namespace App\Http\Requests\User;

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
        // only allow updates if the user is logged in
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
            'email'    => ['required', 'unique:' . config('permission.table_names.users', 'users') . ',email'],
            'username' => ['required', 'unique:users,username'],
            'password' => ['required', 'confirmed'],
            'phone' => ['nullable'],
            'roles' => ['required']
        ];
    }
}