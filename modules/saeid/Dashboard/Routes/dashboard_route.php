<?php
Route::group(['namespace'=>'saeid\Dashboard\Http\Controllers','middleware'=>['web','auth','verified']],function ($router){
    $router->get('dashboard','DashboardController@index')->name('dashboard');
});





