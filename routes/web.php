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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group([
    'prefix'=>'admin',
    'namespace'=>'Admin',
    'middleware'=> 'auth',
    ], function(){
        Route::get('/','IndexController@index')->name('admin');

        Route::resource('config','ConfigController');
        Route::get('down','ConfigController@down');
        Route::get('up','ConfigController@up');
        Route::resource('users','UsersController');
        Route::get('api/users','UsersController@users');
        Route::resource('roles','RolesController');
        Route::get('api/roles','RolesController@roles');
        Route::resource('permissions','PermissionController');
        Route::get('api/permissions','PermissionController@permissions');
    }
);