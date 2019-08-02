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

Route::prefix('_admin_/groups')->middleware('auth')->group(function() {
    Route::get('/', 'GroupsController@index')->middleware('can:create,Modules\Groups\Entities\Group');
    Route::get('/add', 'GroupsController@create')->name('group.create')->middleware('can:view,Modules\Groups\Entities\Group');
    Route::get('/profile', 'GroupsController@show')->name('group.show')->middleware('can:create,Modules\Groups\Entities\Group');
    Route::post('/store', 'GroupsController@store')->name('group.store')->middleware('can:create,Modules\Groups\Entities\Group');

    Route::get('/{id}/edit', 'GroupsController@edit')->name('group.edit')->middleware('can:update,Modules\Groups\Entities\Group');
    Route::patch('/{id}/edit', 'GroupsController@update')->name('group.update')->middleware('can:update,Modules\Groups\Entities\Group');

    Route::get('/delete/{id}', 'GroupsController@destroy')->name('group.delete')->middleware('can:delete,Modules\Groups\Entities\Group');
});
