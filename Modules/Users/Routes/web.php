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

Route::prefix('_admin_/users')->middleware('auth')->group(function() {
    Route::get('/', 'UsersController@index')->middleware('can:view,Modules\Users\Entities\User');
    Route::get('/add', 'UsersController@create')->name('user.create')->middleware('can:create,Modules\Users\Entities\User');
    Route::get('/profile', 'UsersController@show')->name('user.show')->middleware('can:create,Modules\Users\Entities\User');
    Route::post('/store', 'UsersController@store')->name('user.store')->middleware('can:create,Modules\Users\Entities\User');

    Route::get('/{id}/edit', 'UsersController@edit')->name('user.edit')->middleware('can:update,Modules\Users\Entities\User');
    Route::patch('/{id}/edit', 'UsersController@update')->name('user.update')->middleware('can:update,Modules\Users\Entities\User');

    Route::get('/delete/{id}', 'UsersController@destroy')->name('user.delete')->middleware('can:delete,Modules\Users\Entities\User');
});
