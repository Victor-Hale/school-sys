<?php

namespace App\Models\student;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = "subject";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
//学生个人成绩展示--科目
    public static function grade($subject){
        try {
            $user=User::find($subject);
            $res1=$user->self::select('SubjectName')->get();
            return $res1;
        }catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
    public static function doagain($request,$subject){
        try {
            $user=User::find($subject);
            $res=$user->Student::select('$request')->get();
            return $res;
        }
        catch (\Exception $e){
            logError('修改失败',[$e->getMessage()]);
            return false;
        }
    }
}
