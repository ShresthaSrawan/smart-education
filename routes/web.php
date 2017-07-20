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

Route::get('/', function ()
{
    return redirect('/home');
});

Auth::routes();

Route::group([ 'middleware' => 'auth' ], function ()
{

    Route::get('/home', 'HomeController@index')->name('home');
    /*
    |--------------------------------------------------------------------------
    | Admin User
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::group([ 'as' => 'admin.', 'prefix' => 'admin' ], function ()
    {
        Route::get('/', 'AdminController@index')->name('index')->middleware('permission:view-admin');
        Route::post('/', 'AdminController@store')->name('store')->middleware('permission:create-admin');
        Route::get('/create', 'AdminController@create')->name('create')->middleware('permission:create-admin');
        Route::post('/datatable', 'AdminController@datatable')->name('datatable')->middleware('permission:view-admin');
        Route::get('/{user}/edit', 'AdminController@edit')->name('edit')->middleware('permission:update-admin');
        Route::get('/{user}', 'AdminController@show')->name('show')->middleware('permission:view-admin');
        Route::put('/{user}', 'AdminController@update')->name('update')->middleware('permission:update-admin');
        Route::delete('/{user}', 'AdminController@destroy')->name('destroy')->middleware('permission:delete-admin');
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
        Route::get('/', 'TeacherController@index')->name('index')->middleware('permission:view-teacher');
        Route::post('/', 'TeacherController@store')->name('store')->middleware('permission:create-teacher');
        Route::get('/create', 'TeacherController@create')->name('create')->middleware('permission:create-teacher');
        Route::post('/datatable', 'TeacherController@datatable')->name('datatable')->middleware('permission:view-teacher');
        Route::get('/{user}/edit', 'TeacherController@edit')->name('edit')->middleware('permission:update-teacher');
        Route::get('/{user}', 'TeacherController@show')->name('show')->middleware('permission:view-teacher');
        Route::put('/{user}', 'TeacherController@update')->name('update')->middleware('permission:update-teacher');
        Route::delete('/{user}', 'TeacherController@destroy')->name('destroy')->middleware('permission:delete-teacher');
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
        Route::get('/', 'ParentController@index')->name('index')->middleware('permission:view-parent');
        Route::post('/', 'ParentController@store')->name('store')->middleware('permission:create-parent');
        Route::get('/create', 'ParentController@create')->name('create')->middleware('permission:create-parent');
        Route::post('/datatable', 'ParentController@datatable')->name('datatable')->middleware('permission:view-parent');
        Route::get('/{user}/edit', 'ParentController@edit')->name('edit')->middleware('permission:update-parent');
        Route::get('/{user}', 'ParentController@show')->name('show')->middleware('permission:view-parent');
        Route::put('/{user}', 'ParentController@update')->name('update')->middleware('permission:update-parent');
        Route::delete('/{user}', 'ParentController@destroy')->name('destroy')->middleware('permission:delete-parent');
    });

    /*
    |--------------------------------------------------------------------------
    | Grade User
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::group([ 'as' => 'grade.', 'prefix' => 'grade' ], function ()
    {
        Route::get('/', 'GradeController@index')->name('index')->middleware('permission:view-grade');
        Route::post('/', 'GradeController@store')->name('store')->middleware('permission:create-grade');
        Route::get('/create', 'GradeController@create')->name('create')->middleware('permission:create-grade');
        Route::post('/datatable', 'GradeController@datatable')->name('datatable')->middleware('permission:view-grade');
        Route::get('/{grade}/edit', 'GradeController@edit')->name('edit')->middleware('permission:update-grade');
        Route::get('/{grade}', 'GradeController@show')->name('show')->middleware('permission:view-grade');
        Route::put('/{grade}', 'GradeController@update')->name('update')->middleware('permission:update-grade');
        Route::delete('/{grade}', 'GradeController@destroy')->name('destroy')->middleware('permission:delete-grade');

        Route::group([ 'as' => 'subject.', 'prefix' => '/{grade}/subject' ], function ()
        {
            Route::get('/', 'SubjectController@index')->name('index')->middleware('permission:view-subject');
            Route::get('/data', 'SubjectController@data')->name('data')->middleware('permission:view-subject');
            Route::post('/', 'SubjectController@store')->name('store')->middleware('permission:create-subject');
            Route::delete('/{subject}', 'SubjectController@destroy')->name('destroy')->middleware('permission:delete-subject');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Parent User
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::group([ 'as' => 'post.', 'prefix' => 'post' ], function ()
    {
        Route::post('/', 'PostController@store')->name('store')->middleware('permission:create-post');
    });

    /*
    |--------------------------------------------------------------------------
    | Parent User
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::group([ 'as' => 'notice.', 'prefix' => 'notice' ], function ()
    {
        
    });
});