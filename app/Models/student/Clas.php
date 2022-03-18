<?php

namespace App\Models\student;

use Illuminate\Database\Eloquent\Model;

class Clas extends Model
{
    protected $table = "class";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /***
     * 功能（学生个人中心展示）
     * @return false
     */
    public  static  function show(){
        try {
            $res1=Student::select('FormCollege')->get();
            return $res1;
        }catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
    //学生个人成绩展示--对应教师
    public static function grade($id){
        try {
            $user=User::find($id);
            $res1=$user->self::select('teacher')->get();
            return $res1;
        }catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
}
