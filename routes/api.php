<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => 'auth:api'], function() {
	Route::get('user/search', 'UserController@search')->name('user.search');
    Route::get('post/list', 'PostController@api')->name('post.list')->middleware('permission:view-post');
    Route::post('notice', 'NoticeController@store')->name('notice.store')->middleware('permission:create-notice');
});
