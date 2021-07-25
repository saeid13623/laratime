<?php

namespace saeid\Course\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use saeid\Course\Model\Course;
use saeid\Course\Repository\CourseRepo;
use saeid\Payment\Model\Payment;

class RegisterUserInTheCourse
{

    public function __construct()
    {
        //
    }

    public function handle($event)
    {
       if($event->payment->paymentable_type == Course::class){
           resolve(CourseRepo::class)->addStudentToCourse($event->payment->paymentable,$event->payment->buyer_id);
       }
    }
}
