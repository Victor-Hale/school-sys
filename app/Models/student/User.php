<?php

namespace App\Models\student;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "user";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
    //学生个人中心展示
    public static function show(){
        try {
            $res1=Student::select('Email')->get();
            return $res1;
        }catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
}
