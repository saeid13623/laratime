<?php
namespace saeid\Course\Repository;

use Illuminate\Support\Str;
use saeid\Course\Model\Course;
use saeid\Course\Model\Season;




class SeasonRepo
{


    //سرفصلی را بر میگرداند که وضعیت آن تایید شده باشد
    public function getCourseSeason($courseId)
    {
        return Season::where('course_id',$courseId)
            ->where('confirmation_status',Season::CONFIRMATION_STATUS_ACCEPTED)
            ->orderBy('number','desc')
            ->get();
    }

    //چک میکنه ببینه که سرفصل مورد نظربا آی دی دوره مورد نظر همان سرفصل یکی هست یانه .سرفصلی را پیدا میکنه
    // که آی دی دوره آن با آیدی دوره سرفصل یکی باشه
    public function findByIdAndCourse($seasonId,$courseId)
    {
        return Season::where('course_id',$courseId)->where('id',$seasonId)->first();
    }

    public function store($courseId,$values)
    {
        return Season::create([
            "course_id"=>$courseId,
            "user_id"=>auth()->id(),
            "title" => $values->title,
            "number"=> $this->generateNumber($courseId, $values->number),
            "confirmation_status"=>Season::CONFIRMATION_STATUS_PENDING

        ]);


    }

    public function paginate()
    {
        return Season::latest()->paginate();
    }

    public function findById($id)
    {
        return Season::findOrFail($id);
    }

    public function update( $id,$values)
    {

        return Season::where('id',$id)->update([
            'title' => $values->title,
            'number' =>$this->generateNumber($id, $values->number),

        ]);
    }

    public function UpdateConfirmationStatus($id, string $status)
    {
        return Season::where('id',$id)->update(['confirmation_status'=>$status]);
    }
    public function UpdateStatus($id, string $status)
    {
        return Season::where('id',$id)->update(['status'=>$status]);
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
            $number = $courseRepo->findById($courseId)->seasons()->orderBy('number', 'desc')->firstOrNew([])->number ?: 0;
            $number++;
        } else {
            $number = $number;
        }
        return $number;
    }





}
