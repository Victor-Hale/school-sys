<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class spciality extends Model
{
    //

    protected $table='speciality';
    public  $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [];


    //专业总数
    public static  function  spcount(){
        $res=self::count('id');
        return $res;
    }

    //学院专业人数
    public  static  function  num($speciality){
        $res=self::join('class','speciality.id','class.FormSp')
            ->where('SpName','=',$speciality)
            ->sum('class.Number');
        return  $res;
    }

    //开设班级数
    public  static  function  classnum($speciality){
        $res=self::join('class','speciality.id','class.FormSp')
            ->where('SpName','=',$speciality)
            ->count('class.ClassName');
        return  $res;
    }
    public  static  function  name(){
        $res=self::all('SpName');
        return  $res;
    }
}
