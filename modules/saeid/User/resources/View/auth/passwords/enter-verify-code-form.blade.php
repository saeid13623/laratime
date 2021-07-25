@extends('User::auth.master')

@section('content')
    <div class="account act">
        <form action="{{route('password.check-verify-code')}}" class="form" method="post">
            @CSRF
            <a class="account-logo" href="/">
                <img src="/img/weblogo.png" alt="">
            </a>
            <input type="hidden" name="email" value="{{request()->email}}">
            <div class="card-header">
                <p class="activation-code-title">کد فرستاده شده به ایمیل  <span>{{request()->email}}</span>
                    را وارد کنید . ممکن است ایمیل به پوشه spam فرستاده شده باشد
                </p>
            </div>
            <div class="form-content form-content1">
                <input name="verify_code" class="activation-code-input" placeholder="فعال سازی">
                <br>
                <button class="btn i-t">تایید</button>
                <a href="#" onclick="
                event.preventDefault();
                document.getElementById('resend_code').submit()">
                    ارسال مجددکدفعالسازی
                </a>

            </div>
            <div class="form-footer">
                <a href="{{route('register')}}">صفحه ثبت نام</a>
            </div>
        </form>
        <form id="resend_code" method="post" action="{{route('verification.resend')}}">@CSRF</form>
    </div>
@endsection

@section('js')
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/activation-code.js"></script>
@endsection

