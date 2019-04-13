<?php



Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'TwoFA'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
