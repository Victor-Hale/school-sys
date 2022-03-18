<?php

namespace App\Models\teacher;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "student";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /***
     * 功能（教师个人信息展示--不含平均成绩）
     * @param $id
     * @return false
     */
    public static function show($id){
        try {
            $user0=self::find($id);
            $res=$user0->self::select('SFormClass')->get();
            return $res;
        }catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }

    /***
     * 功能（班级成绩显示）
     * @param $SFormClass
     * @param $subject
     * @return false
     */
    public static function grade($SFormClass,$subject){
        try {
            $user=self::find($SFormClass);
            $res=$user->self::select('StudentName','StudentSex','StudentAge','SNumber','$grade')->get();
            return $res;
        }catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }

    /***
     * 功能（查看指定学生成绩）
     * @param $StudentName
     * @param $SFormClass
     * @return false
     */
    public static function dgrade($StudentName,$SFormClass){
        try {
            $res=self::select('SFormClass','StudentName','StudentSex','StudentAge','SNumber','grade')->where('StudentName',$StudentName)->where('SFormClass',$SFormClass)->get();
            return $res;
        }catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }

    /***
     * 功能（修改学生成绩）
     * @param $snumber
     * @param $subject
     * @param $grade
     * @return false
     */
    public static function dagain( $snumber,$subject,$grade){
        try {
          $res=self::where('SNumber','=',$snumber)->where('subject','=',$subject)->update([
            'grade' => $grade
          ]);
            return $res;
        }catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }

}
