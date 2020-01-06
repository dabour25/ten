<?php

/*
 Created By : Eng.Ahmed Magdy 10/12/2019
*/
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lang/{lang}','HomeController@lang');
Route::get('/out','Auth\LoginController@logout');

Route::get('/myadmin', 'MyAdminController@initial');
Route::post('/myadmin/register', 'MyAdminController@register');
Route::get('/myadmin/{secret_key}', 'MyAdminController@index');
Route::post('/myadmin/login/{secret_key}', 'MyAdminController@login');

Route::get('/myadmin/{secret_key}/info', 'MyAdminController@info');
Route::resource('/myadmin/{secret_key}/admin-management', 'Core\AdminManagementController');
Route::get('/myadmin/{secret_key}/master', 'MyAdminController@master');
Route::post('myadmin/{secret_key}/editmaster','MyAdminController@editmaster');
Route::post('myadmin/{secret_key}/add-css','MyAdminController@add_css');

Route::get('/myadmin/{secret_key}/cssfiles', 'MyAdminController@cssfiles');

Auth::routes();
