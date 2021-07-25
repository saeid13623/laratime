@extends('User::auth.master')

@section('content')
    <form method="get" action="{{ route('password.sendVerifyCodeEmail') }}" class="form">

        <a class="account-logo" href="/">
            <img src="/img/weblogo.png" alt="">
        </a>
        <h1>بازیابی رمز عبور</h1>
        <div class="form-content">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <input type="email" name="email" class="txt-l txt @error('email') is-invalid @enderror"
                   placeholder="ایمیل" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
            <button type="submit" class="btn btn-recoverpass">بازیابی</button>
        </div>
        <div class="form-footer">
            <a href="{{route('login')}}">صفحه ورود</a>
        </div>
    </form>

@endsection
