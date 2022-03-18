<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class CollegeImport implements ToCollection
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
            DB::table('college')->insert([
                //  'id'=> $value[0],
                'CollegeName'=>$value[0],
                //    'prclass'=>$value[1],
                'President'=>$value[1],
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
