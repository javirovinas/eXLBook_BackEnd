<?php

namespace Database\Seeders;

use App\Models\instructor_login;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\logbook;
use App\Models\trainee_details;
use App\Models\Instructor_details;


class LogbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logbooks = [
            ['logbook_name' => 'Maintenance Logbook', 'date' => '2023-02-23', 'trainee_id' => 4, 'instructor_id' => 2, 'trainee_name' => '', 'instructor_name' => ''],
            ['logbook_name' => 'Communications Logbook', 'date' => '2023-02-20', 'trainee_id' => 1, 'instructor_id' => 2, 'trainee_name' => '', 'instructor_name' => ''],
            ['logbook_name' => 'Physics Logbook', 'date' => '2023-02-02', 'trainee_id' => 7, 'instructor_id' => 1, 'trainee_name' => '', 'instructor_name' => ''],
            ['logbook_name' => 'Technologies Logbook', 'date' => '2023-01-28', 'trainee_id' => 2, 'instructor_id' => 4, 'trainee_name' => '', 'instructor_name' => ''],
            ['logbook_name' => 'Safety Logbook', 'date' => '2023-03-01', 'trainee_id' => 8, 'instructor_id' => 3, 'trainee_name' => '', 'instructor_name' => ''],
            ['logbook_name' => 'Navigation Logbook', 'date' => '2023-02-11', 'trainee_id' => 6, 'instructor_id' => 1, 'trainee_name' => '', 'instructor_name' => ''],
            ['logbook_name' => 'Research Logbook', 'date' => '2023-03-04', 'trainee_id' => 5, 'instructor_id' => 3, 'trainee_name' => '', 'instructor_name' => ''],
            ['logbook_name' => 'Medical Logbook', 'date' => '2023-01-18', 'trainee_id' => 3, 'instructor_id' => 2, 'trainee_name' => '', 'instructor_name' => ''],
           // ['logbook_name' => 'Physics Logbook', 'date' => '2023-01-20', 'trainee_id' => 1, 'instructor_id' => 2, 'trainee_name' => '', 'instructor_name' => ''],  
           // ['logbook_name' => 'Avionics Logbook', 'date' => '2023-03-15', 'trainee_id' => 3, 'instructor_id' => 5, 'trainee_name' => '', 'instructor_name' => ''],
           // ['logbook_name' => 'Flight Operations Logbook', 'date' => '2023-02-28', 'trainee_id' => 4, 'instructor_id' => 6, 'trainee_name' => '', 'instructor_name' => ''],
           // ['logbook_name' => 'Meteorology Logbook', 'date' => '2023-03-10', 'trainee_id' => 5, 'instructor_id' => 5, 'trainee_name' => '', 'instructor_name' => ''],
           // ['logbook_name' => 'Aircraft Structures Logbook', 'date' => '2023-03-05', 'trainee_id' => 6, 'instructor_id' => 1, 'trainee_name' => '', 'instructor_name' => ''],
        ];

        foreach ($logbooks as &$logbook) {
            if (!empty($logbook['trainee_id'])) {
                $trainee = trainee_details::find($logbook['trainee_id']);
                if ($trainee) {
                    $logbook['trainee_name'] = $trainee->first_name . ' ' . $trainee->family_name;
                }
            }

            if (!empty($logbook['instructor_id'])) {
                $instructor = instructor_details::find($logbook['instructor_id']);
                if ($instructor) {
                    $logbook['instructor_name'] = $instructor->first_name . ' ' . $instructor->family_name;
                }
            }
        }

        unset($logbook);

        foreach ($logbooks as $logbook) {
            logbook::create($logbook);
        }
    }
}
