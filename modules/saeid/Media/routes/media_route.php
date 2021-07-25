<?php
Route::group(['namespace'=>'saeid\Media\Http\Controllers','middleware'=>['web','auth']],function ($routers){
   $routers->get('/media/{media}/download','MediaController@download')->name('media.download');
});
