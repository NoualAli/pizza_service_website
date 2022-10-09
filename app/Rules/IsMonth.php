<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsMonth implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, array_keys(monthsList())) || in_array($value, array_values(monthsList()));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'field :attribute should be a valid month';
    }
}