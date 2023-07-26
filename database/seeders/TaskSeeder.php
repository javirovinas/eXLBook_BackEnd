<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\trainee_logbook;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $tasks = [
            ["trainee_id" => 2, "logbook_id" => 1, "work_order_no" => 50, "task_detail" => "Completed all transit checks", "category" => "B", "ATA" => "21"],
            ["trainee_id" => 2, "logbook_id" => 1, "work_order_no" => 51, "task_detail" => "Maintenance pre-flight checks completed", "category" => "B", "ATA" => "21"],
            ["trainee_id" => 4, "logbook_id" => 2, "work_order_no" => 63, "task_detail" => "Tested aeronautical radio systems", "category" => "", "ATA" => "2"],
            ["trainee_id" => 4, "logbook_id" => 2, "work_order_no" => 64, "task_detail" => "Fixed VHF radios", "category" => "A", "ATA" => "13",],
            ["trainee_id" => 4, "logbook_id" => 2, "work_order_no" => 65, "task_detail" => "Evaluated range performance of communication technologies", "category" => "A1", "ATA" => "13"],
            ["trainee_id" => 1, "logbook_id" => 3, "work_order_no" => 71, "task_detail" => "Calculated aerodynamics questions", "category" => "C2", "ATA" => "6"],
            ["trainee_id" => 1, "logbook_id" => 3, "work_order_no" => 72, "task_detail" => "Experimented with different aircraft lifts", "category" => "C2", "ATA" => "7"],
            ["trainee_id" => 1, "logbook_id" => 3, "work_order_no" => 73, "task_detail" => "Studied how drag affects flight", "category" => "C2", "ATA" => "7"],
            ["trainee_id" => 1, "logbook_id" => 3, "work_order_no" => 74, "task_detail" => "Explored physics concepts involved in aviation", "category" => "C2", "ATA" => "7"],
            ["trainee_id" => 3, "logbook_id" => 4, "work_order_no" => 85, "task_detail" => "Fixed some in-flight connectivity issues", "category" => "", "ATA" => "19"],
            ["trainee_id" => 2, "logbook_id" => 1, "work_order_no" => 87, "task_detail" => "Performed engine inspections", "category" => "B", "ATA" => "11"],
            ["trainee_id" => 2, "logbook_id" => 1, "work_order_no" => 88, "task_detail" => "Conducted aircraft fueling operations", "category" => "", "ATA" => "3"],
            ["trainee_id" => 4, "logbook_id" => 2, "work_order_no" => 93, "task_detail" => "Inspected aircraft landing gear", "category" => "C", "ATA" => "2"],
            ["trainee_id" => 4, "logbook_id" => 2, "work_order_no" => 94, "task_detail" => "Tested aircraft hydraulic systems", "category" => "B2", "ATA" => "29"],
            ["trainee_id" => 4, "logbook_id" => 2, "work_order_no" => 95, "task_detail" => "Checked aircraft navigation instruments", "category" => "A1", "ATA" => "22"],
            ["trainee_id" => 1, "logbook_id" => 3, "work_order_no" => 103, "task_detail" => "Practiced aircraft emergency procedures", "category" => "C2", "ATA" => "12"],
            ["trainee_id" => 1, "logbook_id" => 3, "work_order_no" => 104, "task_detail" => "Performed weight and balance calculations", "category" => "C2", "ATA" => "5"],
            ["trainee_id" => 1, "logbook_id" => 3, "work_order_no" => 105, "task_detail" => "Conducted flight simulation sessions", "category" => "C2", "ATA" => "8"],
            ["trainee_id" => 3, "logbook_id" => 4, "work_order_no" => 108, "task_detail" => "Inspected aircraft avionics systems", "category" => "A", "ATA" => "4"],
            ["trainee_id" => 3, "logbook_id" => 4, "work_order_no" => 110, "task_detail" => "Performed engine run-up tests", "category" => "A", "ATA" => "7"]
        ];

        foreach ($tasks as $task) {
            trainee_logbook::create($task);
        }
    }
}
