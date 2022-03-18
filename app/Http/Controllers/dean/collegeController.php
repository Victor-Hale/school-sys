<?php

namespace App\Http\Controllers\dean;

use App\Http\Controllers\Controller;
use App\Http\Requests\grade;
use App\Http\Requests\studentadd;
use App\Http\Requests\studentmodify;
use App\Http\Requests\studentname;
use App\Models\college;
use App\Models\spciality;
use Illuminate\Http\Request;

class collegeController extends Controller
{
    //搜索指定学生
    public  function  search(studentname $request){
        $studentName=$request['studentname'];
        $res=college::searchStudent($studentName);
           return $res ?
               json_success('查询成功!', $res, 200) :
               json_fail('查询失败!', null, 100);
    }

    public  function  modify(studentmodify $request){
        $studentName=$request['studentname'];
        $studentAge=$request['age'];
        $sex=$request['sex'];
        $id=$request['id'];
        $res=college::modify( $studentName, $studentAge, $sex,$id);
        return $res ?
            json_success('修改成功!', $res, 200) :
            json_fail('修改失败!', null, 100);
    }

    //返回学生总人数
    public  function  count(){
        $res=college::studentCount();
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }
    //删除学生
    public  function  delete(Request $request){
        $SNumber=$request['SNumber'];
        $res=college::deleteStudent($SNumber);
        return $res ?
            json_success('删除成功!', $res, 200) :
            json_fail('删除失败!', null, 100);
    }

    //添加学生
    public  function  add(studentadd $request){
        $studentName=$request['studentname'];
        $studentAge=$request['age'];
        $StudentSex=$request['sex'];
        $SNumber=$request['id'];

        $res=college::studentAdd($studentName, $studentAge, $StudentSex,$SNumber);
        return $res ?
            json_success('添加成功!', $res, 200) :
            json_fail('添加失败!', null, 100);
    }
    public function  view(){
        $res=college::View();
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }
    public  function grade(grade $request){
        $SNumber=$request['SNumber'];
        $res=college::studentGrade($SNumber);
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }
    //学院专业人数
    public  function  speciality(Request $request){
        $speciality=$request['SpName'];
         $res=spciality::num($speciality);
         return $res ?
             json_success('查询成功!', $res, 200) :
             json_fail('查询失败!', null, 100);
    }

    //专业总数
    public function  spcount(){
        $res=spciality::spcount();
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }

    //班级总数
    public function  classcount(Request $request){
        $speciality=$request['SpName'];
        $res=spciality::classnum( $speciality);

        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }
    //专业名字
    public function name (){

        $res=spciality::name();

        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }
}
