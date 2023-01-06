<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Asia/Manila');
        
        DB::table('user_roles')->insert([
            'id' => floor(time()-999999999),
            'usertype' => 'admin',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('user_roles')->insert([
            'usertype' => 'department-mdrrmo',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('user_roles')->insert([
            'usertype' => 'department-dswdo',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('user_roles')->insert([
            'usertype' => 'barangay',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);
    }
}
