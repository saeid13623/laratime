<?php

namespace saeid\User\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        return [
            "name" => 'required|min:3|max:190',
            "email" => 'required|email|min:3|max:190|unique:users,email,' . request()->route('user'),
            "username" => 'required|min:3|max:190|unique:users,username,' . request()->route('user'),
            "mobile" => 'nullable|unique:users,mobile,' . request()->route('user'),
            "status" => ["required", Rule::in(User::$statuses)],
            "password" => 'nullable|min:3|max:50',
            "headline" => 'nullable',
            "card_number" => 'nullable',
            "shaba" =>'nullable',
            "balance" => 'nullable',
            "telegram" => 'nullable',
            "bio" => 'nullable',
            "image" => 'nullable|mimes:jpg,jpeg,png',
        ];
    }

    public function attributes()
    {
        return [
            "name" => "نام",
            "email" => "ایمیل",
            "username" => "نام کاربری",
            "mobile" => "موبایل",
            "status" => "وضعیت",
            "image" => "عکس پروفایل",
        ];
    }
}
