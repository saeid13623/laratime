<?php

namespace saeid\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use saeid\Course\Http\Requests\LessonRequest;
use saeid\Course\Model\Lesson;
use saeid\Course\Model\Season;
use saeid\Course\Repository\CourseRepo;
use saeid\Course\Repository\LessonRepo;
use saeid\Course\Repository\SeasonRepo;
use saeid\Media\Services\MediaFileServices;

class LessonController extends Controller
{
    public $courseRepo;
    public $lessonRepo;
    public $seasonRepo;
    public function __construct(CourseRepo $courseRepo,LessonRepo $lessonRepo,SeasonRepo $seasonRepo)
    {
        $this->courseRepo=$courseRepo;
        $this->lessonRepo=$lessonRepo;
        $this->seasonRepo=$seasonRepo;
    }

    public function create($course)
    {
        $seasons=$this->seasonRepo->getCourseSeason($course);

        $course = $this->courseRepo->findById($course);
        return view('Courses::lesson.create',compact('seasons','course'));

    }
    public function store($courseId,LessonRequest $request)
    {

        $request->request->add(["media_id"=>MediaFileServices::PrivateUpload($request->file('lesson_file'))->id]);
        $this->lessonRepo->store($courseId,$request);

        return redirect(route('courses.details',$courseId));

    }
    public function edit($courseId,$lessonId)
    {
        $lesson=$this->lessonRepo->findById($lessonId);
        $this->authorize('edit',$lesson,Lesson::class);
        $course=$this->courseRepo->findById($courseId);
        $seasons=$this->seasonRepo->getCourseSeason($courseId);
        return view('Courses::lesson.edit',compact('lesson','course','seasons'));
    }
    public function update($courseId,$lessonId,LessonRequest $request)
    {
        $lesson=$this->lessonRepo->findById($lessonId);
        $this->authorize('edit',$lesson);
        if($request->hasFile('lesson_file')&& $lesson->media){
            $lesson->media->delete();
            $request->request->add(['media_id'=>MediaFileServices::PrivateUpload($request->file('lesson_file'))->id]);
        }else{
            $request->request->add(['media_id'=>$lesson->media_id]);
        }
        $this->lessonRepo->update($lessonId,$courseId,$request);
        alert()->success('موفق','با موفقیت انجام شد');
        return redirect()->to(route('courses.details',$courseId));
    }
    public function destroy($courseId,$lessonId)
    {

        $lesson=$this->lessonRepo->findById($lessonId);
        $this->authorize('destroy',$lesson);
        if($lesson->media){
            $lesson->media->delete();
        }
        $lesson->delete();
    }
    public function deleteMultiple(Request $request)
    {
        $ids=explode(',',$request->ids);
        foreach ($ids as $id){
            $lesson=$this->lessonRepo->findById($id);
            $this->authorize('destroy',$lesson);
            if($lesson->media){
                $lesson->media->delete();
            }
            $lesson->delete();
        }
        alert()->success('عملیات موفق','با موفقیت حذف شد');
        return back();


    }
    public function accept($id)
    {
        $lesson=$this->lessonRepo->findById($id);
        $this->authorize('manageLesson',$lesson);
        $this->lessonRepo->UpdateConfirmationStatus($id,Lesson::CONFIRMATION_STATUS_ACCEPT);
    }
    public function acceptAll($courseId)
    {
        $course=$this->courseRepo->findById($courseId);
        $this->authorize('manage',$course);
        $this->lessonRepo->UpdateLessonAcceptAll($courseId);
        alert()->success('عملیات موفق','عملیات با موفقیت انجام شد');
        return back();
    }
    public function selectedAccept($courseId,Request $request)
    {
        $course=$this->courseRepo->findById($courseId);
        $this->authorize('manage',$course);
        $ids=explode(',',$request->ids);
        $this->lessonRepo->selectedAccept($ids);
        alert()->success('عملیات موفق','عملیات با موفقیت انجام شد');
        return back();
    }
    public function selectedReject($courseId,Request $request)
    {
        $course=$this->courseRepo->findById($courseId);
        $this->authorize('manage',$course);
        $ids=explode(',',$request->ids);
        $this->lessonRepo->selectedReject($ids);
        alert()->success('عملیات موفق','عملیات با موفقیت انجام شد');
        return back();
    }
    public function reject($id)
    {
        $lesson=$this->lessonRepo->findById($id);
        $this->authorize('manageLesson',$lesson);
        $this->lessonRepo->UpdateConfirmationStatus($id,Lesson::CONFIRMATION_STATUS_REJECT);
    }
    public function locked($id)
    {
        $lesson=$this->lessonRepo->findById($id);
        $this->authorize('manageLesson',$lesson);
        $this->lessonRepo->UpdateStatus($id,Lesson::STATUS_LOCKED);
    }
    public function opened($id)
    {
        $lesson=$this->lessonRepo->findById($id);
        $this->authorize('manageLesson',$lesson);
        $this->lessonRepo->UpdateStatus($id,Lesson::STATUS_OPENED);
    }


}
