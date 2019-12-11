<?php

/*
 Created By : Eng.Ahmed Magdy 10/12/2019
*/
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lang/{lang}','HomeController@lang');

Route::get('/myadmin', 'MyAdminController@initial');
Route::post('/myadmin/register', 'MyAdminController@register');
Route::get('/myadmin/{secret_key}', 'MyAdminController@index');

Auth::routes();
