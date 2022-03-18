<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    protected $table = "teacher";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /**
     * yjx
     * 添加教师
     * @param $TeacherName
     * @param $TeacherAge
     * @param $Title
     * @param $TeacherSex
     * @param $TeacherEmail
     * @param $TeacherPhone
     * @param $Subject
     * @param $ifPresident
     * @param $class
     * @param $TFormCollege
     * @param $TFormS
     * @return false
     */
    public static function add ($TeacherName,
                                $TeacherAge,
                                $Title,
                                $TeacherSex,
                                $TeacherEmail,
                                $TeacherPhone,
                                $Subject,
                                $ifPresident,
                                $class,
                                $TFormCollege,
                                $TFormS){
        try {
            $rr = self::select()->where('TeacherName', $TeacherName)->
            where('class',$class)->exists();
            if ($rr == false) {
                $res= self::insert([
                    'TeacherName'=>$TeacherName,
                    'TeacherAge' => $TeacherAge,
                    'Title'=>$Title,
                    'TeacherSex' => $TeacherSex,
                    'TeacherEmail'=>$TeacherEmail,
                    'TeacherPhone' => $TeacherPhone,
                    'Subject'=>$Subject,
                    'ifPresident' => $ifPresident,
                    'class' =>$class,
                    'TFormCollege'=>$TFormCollege,
                    'TFormS' => $TFormS
                ]);
            }else{
                return false;
            }
            //dd($res);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('插入不成功', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * yjx
     * 查找教师
     * @param $TeacherName
     * @return false
     */
    public static function show($TeacherName){
        try {
            $res =self::select()->
            where('TeacherName',$TeacherName)
                ->get();/*value('meme');*/
            //dd($res);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * yjx
     * 查找所有教师
     * @return false
     */
    public static function showall(){
        try {
            $res = self::select()
                ->get();
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到所有失败', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * yjx
     * 删除教师
     * @param $TeacherName
     * @param $class
     * @return false
     */
    public static function delete1($TeacherName,$class){
        try {
            //dd($equipment_id);
            $res = self::where('TeacherName','=',$TeacherName)->
            where('class','=',$class)->delete();
            return $res ?
                $res :
                false;
        }catch (\Exception $e){
            logError('删除错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * yjx
     * 修改教师
     * @param $id
     * @param $TeacherName
     * @param $TeacherAge
     * @param $Title
     * @param $TeacherSex
     * @param $TeacherEmail
     * @param $TeacherPhone
     * @param $Subject
     * @param $ifPresident
     * @param $class
     * @param $TFormCollege
     * @param $TFormS
     * @return false
     */
    public static function modify( $id,
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
                                   $TFormS){
        try {
            $res = self::where('id','=',$id)->update(
                [
                    'TeacherName'=>$TeacherName,
                    'TeacherAge' => $TeacherAge,
                    'Title'=>$Title,
                    'TeacherSex' => $TeacherSex,
                    'TeacherEmail'=>$TeacherEmail,
                    'TeacherPhone' => $TeacherPhone,
                    'Subject'=>$Subject,
                    'ifPresident' => $ifPresident,
                    'class' =>$class,
                    'TFormCollege'=>$TFormCollege,
                    'TFormS' => $TFormS
                ]
            );
            return $res?
                $res:
                false;
        }catch (\Exception $e ){
            logError('改变错误', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * yjx
     * 教师详情
     * @param $id
     * @return false
     */
    public static function xiangqing($id){
        try {
            $res =self::where('id',$id)
                ->select()
                ->get();

            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * yjx
     * 算平均成绩
     * @param $subject
     * @param $id
     * @param $num
     * @return false|float
     */
    public static function showav($subject,$id,$num){
        try {

            $res =self::where('teacher.id','=',$id)->
            join('student','student.SFormClass','=','teacher.class')
                ->join('class','class.id','=','student.SFormClass')
                ->join('subject','subject.id','=','student.subject')
                ->select('class.ClassName','grade')
                ->get();/*value('meme');*/
//dd($res);
            $a = json_decode($res,true);
            //dd($a);
            $re = 0;
            for($i = 0;$i<$num;$i++){
                $re = $re+$a[$i]['grade'];
            }
            $re = $re/$num;
            $re = round($re,2);
            //dd($re);
            return $re?
                $re:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * yjx
     * 算要显示的教师总数
     * @return false
     */
    public static function allteacher(){
        try {
            $res =self::
                select()
                ->count();

            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }
}
