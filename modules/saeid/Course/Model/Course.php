<?php

namespace saeid\Course\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use saeid\Category\Model\Category;
use saeid\Course\Repository\CourseRepo;
use saeid\Media\Model\Media;
use saeid\Media\Services\MediaFileServices;
use saeid\Payment\Model\Payment;

class Course extends Model
{
    protected $guarded=[];

    const TYPE_FREE = 'free';
    const TYPE_CASH = 'cash';
    static $types = [self::TYPE_FREE, self::TYPE_CASH];

    const STATUS_COMPLETED = 'completed';
    const STATUS_UNCOMPLETED = 'uncompleted';
    const STATUS_LOCK = 'locked';
    static $statuses = [
        self::STATUS_COMPLETED,
        self::STATUS_UNCOMPLETED,
        self::STATUS_LOCK
    ];


    const CONFIRMATION_STATUS_ACCEPT = 'accepted';
    const CONFIRMATION_STATUS_REJECT = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmationStatuses = [
        self::CONFIRMATION_STATUS_ACCEPT,
        self::CONFIRMATION_STATUS_REJECT,
        self::CONFIRMATION_STATUS_PENDING
    ];


    public function getThumbAttribute()
    {
        return '/storage/'. $this->banner->files['300'];
    }
    public function banner()
    {
        return $this->belongsTo(Media::class, 'banner_id');
    }
    public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }
    public function seasons()
    {
        return $this->hasMany(Season::class);
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getDurationCourse()
    {
        return resolve(CourseRepo::class)->getDurationTimeLesson($this->id);
    }
    public function getFormattedDuration()
    {
        $duration =  $this->getDurationCourse();
        $h  =round($duration / 60) < 10 ? '0' .  round($duration / 60) :  round($duration / 60);
        $m = ($duration % 60) < 10 ? '0' . ($duration % 60) : ($duration % 60);
        return $h . ':' . $m . ":00";
    }
    public function getFormattedPrice()
    {
        return number_format($this->price);
    }
    public function getDiscountPrice()
    {
        //todo discount
        return 0;
    }
    public function getFormattedFinalPrice()
    {
        return $this->price - $this->getDiscountAmount();
    }
    public function getDiscountAmount()
    {
        //todo get amount price
        return 0;
    }
    public function path()
    {
        return route('singleCourse', $this->id . '-' . $this->slug);
    }

    public function getCourseLesson()
    {
        return resolve(CourseRepo::class)->getCourseLesson($this->id);
    }
    public function shortLink()
    {
        return route('singleCourse', $this->id );
    }
    public function students()
    {
        return $this->belongsToMany(User::class,'course_users','course_id','user_id');
    }
    public function payments()
    {
        return $this->morphMany(Payment::class, "paymentable");
    }
    public function hasStudent($studentId)
    {
        return resolve(CourseRepo::class)->hasStudent($this,$studentId);
    }
    public function downloadLinks() : array
    {
        $links=[];
       foreach (resolve(CourseRepo::class)->getLessons($this->id) as $lesson){
            $links[]= $lesson->downloadLink();
        }
       return $links;
    }

}
