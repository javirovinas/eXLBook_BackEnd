<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Instructor_details;
use Illuminate\Support\Facades\Hash;

class InstructorDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $instructors = [
            ['UID' => '105840', 'first_name' => 'Rory', 'family_name' => 'McCarthy', 'i_username' => 'rorymcc', 'i_password' => 'rmc4546', 'email' => 'rorymcc@gmail.com'],
            ['UID' => '110254', 'first_name' => 'John', 'family_name' => 'Doe', 'i_username' => 'jdoe', 'i_password' => 'jdoe3', 'email' => 'jdoe@gmail.com'],
            ['UID' => '100227', 'first_name' => 'Emily', 'family_name' => 'Swift', 'i_username' => 'emswift', 'i_password' => 'swifty54', 'email' => 'eswift@gmail.com'],
            ['UID' => '203735', 'first_name' => 'Kate', 'family_name' => 'Maher', 'i_username' => 'katmaher1', 'i_password' => 'kateohi92', 'email' => 'kmaher@gmail.com'],
           // ['UID' => '305840', 'first_name' => 'Samuel', 'family_name' => 'Anderson', 'i_username' => 'samand2', 'i_password' => 'pwrts893', 'email' => 'sanderson@gmail.com'],
           // ['UID' => '110334', 'first_name' => 'Sophia', 'family_name' => 'Walker', 'i_username' => 'sophwalker', 'i_password' => 'rtyui123', 'email' => 'sophwalker@gmail.com'],
           // ['UID' => '500227', 'first_name' => 'David', 'family_name' => 'Baker', 'i_username' => 'dbaker1', 'i_password' => 'mnbcv987', 'email' => 'dbaker@gmail.com'],
           // ['UID' => '103735', 'first_name' => 'Olivia', 'family_name' => 'Thomas', 'i_username' => 'oliviathomas', 'i_password' => 'lkjhgf321', 'email' => 'othomas@gmail.com']
        ];

        foreach ($instructors as $instructorData) {
            $instructorData['i_password'] = Hash::make($instructorData['i_password']);
            $instructor = Instructor_details::create($instructorData);
            $token = $instructor->createToken('api_token')->plainTextToken;
            $instructor->api_token = $token;
            $instructor->save();
        }
    }
}
