<?php

namespace saeid\Course\Model;


use App\User;
use Illuminate\Database\Eloquent\Model;
use saeid\Course\Model\Course;
use saeid\Course\Model\Lesson;

class Season extends Model
{
    protected $guarded;

    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';

    public static $confirmation_statuses =[
            self::CONFIRMATION_STATUS_ACCEPTED,
            self::CONFIRMATION_STATUS_REJECTED,
            self::CONFIRMATION_STATUS_PENDING
        ];

    const STATUS_OPENED='opened';
    const STATUS_LOCKED='locked';
    public static $statuses=[self::STATUS_OPENED,self::STATUS_LOCKED];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

}
