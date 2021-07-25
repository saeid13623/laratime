<?php


namespace saeid\Payment\Contracts;





use Illuminate\Http\Request;
use saeid\Payment\Model\Payment;

interface GatewayContract
{
    public function request($amount,$description);

    public function verify(Payment $payment);

    public function redirect();

    public function getName();
}
