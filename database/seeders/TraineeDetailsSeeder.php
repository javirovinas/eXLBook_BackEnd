<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TraineeDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trainees')->insert([
            ['UID' => '105085', 'first_name' => 'Terry', 'family_name' => 'Miller', 't_username' => 't.miller1', 't_password' => 'jsgeey159', 'email' => 'tmiller@gmail.com'],
            ['UID' => '123495', 'first_name' => 'Jane', 'family_name' => 'Ryan', 't_username' => 'j.ryan', 't_password' => 'wywooev739', 'email' => 'jdoe@gmail.com'],
            ['UID' => '234534', 'first_name' => 'Barry', 'family_name' => 'Sweeney', 't_username' => 'b.sweeney12', 't_password' => 'oiwqwwehqy98', 'email' => 'bsweeney@gmail.com'],
            ['UID' => '187962', 'first_name' => 'Lisa', 'family_name' => 'Brennan', 't_username' => 'liz.brenn1', 't_password' => 'hewaiu09', 'email' => 'lbrennan@gmail.com'],
        ]);
    }
}
