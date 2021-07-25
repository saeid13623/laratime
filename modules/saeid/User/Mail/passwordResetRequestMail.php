<?php

namespace saeid\User\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class passwordResetRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $code;

    public function __construct(User $user,$code)
    {
        $this->user = $user;
        $this->code = $code;
    }

    public function build()
    {
        return $this->markdown('User::mails.reset-password-verify-code')
            ->subject('سایت آموزشی لاراتایم | کدبازیابی رمز عبور');
    }
}
