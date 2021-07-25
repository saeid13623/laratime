<?php

use App\User;
use saeid\Media\Services\MediaFileServices;


use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/test', function () {
     event(new saeid\Payment\Events\PaymentWasSuccefull(new saeid\Payment\Model\Payment())) ;
/* Permission::create(['name'=>\saeid\RolePermission\Models\Permission::PERMISSION_Super_ADMIN]);
    auth()->user()->givePermissionTo(\saeid\RolePermission\Models\Permission::PERMISSION_SUPER_ADMIN);
    //auth()->user()->assignRole('super-admin');
     return auth()->user()->permission;*/
       /*dd( MediaFileServices::getExtensions());*/
});

/*Route::mixin(new \Laravel\Ui\AuthRouteMethods());*/
/*Auth::routes(['verify'=>true]);*/





