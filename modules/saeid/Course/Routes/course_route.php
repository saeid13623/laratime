<?php
Route::group(['namespace'=>'saeid\Course\Http\Controllers','middleware'=>['web','auth','verified']],function ($routes){
   $routes->resource('/courses','CourseController');
   $routes->patch('courses/{course}/accept','CourseController@accept')->name('courses.accept');
   $routes->patch('courses/{course}/reject','CourseController@reject')->name('courses.reject');
   $routes->patch('courses/{course}/locked','CourseController@locked')->name('courses.locked');
   $routes->get('courses/{course}/details','CourseController@details')->name('courses.details');
   $routes->post('courses/{course}/buy','CourseController@buy')->name('courses.buy');
   $routes->get('courses/{course}/downloadLink','CourseController@downloadLink')->name('courses.downloadLink');
});
