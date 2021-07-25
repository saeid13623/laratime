@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="">دوره ها</a></li>
    <li><a href="{{route('courses.details',$course->id)}}" title="{{$course->title}}">{{$course->title}}</a></li>
    <li><a href="#" title="ویرایش">ویرایش</a></li>

@stop
@section('content')
    <div class="main-content padding-0">
        <p class="box__title">ویرایش درس</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('lessons.update',[$course->id,$lesson->id])}}" class="padding-30" method="post" enctype="multipart/form-data" />
                    @CSRF
                    @method('PATCH')
                    <input type="text" class="text" name="title" value="{{$lesson->title}}"  placeholder=" عنوان درس *"  />
                     <x-ValidationError field="title"/>
                    <input type="text" name="slug" value="{{$lesson->slug}}" class=" text text-left " placeholder="نام انگلیسی درس اختیاری" />
                    <x-ValidationError field="slug"/>
                    <input type="number" class="text" name="time" value="{{$lesson->time}}" placeholder=" مدت زمان درس *" required/>
                    <x-ValidationError field="time"/>
                    <input type="number" class="text" name="number" value="{{$lesson->number}}" placeholder="  شماره درس "  class="text"/>
                    <x-ValidationError field="number"/>
                    <p class="box__title">ایا این درس رایگان است ؟ </p>
                    <div class="w-50">
                        <div class="notificationGroup">
                            <input id="lesson-upload-field-1" class="text" name="is_free" value="0" type="radio" @if(!$lesson->is_free) ? checked="" @endif/>
                            <label for="lesson-upload-field-1">خیر</label>
                        </div>
                        <div class="notificationGroup">
                            <input id="lesson-upload-field-2" class="text" name="is_free" value="1" type="radio" @if($lesson->is_free) ? checked="" @endif />
                            <label for="lesson-upload-field-2">بله</label>
                        </div>
                        <x-ValidationError field="is_free"/>
                    </div>
                @if(count(array($seasons)))
                    <select name="season_id" required>
                        <option value="0">انتخاب سرفصل *</option>
                        @foreach($seasons as $season)
                            //ارور داده وباید بعدا این ارور رفع شود نمیتوتنم سرفصلهارو بگیرم
                           <option value="{{$season->id}}" @if($season->id == $lesson->season_id)) selected @endif >{{$season->title}}</option>
                        @endforeach
                    </select>
                    <x-ValidationError field="season_id"/>
                @endif
                <div class="file-upload">
                    <div class="i-file-upload">
                        <span>آپلود درس</span>
                        <input type="file" class="file-upload" id="files" name="lesson_file"/>
                    </div>
                    <span class="filesize"></span>
                    <p class="selectedFiles">
                            @if(isset($lesson->media))
                            نام فایل:<p>{{$lesson->media->filename}}</p>
                            <img src="{{$lesson->thumb}}" width="80">
                            @endif
                            <x-ValidationError field="images"/>
                    </p>
                </div>

                    <textarea placeholder="توضیحات دوره" name="body"  class="text h">{{$lesson->body}}</textarea>
                    <x-ValidationError field="body"/>
                    <button type="submit" class="btn btn-webamooz_net">بروز رسانی درس</button>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
<script src="/panel/js/tagsInput.js"></script>
@stop
