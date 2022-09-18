<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class AccountInfoRequest extends FormRequest
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
     * Restrict the fields that the user can change.
     *
     * @return array
     */
    // public function validationData()
    // {
    // return $this->only(backpack_authentication_column(), 'name');
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = backpack_auth()->user();
        return [
            'username' => ['required', 'string', 'min:3', 'max:35', 'unique:users,username,' . $user->id . ',id'],
            'email' => ['required', 'string', 'email', 'unique:users,email,' . $user->id . ',id'],
            'firstname' => ['required', 'string', 'min:3', 'max:35'],
            'lastname' => ['required', 'string', 'min:3', 'max:35'],
            'phone' => ['required', 'string', 'max:255', 'regex:/^((04[0-9]{1})(\s?|-?)|050(\s?|-?)|0457(\s?|-?)|[+]?358(\s?|-?)50|0358(\s?|-?)50|00358(\s?|-?)50|[+]?358(\s?|-?)4[0-9]{1}|0358(\s?|-?)4[0-9]{1}|00358(\s?|-?)4[0-9]{1})(\s?|-?)(([0-9]{3,4})(\s|\-)?[0-9]{1,4})$/'],
        ];
    }
}