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

Route::prefix('_admin_/city')->middleware('auth')->group(function() {
    Route::get('/', 'CityController@index')->middleware('can:view,Modules\Pumps\Entities\Pump');
    Route::get('/add', 'CityController@create')->name('city.create')->middleware('can:create,Modules\Pumps\Entities\Pump');
    Route::post('/store', 'CityController@store')->name('city.store')->middleware('can:create,Modules\Pumps\Entities\Pump');

    Route::get('/{id}/edit', 'CityController@edit')->name('city.edit')->middleware('can:update,Modules\Pumps\Entities\Pump');
    Route::patch('/{id}/edit', 'CityController@update')->name('city.update')->middleware('can:update,Modules\Pumps\Entities\Pump');

    Route::get('/delete/{id}', 'CityController@destroy')->name('city.delete')->middleware('can:delete,Modules\Pumps\Entities\Pump');
});
