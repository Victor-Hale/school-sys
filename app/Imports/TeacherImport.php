<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class TeacherImport implements ToCollection
{
    /**
     * 使用 ToCollection
     * @param array $row
     *
     * @
     */
    public function collection(Collection $rows)
    {
        //$login_id = auth('api')->user()->id;
        foreach ($rows as $key => $value)
        {
            $created_at = now();
            $updated_at = now();
            DB::table('teacher')->insert([
                //  'id'=> $value[0],
                'TeacherName'=>$value[0],
                //    'prclass'=>$value[1],
                'TeacherAge'=>$value[1],
                'Title'=>$value[2],
                'TeacherSex'=>$value[3],
                'TeacherEmail'=>$value[4],
                'TeacherPhone'=>$value[5],
                'Subject'=>$value[6],
                'ifPresident'=>$value[7],
                'class'=>$value[8],
                'TFormCollege'=>$value[9],
                'TFormS'=>$value[10],
                'created_at'=>$created_at,
                'updated_at'=>$updated_at,
                /*'login_id' =>$login_id,*/
            ]);
        }
    }
    public function createData($rows)
    {
        //todo
    }
}
