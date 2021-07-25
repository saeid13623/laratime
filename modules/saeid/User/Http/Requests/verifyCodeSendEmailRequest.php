<?php

namespace saeid\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use saeid\User\Services\verifyCodeService;

class verifyCodeSendEmailRequest extends FormRequest
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
            'email'=>'required|email',
            'verify_code' => verifyCodeService::getRule()
        ];
    }
}