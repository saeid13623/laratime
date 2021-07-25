<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class passwordRule implements Rule
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
        return preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{6,}/',$value);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'فرمت پسورد صحیح نمیباشدفرمت باید یک حرف کوچک و یک حرف بزرگ و یک عددویکی از کاراکترهای غیرالفبایی (!@#$%^&*) داشته باشد';

    }
}
