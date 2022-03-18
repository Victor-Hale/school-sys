<?php

namespace App\Models;

use App\Http\Controllers\Headmaster\Users\UserController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class college extends Model
{
    protected $table = "college";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /**
     * yjx
     * 添加
     * @param $CollegeName
     * @param $President
     * @return false
     */
    public static function add ($CollegeName,$President){
        try {
            $rr = self::select()->where('CollegeName', $CollegeName)->exists();
            if ($rr == false) {

                $res= self::create([
                    'CollegeName'=>$CollegeName,
                    'President' => $President
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

    /**
     * yjx
     * 查找
     * @param $CollegeName
     * @return false
     */
    public static function show($CollegeName){
        try {
            $res =self::select()->
            where('CollegeName',$CollegeName)
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

    /**
     * yjx
     * 查找所有
     * @return false
     *
     */
    public static function showall(){
        try {
            $res = self::select()
                ->get();
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到所有失败', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * yjx
     * 删除
     * @param $CollegeName
     * @return false
     */
    public static function delete1($CollegeName){
        try {
            //dd($equipment_id);
            $res = self::where('CollegeName','=',$CollegeName)->delete();
            return $res ?
                $res :
                false;
        }catch (\Exception $e){
            logError('删除错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * yjx
     * 修改
     * @param $id
     * @param $CollegeName
     * @param $President
     * @return false
     */
    public static function modify( $id,
                                   $CollegeName,
                                   $President){
        try {

            $a = self::where('id',$id)->value('President');///原来院长的名字

            $a_a = DB::table('teacher')->where('TeacherName',$a)->value('TeacherEmail');///被更改院长的账号


            $res = self::where('id','=',$id)->update(
                [
                    'CollegeName'=>$CollegeName,
                    'President' =>$President
                ]
            );


            $a_b = DB::table('teacher')->where('TeacherName',$President)->value('TeacherEmail');///现在院长的账号
            //dd($a_a);
            $b = DB::table('user')->where('user.account',$a_b)->update(
                [
                    'Level' => 2
                ]
            );


            $c = $b = DB::table('user')->where('user.account',$a_a)->update(
                [
                    'Level' => 1
                ]
            );

            return $res?
                $res:
                false;
        }catch (\Exception $e ){
            logError('改变错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * yjx
     * 详细
     * @param $CollegeName
     * @param $id
     * @return false
     */
    public static function showclass($id){
        try {
            $res =self::where('college.id','=',$id)->
            join('speciality','speciality.FormCollege','=','college.id')
                ->join('class','class.FormSp','=','speciality.id')
                ->select('class.ClassName','class.Number')
                ->get();/*value('meme');*/
            //dd($res);
          /*  $a = json_decode($res,true);
            dd($a[0]['Number']);*/
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * yjx
     * 所有学院数量
     * @return false
     *
     */
    public static function allcollege(){
        try {
            $res =self::select()->count();
               // get();/*value('meme');*/
            //dd($res);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * yjx
     * 专业数量
     * @param $id
     * @return false
     *
     */
    public static function allsp($id){
        try {
            $res =self::join('speciality','speciality.FormCollege','=','college.id')
                ->where('speciality.FormCollege',$id)
                ->select('SpName')
                ->count();

            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * yjx
     * 学生数量
     * @param $id
     * @return false|int|mixed
     */
    public static function allstudent($id){
        try {
            $res =self::join('speciality','speciality.FormCollege','=','college.id')
                ->where('speciality.FormCollege',$id)
                ->join('class','class.FormSp','=','speciality.id')
                ->select('class.Number')
                ->get();

            $res1 =self::join('speciality','speciality.FormCollege','=','college.id')
                ->where('speciality.FormCollege',$id)
                ->join('class','class.FormSp','=','speciality.id')
                ->select('class.Number')
                ->count();

            $a = json_decode($res,true);
            //dd($a);
            $re = 0;
            for($i = 0;$i<$res1;$i++){
                $re = $re+$a[$i]['Number'];
            }
           // dd($re);
            return $re?
                $re:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * yjx
     * 教师数量
     * @param $id
     * @return false
     */
    public static function allteacher($id){
        try {
            $res =self::join('teacher','teacher.TFormCollege','=','college.id')
                ->where('teacher.TFormCollege',$id)
                ->count();

            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }

    public static function test($id,$subject_id){
        try {
              $res = DB::table('student')->join('class','class.id','student.SFormClass')
                  ->join('teacher','teacher.class','class.id')
                  ->where('student.id',$id)
                  ->join('subject','subject.id','student.subject')
                  ->where('subject.id',$subject_id)
                  ->select('StudentName','grade')
                  ->get();
dd($res);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }

    public static function supmodify($id,$password){
        try {

            $res = DB::table('user')
                ->where('id',$id)
                ->update([
               'password' =>$password
            ]);

            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('xiugai失败', [$e->getMessage()]);
            return false;
        }
    }

    public static function alluser(){
        try {
            $res =DB::table('user')
                ->select()->get();
            dd($res);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }
=======
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
