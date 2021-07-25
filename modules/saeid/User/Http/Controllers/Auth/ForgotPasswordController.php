<?php

namespace saeid\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyCodeRequest;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use saeid\User\Http\Requests\sendVerifyCodeRequest;
use saeid\User\Http\Requests\verifyCodeSendEmailRequest;
use saeid\User\Notifications\passwordResetEmailNotification;
use saeid\User\Repository\userRepo;
use saeid\User\Services\verifyCodeService;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controllers
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    public function showCodeFormRequest()
    {
        return view('User::auth.passwords.email');
    }
    public function sendVerifyCodeEmail(sendVerifyCodeRequest $request)
    {
        $user=resolve(userRepo::class)->findByEmail($request->email);

        if($user && ! verifyCodeService::has($user->id)){

            $user->notify(new passwordResetEmailNotification());
        }
        return view('User::auth.passwords.enter-verify-code-form');

    }
    public function checkVerifyCode(verifyCodeSendEmailRequest $request)
    {
        $user=resolve(userRepo::class)->findByEmail($request->email);

        if(! verifyCodeService::check($user->id,$request->verify_code)){
            return back()->withErrors(['verify_code'=>'کد وارد شده صحیح نمیباشد']);
        }
        auth()->loginUsingId($user->id);
        return redirect()->route('password.showResetForm');
    }

}
