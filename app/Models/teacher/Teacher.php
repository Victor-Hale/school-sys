<?php

namespace App\Models\teacher;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = "teacher";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /***
     * 功能（教师个人信息展示）
     * @return false
     */
    public static function show(){
        try {
            $res0=self::select('TeacherName','TeacherAge','TeacherSex','TeacherPhone','TeacherEmail','TFormCollege','Subject','ifPresident')->get();
            return $res0;
        }catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
}
