<?php

namespace App\Imports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\ToModel;

class TaskImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $request = request()->all();
        return new Task([
            'user_id'       => $request['user_id'],
            'name'          => $row[1],
            'email'         => $row[2],
            'fb_id'         => $row[3],
            'address'       => $row[4],
            'device'        => $row[5],
            'phone'         => $row[6],
            'profession'    => $row[7],
        ]);
    }
}
