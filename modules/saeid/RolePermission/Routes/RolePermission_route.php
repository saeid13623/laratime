<?php
Route::group(['namespace'=>'saeid\RolePermission\Http\Controllers',
    'middleware'=>['web','auth','verified']],function ($router){
   $router->resource('/role-permissions','RolePermissionController');
});
