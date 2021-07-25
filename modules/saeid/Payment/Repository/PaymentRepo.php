<?php

namespace saeid\Payment\Repository;



use saeid\Payment\Model\Payment;

class PaymentRepo
{

    public function store($data)
    {
        return Payment::create([
            "buyer_id" => $data['buyer_id'],
            "paymentable_id" => $data['paymentable_id'],
            "paymentable_type" => $data['paymentable_type'],
            "amount" => $data['amount'],
            "invoice_id" => $data['invoice_id'],
            "gateway" => $data['gateway'],
            "status" => $data['status'],
            "seller_p" => $data['seller_p'],
            "seller_share" => $data['seller_share'],
            "site_share" => $data['site_share'],
        ]);
    }

    public function findByInvoiceId($invoiceId)
    {
        return Payment::query()->where('invoice_id',$invoiceId)->first();
    }


    public function changeStatus($id,  $status)
    {
        return Payment::query()->where('id',$id)->update(['status'=>$status]);
    }

    public function paginate()
    {
        return Payment::query()->latest()->paginate();
    }
    public function getNDaysPayments($days,$status)
    {
        return Payment::query()->where('created_at','>',now()->addDays($days))
            ->where('status',$status)
            ->latest();
    }

    public function getLastDaysTotal($days)
    {
        return $this->getNDaysPayments($days,Payment::STATUS_SUCCESS)->sum('amount');
    }
    public function getLastNDaysSiteBenefit($days)
    {
        return $this->getNDaysPayments($days,Payment::STATUS_SUCCESS)->sum('site_share');
    }
    public function getSuccessPayment($status)
    {
    return Payment::query()->where('status',$status)->get();
    }
    public function getTotalSiteSeller()
    {
        return $this->getSuccessPayment(Payment::STATUS_SUCCESS)->sum('amount');
    }
    public function getTotalBenefit()
    {
        return $this->getSuccessPayment(Payment::STATUS_SUCCESS)->sum('site_share');
    }
}
