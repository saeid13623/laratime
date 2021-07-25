<?php

namespace saeid\Course\Rules;

use Illuminate\Contracts\Validation\Rule;
use saeid\Course\Repository\CourseRepo;
use saeid\Course\Repository\SeasonRepo;
use saeid\RolePermission\Models\Permission;
use saeid\User\Repository\userRepo;

class ValidSeason implements Rule
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

        $season=resolve(SeasonRepo::class)->findByIdAndCourse($value,request()->route('course'));

        if($season){
            return true;
        }else{
            return false;
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'سرفصل انتخاب شده معتبر نمیباشد ';
    }
}
