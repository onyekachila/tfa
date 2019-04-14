<?php



Route::get('/', function () {
    return view('welcome');
});

Route::post('/verifyOTP', 'VerifyOTPController@verify');

Route::group(['middleware' => 'TwoFA'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
