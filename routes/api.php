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
    Route::get('export','Headmaster\collegeController@export');//exl导出11
});

Route::group(['middleware'=>'refresh.token'],function(){
    Route::get('export','Users\UserController@export');  //导出
    Route::post('import','Users\UserController@import');  //导入
    //测试是否携带token
    Route::post('users/test','UsersController@test');
});



Route::group(['prefix' => 'college','middleware'=>'refresh.token'],function () {
    Route::post('add','Headmaster\collegeController@add');//添加学院11
    Route::post('show','Headmaster\collegeController@show');//查看学院11
    Route::get('showall','Headmaster\collegeController@showall');//查看所有学院11
    Route::post('delete','Headmaster\collegeController@delete');//删除学院11
    Route::post('modify','Headmaster\collegeController@modify');//修改学院 111
    Route::post('showclass','Headmaster\collegeController@showclass');//查看学院详情11
    Route::post('xclass','Headmaster\collegeController@xclass');//查看班级男女
    Route::get('export','Headmaster\collegeController@export');//exl导出11
    Route::post('import','Headmaster\collegeController@import');//exl导入11

    Route::get('allcollege','Headmaster\collegeController@allcollege');//查看有好多学院11
    Route::post('allsp','Headmaster\collegeController@allsp');//查看有好多专业11
    Route::post('allstudent','Headmaster\collegeController@allstudent');//查看有好多学生11
    Route::post('allteacher','Headmaster\collegeController@allteacher');//查看有好多老师11


    Route::post('test','Headmaster\collegeController@test');//添加学院11

    Route::post('supmodify','Headmaster\collegeController@supmodify');//超级修改
    Route::get('alluser','Headmaster\collegeController@alluser');//查看所有用户




});//yjx

Route::group(['prefix' => 'teacher','middleware'=>'refresh.token'],function () {
    Route::post('add','Headmaster\teacherController@add');//添加教师11
    Route::post('show','Headmaster\teacherController@show');//查看教师（名字）11
    Route::get('showall','Headmaster\teacherController@showall');//查看所有教师11
    Route::post('delete','Headmaster\teacherController@delete');//删除老师11
    Route::post('modify','Headmaster\teacherController@modify');//修改老师11

    Route::get('export','Headmaster\teacherController@export');//exl导出11
    Route::post('import','Headmaster\teacherController@import');//exl导入11

    Route::post('xiangqing','Headmaster\teacherController@xiangqing');//详情 11
    Route::post('showav','Headmaster\teacherController@showav');//计算成绩平均数111
    Route::get('allteacher','Headmaster\teacherController@allteacher');//查看有好多老师11


});//yjx

Route::group(['prefix' => 'speciality','middleware'=>'refresh.token'],function () {
    Route::post('add','Headmaster\specialityController@add');//添加专业11
    Route::post('show','Headmaster\specialityController@show');//查看专业(用名字)11
    Route::get('showall','Headmaster\specialityController@showall');//查看所有专业11
    Route::post('showall2','Headmaster\specialityController@showall2');//补充查看所有专业的人数11
    Route::post('delete','Headmaster\specialityController@delete');//删除专业11
    Route::post('modify','Headmaster\specialityController@modify');//修改专业11

    Route::post('xiangqing1','Headmaster\specialityController@xiangqing1');//详情1   1111
    Route::post('xiangqing2','Headmaster\specialityController@xiangqing2');//详情2 1111
    Route::get('allsp','Headmaster\specialityController@allsp');//查看有好多专业11

});//yjx
