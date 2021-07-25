<?php


namespace saeid\Course\Repository;


use Illuminate\Support\Str;
use saeid\Course\Model\Course;
use saeid\Course\Model\Lesson;

class CourseRepo
{
    public function store($values)
    {
        return Course::create([
            'teacher_id' => $values->teacher_id,
            'category_id' => $values->category_id,
            'title' => $values->title,
            'slug' => Str::slug($values->slug),
            'priority' => $values->priority,
            'price' => $values->price,
            'percent' => $values->percent,
            'type' => $values->type,
            'status' => $values->status,
            'body' => $values->body,
            'banner_id' => $values->banner_id,
            /*'confirmation_status' => Course::CONFIRMATION_STATUS_PENDING,*/

        ]);
    }

    public function paginate()
    {
        return Course::latest()->paginate();
    }

    public function findById($id)
    {
        return Course::findOrFail($id);
    }

    public function update( $id,$values)
    {
           return Course::where('id',$id)->update([
               'teacher_id' => $values->teacher_id,
               'category_id' => $values->category_id,
               'title' => $values->title,
               'slug' => Str::slug($values->slug),
               'priority' => $values->priority,
               'price' => $values->price,
               'percent' => $values->percent,
               'type' => $values->type,
               'status' => $values->status,
               'body' => $values->body,
               'banner_id' => $values->banner_id,
           ]);
    }

    public function UpdateConfirmationStatus($id, string $status)
    {
        return Course::where('id',$id)->update(['confirmation_status'=>$status]);
    }
    public function UpdateStatus($id, string $status)
    {
        return Course::where('id',$id)->update(['status'=>$status]);
    }

    public function getCourseByTeacherId(?int $id)
    {
        return Course::query()->where('teacher_id',$id)->get();
    }
    public function getLatestCourse()
    {
        return Course::query()->where('confirmation_status',Course::CONFIRMATION_STATUS_ACCEPT)
            ->latest()->paginate(8);
    }
    public function getDurationTimeLesson($id)
    {
        return Lesson::query()->where('course_id',$id)
            ->where('confirmation_status',Lesson::CONFIRMATION_STATUS_ACCEPT)
            ->sum('time');

    }
    public function getCourseLesson($id)
    {
        return Lesson::query()->where('course_id',$id)
            ->where('confirmation_status',Lesson::CONFIRMATION_STATUS_ACCEPT)
            ->count();
    }

    public function addStudentToCourse($course,$studentId)
    {
        if(! $this->getCourseStudent($course,$studentId)){
            $course->students()->attach($studentId);
        }
    }
    public function getCourseStudent(Course $course,$studentId)
    {
        return $course->students()->where('id',$studentId)->first();
    }

    public function hasStudent(Course $course,$studentId)
    {
        return $course->students->contains($studentId);
    }
    public function getLessons($courseId)
    {
        return Lesson::query()->where('course_id',$courseId)
            ->where('confirmation_status',Lesson::CONFIRMATION_STATUS_ACCEPT)
            ->get();
    }


}
