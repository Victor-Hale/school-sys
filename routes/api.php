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
/**
 * 注册 登录  修改密码  excel导入  excel导出  邮件发送
 */
Route::prefix('users')->group(function (){
    Route::post('login','Users\UserController@login');  //登录
    Route::post('registered','Users\UserController@registered');  //注册
    Route::post('again','Users\UserController@again');  // 修改密码
    Route::post('sendmail','Users\UserController@sendmail');  //发送邮箱
});

Route::group(['middleware'=>'refresh.token'],function(){
    Route::get('export','Users\UserController@export');  //导出
    Route::post('import','Users\UserController@import');  //导入
    //测试是否携带token
    Route::post('users/test','UsersController@test');
});

