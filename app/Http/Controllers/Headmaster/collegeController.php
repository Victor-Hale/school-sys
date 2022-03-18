<?php

namespace App\Http\Controllers\Headmaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\YJX\CollegeRequest1;
use App\Http\Requests\YJX\CollegeRequest2;
use App\Http\Requests\YJX\CollegeRequest3;
use App\Http\Requests\YJX\CollegeRequest4;
use App\Http\Requests\YJX\CollegeRequest5;
use App\Imports\CollegeImport;
use App\Imports\TeacherImport;
use App\Models\college;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;

class collegeController extends Controller
{
    /**yjx
     * 添加学院
     * @param CollegeRequest1 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(CollegeRequest1 $request){
        $CollegeName = $request['CollegeName'];
        $President = $request['President'];
        $res= college::add($CollegeName,$President);
         return $res?
             json_success('操作成功!', $res, 200) :
             json_fail('操作失败!', $res, 100);

    }

    /**yjx
     * 查找学院
     * @param CollegeRequest2 $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function show(CollegeRequest2 $request){
        $CollegeName = $request['CollegeName'];
        $res = college::show($CollegeName);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /**
     * yjx
     * 查找所有学院
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function showall(){
        $res = college::showall();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /**
     * yjx
     * 删除学院
     * @param CollegeRequest2 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(CollegeRequest2 $request)
    {
        $CollegeName = $request['CollegeName'];
        $res = college::delete1($CollegeName);
        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);

    }

    /**
     * yjx
     * 修改学院
     * @param CollegeRequest3 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function modify(CollegeRequest3 $request){
        $id = $request['id'];
        $CollegeName = $request['CollegeName'];
        $President = $request['President'];

        $res = college::modify(
            $id,
            $CollegeName,
            $President
        );
        return $res?
            json_success("操作成功",$res,200):
            json_fail("操作失败",$res,100);

    }

    /**
     * yjx
     * 查看学院详情
     * @param CollegeRequest4 $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function showclass(CollegeRequest4 $request){
        /*$CollegeName = $request['CollegeName'];*/
        $id = $request['id'];
        $res = college::showclass($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /**
     * yjx
     * 导出
     * @return string|\Symfony\Component\HttpFoundation\StreamedResponse
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function export(){

        $d=college::select()->get();
        //dd($d);
        return (new FastExcel($d))->download('模板' . '.xlsx');

    }

    /**
     * yjx
     * 导入
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(Request $request)
    {
        $file = $request['file'];
        $res= Excel::import(new CollegeImport(), $file);
        return $res?
            json_success('导入成功!',null,  200):
            json_fail('导入失败!',null, 100 ) ;
    }

    /**
     * yjx
     * 查看班级男
     * @param CollegeRequest5 $request
     * @return false|int
     */
    public function xclass(CollegeRequest5 $request){
        $id = $request['id'];
        $num = $request['num'];
        //dd($id);
        $res = DB::table('class')->where('class.id','=',$id)
            ->join('student','student.SFormClass','=','class.id')
            ->select('student.StudentSex')->get();
//dd($res);
        $a = json_decode($res,true);

        //dd($a[0]['StudentSex']);
        $boy = 0;
        //$girl = 0;
        for($i = 0;$i<$num;$i++){
            if ($a[$i]['StudentSex'] == "0" ){
                //$girl = $girl+1;
                $boy = $boy+1;
            }
        }

        return $boy ?
            $boy:
            false;
    }

    /**
     * yjx
     * 所有学院数量
     * @return \Illuminate\Http\JsonResponse
     */
    public function allcollege(){
        $res = college::allcollege();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /**
     * yjx
     * 所欲专业数量
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function allsp(Request $request){
        $id = $request['id'];
        $res = college::allsp($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /**
     * yjx
     *所有学生数量
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function allstudent(Request $request){
        $id = $request['id'];
        $res = college::allstudent($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /**
     * yjx
     * 所有教师数量
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function allteacher(Request $request){
        $id = $request['id'];
        $res = college::allteacher($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }


    public function test (Request $request){
        $id = $request['id'];
        $subject_id = $request['subject_id'];
        $res = college::test($id,$subject_id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    public function supmodify(Request $request){
        $id = $request['id'];
        /*$password = $request['password'];*/
        $registeredInfo = $request->except('password_confirmation');
        $password = bcrypt($registeredInfo['password']);

        $res = college::supmodify($id,$password);

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    public function alluser(){
        $res = college::alluser();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }
}
