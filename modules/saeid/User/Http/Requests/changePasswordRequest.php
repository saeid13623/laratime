<?php

namespace saeid\User\Http\Requests;

use App\Rules\passwordRule;
use Illuminate\Foundation\Http\FormRequest;
use saeid\User\Services\verifyCodeService;

class changePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*if(auth()->check())
            return true;
        return false;*/
        return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => ['required',new passwordRule(),'confirmed']
        ];
    }
}
