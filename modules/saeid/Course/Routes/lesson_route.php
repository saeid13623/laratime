<?php
Route::group(['namespace'=>'saeid\Course\Http\Controllers','middleware'=>['web','auth','verified']],function ($routes){

    $routes->get('courses/{course}/lessons/create','LessonController@create')->name('lessons.create');
    $routes->post('courses/{course}/lessons','LessonController@store')->name('lessons.store');
    $routes->delete('courses/{course}/lessons/{lesson}','LessonController@destroy')->name('lessons.destroy');
    $routes->delete('courses/{course}/lessons/','LessonController@deleteMultiple')->name('lessons.deleteMultiple');
    $routes->get('courses/{course}/lessons/{lesson}/edit', 'LessonController@edit')->name('lessons.edit');
    $routes->patch('courses/{course}/lessons/{lesson}', 'LessonController@update')->name('lessons.update');


    $routes->patch('lesson/{lesson}/accept','LessonController@accept')->name('lessons.accept');
    $routes->patch('lesson/{lesson}/reject','LessonController@reject')->name('lessons.reject');
    $routes->patch('lesson/{lesson}/locked','LessonController@locked')->name('lessons.locked');
    $routes->patch('lesson/{lesson}/opened','LessonController@opened')->name('lessons.opened');
    $routes->patch('courses/{course}/lesson/acceptAll','LessonController@acceptAll')->name('lessons.acceptAll');
    $routes->patch('courses/{course}/lesson/selectedAccept','LessonController@selectedAccept')->name('lessons.selectedAccept');
    $routes->patch('courses/{course}/lesson/selectedReject','LessonController@selectedReject')->name('lessons.selectedReject');



});
