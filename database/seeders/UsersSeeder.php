<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Asia/Manila');
        
        DB::table('users')->insert([
            'id' => floor(time()-999999999),
            'name' => 'Super Admin',
            'barangay' => NULL,
            'usertype' => 'admin',
            'username' => 'super-admin',
            'password' => Hash::make('admin'),
            'status' => '1',
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'barangay' => NULL,
            'usertype' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'status' => '1',
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('users')->insert([
            'name' => 'MDRRMO',
            'barangay' => NULL,
            'usertype' => 'department-mdrrmo',
            'username' => 'renel',
            'password' => Hash::make('mdrrmo'),
            'status' => '1',
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('users')->insert([
            'name' => 'DSWDO',
            'barangay' => NULL,
            'usertype' => 'department-dswdo',
            'username' => 'dsdwo',
            'password' => Hash::make('dsdwo'),
            'status' => '1',
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('users')->insert([
            'name' => 'Barangay Ap-apaya',
            'barangay' => 'Ap-apaya',
            'usertype' => 'barangay',
            'username' => 'ap-apaya',
            'password' => Hash::make('ap-apaya'),
            'status' => '1',
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('users')->insert([
            'name' => 'Barangay Bol-lilising',
            'barangay' => 'Bol-lilising',
            'usertype' => 'barangay',
            'username' => 'bol-lilising',
            'password' => Hash::make('bol-lilising'),
            'status' => '1',
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('users')->insert([
            'name' => 'Barangay Cal-lao',
            'barangay' => 'Cal-lao',
            'usertype' => 'barangay',
            'username' => 'cal-lao',
            'password' => Hash::make('cal-lao'),
            'status' => '1',
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('users')->insert([
            'name' => 'Barangay Lap-Lapog',
            'barangay' => 'Lap-lapog',
            'usertype' => 'barangay',
            'username' => 'lap-lapog',
            'password' => Hash::make('lap-lapog'),
            'status' => '1',
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        

        DB::table('users')->insert([
            'name' => 'Barangay Lumaba',
            'barangay' => 'Lumaba',
            'usertype' => 'barangay',
            'username' => 'lumaba',
            'password' => Hash::make('lumaba'),
            'status' => '1',
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('users')->insert([
            'name' => 'Barangay Poblacion',
            'barangay' => 'Poblacion',
            'usertype' => 'barangay',
            'username' => 'poblacion',
            'password' => Hash::make('poblacion'),
            'status' => '1',
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('users')->insert([
            'name' => 'Barangay Tamac',
            'barangay' => 'Tamac',
            'usertype' => 'barangay',
            'username' => 'tamac',
            'password' => Hash::make('tamac'),
            'status' => '1',
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('users')->insert([
            'name' => 'Barangay Tuquib',
            'barangay' => 'Tuquib',
            'usertype' => 'barangay',
            'username' => 'tuquib',
            'password' => Hash::make('tuquib'),
            'status' => '1',
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);
    }
}