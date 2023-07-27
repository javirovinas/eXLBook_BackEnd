<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\trainee_details;
use Illuminate\Support\Facades\Hash;


class TraineeDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $trainees = [
            ['UID' => '105085', 'first_name' => 'Terry', 'family_name' => 'Miller', 't_username' => 'tmiller1', 't_password' => 'miller1', 'email' => 'tmiller@gmail.com'],
            ['UID' => '123495', 'first_name' => 'Jane', 'family_name' => 'Ryan', 't_username' => 'jryan', 't_password' => 'wywooev739', 'email' => 'jdoe@gmail.com'],
            ['UID' => '234534', 'first_name' => 'Barry', 'family_name' => 'Sweeney', 't_username' => 'bsweeney12', 't_password' => 'oiwqwwehqy98', 'email' => 'bsweeney@gmail.com'],
            ['UID' => '187962', 'first_name' => 'Lisa', 'family_name' => 'Brennan', 't_username' => 'lizbrenn1', 't_password' => 'hewaiu09', 'email' => 'lbrennan@gmail.com'],
            ['UID' => '305085', 'first_name' => 'Michael', 'family_name' => 'Jones', 't_username' => 'mjones23', 't_password' => 'pqowieuryt', 'email' => 'mjones@gmail.com'],      
            ['UID' => '323495', 'first_name' => 'Sarah', 'family_name' => 'Smith', 't_username' => 'ssmith', 't_password' => 'oiuytrewq', 'email' => 'ssmith@gmail.com'],
            ['UID' => '334534', 'first_name' => 'Andrew', 'family_name' => 'Johnson', 't_username' => 'ajohnson12', 't_password' => 'lkjhgfdsa', 'email' => 'ajohnson@gmail.com'],
            ['UID' => '287962', 'first_name' => 'Emily', 'family_name' => 'Wilson', 't_username' => 'ewilson1', 't_password' => 'nbvcxzasdf', 'email' => 'ewilson@gmail.com']
        ];

        foreach ($trainees as $traineeData) {
            $traineeData['t_password'] = Hash::make($traineeData['t_password']); // Hash the password
            $trainee = Trainee_details::create($traineeData);
            $token = $trainee->createToken('api_token')->plainTextToken;
            $trainee->api_token = $token;
            $trainee->save();
        }
    }
}
