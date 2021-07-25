@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="دوره ها">دوره ها</a></li>
@stop
@section('content')
    <div class="tab__box">
        <div class="tab__items">
            <a class="tab__item is-active" href="courses.html">لیست دوره ها</a>
            <a class="tab__item" href="approved.html">دوره های تایید شده</a>
            <a class="tab__item" href="new-course.html">دوره های تایید نشده</a>
            <a   href="{{ route('courses.create') }}" title="ایجاد دوره جدید">ایجاد دوره جدید</a>
        </div>
    </div>
    <div class="row no-gutters  ">
        <div class="col-12 ">
                <p  class="box__title">  دوره ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">

                        <th>شناسه</th>
                        <th>ای دی</th>
                        <th>بنر دوره</th>
                        <th>عنوان</th>
                        <th>جرییات</th>
                        <th>مدرس</th>
                        <th>قیمت</th>
                        <th>درصدمدرس</th>
                        <th>وضعیت دوره</th>
                        <th>وضعیت تایید</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($courses as $course)
                        <tr role="row" class="" id="trTag">
                        <td><a href="">{{$course->priority}}</a></td>
                        <td><a href="">{{$course->id}}</a></td>
                        <td width="80"><img src="{{$course->thumb}}" alt="" width="80"></td>
                        <td><a href="">{{$course->title}}</a></td>
                        <td><a href="{{ route('courses.details',$course->id) }}"  class="item-eye mlg-15" title="مشاهده سرفصل های دوره"></a></td>
                        <td><a href="">{{$course->teacher->name}}</a></td>
                        <td>{{$course->price}}</td>
                        <td>{{$course->percent}}%</td>

                        <td class="status">@lang($course->status)</td>
                        <td class="confirmation_status">@lang($course->confirmation_status)</td>

                        <td>



                            <a href="{{route('courses.edit',$course->id)}}" class="item-edit " title="ویرایش"></a>
                            @can(saeid\RolePermission\Models\Permission::PERMISSION_MANAGE_COURSE)
                                <a href="" onclick=" deleteItem( event, '{{route('courses.destroy',$course->id)}}')"
                                   class="item-delete mlg-15" title="حذف">
                                </a>
                            <a href="" class="item-confirm mlg-15 "
                               onclick="updateConfirmationStatus(event,'{{ route('courses.accept',$course->id)}}'
                                   ,'آیا از تایید آیتم اطمینان دارید','تاییدشده') " title="تایید">
                            </a>
                            <a href="" class="item-reject mlg-15 "
                               onclick="updateConfirmationStatus(event,'{{ route('courses.reject',$course->id)}}'
                                   ,'آیا از رد آیتم اطمینان دارید','ردشده') " title="رد">
                            </a>
                            <a href="" class="item-lock mlg-15"
                               onclick="updateConfirmationStatus(event,'{{ route('courses.locked',$course->id)}}'
                                   ,'آیا ازتغییروضعیت دوره به تکمیل شده اطمینان دارید','تکمیل شده','status')" title="تایید">
                            </a>
                            <a href="" class="item-lock-red mlg-15"
                               onclick="updateConfirmationStatus(event,'{{ route('courses.locked',$course->id)}}'
                                   ,'آیا ازتغییروضعیت دوره به قفل شده اطمینان دارید','قفل شده','status')" title="تایید">
                            </a>
                        </td>
                    </tr>
                    @endcan
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@stop()
