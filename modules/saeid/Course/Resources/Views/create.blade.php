@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.create')}}" title="نقشهای کاربری">دوره ها</a></li>
@stop
@section('content')
    <div class="col-12 bg-white">
        <p class="box__title">ایجاد دوره جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('courses.store')}}" class="padding-30" method="post" enctype="multipart/form-data">
                    @CSRF
                    <input type="text"  name="title" class="text" placeholder="عنوان دوره" value="{{old('title')}}">
                        <div>
                            @error('bio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                             </span>
                            @enderror
                        </div>

                    <input type="text"  name="slug" class="text text-left " placeholder="نام انگلیسی دوره" value="{{old('slug')}}">
                    <div>
                        @error('slug')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="d-flex multi-text">
                        <input type="text"  name="priority" class="text text-left mlg-15" placeholder="ردیف دوره" value="{{old('priority')}}">
                        <div>
                            @error('priority')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <input type="text"  name="price" placeholder="مبلغ دوره" class="text-left text mlg-15" value="{{old('price')}}">
                        <div>
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <input type="text"  name="percent" placeholder="درصد مدرس" class="text-left text" value="{{old('percent')}}">
                        <div>
                            @error('percent')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <select name="teacher_id">
                        @foreach($teachers as $teacher)
                        <option value="{{$teacher->id}}">{{ $teacher->name }}</option>
                         @endforeach
                    </select>
                    <div>
                        @error('teacher_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <ul class="tags" name="tags">
                        <li class="tagAdd taglist">
                            <input type="text" id="search-field" placeholder="برچسب ها">
                        </li>
                    </ul>
                    <div>
                        @error('tags')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <select name="type">
                        <option value="free">نوع دوره</option>
                        @foreach(\saeid\Course\Model\Course::$types as $type)
                        <option value="{{ $type }}">@lang($type)</option>
                        @endforeach
                    </select>
                    <div>
                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <select name="status">
                        <option value="0">وضعیت دوره</option>
                        @foreach(\saeid\Course\Model\Course::$statuses as $status)
                            <option value="{{ $status }}">@lang($status)</option>
                        @endforeach
                    </select>
                    <div>
                        @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <select name="category_id">
                        <option value="">دسته بندی</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{ $category->title }} </option>
                        @endforeach
                    </select>
                    <div>
                        @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="file-upload">
                        <div class="i-file-upload">
                            <span>آپلود بنر دوره</span>
                            <input type="file" class="file-upload" id="files" name="image"/>
                            <x-ValidationError field="image"/>
                        </div>
                        <span class="filesize"></span>
                        <span class="selectedFiles">فایلی انتخاب نشده است</span>
                    </div>

                    <textarea placeholder="توضیحات دوره" name="body" class="text h" value="{{old('body')}}"></textarea>
                    <div>
                        @error('body')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-webamooz_net">ایجاد دوره</button>
                </form>
            </div>
        </div>
    </div>
@stop()

