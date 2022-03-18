<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dgrade;
use App\Http\Requests\Grade;
use App\Http\Requests\pdp;
use App\Models\student\Clas;
use App\Models\student\Student;
use App\Models\student\Subject;
use App\Models\student\Teacher;
use App\Models\student\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class StudentController extends Controller
{
    /**
     * 功能（查看学生个人中心）
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function personal(){
        $res1 =Student::show();//转到model
        $res2 =Clas::show();//转到model
        $res[0]=$res1;
        $res[1]=$res2;
        return $res?
            json_success('查询成功！',$res,200):
            json_fail('查询失败',null,100);
    }


    /***
     * 功能：（查看个人成绩）
     * @param Request $request
     *
     */
    public function grade(Grade $request){
        $SNumber = $request['SNumber'];
        $res0 =Student::grade($SNumber);//转到model
        return $res0?
            json_success('查询成功！',$res0,200):
            json_fail('查询失败',null,100);
    }

    /***
     * 功能（根据科目查看对应成绩）
     * @param Dgrade $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dgrade(Dgrade $request){
        $SNumber = $request['SNumber'];
        $subject_id=$request['subject_id'];
        $res =Student::dgrade($SNumber,$subject_id);//转到model
      //  $res1 =subject::dgrade( $subject);//转到model
      //  $res2 =teacher::dgrade( $subject);//转到model
//        $res[0]=$res0;
//        $res[1]=$res1;
//        $res[2]=$res2;
        return $res?
            json_success('查询成功！',$res,200):
            json_fail('查询失败',null,100);
    }
}
