<?php

namespace App\Http\Controllers\Headmaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\YJX\SpecialityRequest1;
use App\Http\Requests\YJX\SpecialityRequest2;
use App\Http\Requests\YJX\SpecialityRequest3;
use App\Http\Requests\YJX\SpecialityRequest4;
use App\Models\speciality;
use Illuminate\Http\Request;

class specialityController extends Controller
{
    /**
     * yjx
     * 添加专业
     * @param SpecialityRequest1 $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function add(SpecialityRequest1 $request){
        $SpName = $request['SpName'];
        $FormCollege = $request['FormCollege'];

        $res= speciality::add($SpName,$FormCollege);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /**
     * yjx
     * 查找专业
     * @param SpecialityRequest2 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(SpecialityRequest2 $request){
        $SpName = $request['SpName'];
        $res = speciality::show($SpName);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /**
     * yjx
     * 查找所有专业
     * @return \Illuminate\Http\JsonResponse
     */
    public function showall(){
        $res = speciality::showall();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /**
     * yjx
     * 对showall的补充
     *
     * @param SpecialityRequest3 $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function showall2(SpecialityRequest3 $request){
        $id = $request['id'];
        $res = speciality::showall2($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /**
     * yjx
     * 删除
     * @param SpecialityRequest2 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(SpecialityRequest2 $request)
    {
        $SpName = $request['SpName'];
        $res = speciality::delete1($SpName);
        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);

    }

    /**
     * yjx
     * 修改专业
     * @param SpecialityRequest4 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function modify(SpecialityRequest4  $request){
        $id = $request['id'];
        $SpName = $request['SpName'];
        $FormCollege = $request['FormCollege'];

        $res = speciality::modify(
            $id,
            $SpName,
            $FormCollege
        );
        return $res?
            json_success("操作成功",$res,200):
            json_fail("操作失败",$res,100);

    }

    /**
     * yjx
     * 所有专业数量
     * @return \Illuminate\Http\JsonResponse
     */
    public function allsp(){

        $res = speciality::allsp();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /**
     * yjx
     * 详情1
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function xiangqing1(Request $request){
        $id =$request['id'];//专业id

        $res = speciality::xiangqing1($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /**
     * yjx
     *详情2
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function xiangqing2(Request $request){
        $id =$request['id'];//班级id

        $res = speciality::xiangqing2($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

}
