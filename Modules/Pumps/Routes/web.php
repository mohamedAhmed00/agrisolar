<?php

Route::prefix('_admin_/pumps')->middleware('auth')->group(function() {
    Route::get('/', 'PumpsController@index')->middleware('can:view,Modules\Pumps\Entities\Pump');
    Route::get('/add', 'PumpsController@create')->name('pump.create')->middleware('can:create,Modules\Pumps\Entities\Pump');
    Route::post('/store', 'PumpsController@store')->name('pump.store')->middleware('can:create,Modules\Pumps\Entities\Pump');

    Route::get('/{id}/edit', 'PumpsController@edit')->name('pump.edit')->middleware('can:update,Modules\Pumps\Entities\Pump');
    Route::patch('/{id}/edit', 'PumpsController@update')->name('pump.update')->middleware('can:update,Modules\Pumps\Entities\Pump');

    Route::get('/delete/{id}', 'PumpsController@destroy')->name('pump.delete')->middleware('can:delete,Modules\Pumps\Entities\Pump');
});

Route::prefix('_admin_/pumps/add/height')->middleware('auth')->group(function() {
    Route::get('/{pumps_id}', 'HeightPumpsController@index')->middleware('can:view,Modules\Pumps\Entities\HeightPumps');
    Route::get('/add/{pumps_id}', 'HeightPumpsController@create')->name('HeightPumps.create')->middleware('can:create,Modules\Pumps\Entities\HeightPumps');
    Route::post('/store/{pumps_id}', 'HeightPumpsController@store')->name('HeightPumps.store')->middleware('can:create,Modules\Pumps\Entities\HeightPumps');

    Route::get('/{id}/edit/{pumps_id}', 'HeightPumpsController@edit')->name('HeightPumps.edit')->middleware('can:update,Modules\Pumps\Entities\HeightPumps');
    Route::patch('/{id}/edit/{pumps_id}', 'HeightPumpsController@update')->name('HeightPumps.update')->middleware('can:update,Modules\Pumps\Entities\HeightPumps');

    Route::get('/delete/{id}', 'HeightPumpsController@destroy')->name('HeightPumps.delete')->middleware('can:delete,Modules\Pumps\Entities\HeightPumps');
});
