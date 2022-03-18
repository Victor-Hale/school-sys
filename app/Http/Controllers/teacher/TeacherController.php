<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dagain;
use App\Http\Requests\Personal;
use App\Http\Requests\Tdgrade;
use App\Http\Requests\Tgrade;
use App\Models\teacher\Student;
use App\Models\teacher\Teacher;
use App\Models\teacher\User;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class TeacherController extends Controller
{
    /***
     * 功能（查看教师个人中心---不含平均分数）
     * @param Personal $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function personal(Personal $request){
        $id=$request['id'];
        $class=$request['class'];
        $subject=$request['subject'];
        $res0 =Teacher::show();//转到model
        $res1 =Student::show($id);//转到model
        $res[0]=$res0;
        $res[1]=$res1;
        return $res?
            json_success('查询成功！',$res,200):
            json_fail('查询失败',null,100);
    }

    /***
     * 功能（修改学生成绩）
     * @param Dagain $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dagain(Dagain $request){
        $snumber=$request['snumber'];
        $subject=$request['subject'];
        $grade = $request['grade'];
        $res = Student::dagain( $snumber,$subject,$grade);//转到model
        return $res?   //判断
            json_success("修改成功",$res,200):
            json_fail("修改失败",$res,100);
    }
    /***
     * 功能（查看指定学生成绩）
     * @param Tdgrade $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dgrade(Tdgrade $request){
        $StudentName=$request['StudentName'];
        $SFormClass=$request['SFormClass'];
        $res = Student::dgrade($StudentName,$SFormClass);//转到model
        return $res?   //判断
            json_success("查看成功",$res,200):
            json_fail("查看失败",$res,100);
    }

    /***
     * 功能（班级成绩展示）
     * @param Tgrade $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function grade(Tgrade $request){
        $SFormClass=$request['SFormClass'];
        $subject=$request['subject'];
        $res =Student::grade($SFormClass,$subject);//转到model
        return $res?
            json_success('查询成功！',$res,200):
            json_fail('查询失败',null,100);
    }
}
