<?php

Route::prefix('_admin_/base')->middleware('auth')->group(function() {
    Route::get('/', 'BaseController@index');
});
Route::get('_admin_/home', 'BaseController@index')->middleware('auth');
Route::get('/home', 'BaseController@index')->middleware('auth');
