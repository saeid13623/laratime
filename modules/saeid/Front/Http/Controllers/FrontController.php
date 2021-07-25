<?php

namespace saeid\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use saeid\Course\Repository\CourseRepo;
use saeid\Course\Repository\LessonRepo;
use saeid\Course\Repository\SeasonRepo;
use saeid\RolePermission\Models\Permission;


class FrontController extends Controller
{
    public $courseRepo;
    public $seasonRepo;
    public $lessonRepo;
    public function __construct(CourseRepo $courseRepo,SeasonRepo $seasonRepo,LessonRepo $lessonRepo)
    {
        $this->courseRepo=$courseRepo;
        $this->seasonRepo=$seasonRepo;
        $this->lessonRepo=$lessonRepo;
    }

    public function index()
    {
        $latestCourses=$this->courseRepo->getLatestCourse();
        return view('Front::index',compact('latestCourses'));
    }
    public function singleCourse($slug)
    {
        $courseId=$this->getItemId($slug,'c');
        $course=$this->courseRepo->findById($courseId);
        $lessons=$this->lessonRepo->getLesson($courseId);

        if(request()->lesson)
        {
            $lessonId=$this->getItemId(request()->lesson,'e');
            $lesson= $this->lessonRepo->getLessonCourse($courseId,$lessonId);
        }else{
            $lesson=$this->lessonRepo->getFirstLesson($courseId);
        }

        return view('Front::layout.singleCourse',compact('course','lessons','lesson'));
    }

    public function getItemId($slug,$item)
    {
     return str::before(str::after($slug,$item.'-'),'-');
    }
    public function tutorSingle($username)
    {

        $tutor= User::Permission(Permission::PERMISSION_TEACH)->where('username',$username)->first();

        return view('Front::tutor',compact('tutor'));
    }

}
