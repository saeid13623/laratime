@component('mail::message')

 {{$user->name}} عزیز
# کد فعالسازی حساب کاربری شمادر سایت

این ایمیل به دلیل ثبت نام شما در سایت برای ایمیل شما فرستاده شده است.
**در صورت اینکه مربوط به شما نمیباشد** آن را نادیده بگیرید.

@component('mail::panel')
کد فعالسازی : {{$code}}
@endcomponent

باتشکر,<br>
{{ config('app.name') }}
@endcomponent
