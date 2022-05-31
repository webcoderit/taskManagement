<?php

namespace App\Imports;

use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class ImportUser implements ToModel,SkipsOnError, WithHeadingRow, WithValidation
{
    use Importable, SkipsErrors;
    /**
     * @param array $row
     *
     * @return Task|null
     */
    public function model(array $row)
    {
        //dd($row);
        $request = request()->user_id;
        //dd($request);
        $task = new Task([
            'user_id'       => $request,
            'name'          => $row['name'],
            'email'         => $row['email'],
            'fb_id'         => $row['fb_id'],
            'address'       => $row['address'],
            'device'        => $row['device'],
            'phone'         => $row['phone'],
            'profession'    => $row['profession'],
        ]);
        //dd($task);
        return $task;
    }

    public function rules() : array
    {
        return [
            'phone' => 'unique:tasks,phone'
        ];
    }
}
