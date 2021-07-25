<?php

namespace saeid\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use saeid\Category\Repositories\CategoryRepo;
use saeid\Course\Http\Requests\CourseRequest;
use saeid\Course\Model\Course;
use saeid\Course\Repository\CourseRepo;
use saeid\Course\Repository\LessonRepo;
use saeid\Media\Services\MediaFileServices;
use saeid\Media\Services\videoFileService;
use saeid\Payment\Gateways\Gateway;
use saeid\Payment\Repository\PaymentRepo;
use saeid\Payment\Services\PaymentService;
use saeid\RolePermission\Models\Permission;
use saeid\User\Repository\userRepo;

class CourseController extends Controller
{
    public $courseRepo;
    public $userRepo;
    public $categoryRepo;
    public function __construct(CourseRepo $courseRepo, userRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $this->courseRepo=$courseRepo;
        $this->userRepo=$userRepo;
        $this->categoryRepo=$categoryRepo;
    }
    public function index()
    {
        $this->authorize('index',Course::class);
        if(auth()->user()->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSE )||
            auth()->user()->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN)){
            $courses=$this->courseRepo->paginate();
        }else{
            $courses=$this->courseRepo->getCourseByTeacherId(auth()->id());
        }

        return view('Courses::index',compact('courses'));
    }
    public function create(userRepo $userRepo,CategoryRepo $categoryRepo)
    {

        $this->authorize('store',Course::class);
        $this->authorize('store',Course::class);
        $teachers=$this->userRepo->getTeacher();
        $categories=$this->categoryRepo->all();
        return view('Courses::create',compact('teachers','categories'));
    }
    public function store(CourseRequest $request)
    {

        $this->authorize('store',Course::class);

        $request->request->add(['banner_id' => MediaFileServices::PublicUpload($request->file('image'))->id]);
        $this->courseRepo->store($request);
        return redirect()->route('courses.index');
    }
    public function edit($id)
    {
        $course=$this->courseRepo->findById($id);
        $this->authorize('edit',$course,Course::class);

        $teachers=$this->userRepo->getTeacher();
        $categories=$this->categoryRepo->all();
        $course=$this->courseRepo->findById($id);
        $courses=$this->courseRepo->paginate();
        return view('Courses::edit',compact('teachers','categories','course','courses'));
    }
    public function update($id,CourseRequest $request)
    {

        $course=$this->courseRepo->findById($id);
        $this->authorize('edit',$course,Course::class);

        //اگر در درخواست ما فایل ایمیج بود یعنی میخواهیم عکی عوض کنیم پس همان مراحل دریافت عکی رو دوباره انجام میدیم
        if($request->hasFile('image')){
            $request->request->add(['banner_id' => MediaFileServices::PublicUpload($request->file('image'))->id]);
            $course->banner->delete();

        }else{
            //اگر فایل ایمیج نبود خب همون فایل ایمیج قبلی که ست شده رو قرار میدیم
            $request->request->add(['banner_id' => $course->banner_id]);
        }
        $this->courseRepo->update($id,$request);
        return redirect(route('courses.index'));
    }
    public function destroy($id)
    {

        $course=$this->courseRepo->findById($id);

        $this->authorize('delete',$course,Course::class);

        if($course->banner){
            $course->banner->delete();

        }
          $course->delete();

    }
    public function accept($id)
    {
        $course=$this->courseRepo->findById($id);
        $this->authorize('changeConfirmationStatus',$course,Course::class);
        $this->courseRepo->UpdateConfirmationStatus($id,Course::CONFIRMATION_STATUS_ACCEPT);
    }
    public function reject($id)
    {
        $course=$this->courseRepo->findById($id);
        $this->authorize('changeConfirmationStatus',$course,Course::class);
        $this->courseRepo->UpdateConfirmationStatus($id,Course::CONFIRMATION_STATUS_REJECT);
    }
    public function locked($id)
    {
        $course=$this->courseRepo->findById($id);
        $this->authorize('changeConfirmationStatus',$course,Course::class);
        $this->courseRepo->UpdateStatus($id,Course::STATUS_LOCK);
    }

    public function details ($courseId,LessonRepo $lessonRepo)
    {

        $course=$this->courseRepo->findById($courseId);
        $lessons=$lessonRepo->paginate($courseId);

        $this->authorize('details',$course,Course::class);
        return view('Courses::details',compact('course','lessons'));
    }

    public function buy($courseId,CourseRepo $courseRepo)
    {
        $course=$courseRepo->findById($courseId);

        if(!$this->canPurchasesByCourse($course)){
            return back();
        }
        if(!$this->notAuthorizeByCourse($course)){
            return back();
        }

        $amount=$course->getFormattedFinalPrice();

        if($amount <= 0){
            $courseRepo->addStudentToCourse($course,auth()->id());
            alert()->success('موفقیت آمیز بود','شما با موفقیت در دوره ثبت نام کردبد');
            return redirect()->to($course->path());
        }
        $payment = PaymentService::generate($amount, $course, auth()->user());

        resolve(Gateway::class)->redirect($payment->invoice_id);
    }

    public function canPurchasesByCourse(Course $course)
    {
        if($course->type == Course::TYPE_FREE){
          //  newfeedback('عملیات نا موفق','این دوره رایگان است و قابل خریداری نیست','error');
            alert()->error('عملیات ناموفق','این دوره رایگان و قابل خریداری نیست');
            return false;
        }
        if($course->status == Course::STATUS_LOCK){
            alert()->error('عملیات ناموفق','این دوره قفل است و قابل خریداری نیست');
            return false;
        }
        if($course->confirmation_status == Course::CONFIRMATION_STATUS_REJECT){
            alert()->error('عملیات ناموفق','این دوره تایید نشده است و قابل خریداری نیست');
            return false;
        }

        return true;
    }

    public function notAuthorizeByCourse(Course $course)
    {
        if(auth()->user()->id == $course->teacher_id) {
            alert()->error('عملیات ناموفق','شما مدرس این دوره هستید و دسترسی به این دوره را دارید');
            return false;
        }
        if(auth()->user()->can('download',$course)) {
            alert()->error('عملیات ناموفق','شما دسترسی به این دوره ندارین');
            return false;
        }
        return true;
    }

    public function downloadLink($id)
    {
        $course=$this->courseRepo->findById($id);

        $this->authorize('download',$course);

        return implode('<br>',$course->downloadLinks());
    }
}
