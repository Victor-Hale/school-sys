<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class speciality extends Model
{
    protected $table = "speciality";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function add ($SpName,$FormCollege){
        try {
            $rr = self::select()->where('SpName', $SpName)->exists();
            if ($rr == false) {

                $res= self::insert([
                    'SpName'=>$SpName,
                    'FormCollege' => $FormCollege
                ]);
            }else{
                return false;
            }
            //dd($res);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('插入不成功', [$e->getMessage()]);
            return false;
        }
    }

    public static function show($SpName){
        try {
            $res =self::select()->
            where('SpName',$SpName)
                ->get();/*value('meme');*/
            //dd($res);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }

    public static function showall(){
        try {
            $res = self::join('college','college.id','=','speciality.FormCollege')
                /*->join('class','class.FormSp','=','speciality.id')*/
            ->select('speciality.id','college.CollegeName','speciality.SpName'/*,'class.Number'*/)
                ->get();

            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到所有失败', [$e->getMessage()]);
            return false;
        }
    }

    public static function showall2($id){
        try {
            $res = self::join('class','class.FormSp','=','speciality.id')
                ->where('class.FormSp',$id)
                ->select('speciality.id','class.Number')
                ->get();

            $res1 = self::join('class','class.FormSp','=','speciality.id')
                ->where('class.FormSp',$id)
                ->select('speciality.id','class.Number')
                ->count();
            $a = 0;
            for($i = 0;$i<$res1;$i++){
                $a = $a+$res[$i]['Number'];
            }
           // dd($a);
            return $a?
                $a:
                false;
        }catch (\Exception $e) {
            logError('得到所有失败', [$e->getMessage()]);
            return false;
        }
    }


    public static function delete1($SpName){
        try {
            //dd($equipment_id);
            $res = self::where('SpName','=',$SpName)->delete();
            return $res ?
                $res :
                false;
        }catch (\Exception $e){
            logError('删除错误', [$e->getMessage()]);
            return false;
        }
    }

    public static function modify( $id,
                                   $SpName,
                                   $FormCollege)
    {
        try {
            $res = self::where('id', '=', $id)->update(
                [
                    'SpName' => $SpName,
                    'FormCollege' => $FormCollege
                ]
            );
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('改变错误', [$e->getMessage()]);
            return false;
        }
    }


    public static function allsp(){
        try {
            $res =self::
                select()
                ->count();

            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }

    public static function xiangqing1($id){
        try {
            $res = self::join('college','college.id','=','speciality.FormCollege')
                ->join('class','class.FormSp','=','speciality.id')
                ->where('class.FormSp',$id)
                ->select('class.id','college.CollegeName','class.ClassName','class.Number')
                ->get();

            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }

    public static function xiangqing2($id){
        try {
            $res = self::join('class','class.FormSp','=','speciality.id')
                ->where('class.FormSp',$id)
                ->join('student','student.SFormClass','=','class.id')
                ->select('StudentName','StudentSex','StudentAge','SNumber')
                ->get();
            //dd($res);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }
}
