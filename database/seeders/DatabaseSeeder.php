<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\trainee_details;
use App\Models\Instructor_details;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('tasks')->delete();
        DB::table('instructors')->delete();
        //DB::table('trainees')->delete();
        DB::table('logbooks')->delete();

        //DB::statement('ALTER TABLE trainees AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE instructors AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE tasks AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE logbooks AUTO_INCREMENT = 1;');
        
        $this->call([
            InstructorDetailsSeeder::class,
            //TraineeDetailsSeeder::class,
            LogbookSeeder::class,
            TaskSeeder::class,
        ]);

    }
}
