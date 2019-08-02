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

Route::prefix('_admin_/module')->middleware('auth')->group(function() {
    Route::get('/', 'ModuleController@index')->middleware('can:view,Modules\Pumps\Entities\Pump');
    Route::get('/add', 'ModuleController@create')->name('module.create')->middleware('can:create,Modules\Pumps\Entities\Pump');
    Route::post('/store', 'ModuleController@store')->name('module.store')->middleware('can:create,Modules\Pumps\Entities\Pump');

    Route::get('/{id}/edit', 'ModuleController@edit')->name('module.edit')->middleware('can:update,Modules\Pumps\Entities\Pump');
    Route::patch('/{id}/edit', 'ModuleController@update')->name('module.update')->middleware('can:update,Modules\Pumps\Entities\Pump');

    Route::get('/delete/{id}', 'ModuleController@destroy')->name('module.delete')->middleware('can:delete,Modules\Pumps\Entities\Pump');
});
