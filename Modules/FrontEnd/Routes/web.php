<?php

Route::get('/', 'FrontEndController@index')->middleware('authCheck');
Route::get('/register', 'FrontEndController@getFormRegister')->middleware('authCheck');
Route::post('/login', 'FrontEndController@login')->middleware('authCheck');
Route::post('/register', 'FrontEndController@register')->middleware('authCheck');
Route::get('/dashboard', 'FrontEndController@dashboard')->middleware('notAuthCheck');
Route::get('/logout', 'FrontEndController@logout')->middleware('notAuthCheck');
Route::get('/profile', 'FrontEndController@getProfile')->middleware('notAuthCheck');
Route::post('/editProfile', 'FrontEndController@editProfile')->middleware('notAuthCheck');

Route::get('/search', 'FrontEndController@search')->middleware('notAuthCheck');

Route::post('pump/data','FrontEndController@pumpData');
Route::post('pump/search','FrontEndController@pumpDataSearch');
Route::post('pump/search/monthChart','FrontEndController@monthChart');


Route::get('getPDF','FrontEndController@getPDF');
Route::get('pdf/{path}','FrontEndController@download');
