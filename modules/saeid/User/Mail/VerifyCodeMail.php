<?php

namespace saeid\User\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyCodeMail extends Mailable
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
        return $this->markdown('User::mails.verify_mail')
            ->subject('سایت آموزشی لاراتایم | کدفعالسازی');
    }
}
