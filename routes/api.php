<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
    Route::get('userchange','Users\UserController@userChange');//验证状态
    Route::post('modify','Users\UserController@modify');//忘记密码-修改密码
});

Route::group(['middleware'=>'refresh.token'],function(){
    Route::get('export','Users\UserController@export');  //导出
     // Route::post('import','Users\UserController@import');  //导入
    //测试是否携带token
    Route::post('users/test', 'UsersController@test');

    Route::post('deanimport','Users\UserController@deanImport');//院长导入 第一排不能为字段
    Route::get('deanexport','Users\UserController@deanExport');//院长导出

});
Route::group(['prefix' => 'deans','middleware'=>'refresh.token'],function () {
    Route::post('modifycode', 'dean\PersonalCenter@modifyCode');//院长修改密码   正
    Route::post('checkone', 'dean\PersonalCenter@checkOne');//院长个人中心
    Route::post('checktwo', 'dean\PersonalCenter@checkTwo');
    Route::post('checkthree', 'dean\PersonalCenter@avg');

    Route::post('checkall', 'dean\TeacherManagerController@viewTeacherInformation');//查看所有教师  正

    Route::post('checkdetails', 'dean\TeacherManagerController@teacherDetails');//教师基本信息 正
    Route::post('teachclass', 'dean\TeacherManagerController@teachClass');//查看教授班级  正
    Route::post('avg', 'dean\TeacherManagerController@avg');//班级平均成绩   正


    Route::post('teachermodify', 'dean\TeacherManagerController@teacherModify');//教师修改  正
    Route::post('class', 'dean\TeacherManagerController@viewClass');  //教师修改->查看所有班级   正
    Route::post('teachersearch', 'dean\TeacherManagerController@search');  //搜索指定教师  正

    Route::post('speciality', 'dean\collegeController@speciality');//学院专业人数
    Route::post('spcount', 'dean\collegeController@spcount');//学院专业总数
    Route::post('classcount', 'dean\collegeController@classcount');//学院班级总数
    Route::get('name', 'dean\collegeController@name');//专业名称

    Route::post('studentsearch', 'dean\collegeController@search');//查询指定学生信息   正
    Route::get('view', 'dean\collegeController@view');//查看所有学生 正
    Route::post('studentmodify', 'dean\collegeController@modify');//修改学生信息  正
    Route::post('studentdelete', 'dean\collegeController@delete');//删除学生   正
    Route::post('studentcount', 'dean\collegeController@count');//查询学生总数   正
    Route::post('studentadd', 'dean\collegeController@add');//添加学生   正 默认学生教室 学科 成绩为-1
    Route::post('grade', 'dean\collegeController@grade');//查看学生成绩   正

    Route::get('studentexport','Users\UserController@studentExport');// 学生导出 需要传参？
    Route::get('teacherexport','Users\UserController@teacherExport');//教师导出  传参问题
    });



Route::post('deanimport','Users\UserController@deanImport');//院长导入
Route::get('deanexport','Users\UserController@deanExport');//院长导出
Route::post('modifycode', 'dean\PersonalCenter@modifyCode');//院长修改密码
