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

Route::prefix('_admin_/radiation')->middleware('auth')->group(function() {
    Route::get('/view/{city_id}/{radiation_type}', 'RadiationController@index')->middleware('can:view,Modules\Pumps\Entities\Pump');
    Route::get('/add/{city_id}/{radiation_type}', 'RadiationController@create')->name('radiation.create')->middleware('can:create,Modules\Pumps\Entities\Pump');
    Route::post('/store/{city_id}/{radiation_type}', 'RadiationController@store')->name('radiation.store')->middleware('can:create,Modules\Pumps\Entities\Pump');

    Route::get('/{id}/edit/{city_id}/{radiation_type}', 'RadiationController@edit')->name('radiation.edit')->middleware('can:update,Modules\Pumps\Entities\Pump');
    Route::patch('/{id}/edit/{city_id}/{radiation_type}', 'RadiationController@update')->name('radiation.update')->middleware('can:update,Modules\Pumps\Entities\Pump');

    Route::get('/delete/{id}', 'RadiationController@destroy')->name('radiation.delete')->middleware('can:delete,Modules\Pumps\Entities\Pump');
    Route::get('/delete/all/{id}/{type}', 'RadiationController@destroyAll')->name('radiation.delete.all')->middleware('can:delete,Modules\Pumps\Entities\Pump');
});
