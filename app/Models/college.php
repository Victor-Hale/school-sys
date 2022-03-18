<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class college extends Model
{
    //
    protected $table='student';
    public  $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = [];

    //查询指定学生
    public  static  function searchStudent($studentName){
        $res=self::where('StudentName',$studentName)
            ->select('StudentName','StudentSex','StudentAge','SNumber')
            ->distinct('StudentName')
            ->get();
        return $res;
    }

    //修改学生信息(没有邮箱）
    public  static  function modify($studentName, $studentAge, $sex,$id){
        $res=self::where('StudentName',$studentName)->update(
            ['StudentName'=>$studentName,
              'StudentSex'=>$sex,
              'StudentAge'=>$studentAge,
              'SNumber'=>$id
                ]
        );
        return $res;
    }

    //删除学生
    public  static function deleteStudent( $SNumber){
       $res=self::where('SNumber',$SNumber)->delete();
       return $res;
    }

    //学生总数
    public  static  function  studentCount(){
        $res=self::distinct('StudentName')->count();
        return $res;
    }
    //添加学生（没有邮箱）
    public  static  function  studentAdd($studentName, $studentAge, $StudentSex,$SNumber){
        $created_at = now();
        $updated_at = now();
        $res=self::create(['StudentName'=>$studentName,
            'StudentSex'=>$StudentSex,
            'StudentAge'=>$studentAge,
            'SNumber'=>$SNumber,
            'cereated_at'=>now(),
            'updated_at'=>now(),
           'subject'=>-1,
            'grade'=>-1,
            'SFormClass'=>-1
            ]);

        return $res;
    }
    //查看全部学生
    public  static  function  View (){
        $res=self::select('StudentName','StudentSex','StudentAge','SNumber')
            ->distinct('StudentName')
            ->get();
        return $res;
    }
    //查看学生成绩
    public  static  function  studentGrade($SNumber){
        $res=self::where('SNumber',$SNumber)
            ->join('subject','student.subject','subject.id')
            ->join('class','student.SFormClass','class.id')
            ->join('teacher','teacher.class','class.id')
            ->select('SubjectName','grade','TeacherName')
            ->get();
        return $res;
    }

    //学生成绩导出
    public  static function export($SNumber){
        $res=self::where('SNumber',$SNumber)
            ->join('subject','student.subject','subject.id')
            ->join('class','student.SFormClass','class.id')
            ->join('teacher','teacher.class','class.id')
            ->select('SubjectName','grade','TeacherName')
            ->get();
        return $res;
    }
    //教师班级导出
    public static  function  studentexport($ClassName){
        $res=self::join('class','student.SFormClass','class.id')
            ->where('ClassName','专业2_20210')
            ->select('StudentName','StudentSex','StudentAge','SNumber','grade')
        ->get();
        return $res;
    }

    //班级平均成绩查询
    public  static  function  avrage($subject,$ClassName){
        $res=self::join('subject','student.subject','subject.id')
            ->join('class','student.SFormClass','class.id')
            ->join('teacher','teacher.class','class.id')
            ->where([['teacher.subject','=',$subject],['class.ClassName','=',$ClassName]])
            ->avg('grade');
        return $res;
    }




}
