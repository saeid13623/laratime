<?php

namespace saeid\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use saeid\Course\Model\Course;
use saeid\Course\Rules\ValidTeacher;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules= [
            'title'=>'required|min:3|max:190',
            'slug'=>'required|min:3|max:190|unique:courses,slug',
            'price'=>'required|numeric|min:0|max:1000000',
            'percent'=>'required|numeric|min:0|max:100',
            'priority'=>'required|numeric',
            'teacher_id'=>['required','exists:users,id',new ValidTeacher()],
            'type'=>['required',Rule::in(Course::$types)],
            'status'=>['required',Rule::in(Course::$statuses)],
            'category_id'=>'required|exists:categories,id',
            'image'=>'required|mimes:jpg,png,jpeg,gif'
        ];
        if(request()->method === 'PATCH'){
            $rules['image'] = 'nullable|mimes:jpg,png,jpeg';
            $rules['slug'] = 'required|min:3|max:190|unique:courses,slug,' .request()->route('course');
        }

        return  $rules;
    }

    public function attributes()
    {
        return [
            "price" => "قیمت",
            "slug" => "عنوان انگلیسی",
            "priority" => "ردیف دوره",
            "percent" => "درصد مدرس",
            "teacher_id" => "مدرس",
            "category_id" => "دسته بندی",
            "status" => "وضعیت",
            "type" => "نوع",
            "body" => "توضیحات",
            "image" => "بنر دوره",
        ];
    }
}
