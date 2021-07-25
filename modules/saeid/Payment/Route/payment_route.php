<?php
Route::group(['namespace'=>'saeid\Payment\Http\Controllers','middleware'=>'web'],function ($router){
    $router->any('/payments/callback',['uses'=>'PaymentController@callback','as'=>'payments.callback']);

    $router->get('/payments',['uses'=>'paymentController@index','as'=>'payments.index']);

});

