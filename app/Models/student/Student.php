<?php

namespace App\Models\student;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "student";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /***
     * 功能（学生个人中心展示）
     * @return false
     */
    public static function show(){
        try {
     $res1=Student::select('StudentName','StudentAge','StudentSex','SNumber','SFormClass')->get();
            return $res1;
        }catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }

    /***
     * 功能（学生个人成绩展示--科目分数）
     * @param $SNumber
     * @return false
     */

    public static function grade($SNumber){
        try {
            $res = self::join('class','class.id','student.SFormClass')
                ->join('teacher','teacher.class','class.id')
                ->join('subject','subject.id','student.subject')
                ->where('student.SNumber',$SNumber)
                ->select('teacher.TeacherName','grade','subject.SubjectName')
                ->get();
            return $res;
        }catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }

    /***
     * 功能（查找对应科目成绩）
     * @param $SNumber
     * @param $subject_id
     * @return false
     */
    public static function dgrade($SNumber,$subject_id){
        try {
           // $res=self::where('student.id',$id)->select('student.grade','student.subject','subject.SubjectName')
         //   ->leftjoin('subject','student.subject','subject.id')
//      ->leftjoin('teacher','student.subject','teacher.Subject')
          //  ->get();
           // $user1=Student::find($subject);
          //  $res0=$user->self::select('grade')->get();

    //        $res = self::leftjoin('teacher','student.SFormClass','teacher.class')->where('student.SFormClass',$studentclass)->where('teacher.subject',$studentsubject)
     //           ->select('teacher.TeacherName');
            $res = self::join('class','class.id','student.SFormClass')
                ->join('teacher','teacher.class','class.id')
                ->where('student.SNumber',$SNumber)
                ->join('subject','subject.id','student.subject')
                ->where('subject.id',$subject_id)
                ->select('teacher.TeacherName','grade','subject.SubjectName')
                ->get();

            return $res;
        }catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
}
