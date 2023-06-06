<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstructorDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('instructors')->insert([
		['UID' => '105840', 'first_name' => 'Rory', 'family_name' => 'McCarthy', 'i_username' => 'rorymcc', 'i_password' => 'owefh23', 'email' => 'rorymcc@gmail.com'],
		['UID' => '110254', 'first_name' => 'John', 'family_name' => 'Doe', 'i_username' => 'j.doe', 'i_password' => 'oethwe34', 'email' => 'jdoe@gmail.com'],
		['UID' => '200227', 'first_name' => 'Emily', 'family_name' => 'Swift', 'i_username' => 'em.swift', 'i_password' => 'reoghiro54', 'email' => 'eswift@gmail.com'],
		['UID' => '203735', 'first_name' => 'Kate', 'family_name' => 'Maher', 'i_username' => 'kat.maher1', 'i_password' => 'sfjsohi92', 'email' => 'kmaher@gmail.com'],
	]);
    }
}
