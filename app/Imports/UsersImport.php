<?php


namespace App\Imports;

use App\Player;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Player([
            'id'          =>$row[0],
            'name'        =>$row[1],
            'address'     =>$row[2],
            'description' =>$row[3],
            'retired'     =>$row[4],
        ]);
    }
}
