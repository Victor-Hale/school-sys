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

/**  学生
 *  个人中心  修改密码    excel导出
 */
Route::group(['prefix' => 'student','middleware'=>'refresh.token'],function(){
    Route::get('personal','student\StudentController@personal');//个人中心   OK+
    Route::get('grade','student\StudentController@grade');//查看个人成绩   OK+
    Route::post('dgrade','student\StudentController@dgrade');//查看指定科目成绩    OK+
});
/**  教师
 *  个人中心  修改密码    excel导出
 * 修改学生成绩   查找学生成绩   班级成绩查看
 */
Route::group(['prefix' => 'teacher','middleware'=>'refresh.token'],function(){
    Route::get('personal','teacher\TeacherController@personal');//个人中心   OK++
    Route::post('dagain','teacher\TeacherController@dagain');//修改学生成绩     OK+
    Route::get('grade','teacher\TeacherController@grade');//查看班级成绩     OK+
    Route::any('dgrade','teacher\TeacherController@dgrade');//查看指定学生成绩  OK+
});

