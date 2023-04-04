<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Personnel;
use App\Models\AnimalMedicalCondition;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Admin Admins';
        $user->role = 'admin';
        $user->email = 'admin2@gmail.com';
        $user->password=  Hash::make('password');
        $user->status  ='active';
        $user->save();

        $personnel = new Personnel();
        $personnel -> role = 'Admin';;
        $personnel->user_id = $user->id;
        $personnel -> fname = "Admin";
        $personnel -> lname = "Admins";
        $personnel -> phone = "09104856304";
        $personnel -> addressline = "Kalachuchi";
        $personnel -> town ="Taguig City";
        $personnel -> zipcode = "1630";
        $personnel -> birth_date = "1998-09-19";
        $personnel -> gender ="Male";
        $personnel -> email = $user->email;
        $personnel->save(); 
       
        $animalcondition = new AnimalMedicalCondition();
        $animalcondition -> condition_name = "Poison";
        $animalcondition -> condition_type ="Disease";
        $animalcondition->save(); 

    }
}
