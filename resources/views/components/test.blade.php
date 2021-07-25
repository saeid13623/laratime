@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('users.edit',auth()->user()->id)}}" title="ویرایش پروفایل"> کاربران </a></li>
    <li><a title="ویرایش پروفایل"> ویرایش پروفایل </a></li>
@stop
@section('content')
    <div class="col-12 bg-white">
        <p class="box__title">ویرایش پروفایل</p>

        <form action="{{ route('users.photo') }}" method="post" enctype="multipart/form-data">
            @CSRF
            <div class="profile__info border cursor-pointer text-center">
                <div class="avatar__img"><img src="{{auth()->user()->thumb}}" class="avatar___img">
                    <input type="file" accept="image/*" class="hidden avatar-img__input" name="userphoto"
                           onchange="this.form.submit()"
                    >
                    <div class="v-dialog__container" style="display: block;"></div>
                    <div class="box__camera default__avatar"></div>
                </div>
                <span class="profile__name">کاربر : {{auth()->user()->name}}</span>
            </div>
        </form>


        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('users.profile')}}" class="padding-30" method="post">
                    @CSRF

                    <input type="text" name="name" class="text" placeholder=" کاربر" value="{{auth()->user()->name}}">
                    <div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <input type="email" name="email" class="text text-left " placeholder="ایمیل"
                           value="{{auth()->user()->email}}">
                    <div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <input type="text" name="mobile" class="text text-left " placeholder="موبایل"
                           value="{{auth()->user()->mobile}}">

                    <div>
                        @error('mobile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <input type="password" name="password" class="text text-left " placeholder="پسورد">

                    <div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <p class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای
                        غیر الفبا مانند <strong>!@#$%^&amp;*()</strong> باشد.</p>

                    @can(saeid\RolePermission\Models\Permission::PERMISSION_TEACH)

                        <input type="text" name="username" class="text text-left "
                               placeholder="نام کاربری و مشخصات کاربر"
                               value="@if(isset(auth()->user()->username)){{auth()->user()->username}}" @endif>
                        <p class="input-help text-left margin-bottom-12" dir="ltr">

                            <a href="{{auth()->user()->profilePath()}}">{{auth()->user()->profilePath()}}</a>
                        </p>
                        <div>
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        <input type="text" name="card_number" class="text text-left " placeholder="شماره کارت"
                               value="{{auth()->user()->card_number}}">
                        <div>
                            @error('card_number')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        <input type="text" name="headline" class="text text-left " placeholder="معرفی کاربر"
                               value="{{auth()->user()->headline}}">
                        <div>
                            @error('headline')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        <input type="text" name="shaba" class="text text-left " placeholder="شماره شبا"
                               value="{{auth()->user()->shaba}}">
                        <div>
                            @error('shaba')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <textarea placeholder="توضیحات کاربر" name="bio"
                                  class="text h">{{ auth()->user()->bio }}</textarea>
                        <div>
                            @error('bio')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    @endcan


                    <button type="submit" class="btn btn-webamooz_net">ویرایش کاربر</button>
                </form>
            </div>
        </div>
    </div>
@stop()


