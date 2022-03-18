<?php

namespace App\Models\teacher;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "user";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
    //教师修改学生分数
    public static function dagain($id,$subject){
        try {
            $user=User::find($id);
            if (!empty($user->self)) {
                $res = $user->self::update([
                    'subject' => $subject['subject']
                ])->get();
                return $res;
            }
            //返回值

        }
        catch (\Exception $e){
            logError('修改失败',[$e->getMessage()]);
            return false;
        }
    }
}
