<?php


namespace saeid\Payment\Gateways\Zarinpal;





use Illuminate\Http\Request;
use saeid\Payment\Contracts\GatewayContract;
use saeid\Payment\Model\Payment;
use saeid\Payment\Repository\PaymentRepo;


class ZarinpalAdaptor implements GatewayContract
{
    private $url;
    private $client;
    public function request($amount,$description)
    {
        $this->client=new Zarinpal();
        $callback=route('payments.callback');
        $result=$this->client->request("f83cc956-f59f-11e6-889a-005056a205be",$amount,$description,"","",$callback,true);
        if (isset($result["Status"]) && $result["Status"] == 100)
        {
            $this->url=$result['StartPay'];
            return $result['Authority'];

        } else {

            return[
                "status"=>$result["Status"],
                "message"=>$result["Message"]
            ];

        }



    }


    public function verify(Payment $payment)
    {

        $result = (new Zarinpal())->verify("f83cc956-f59f-11e6-889a-005056a205be", $payment->amount,true);

        if (isset($result["Status"]) && $result["Status"] == 100)
        {
            return $result["RefID"];
        } else {
            return [
                "status" => $result["Status"],
                "message" => $result["Message"]
            ];
        }
    }



    public function redirect()
    {
        $this->client->redirect($this->url);
    }

        public function getName()
        {
           return 'zarinpal';
        }

       /* public function getInvoiceFromRequest(Request $request)
        {
            return $request->Authority;
        }*/


}
