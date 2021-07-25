<?php

namespace saeid\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use saeid\Course\Model\Course;
use saeid\Course\Rules\ValidSeason;
use saeid\Course\Rules\ValidTeacher;
use saeid\Media\Services\MediaFileServices;


class LessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        $rules= [
            'title'=>'required|min:3|max:255',
            'slug'=>'nullable|min:3|max:190',
            'number'=>'nullable',
            'time'=>'required|numeric|min:0|max:500',
            'season_id'=>[ new ValidSeason()],
            'is_free'=>'required|boolean',
            'body'=>'nullable',
            'lesson_file'=>'required|file|mimes:'.MediaFileServices::getExtensions(),
        ];
        if(request()->method === 'PATCH'){
            $rules['lesson_file'] = 'nullable|file|mimes:'.MediaFileServices::getExtensions();

        }

        return  $rules;
    }

    public function attributes()
    {
        return [
            "title" => "عنوان دوره",
            "slug" => "عنوان انگلیسی",
            "number" => "ردیف دوره",
            "time" => "مدت زمان دوره",
            "media"=>"فایل تصویری",
            "body" => "توضیحات",
        ];
    }
}
