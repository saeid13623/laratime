<?php
Route::group(['namespace'=>'saeid\Course\Http\Controllers','middleware'=>['web','auth','verified']],function ($routes){

    //route confirmation_status


    //route status
    $routes->patch('season/{season}/locked','SeasonController@locked')->name('seasons.locked');


    //seasons route
    $routes->post('/season/{course}','SeasonController@store')->name('seasons.store');
    $routes->get('/season/{season}','SeasonController@edit')->name('seasons.edit');
    $routes->patch('/season/{season}','SeasonController@update')->name('seasons.update');
    $routes->delete('/season/{season}','SeasonController@destroy')->name('seasons.destroy');
    $routes->patch('season/{season}/accept','SeasonController@accept')->name('seasons.accept');
    $routes->patch('season/{season}/reject','SeasonController@reject')->name('seasons.reject');
    $routes->patch('season/{season}/locked','SeasonController@locked')->name('seasons.locked');
    $routes->patch('season/{season}/opened','SeasonController@opened')->name('seasons.opened');

});
