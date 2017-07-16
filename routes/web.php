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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group([ 'middleware' => 'auth' ], function ()
{
    /*
    |--------------------------------------------------------------------------
    | Admin User
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::group([ 'as' => 'admin.', 'prefix' => 'admin' ], function ()
    {
        Route::get('/', 'AdminController@index')->name('index');
        Route::post('/', 'AdminController@store')->name('store');
        Route::get('/create', 'AdminController@create')->name('create');
        Route::post('/datatable', 'AdminController@datatable')->name('datatable');
        Route::get('/{user}/edit', 'AdminController@edit')->name('edit');
        Route::get('/{user}', 'AdminController@show')->name('show');
        Route::put('/{user}', 'AdminController@update')->name('update');
        Route::delete('/{user}', 'AdminController@destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Teacher User
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::group([ 'as' => 'teacher.', 'prefix' => 'teacher' ], function ()
    {
        Route::get('/', 'TeacherController@index')->name('index');
        Route::post('/', 'TeacherController@store')->name('store');
        Route::get('/create', 'TeacherController@create')->name('create');
        Route::post('/datatable', 'TeacherController@datatable')->name('datatable');
        Route::get('/{user}/edit', 'TeacherController@edit')->name('edit');
        Route::get('/{user}', 'TeacherController@show')->name('show');
        Route::put('/{user}', 'TeacherController@update')->name('update');
        Route::delete('/{user}', 'TeacherController@destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Parent User
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::group([ 'as' => 'parent.', 'prefix' => 'parent' ], function ()
    {
        Route::get('/', 'ParentController@index')->name('index');
        Route::post('/', 'ParentController@store')->name('store');
        Route::get('/create', 'ParentController@create')->name('create');
        Route::post('/datatable', 'ParentController@datatable')->name('datatable');
        Route::get('/{user}/edit', 'ParentController@edit')->name('edit');
        Route::get('/{user}', 'ParentController@show')->name('show');
        Route::put('/{user}', 'ParentController@update')->name('update');
        Route::delete('/{user}', 'ParentController@destroy')->name('destroy');
    });
});