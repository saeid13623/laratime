<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use saeid\Course\Model\Course;
use saeid\Course\Model\Lesson;
use saeid\Course\Model\Season;
use saeid\Media\Model\Media;
use saeid\RolePermission\Models\Permission;
use saeid\RolePermission\Models\Role;
use saeid\User\Notifications\passwordResetEmailNotification;
use \saeid\User\Notifications\verifyEmailNotification;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','card_number','shaba','bio','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $defaultUser=[
        [
            "email" => "admin@admin.com",
            "name"=>"admin",
            "password"=>"admin",
            "role"=>Role::ROLE_SUPER_ADMIN
        ]
    ];

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_BAN = 'ban';

    public static $statuses =[
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
        self::STATUS_BAN,
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new verifyEmailNotification());
    }
    public function resetPasswordNotification()
    {
        $this->notify(new passwordResetEmailNotification());
    }
    public function getThumbAttribute()
    {
        if($this->image){
            return '/storage/'. $this->image->files[300];
        }
        return '/panel/img/profile.jpg';
    }
    public function image()
    {
        return $this->belongsTo(Media::class);
    }

    public function profilePath()
    {
        return $this->username ? route('viewProfile',$this->username) : route('viewProfile','username');
    }
    public function seasons()
    {
        return $this->hasMany(Season::class);
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function hasAccessToCourse(Course $course)
    {
        if($this->can('manage',Course::class) ||

        $this->id === $course->teacher_id ||
            $course->students->contains($this->id)

            //todo student
        )return true;
        return false;
    }
    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }
    public function purcheses()
    {
        return $this->belongsToMany(Course::class,'course_users','user_id','course_id');
    }
    public function countStudent()
    {
       return DB::table('courses')->select('course_id')
            ->where('teacher_id',$this->id)
            ->join('course_users','courses.id','=','course_users.course_id')
            ->count();
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, "buyer_id");
    }

}
