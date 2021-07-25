@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('users.edit',$user->id)}}" title="نقشهای کاربری"> ویرایش کاربر </a></li>
@stop
@section('content')
    <div class="col-12 bg-white">
        <p class="box__title">ویرایش کاربر</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('users.update',$user->id)}}" class="padding-30" method="post" enctype="multipart/form-data">
                    @CSRF
                    @method('patch')
                    <input type="text"  name="name" class="text"  placeholder=" کاربر" value="{{$user->name}}">
                    <x-ValidationError field="title"/>

                    <input type="text"  name="username" class="text text-left " placeholder="نام کاربری" value="{{$user->username}}">
                    <x-ValidationError field="username"/>

                    <input type="email"  name="email" class="text text-left " placeholder="ایمیل" value="{{$user->email}}">
                    <x-ValidationError field="email"/>

                    <input type="text"  name="mobile" class="text text-left " placeholder="موبایل" value="{{$user->mobile}}">
                    <x-ValidationError field="mobile"/>

                    <input type="text"  name="headline" class="text text-left " placeholder="معرفی کاربر" value="{{$user->hesdline}}">
                    <x-ValidationError field="headline"/>

                    <input type="text"  name="card_number" class="text text-left " placeholder="شماره کارت" value="{{$user->card_number}}">
                    <x-ValidationError field="card_number"/>

                    <input type="text"  name="shaba" class="text text-left " placeholder="شماره شبا" value="{{$user->shaba}}">
                    <x-ValidationError field="shaba"/>

                    <input type="text"  name="balance" class="text text-left " placeholder="" value="{{$user->balance}}">
                    <x-ValidationError field="balance"/>

                    <input type="text"  name="telegram" class="text text-left " placeholder="تلگرام" value="{{$user->telegram}}">
                    <x-ValidationError field="telegram"/>

                    <input type="password"  name="password" class="text text-left " placeholder="پسورد" >
                    <x-ValidationError field="password"/>



                    <select name="status">
                        <option value="0">وضعیت کاربر</option>
                        @foreach(App\User::$statuses as $status)
                            <option value="{{ $status }}" @if($status==$user->status) selected @endif>@lang($status)</option>
                        @endforeach
                    </select>
                    <x-ValidationError field="status"/>


                    <div class="file-upload">
                        <div class="i-file-upload">
                            <span>آپلود بنر کاربر</span>
                            <input type="file" class="file-upload" id="files" name="image"/>
                            <x-ValidationError field="image"/>
                        </div>
                        @if(isset($user->image->thumb))
                        <img src="{{$user->image->thumb}}" width="80" style="padding-top: 15px;">
                        @else
                        <span class="selectedFiles">فایلی انتخاب نشده است</span>
                            @endif
                    </div>

                    <textarea placeholder="توضیحات کاربر" name="bio" class="text h" ></textarea>
                    <x-ValidationError field="body"/>

                    <button type="submit" class="btn btn-webamooz_net">ویرایش کاربر</button>
                </form>
            </div>
        </div>
    </div>
@stop()

