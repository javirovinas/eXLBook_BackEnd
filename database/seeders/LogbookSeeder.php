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
            ['logbook_name' => 'Maintenance Logbook', 'date' => '2023-02-23', 'trainee_id' => 4, 'instructor_id' => 3],
            ['logbook_name' => 'Communications Logbook', 'date' => '2023-02-20', 'trainee_id' => 1, 'instructor_id' => 2],
            ['logbook_name' => 'Physics Logbook', 'date' => '2023-02-02', 'trainee_id' => 7, 'instructor_id' => 1],
            ['logbook_name' => 'Technologies Logbook', 'date' => '2023-01-28', 'trainee_id' => 2, 'instructor_id' => 4],
            ['logbook_name' => 'Safety Logbook', 'date' => '2023-03-01', 'trainee_id' => 8, 'instructor_id' => 3],
            ['logbook_name' => 'Navigation Logbook', 'date' => '2023-02-11', 'trainee_id' => 6, 'instructor_id' => 1],
            ['logbook_name' => 'Medical Logbook', 'date' => '2023-01-18', 'trainee_id' => 3, 'instructor_id' => 2], 
            ['logbook_name' => 'Research Logbook', 'date' => '2023-03-04', 'trainee_id' => 5, 'instructor_id' => 4]
        ];

        foreach ($logbooks as $logbook) {
            logbook::create($logbook);
        }
    }
}
