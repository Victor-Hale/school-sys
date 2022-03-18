<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class DeanImport implements ToCollection
{
    /**
     * 使用 ToCollection
     * @param array $row
     *
     * @
     */
    public function collection(Collection $rows)
    {
       // $login_id = auth('api')->user()->id;
        foreach ($rows as $key => $value)
        {
            $created_at = now();
            $updated_at = now();
            DB::table('student')->insert([
                //  'id'=> $value[0],
                'StudentName'=>$value[1],
                'StudentSex'=>$value[2],
                'StudentAge'=>$value[3],
                'SNumber'=>$value[4],
                'SFormClass'=>$value[5],
                'subject'=>$value[6],
                'grade'=>$value[7],
                'cereated_at'=>$created_at,
                'updated_at'=>$updated_at,

            ]);
        }
    }
    public function createData($rows)
    {
        //todo
    }
}
