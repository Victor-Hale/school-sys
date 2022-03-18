<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class dean extends Model
{
    protected $table='teacher';
    public  $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [];



    public  static  function  checkOne($account){
        try {
        $res=self::join('user','TeacherEmail','account')
            ->where('TeacherEmail',$account)
            ->select("TeacherName","TeacherAge","Title","TeacherSex", "TeacherEmail", "TeacherPhone","Subject",
                "ifPresident",
                "class",
                "TFormCollege",
                "TFormS")->get();
        return $res;
    }      catch (\Exception $e){
            logError('添加失败',[$e->getMessage()]);
            return false;
        }
    }

    public  static  function modify($id,$password){
        $res=self::where('id',$id)->update(
            ['Password'=>$password]
        );
        return $res;
    }

    static  function  checkAll( ){
        $res=self::all('TeacherName','Subject','class','TeacherEmail');
        return $res;
    }

    static  function  teacherCount(){
        $res=self::count();
        return $res;
    }

    public static  function  checkDetails($teacherEmail ){
        $res=self::where(
                'TeacherEmail','=',$teacherEmail
        )->select("TeacherName","TeacherAge","Title","TeacherSex", "TeacherEmail", "TeacherPhone","Subject",
            "ifPresident",
            "class",
            "TFormCollege",
            "TFormS")->get();
        return $res;
    }

    public static  function viewClass($teacherEmail){
        $res=self::where(
            'TeacherEmail','=',$teacherEmail)
            ->join('class','teacher.class','class.id')
            ->select(
            "ClassName")->get();
        return $res;
    }

    static function modifyTeacher($TeacherEmail,$oldclass,$newclass){
        $res=self::where([['TeacherEmail',$TeacherEmail],['class',$oldclass]])->update([
             'class'=>$newclass
        ]);
        return  $res;
    }

    static  function  class($teacherEmail  ){
        $res=self::where('TeacherEmail',$teacherEmail)
            ->join('class','teacher.class','class.id')
            ->join('student','class.id','student.SFormClass')
           ->groupby('ClassName')
           // ->select('ClassName','grade')
            ->sum('grade');
          //->get();
        return $res;
    }

   public static  function  class1($teacherEmail ,$subject ){
        $res=self::where('TeacherEmail',$teacherEmail)->join('class','class','FormSp')
            ->join('student','FormSp','SFormClass')->
            select('ClassName')->get();
        return $res;
    }

    public static function teachClass($teacherEmail){
        $res=self::where('TeacherEmail',$teacherEmail)->join('class','teacher.class','class.id')->select('ClassName')->get();
        return $res;
    }

    //查询指定教师
    public  static  function searchTeacher($teacherName){
        $res=self::where('TeacherName',$teacherName)->get();
        return $res;
    }
}
