<?php
Route::group(['namespace'=>'saeid\Front\Http\Controllers','middleware'=>['web']],function ($router){
    $router->get('/','FrontController@index');
    $router->get('/c-{slug}','FrontController@singleCourse')->name('singleCourse');
    $router->get('/tutors/{username}','FrontController@tutorSingle')->name('tutorSingle');
});
