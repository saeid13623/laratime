@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="دوره ها">  دوره ها </a></li>
    <li><a href="{{route('courses.details',$season->course_id)}}" title="چزییات دوره">چزییات دوره</a></li>
    <li><a href="{{route('courses.create')}}" title="نقشهای کاربری"> ویرایش فصل دوره({{$season->title}}) </a></li>
@stop
@section('content')
    <div class="col-12 bg-white">
        <p class="box__title">ویرایش دوره</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('seasons.update',$season->id)}}" class="padding-30" method="post" >
                    @CSRF
                    @method('patch')
                    <input type="text" name="title" placeholder="عنوان سرفصل" value="{{$season->title}}" class="text">

                    <input type="text" name="number" placeholder="شماره سرفصل"  value="{{$season->number}}" class="text">
                    <button type="submit" class="btn btn-webamooz_net">ویرایش فصل</button>
                </form>
            </div>
        </div>
    </div>
@stop()

