<?php
namespace saeid\Course\Repository;

use Illuminate\Support\Str;
use saeid\Course\Model\Course;
use saeid\Course\Model\Lesson;


class LessonRepo
{


    public function store($courseId,$values)
    {


        return Lesson::create([
            "course_id"=>$courseId,
            'season_id'=>$values->season_id,
            "user_id"=>auth()->id(),
            "media_id"=>$values->media_id,
            "title" => $values->title,
            'slug' => Str::slug($values->slug),
            "time"=>$values->time,
            "is_free"=>$values->is_free,
            "body"=>$values->body,
            "number"=> $this->generateNumber($courseId, $values->number),
            "confirmation_status"=>Lesson::CONFIRMATION_STATUS_PENDING,
            "status"=>Lesson::STATUS_OPENED,


        ]);


    }

    public function paginate($courseId)
    {
        return Lesson::where('course_id', $courseId)->orderBy('number')->paginate();
    }

    public function findById($id)
    {
        return Lesson::findOrFail($id);
    }

    public function update($id,$courseId,$values)
    {

        return Lesson::where('id',$id)->update([
            'title' => $values->title,
            'slug'=>$values->slug ? str::slug($values->slug) : str::slug($values->title),
            'time'=>$values->time,
            'number' =>$this->generateNumber($courseId, $values->number),
            'is_free'=> $values->is_free,
            'season_id'=>$values->season_id,
            'media_id'=>$values->media_id,
            'body'=>$values->body,

        ]);
    }
    public function UpdateLessonAcceptAll($courseId)
    {
        return Lesson::where('course_id',$courseId)->update(['confirmation_status'=>Lesson::CONFIRMATION_STATUS_ACCEPT]);
    }

    public function UpdateConfirmationStatus($id, string $status)
    {
        return Lesson::where('id',$id)->update(['confirmation_status'=>$status]);
    }
    public function UpdateStatus($id, string $status)
    {
        return Lesson::where('id',$id)->update(['status'=>$status]);
    }

    /**
     * @param $courseId
     * @param $number
     * @return int
     */
    public function generateNumber($courseId, $number)
    {
        $courseRepo = new CourseRepo();
        if (is_null($number)) {
            $number = $courseRepo->findById($courseId)->lessons()->orderBy('number', 'desc')->firstOrNew([])->number ?: 0;
            $number++;
        } else {
            $number = $number;
        }
        return $number;
    }

    public function selectedAccept(array $ids)
    {
        return Lesson::query()->whereIn('id',$ids)->update(['confirmation_status'=>Lesson::CONFIRMATION_STATUS_ACCEPT]);
    }

    public function selectedReject(array $ids)
    {
        return Lesson::query()->whereIn('id',$ids)->update(['confirmation_status'=>Lesson::CONFIRMATION_STATUS_REJECT]);

    }
    public function getLesson($courseId)
    {
        return Lesson::query()->where('course_id',$courseId)
            ->where('confirmation_status',Lesson::CONFIRMATION_STATUS_ACCEPT)
            ->get();
    }

    public function getFirstLesson($courseId)
    {
        return Lesson::query()->where('course_id',$courseId)
            ->where('confirmation_status',Lesson::CONFIRMATION_STATUS_ACCEPT)
            ->orderBy('number','asc')->first();
    }
    public function getLessonCourse($courseId,$lessonId)
    {
        return Lesson::query()->where('course_id',$courseId)
            ->where('id',$lessonId)->first();
    }


}
