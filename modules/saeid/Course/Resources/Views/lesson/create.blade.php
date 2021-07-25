@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="نقشهای کاربری"> دوره ها</a></li>
    <li><a href="{{ route('courses.details', $course->id) }}" title="{{ $course->title }}">{{ $course->title }}</a></li>
    <li><a href="#" title="ویرایش درس">ایجاد درس</a></li>

@stop
@section('content')
    <div class="col-12 bg-white">
        <p class="box__title">ایجاد درس جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('lessons.store',$course->id)}}" class="padding-30" method="post" enctype="multipart/form-data">
                    @CSRF
                    <input type="text"  name="title" class="text" placeholder="  عنوان درس *" value="{{old('title')}}">
                    <x-ValidationError field="title"/>

                    <input type="text"  name="slug" class="text text-left " placeholder=" نام انگلیسی درس" value="{{old('slug')}}">
                    <x-ValidationError field="slug"/>


                    <input type="number"  name="number" class="text text-left " placeholder="شماره درس" value="{{old('number')}}">
                    <x-ValidationError field="number"/>


                    <input type="number"  name="time" class="text text-left " placeholder="زمان درس" value="{{old('time')}}">
                    <x-ValidationError field="time"/>


                    @if($seasons)
                    <select name="season_id">
                        <option value="">سرفصل درسها</option>

                        @foreach($seasons as $season)

                        <option value="{{$season->id}}" @if($season->id == old('season_id')) selected @endif>{{ $season->title }}</option>
                        @endforeach
                    </select>
                    <x-ValidationError field="season_id"/>

                    @endif

                    <p class="box__title">ایا این درس رایگان است ؟ </p>
                    <div class="w-50">
                        <div class="notificationGroup">
                            <input id="lesson-upload-field-1" name="is_free" value="0" type="radio" checked="">
                            <label for="lesson-upload-field-1">خیر</label>
                        </div>
                        <div class="notificationGroup">
                            <input id="lesson-upload-field-2" name="is_free" value="1" type="radio">
                            <label for="lesson-upload-field-2">بله</label>
                        </div>
                    </div>

                    <div class="file-upload">
                        <div class="i-file-upload">
                            <span>آپلود درس</span>
                            <input type="file" class="file-upload" id="files" name="lesson_file"/>
                            <x-ValidationError field="media"/>
                        </div>
                        <span class="filesize"></span>

                        <span class="selectedFiles">فایلی انتخاب نشده است</span>
                    </div>

                    <textarea placeholder="توضیحات درس" name="body" class="text h" value="{{old('body')}}"></textarea>
                    <x-ValidationError field="body"/>

                    <button type="submit" class="btn btn-webamooz_net">ایجاد درس</button>
                </form>
            </div>
        </div>
    </div>
@stop()

