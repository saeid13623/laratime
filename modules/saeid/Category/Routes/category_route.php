<?php
Route::group(['namespace'=>'saeid\Category\Http\Controllers',
    'middleware'=>['web','auth','verified']]
    ,function ($router){
        $router->resource('/category','CategoryController');
    });
