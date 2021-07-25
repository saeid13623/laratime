@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.create')}}" title="نقشهای کاربری"> ویرایش دوره </a></li>
@stop
@section('content')
    <div class="col-12 bg-white">
        <p class="box__title">ویرایش دوره</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('courses.update',$course->id)}}" class="padding-30" method="post" enctype="multipart/form-data">
                    @CSRF
                    @method('patch')
                    <input type="text"  name="title" class="text"  placeholder="عنوان دوره" value="{{$course->title}}">
                    <x-ValidationError field="title"/>

                    <input type="text"  name="slug" class="text text-left " placeholder="نام انگلیسی دوره" value="{{$course->slug}}">
                    <x-ValidationError field="slug"/>

                    <div class="d-flex multi-text">
                        <input type="text"  name="priority" class="text text-left mlg-15" placeholder="ردیف دوره" value="{{$course->priority}}">
                        <x-ValidationError field="priority"/>
                        <input type="text"  name="price" placeholder="مبلغ دوره" class="text-left text mlg-15" value="{{$course->price}}">
                        <x-ValidationError field="price"/>
                        <input type="text"  name="percent" placeholder="درصد مدرس" class="text-left text" value="{{$course->percent}}">
                        <x-ValidationError field="percent"/>
                    </div>
                    @can(saeid\RolePermission\Models\Permission::PERMISSION_MANAGE_COURSE)
                    <select name="teacher_id">
                        @foreach($teachers as $teacher)
                        <option value="{{$teacher->id}}" @if($teacher->id==$course->teacher_id)  selected @endif>{{ $teacher->name }}</option>
                         @endforeach
                    </select>
                    @endcan
                    <x-ValidationError field="teacher_id"/>

                    <ul class="tags" name="tags">
                        <li class="tagAdd taglist">
                            <input type="text" id="search-field" placeholder="برچسب ها">
                        </li>
                    </ul>
                    <x-ValidationError field="tags"/>

                    <select name="type">
                        <option value="free">نوع دوره</option>
                        @foreach(\saeid\Course\Model\Course::$types as $type)
                        <option value="{{ $type }}" @if($type==$course->type) selected @endif>@lang($type)</option>
                        @endforeach
                    </select>
                    <x-ValidationError field="type"/>

                    <select name="status">
                        <option value="0">وضعیت دوره</option>
                        @foreach(\saeid\Course\Model\Course::$statuses as $status)
                            <option value="{{ $status }}" @if($status==$course->status) selected @endif>@lang($status)</option>
                        @endforeach
                    </select>
                    <x-ValidationError field="status"/>

                    <select name="category_id">
                        <option value="">دسته بندی</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" @if($category->id==$course->category_id) selected @endif>{{ $category->title }} </option>
                        @endforeach
                    </select>
                    <x-ValidationError field="category_id"/>

                    <div class="file-upload">
                        <div class="i-file-upload">
                            <span>آپلود بنر دوره</span>
                            <input type="file" class="file-upload" id="files" name="image"/>
                            <x-ValidationError field="image"/>
                        </div>
                        @if(isset($course->banner->thumb))
                        <img src="{{$course->banner->thumb}}" width="80" style="padding-top: 15px;">
                        @else
                        <span class="selectedFiles">فایلی انتخاب نشده است</span>
                            @endif
                    </div>

                    <textarea placeholder="توضیحات دوره" name="body" class="text h" value="{{ $course->body }}"></textarea>
                    <x-ValidationError field="body"/>

                    <button type="submit" class="btn btn-webamooz_net">ویرایش دوره</button>
                </form>
            </div>
        </div>
    </div>
@stop()

