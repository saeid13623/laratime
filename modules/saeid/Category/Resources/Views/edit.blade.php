@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('category.index')}}" title="نقشهای کاربری">دسته بندی</a></li>
    <li><a href="{{route('category.edit',$category->id)}}" title="ویرایش">ویرایش</a></li>
@stop
@section('content')
<div class="col-12 bg-white">
    <p class="box__title">ایجاد دسته بندی جدید</p>
    <form action="{{route('category.update',$category->id)}}" method="post" class="padding-30">
        @CSRF
        @method('patch')
        <input type="text" required name="title" placeholder="نام دسته بندی" class="text" value="{{$category->title}}">
        <input type="text" required name="slug" placeholder="نام انگلیسی دسته بندی" class="text" value="{{$category->id}}">
        <p class="box__title margin-bottom-15">انتخاب دسته والد</p>
        <select name="parent_id" id="parent_id">
            <option value="">ندارد</option>

            @foreach($categories as $categoryItem)
                <option value="{{$categoryItem->id}}" @if($categoryItem->id == $category->parent_id) selected @endif>{{$categoryItem->title}}</option>
            @endforeach
        </select>
        <button class="btn btn-webamooz_net">بروزرسانی</button>
    </form>
</div>
@stop()
