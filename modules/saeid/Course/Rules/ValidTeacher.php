<?php

namespace saeid\Course\Rules;

use Illuminate\Contracts\Validation\Rule;
use saeid\RolePermission\Models\Permission;
use saeid\User\Repository\userRepo;

class ValidTeacher implements Rule
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

        $user=resolve(userRepo::class)->findById($value);

        return $user->hasPermissionTo(Permission::PERMISSION_TEACH);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'شما یک مدرس نیستید ';
    }
}
