@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('role-permissions.index')}}" title="نقشهای کاربری">نقشهای کاربری</a></li>
    <li><a href="#" title="ویرایش">ویرایش</a></li>
@stop
@section('content')
<div class="col-12 bg-white">
    <p class="box__title">ویرایش نقش کاربری</p>
    <form action="{{  route("role-permissions.update",$role->id) }}" method="post" class="padding-30">
        @CSRF
        @method('PATCH')

        <input type="text"  name="name"  class="text" value="{{$role->name}}">
        <p class="box__title margin-bottom-15">انتخاب مجوزها</p>
            @foreach($permissions as $permission)
                <label class="ui-checkbox p-t-10 pr-35">
                    <input type="checkbox" name="permissions[{{$permission->name}}]" class="checkedAll"
                           value="{{$permission->name}}"
                           @if($role->hasPermissionTo($permission->name)) checked @endif
                    >
                    <span class="checkmark"></span>
                    @lang($permission->name)
                </label>
            @endforeach
            @error('permissions')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        <hr >
        <button type="submit" class="btn btn-webamooz_net mt-20">بروزرسانی</button>
    </form>
</div>
@stop()
