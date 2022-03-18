<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{

    protected $table = 'user';
    protected $guarded = [];
    protected $fillable = [ 'Password','Account','Email','Level'];
    public  $timestamps=false;
    protected $hidden = [
        'password',
    ];
    static function  add($account,$password){
        $res= user::where('Account',$account)->update([
            'Password'=> $password  ,
        ]);
        return $res;

    }
    //邮箱链接状态改变
    public  static function  change($account){
        $res=self::where('account',$account)
            ->update(
                ['change'=>1
            ]);
        return $res;
    }
}
