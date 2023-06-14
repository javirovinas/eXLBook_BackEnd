<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\logbook;


class LogbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logbooks = [
            ['logbook_name' => 'Maintenance_Logbook', 'trainee_id' => 4, 'instructor_id' => 3],
            ['logbook_name' => 'Communications_Logbook', 'trainee_id' => 1, 'instructor_id' => 2],
            ['logbook_name' => 'Physics_Logbook', 'trainee_id' => 3, 'instructor_id' => 1],
            ['logbook_name' => 'Technologies_Logbook', 'trainee_id' => 2, 'instructor_id' => 4],
            ['logbook_name' => 'Safety_Logbook', 'trainee_id' => 1, 'instructor_id' => 3],
            ['logbook_name' => 'Navigation_Logbook', 'trainee_id' => 4, 'instructor_id' => 1],
            ['logbook_name' => 'Medical_Logbook', 'trainee_id' => 3, 'instructor_id' => 2], 
            ['logbook_name' => 'Research_Logbook', 'trainee_id' => 4, 'instructor_id' => 4]
        ];

        foreach ($logbooks as $logbook) {
            logbook::create($logbook);
        }
    }
}
