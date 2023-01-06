<?php
  
namespace App\Imports;
  
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
  
class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        date_default_timezone_set('Asia/Manila');

        return new User([
            'name' => $row['name'],
            'barangay' => $row['barangay'],
            'usertype' => $row['usertype'],
            'username' => $row['username'],
            'password' => bcrypt(($row['password'])),
            'status' => $row['status'],
            'image' => $row['image'],
            'online' => $row['online'],
        ]);
    }
}