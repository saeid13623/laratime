@extends('Dashboard::master')

@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="دوره ها"> دوره ها </a></li>
    <li><a href="" title="جزییات دوره"> جزییات دوره </a></li>
@stop
@section('content')

    <div class="main-content padding-0 course__detial">
        <div class="row no-gutters  ">
            <div class="col-12 bg-white padding-30 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="margin-bottom-20 flex-wrap font-size-14 d-flex bg-white padding-0">
                    <p class="mlg-15">{{ $course->title }}</p>
                    <a class="color-2b4a83" href="{{ route('lessons.create',$course->id) }}">آپلود جلسه جدید</a>
                </div>
                <div class="d-flex item-center flex-wrap margin-bottom-15 operations__btns">
                    @can(saeid\RolePermission\Models\Permission::PERMISSION_MANAGE_COURSE)

                    <button class="btn all-confirm-btn" onclick="updateAcceptAll('{{ route('lessons.acceptAll',$course->id) }}')">تایید همه جلسات</button>
                    <button class="btn confirm-btn" onclick="doSelectedAccept('{{ route('lessons.selectedAccept',$course->id) }}')">تایید جلسات</button>
                    <button class="btn reject-btn" onclick="doSelectedReject('{{ route('lessons.selectedReject',$course->id) }}')">رد جلسات</button>
                    <button class="btn delete-btn" onclick="deleteMultiple( '{{ route('lessons.deleteMultiple',$course->id) }}' )">حذف جلسات</button>
@endcan
                </div>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th style="padding: 13px 30px;">
                                <label class="ui-checkbox">
                                    <input type="checkbox" class="checkedAll" >
                                    <span class="checkmark"></span>
                                </label>
                            </th>
                            <th>شناسه</th>
                            <th>عنوان جلسه</th>
                            <th>عنوان فصل</th>
                            <th>مدت زمان جلسه</th>
                            <th>وضعیت دوره</th>
                            <th>وضعیت تایید</th>
                            <th>سطح دسترسی</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lessons as $lesson)

                        <tr role="row" class="" data-row-id="1">
                            <td>
                                <label class="ui-checkbox">
                                    <input type="checkbox" class="sub-checkbox" data-id="{{$lesson->id}}">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>{{ $lesson->number }}</td>
                            <td><a href="">{{ $lesson->title }}</a></td>

                            <td>{{ ($lesson->season) ? $lesson->season->title : '-' }}</td>
                            <td>{{ $lesson->time }}دقیقه</td>
                            <td class="confirmation_status">
                                <span style="@if($lesson->confirmation_status== saeid\Course\Model\Lesson::CONFIRMATION_STATUS_ACCEPT)  color:#00b894 @else color:#e73368  @endif">
                                @lang($lesson->confirmation_status)
                                </span>
                            </td>
                            <td class="status">
                                <span style="@if($lesson->status == saeid\Course\Model\Lesson::STATUS_OPENED)  color:#00b894 @else color:#e73368  @endif">
                                @lang($lesson->status)
                                </span>
                            </td>
                            <td>
                                {{ $lesson->is_free ? 'همه' : 'شرکت کنندگان' }}
                            </td>
                            <td>
                                @can(saeid\RolePermission\Models\Permission::PERMISSION_MANAGE_COURSE)
                                <a href="" onclick=" deleteItem( event, '{{route('lessons.destroy',[$course->id,$lesson->id])}}')"
                                   class="item-delete mlg-15" title="حذف">
                                </a>

                                    <a href="" class="item-confirm mlg-15" title="تایید"
                                       onclick="updateConfirmationStatus(event,'{{ route('lessons.accept',$lesson->id) }}','آیاازتاییدآیتم اطمینان دارید','تاییدشده')" >
                                    </a>
                                    <a href="" class="item-reject mlg-15" title="رد"
                                       onclick="updateConfirmationStatus(event,'{{ route('lessons.reject',$lesson->id) }}','آیااز رد آیتم اطمینان دارید','ردشده')">
                                    </a>
                                    <a href="" class="item-lock mlg-15 lockedItem"
                                       onclick="updateStatus(event,'{{ route('lessons.opened',$lesson->id)}}'
                                           ,'آیا ازتغییروضعیت دوره به باز شده اطمینان دارید','بازشده')" title="باز">
                                    </a>
                                    <a href="" class="item-lock-red mlg-15 lockedItem"
                                       onclick="updateStatus(event,'{{ route('lessons.locked',$lesson->id)}}'
                                           ,'آیا ازتغییروضعیت دوره به قفل شده اطمینان دارید','قفل شده')" title="قفل">
                                    </a>
                                @endcan

                                <a href="{{ route('lessons.edit',[$course->id,$lesson->id]) }}" class="item-edit " title="ویرایش"></a>

                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12">
                @include('Courses::season.index')
                <div class="col-12 bg-white margin-bottom-15 border-radius-3">
                    <p class="box__title">اضافه کردن دانشجو به دوره</p>
                    <form action="" method="post" class="padding-30">
                        <select name="" id="">
                            <option value="0">انتخاب کاربر</option>
                            <option value="1">mohammadniko3@gmail.com</option>
                            <option value="2">sayad@gamil.com</option>
                        </select><div class="dropdown-select wide" tabindex="0"><span class="current">انتخاب کاربر</span><div class="list"><div class="dd-search"><input id="txtSearchValue" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div><ul><li class="option selected" data-value="0" data-display-text="">انتخاب کاربر</li><li class="option " data-value="1" data-display-text="">mohammadniko3@gmail.com</li><li class="option " data-value="2" data-display-text="">sayad@gamil.com</li></ul></div></div>
                        <input type="text" placeholder="مبلغ دوره" class="text">
                        <p class="box__title">کارمزد مدرس ثبت شود ؟</p>
                        <div class="notificationGroup">
                            <input id="course-detial-field-1" name="course-detial-field" type="radio" checked="">
                            <label for="course-detial-field-1">بله</label>
                        </div>
                        <div class="notificationGroup">
                            <input id="course-detial-field-2" name="course-detial-field" type="radio">
                            <label for="course-detial-field-2">خیر</label>
                        </div>
                        <button class="btn btn-webamooz_net">اضافه کردن</button>
                    </form>
                    <div class="table__box padding-30">
                        <table class="table">
                            <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th class="p-r-90">شناسه</th>
                                <th>نام و نام خانوادگی</th>
                                <th>ایمیل</th>
                                <th>مبلغ (تومان)</th>
                                <th>درامد شما</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr role="row" class="">
                                <td><a href="">1</a></td>
                                <td><a href="">توفیق حمزه ای</a></td>
                                <td><a href="">Mohammadniko3@gmail.com</a></td>
                                <td><a href="">40000</a></td>
                                <td><a href="">20000</a></td>
                                <td>
                                    <a href="" class="item-delete mlg-15" title="حذف"></a>
                                    <a href="" class="item-edit " title="ویرایش"></a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
