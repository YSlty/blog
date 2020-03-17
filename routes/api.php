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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('article','CommonController@article');//文章列表展示
Route::post('artUpdata','CommonController@artUpdata');//文章上传
Route::post('leaveMsg','CommonController@leaveMsg');//留言
Route::get('screenLeaveMsg','CommonController@screenLeaveMsg');//留言筛选
Route::get('showLeaveMsg','CommonController@showLeaveMsg');//可展示留言
Route::post('passLeaveMsg','CommonController@passLeaveMsg');//通过留言
Route::post('delLeaveMsg','CommonController@delLeaveMsg');//删除留言