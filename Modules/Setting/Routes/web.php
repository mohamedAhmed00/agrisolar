<?php

Route::prefix('_admin_/setting')->middleware('auth')->group(function() {
    Route::get('/', 'SettingController@index')->middleware('can:view,Modules\Setting\Entities\Setting');
    Route::get('/add', 'SettingController@create')->name('setting.create')->middleware('can:create,Modules\Setting\Entities\Setting');
    Route::post('/store', 'SettingController@store')->name('setting.store')->middleware('can:create,Modules\Setting\Entities\Setting');

    Route::get('/{id}/edit', 'SettingController@edit')->name('setting.edit')->middleware('can:update,Modules\Setting\Entities\Setting');
    Route::post('/{id}/edit', 'SettingController@update')->name('setting.update')->middleware('can:update,Modules\Setting\Entities\Setting');

    Route::get('/delete/{id}', 'SettingController@destroy')->name('setting.delete')->middleware('can:delete,Modules\Setting\Entities\Setting');
});
