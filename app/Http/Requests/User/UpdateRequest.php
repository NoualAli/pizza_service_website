<?php

namespace App\Http\Requests\User;

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
        $id = $this->get('id') ?? request()->route('id');

        return [
            'email'    => ['required', 'unique:' . config('permission.table_names.users', 'users') . ',email,' . $id],
            'username' => ['required', 'unique:' . config('permission.table_names.users', 'users') . ',username,' . $id . ',id'],
            'password' => ['nullable', 'confirmed'],
            'phone' => ['nullable'],
            'roles' => ['required']
        ];
    }
}