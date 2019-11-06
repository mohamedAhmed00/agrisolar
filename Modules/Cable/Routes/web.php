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

Route::prefix('_admin_/cable')->middleware('auth')->group(function() {
    Route::get('/', 'CableController@index')->middleware('can:view,Modules\Pumps\Entities\Pump');
    Route::get('/add', 'CableController@create')->name('cable.create')->middleware('can:create,Modules\Pumps\Entities\Pump');
    Route::post('/store', 'CableController@store')->name('cable.store')->middleware('can:create,Modules\Pumps\Entities\Pump');

    Route::get('/{id}/edit', 'CableController@edit')->name('cable.edit')->middleware('can:update,Modules\Pumps\Entities\Pump');
    Route::patch('/{id}/edit', 'CableController@update')->name('cable.update')->middleware('can:update,Modules\Pumps\Entities\Pump');

    Route::get('/delete/{id}', 'CableController@destroy')->name('cable.delete')->middleware('can:delete,Modules\Pumps\Entities\Pump');
});
