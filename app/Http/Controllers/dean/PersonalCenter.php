<?php

namespace App\Http\Controllers\dean;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\UserController;
use App\Http\Requests\deanmodifyCode;
use App\Http\Requests\userstatus;
use App\Models\college;
use App\Models\dean;
use App\Models\user;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class PersonalCenter extends Controller
{
    /*
     *
     * 院长修改密码
     */
   public function modifyCode(deanmodifyCode $request){
       $account= $request['account'];//邮箱
        $code=$request['code'];
        $confirmCode=$request['confirmCode'];
        if($code==$confirmCode) {

            $password = self::userHandle($code);
            $res=user::add($account,$password);
            return $res?
                json_success('修改成功!', $res, 200) :
                json_fail('修改失败!', null, 100);
        }
           return  json_fail('密码不匹配',null,100);

}
/*
 *
 *密码加密
 */
    protected function userHandle($password)   //对密码进行哈希256加密
    {
        $red = bcrypt($password);
        return $red;
    }
    function viewInformation(){

    }
    /*
     * 个人信息
     */
    public function checkOne(userstatus $request){
        $account=$request['account'];//邮箱
        $res=dean::checkOne($account);
        return $res?
            json_success('查询成功!', $res, 200):
            json_fail('查询失败!', null, 100);
    }


    public function checkTwo(Request $request){
        $teacherName=$request['teacherName'];
        $teacherEmail=$request['email'];
        $res=dean::viewClass($teacherEmail);//查询教授班级
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }

    public  static  function  avg(Request $request){
        $subject=$request['subject'];
        $ClassName=$request['ClassName'];
        $res=college::avrage($subject,$ClassName);
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }
}
