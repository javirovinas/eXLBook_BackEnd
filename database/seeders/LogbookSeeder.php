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
            ['logbook_name' => 'Maintenance_Logbook', 'date' => '2023-02-23', 'trainee_id' => 4, 'instructor_id' => 3],
            ['logbook_name' => 'Communications_Logbook', 'date' => '2023-02-20', 'trainee_id' => 1, 'instructor_id' => 2],
            ['logbook_name' => 'Physics_Logbook', 'date' => '2023-02-02', 'trainee_id' => 3, 'instructor_id' => 1],
            ['logbook_name' => 'Technologies_Logbook', 'date' => '2023-01-28', 'trainee_id' => 2, 'instructor_id' => 4],
            ['logbook_name' => 'Safety_Logbook', 'date' => '2023-03-01', 'trainee_id' => 1, 'instructor_id' => 3],
            ['logbook_name' => 'Navigation_Logbook', 'date' => '2023-02-11', 'trainee_id' => 4, 'instructor_id' => 1],
            ['logbook_name' => 'Medical_Logbook', 'date' => '2023-01-18', 'trainee_id' => 3, 'instructor_id' => 2], 
            ['logbook_name' => 'Research_Logbook', 'date' => '2023-03-04', 'trainee_id' => 4, 'instructor_id' => 4]
        ];

        foreach ($logbooks as $logbook) {
            logbook::create($logbook);
        }
    }
}
