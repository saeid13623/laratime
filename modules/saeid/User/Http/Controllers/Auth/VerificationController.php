<?php

namespace saeid\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use saeid\User\Services\verifyCodeService;

class VerificationController extends Controller
{
    use VerifiesEmails;


    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
       /*$this->middleware('signed')->only('verify');*///برای روش فرستادن ایمیل فعالسازی استفاده میشود
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    public function verify(Request $request)
    {
        $this->validate($request,['verify_code'=>'required|numeric|min:6']);
        $code=verifyCodeService::getCache(auth()->id());
        if($code == $request->verify_code){
            auth()->user()->markEmailAsVerified();
            verifyCodeService::delete(auth()->id());
            return redirect()->route('home');
        }
        return back()->withErrors(['verify_code'=>'کد وارد شده صحیح نمیباشد']);
    }
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('User::auth.verify');
    }

}
