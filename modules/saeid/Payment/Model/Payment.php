<?php

namespace saeid\Payment\Model;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];
    const STATUS_PENDING = "pending";
    const STATUS_canceled = "canceled";
    const STATUS_SUCCESS = "success";
    const STATUS_FAIL = "fail";
    public static $statuses = [
        self::STATUS_PENDING,
        self::STATUS_canceled,
        self::STATUS_SUCCESS,
        self::STATUS_FAIL
    ];

    public function paymentable()
    {
        return $this->morphTo("paymentable");
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, "buyer_id");
    }

}
