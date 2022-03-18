<?php

namespace App\Models\student;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = "teacher";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
    //学生个人成绩展示--教师
    public static function grade($subject){
        try {
            $user=User::find($subject);
            $res2=$user->self::select('TeacherName')->get();
            return $res2;
        }catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
}
