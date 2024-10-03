<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Auth\User'], function() {
    Route::get('/user/login', 'LoginController@index')->name('auth.user.login');
    Route::post('/user/login', 'LoginController@login');
    Route::get('/user/register', 'RegisterController@index')->name('auth.user.register');
    Route::post('/user/register', 'RegisterController@register');
    Route::get('/user/logout', 'LogoutController@index')->name('auth.user.logout');
});

Route::group(['namespace' => 'App\Http\Controllers\Auth\Admin'], function() {
    Route::get('/admin/login', 'LoginController@index')->name('auth.admin.login');
    Route::post('/admin/login', 'LoginController@login');
    Route::get('/admin/register', 'RegisterController@index')->name('auth.admin.register');
    Route::post('/admin/register', 'RegisterController@register');
    Route::get('/admin/logout', 'LogoutController@index')->name('auth.admin.logout');
});

Route::group(['namespace' => 'App\Http\Controllers\Notification'], function() {
    Route::get('/send', 'SendController@index')->middleware('auth:admin');
    Route::post('/send', 'SendController@send')->middleware('auth:admin');

    Route::get('/recieve', 'RecieveController@index')->middleware('auth:web');
    Route::get('/get', 'RecieveController@recieve')->middleware('auth:web');
});
