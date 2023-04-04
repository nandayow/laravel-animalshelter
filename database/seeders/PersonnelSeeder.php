<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personnels')->insert([
            'role' => 'admin',
            'fname' => 'russel',
            'lname' => 'solleza',
            'phone' => '09669205777',
            'addressline' => 'western bicutan', 
            'town' => 'taguig city', 
            'zipcode' => '1630', 
            'email' => 'russel@gmail.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
