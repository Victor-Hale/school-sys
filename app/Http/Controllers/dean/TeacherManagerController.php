<?php

namespace App\Http\Controllers\dean;

use App\Http\Controllers\Controller;
use App\Http\Requests\teachermodify;
use App\Http\Requests\teachersearch;
use App\Models\college;
use App\Models\dean;
use App\Models\teacher;
use Illuminate\Http\Request;

class TeacherManagerController extends Controller
{
    /*
     * 教师信息
     */
    function  viewTeacherInformation(){
        $res=dean::checkAll();
        //教师人数
         $count=dean::teacherCount();
        return $res ?
            json_success('查询成功!', [$res,$count], 200) :
            json_fail('查询失败!', null, 100);
    }

    //教师详情
  public function teacherDetails(Request $request){

        $teacherEmail=$request['email'];
      $res=dean::checkDetails($teacherEmail);//教师信息


       return $res ?
           json_success('查询成功!', $res, 200) :
           json_fail('查询失败!', null, 100);
   }

   //查看教授班级
    public function teachClass(Request $request){
        $teacherName=$request['teacherName'];
        $teacherEmail=$request['email'];
        $res=dean::viewClass($teacherEmail);//查询教授班级
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }

   //班级分数平均值
   public  static  function  avg(Request $request){
        $subject=$request['subject'];
        $ClassName=$request['ClassName'];
        $res=college::avrage($subject,$ClassName);
       return $res ?
           json_success('查询成功!', $res, 200) :
           json_fail('查询失败!', null, 100);
   }

   public function teacherModify(teachermodify $request){
        $TeacherEmail=$request['teacheremail'];
        $oldclass=$request['oldclass'];
        $newclass=$request['newclass'];
       $res=dean::modifyTeacher($TeacherEmail,$oldclass,$newclass);
       return $res ?
           json_success('修改成功!', $res, 200) :
           json_fail('修改失败!', null, 100);
   }

   //查看教师教授班级
   function viewClass(Request $request){
        $email=$request['email'];
       $res=dean::teachClass($email);

         return $res ?
             json_success('查询成功!', $res, 200) :
             json_fail('查询失败!', null, 100);
   }
   //查询指定教师
    public  function  search(teachersearch $request){
        $teacherName=$request['teachername'];
      $res=dean::searchTeacher($teacherName);
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }
}
