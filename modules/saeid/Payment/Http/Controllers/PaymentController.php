<?php

namespace saeid\Payment\Http\Controllers;




use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use saeid\Payment\Events\PaymentWasSuccefull;
use saeid\Payment\Gateways\Gateway;
use saeid\Payment\Model\Payment;
use saeid\Payment\Repository\PaymentRepo;

class PaymentController extends Controller
{
    public $paymentRepo;
    public function __construct(PaymentRepo $paymentRepo)
    {
        $this->paymentRepo=$paymentRepo;
    }

    public function index()
    {
        $this->authorize('manage',Payment::class);
        $payments=$this->paymentRepo->paginate();
        $last30DaysTotal=$this->paymentRepo->getLastDaysTotal(-30);
        $totalNDaysSiteBenefit=$this->paymentRepo->getLastNDaysSiteBenefit(-30);
        $totalSellerSite=$this->paymentRepo->getTotalSiteSeller();
        $totalSiteBenefit=$this->paymentRepo->getTotalBenefit();
        return view('Payment::index',compact(
            'payments',
            'last30DaysTotal',
            'totalNDaysSiteBenefit',
            'totalSellerSite',
            'totalSiteBenefit'));
    }
    public function callback(Request $request)
    {
        $gateway=resolve(Gateway::class);
        $paymentRepo = new PaymentRepo();
        $payment=$paymentRepo->findByInvoiceId($request->Authority);

        if(!$payment){
            alert()->error('تراکنش ناموفق','عملیات با موفقیت انجام نشد');
            return redirect('/');
        }
        $result=$gateway->verify($payment);

        if(is_array($result))
        {
           // newfeedback('عملیات موفق نبود',$result['message'],"error");
            alert()->error('عملیات موفقیت آمیز نبود.','عملیات ناموفق');
            $paymentRepo->changeStatus($payment->id,Payment::STATUS_FAIL);
        }else{
            event(new PaymentWasSuccefull($payment));
            alert()->success('عملیات موفقیت آمیز','عملیات موفق');
            $paymentRepo->changeStatus($payment->id,Payment::STATUS_SUCCESS);
        }
        return redirect()->to($payment->paymentable->path());
    }

   /* public function mypurchase ()
    {
        $purcheses= auth()->user()->payments()->with("paymentable")->get();
    }*/
}
