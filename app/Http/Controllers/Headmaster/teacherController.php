<?php

namespace App\Http\Controllers\Headmaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\YJX\TeahcerRequest1;
use App\Http\Requests\YJX\TeahcerRequest2;
use App\Http\Requests\YJX\TeahcerRequest3;
use App\Http\Requests\YJX\TeahcerRequest4;
use App\Http\Requests\YJX\TeahcerRequest5;
use App\Imports\TeacherImport;
use App\Models\teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;


class teacherController extends Controller
{

    /**
     * yjx
     * 添加教师
     * @param TeahcerRequest1 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(TeahcerRequest1 $request){
       $TeacherName = $request['TeacherName'];
       $TeacherAge = $request['TeacherAge'];
       $Title = $request['Title'];
       $TeacherSex = $request['TeacherSex'];
       $TeacherEmail = $request['TeacherEmail'];
       $TeacherPhone = $request['TeacherPhone'];
       $Subject = $request['Subject'];
       $ifPresident = $request['ifPresident'];
       $class = $request['class'];
       $TFormCollege = $request['TFormCollege'];
       $TFormS = $request['TFormS'];

        $res= teacher::add($TeacherName,
            $TeacherAge,
            $Title,
            $TeacherSex,
            $TeacherEmail,
            $TeacherPhone,
            $Subject,
            $ifPresident,
            $class,
            $TFormCollege,
            $TFormS);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /***
     * yjx
     * 查找教师
     * @param TeahcerRequest2 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(TeahcerRequest2 $request){
        $TeacherName = $request['TeacherName'];
        $res = teacher::show($TeacherName);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /**
     * yjx
     * 查找所有教师
     * @return \Illuminate\Http\JsonResponse
     */
    public function showall(){
        $res = teacher::showall();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /**
     * yjx
     * 删除教师
     *
     * @param TeahcerRequest3 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(TeahcerRequest3 $request)
    {
        $TeacherName = $request['TeacherName'];
        $class = $request['class'];
        $res = teacher::delete1($TeacherName,$class);
        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);

    }

    /**
     * yjx
     * 修改教师
     * @param TeahcerRequest1 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function modify(TeahcerRequest1 $request){
        $id = $request['id'];
        $TeacherName = $request['TeacherName'];
        $TeacherAge = $request['TeacherAge'];
        $Title = $request['Title'];
        $TeacherSex = $request['TeacherSex'];
        $TeacherEmail = $request['TeacherEmail'];
        $TeacherPhone = $request['TeacherPhone'];
        $Subject = $request['Subject'];
        $ifPresident = $request['ifPresident'];
        $class = $request['class'];
        $TFormCollege = $request['TFormCollege'];
        $TFormS = $request['TFormS'];

        $res = teacher::modify(
            $id,
            $TeacherName,
            $TeacherAge,
            $Title,
            $TeacherSex,
            $TeacherEmail,
            $TeacherPhone,
            $Subject,
            $ifPresident,
            $class,
            $TFormCollege,
            $TFormS
        );
        return $res?
            json_success("操作成功",$res,200):
            json_fail("操作失败",$res,100);

    }

    /**
     * yjx
     * 教师详情
     * @param TeahcerRequest4 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function xiangqing (TeahcerRequest4 $request){

        $id = $request['id'];

        $res = teacher::xiangqing($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /**
     * yjx
     * 算平均成绩
     * @param TeahcerRequest5 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showav(TeahcerRequest5 $request){
        $subject = $request['subject'];
        $id = $request['id'];
        $num = $request['num'];
        $res = teacher::showav($subject,$id,$num);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /**
     * yjx
     * 导chu
     * @return string|\Symfony\Component\HttpFoundation\StreamedResponse
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function export(){

        $d=teacher::select()->get();
        //dd($d);
        return (new FastExcel($d))->download('模板' . '.xlsx');

    }

    /**
     * yjx
     * 导ru
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(Request $request)
    {
        $file = $request['file'];
        $res= Excel::import(new TeacherImport(), $file);
        return $res?
            json_success('导入成功!',null,  200):
            json_fail('导入失败!',null, 100 ) ;
    }

    /**
     * yjx
     * 显示的所有教师
     * @return \Illuminate\Http\JsonResponse
     */
    public function allteacher(){

        $res = teacher::allteacher();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }



}
