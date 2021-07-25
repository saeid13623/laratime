<?php

namespace saeid\User\Http\Requests;

use App\Rules\passwordRule;
use Illuminate\Foundation\Http\FormRequest;
use saeid\RolePermission\Models\Permission;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules=[
            'name' => 'required|min:4|max:100',
            'email' => 'required|unique:users,email,'. auth()->id(),
            'mobile' => 'required|unique:users,mobile,'. auth()->id(),
            'password' => ['nullable',new passwordRule()],
            'username' => 'nullable|min:3|max:190|unique:users,username,' . auth()->id(),
        ];
        if(auth()->user()->hasPermissionTo(Permission::PERMISSION_TEACH)){
            $rules += [
                'card_number' => 'required|string|size:16',
                'headline' => 'required|min:5|max:60',
                'shaba' => 'required|size:24',
                'bio' => 'required',
            ];

            $rules['username'] = 'required|min:3|max:190|unique:users,username,' . auth()->id();


        }

        return $rules;
    }

    public function attributes()
    {
        return[
            'name' => 'نام',
            'mobile' => 'موبایل',

            'username'=>'نام کاربری',
            'card_number'=>'شماره کارت',
            'shaba'=>'شماره شبا',
            'bio'=>'بیوگرافی',
            'headline'=>'معرفی کاربر',

        ];
    }
}
