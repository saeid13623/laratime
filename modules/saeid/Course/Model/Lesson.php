<?php

namespace saeid\Course\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use saeid\Course\Model\Course;
use saeid\Course\Model\Season;
use saeid\Media\Model\Media;

class Lesson extends Model
{
    protected $guarded=[];

    const TYPE_FREE = 'free';
    const TYPE_CASH = 'cash';
    static $types = [self::TYPE_FREE, self::TYPE_CASH];


    const CONFIRMATION_STATUS_ACCEPT = 'accepted';
    const CONFIRMATION_STATUS_REJECT = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmation_statuses = [
        self::CONFIRMATION_STATUS_ACCEPT,
        self::CONFIRMATION_STATUS_REJECT,
        self::CONFIRMATION_STATUS_PENDING
    ];
    const STATUS_OPENED='opened';
    const STATUS_LOCKED='locked';
    public static $statuses=[self::STATUS_OPENED,self::STATUS_LOCKED];

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
    public function media()
    {
        return $this->belongsTo(Media::class,'media_id');
    }
    public function getThumbAttribute()
    {
        switch ($this->media->type){
            case 'video' :
                return '/img/video-thumb.png';
                break;
            case 'zip' :
                return '/img/zip-thumb.png';
                break;
        }
    }
    public function path()
    {
        return $this->course->path() .'?lesson=e-' .$this->id. '-' .$this->slug;
    }
    public function downloadLink()
    {
        if($this->media_id)
        return URL::temporarySignedRoute('media.download',now()->addDay() ,['media'=>$this->media_id]);
    }
}
