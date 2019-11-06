<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('_admin_/media')->middleware('auth')->group(function() {
    Route::get('/', 'MediaController@index');
    Route::get('/add', 'MediaController@create')->name('media.create');
    Route::post('/store', 'MediaController@store')->name('media.store');

    Route::get('/{id}/edit', 'MediaController@edit')->name('media.edit');
    Route::post('/{id}/edit', 'MediaController@update')->name('media.update');

    Route::get('/delete/{id}', 'MediaController@destroy')->name('media.delete');
});
