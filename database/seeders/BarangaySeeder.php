<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Asia/Manila');
        
        DB::table('barangays')->insert([
            'id' => '1001',
            'barangay' => 'Ap-apaya',
            'municipality' => 'Villaviciosa',
            'province' => 'Abra',
            'postal_id' => '2811',
            'phone_number' => NULL,
            'email_add' => NULL,
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('barangays')->insert([
            'barangay' => 'Bol-lilising',
            'municipality' => 'Villaviciosa',
            'province' => 'Abra',
            'postal_id' => '2811',
            'phone_number' => NULL,
            'email_add' => NULL,
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('barangays')->insert([
            'barangay' => 'Cal-lao',
            'municipality' => 'Villaviciosa',
            'province' => 'Abra',
            'postal_id' => '2811',
            'phone_number' => NULL,
            'email_add' => NULL,
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('barangays')->insert([
            'barangay' => 'Lap-lapog',
            'municipality' => 'Villaviciosa',
            'province' => 'Abra',
            'postal_id' => '2811',
            'phone_number' => NULL,
            'email_add' => NULL,
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('barangays')->insert([
            'barangay' => 'Lumaba',
            'municipality' => 'Villaviciosa',
            'province' => 'Abra',
            'postal_id' => '2811',
            'phone_number' => NULL,
            'email_add' => NULL,
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('barangays')->insert([
            'barangay' => 'Poblacion',
            'municipality' => 'Villaviciosa',
            'province' => 'Abra',
            'postal_id' => '2811',
            'phone_number' => NULL,
            'email_add' => NULL,
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('barangays')->insert([
            'barangay' => 'Tamac',
            'municipality' => 'Villaviciosa',
            'province' => 'Abra',
            'postal_id' => '2811',
            'phone_number' => NULL,
            'email_add' => NULL,
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);

        DB::table('barangays')->insert([
            'barangay' => 'Tuquib',
            'municipality' => 'Villaviciosa',
            'province' => 'Abra',
            'postal_id' => '2811',
            'phone_number' => NULL,
            'email_add' => NULL,
            'image' => 'male.jpg',
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);
        
    }
}