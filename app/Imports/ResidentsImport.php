<?php

namespace App\Imports;

use App\Models\Resident;
use App\Models\Barangay;
use App\Models\ResidentSector;
use App\Models\Sector;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ResidentsImport implements ToModel, WithHeadingRow, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        date_default_timezone_set('Asia/Manila');

        $date = intval($row['birthday']);
        $formatted_birthday = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)->format('Y/m/d');

        $get = Barangay::where('barangay', $row['barangay'])->first();
        
        if(!empty($date))
        {
            if(!Resident::where('firstname', '=', $row['firstname'])->where('lastname', '=', $row['lastname'])->where('birth_date', '=', $formatted_birthday)->first())
            {
                    $create = Resident::firstOrCreate([
                        'household_no' => trim($row['household_no']),
                        'firstname' => trim(strtoupper($row['firstname'])),
                        'middlename' => trim(strtoupper($row['middlename'])),
                        'lastname' => trim(strtoupper($row['lastname'])),
                        'suffix' => trim(ucfirst($row['suffix'])),
                        'birth_date' => $formatted_birthday,
                        'gender' => trim(strtoupper($row['sex'])),
                        'phone_number' => trim($row['contact']),
                        'sitio' => trim(ucfirst($row['sitio'])),
                        'barangay_id' => $get->id,
                    ]);

                    if($create)
                    {
                        if($row['family_head'] == '1')
                        {
                            $look_id = Resident::where('firstname', '=', $row['firstname'])->where('lastname', '=', $row['lastname'])->where('birth_date', '=', $formatted_birthday)->first();
                            $res_sec = [
                                'resident_id' => $look_id->id,
                                'sector_id' => '20220001',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                            DB::table('resident_sectors')->insert($res_sec);
                        }
    
                        if($row['farmer'] == '1')
                        {
                            $look_id = Resident::where('firstname', '=', $row['firstname'])->where('lastname', '=', $row['lastname'])->where('birth_date', '=', $formatted_birthday)->first();
                            $res_sec = [
                                'resident_id' => $look_id->id,
                                'sector_id' => '20220002',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                            DB::table('resident_sectors')->insert($res_sec);
                        }
    
                        if($row['household_head'] == '1')
                        {
                            $look_id = Resident::where('firstname', '=', $row['firstname'])->where('lastname', '=', $row['lastname'])->where('birth_date', '=', $formatted_birthday)->first();
                            $res_sec = [
                                'resident_id' => $look_id->id,
                                'sector_id' => '20220003',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                            DB::table('resident_sectors')->insert($res_sec);
                        }
    
                        if($row['ofw'] == '1')
                        {
                            $look_id = Resident::where('firstname', '=', $row['firstname'])->where('lastname', '=', $row['lastname'])->where('birth_date', '=', $formatted_birthday)->first();
                            $res_sec = [
                                'resident_id' => $look_id->id,
                                'sector_id' => '20220004',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                            DB::table('resident_sectors')->insert($res_sec);
                        }
    
                        if($row['out_of_school_youth'] == '1')
                        {
                            $look_id = Resident::where('firstname', '=', $row['firstname'])->where('lastname', '=', $row['lastname'])->where('birth_date', '=', $formatted_birthday)->first();
                            $res_sec = [
                                'resident_id' => $look_id->id,
                                'sector_id' => '20220005',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                            DB::table('resident_sectors')->insert($res_sec);
                        }
    
                        if($row['pwd'] == '1')
                        {
                            $look_id = Resident::where('firstname', '=', $row['firstname'])->where('lastname', '=', $row['lastname'])->where('birth_date', '=', $formatted_birthday)->first();
                            $res_sec = [
                                'resident_id' => $look_id->id,
                                'sector_id' => '20220006',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                            DB::table('resident_sectors')->insert($res_sec);
                        }
    
                        if($row['solo_parent'] == '1')
                        {
                            $look_id = Resident::where('firstname', '=', $row['firstname'])->where('lastname', '=', $row['lastname'])->where('birth_date', '=', $formatted_birthday)->first();
                            $res_sec = [
                                'resident_id' => $look_id->id,
                                'sector_id' => '20220008',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                            DB::table('resident_sectors')->insert($res_sec);
                        }
    
                        if($row['4ps'] == '1')
                        {
                            $look_id = Resident::where('firstname', '=', $row['firstname'])->where('lastname', '=', $row['lastname'])->where('birth_date', '=', $formatted_birthday)->first();
                            $res_sec = [
                                'resident_id' => $look_id->id,
                                'sector_id' => '20220009',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                            DB::table('resident_sectors')->insert($res_sec);
                        }
    
                        if($row['business_owner'] == '1')
                        {
                            $look_id = Resident::where('firstname', '=', $row['firstname'])->where('lastname', '=', $row['lastname'])->where('birth_date', '=', $formatted_birthday)->first();
                            $res_sec = [
                                'resident_id' => $look_id->id,
                                'sector_id' => '20220010',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                            DB::table('resident_sectors')->insert($res_sec);
                        }
                    }
                    
                    return;
            }
            else
            {
                //success, error, info, warning
                Toastr::error('Duplicate Entry - ' . strtoupper($row['firstname']) . ' ' . strtoupper($row['lastname']),'Warning');
            }
        }
        
    }

    public function startRow(): int
    {
        return 3;
    }

    
}