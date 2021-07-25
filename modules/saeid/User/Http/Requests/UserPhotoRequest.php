<?php

namespace saeid\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check()==true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'userphoto' => 'required|mimes:jpg,jpeg,png',
        ];
    }
}
