<?php

//روتهایی که برای دسترسی به آنها به لاگین کردن یوزر نیاز داره وبه محض کلیک کردن خودکار به صفحه لاگین بریم باید میدلور auth برای آنها ست شود
Route::group(['namespace'=> 'saeid\User\Http\Controllers','middleware'=>['web','auth']],function ($router){
    Route::post('/users/{user}/add/role','UserController@addRole')->name('users-addRole');
    Route::delete('/users/{user}/remove/{role}/role','UserController@removeRole')->name('users.removeRole');
    Route::patch('/users/{user}/manualVerified','UserController@manualVerified')->name('users.manualVerified');
    Route::post('/users/photo','UserController@userPhoto')->name('users.photo');
    Route::get('/edit-profile','UserController@profile')->name('users.profile')->middleware('verified');
    Route::post('/edit-profile','UserController@updateProfile')->name('users.profile');
    Route::resource('/users','UserController');
});

Route::group(['namespace'=>'saeid\User\Http\Controllers','middleware'=>['web']],function ($router){

    Route::post('/email/verify','Auth\VerificationController@verify')->name('verification.verify');
    Route::post('/email/resend','Auth\VerificationController@resend')->name('verification.resend');
    Route::get('/email/verify','Auth\VerificationController@show')->name('verification.notice');

//login
    Route::post('/login','Auth\LoginController@login');
    Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
    Route::post('/logout','Auth\LoginController@logout')->name('logout');

//password confirm
    Route::get('/password/reset','Auth\ForgotPasswordController@showCodeFormRequest')->name('password.request');
    Route::get('/password/reset/send','Auth\ForgotPasswordController@sendVerifyCodeEmail')->name('password.sendVerifyCodeEmail');
    Route::post('/password/reset/check','Auth\ForgotPasswordController@checkVerifyCode')
        ->name('password.check-verify-code')
        ->middleware('throttle:5,1');
    Route::get('/password/change','Auth\ResetPasswordController@showResetForm')
        ->name('password.showResetForm')
        ->middleware('auth');
    Route::post('/password/change','Auth\ResetPasswordController@reset')->name('password.update');

    Route::post('/password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');


//register
    Route::get('/register','Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register','Auth\RegisterController@register');
});
