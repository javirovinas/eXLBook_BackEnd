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
            ["trainee_id" => 4, "logbook_id" => 1, "work_order_no" => 1, "task_detail" => "Completed all transit checks", "category" => "B", "ATA" => "21"],
            ["trainee_id" => 4, "logbook_id" => 1, "work_order_no" => 2, "task_detail" => "Maintenance pre-flight checks completed", "category" => "B", "ATA" => "21"],
            ["trainee_id" => 1, "logbook_id" => 2, "work_order_no" => 1, "task_detail" => "Tested aeronautical radio systems", "category" => "C2", "ATA" => "2", "TEE_SO" => "2023-07-12 09:54:30"],
            ["trainee_id" => 1, "logbook_id" => 2, "work_order_no" => 2, "task_detail" => "Fixed VHF radios", "category" => "C2", "ATA" => "13", "TEE_SO" => "2023-07-14 18:34:14"],
            ["trainee_id" => 1, "logbook_id" => 2, "work_order_no" => 3, "task_detail" => "Evaluated range performance of communication technologies", "category" => "C2", "ATA" => "13", "TEE_SO" => "2023-07-18 11:20:31"],
            ["trainee_id" => 1, "logbook_id" => 2, "work_order_no" => 4, "task_detail" => "Calculated aerodynamics questions", "category" => "C2", "ATA" => "6"],
            ["trainee_id" => 1, "logbook_id" => 2, "work_order_no" => 5, "task_detail" => "Experimented with different aircraft lifts", "category" => "C2", "ATA" => "7"],
            ["trainee_id" => 1, "logbook_id" => 2, "work_order_no" => 6, "task_detail" => "Inspected aircraft control systems", "category" => "C2", "ATA" => "7"],
            ["trainee_id" => 1, "logbook_id" => 2, "work_order_no" => 7, "task_detail" => "Explored physics concepts involved in aviation", "category" => "C2", "ATA" => "7"],
            ["trainee_id" => 7, "logbook_id" => 4, "work_order_no" => 1, "task_detail" => "Fixed some in-flight connectivity issues", "category" => "", "ATA" => "19"],
            ["trainee_id" => 4, "logbook_id" => 1, "work_order_no" => 3, "task_detail" => "Performed engine inspections", "category" => "B", "ATA" => "11"],
            ["trainee_id" => 4, "logbook_id" => 1, "work_order_no" => 4, "task_detail" => "Conducted aircraft fueling operations", "category" => "", "ATA" => "3"],
            ["trainee_id" => 1, "logbook_id" => 2, "work_order_no" => 8, "task_detail" => "Checked aircraft navigation instruments", "category" => "C2", "ATA" => "2"],
            ["trainee_id" => 1, "logbook_id" => 2, "work_order_no" => 9, "task_detail" => "", "category" => "C2", "ATA" => "29"],
            ["trainee_id" => 1, "logbook_id" => 2, "work_order_no" => 10, "task_detail" => "", "category" => "", "ATA" => Null],
            ["trainee_id" => 7, "logbook_id" => 3, "work_order_no" => 1, "task_detail" => "Practiced aircraft emergency procedures", "category" => "C2", "ATA" => "12"],
            ["trainee_id" => 7, "logbook_id" => 3, "work_order_no" => 2, "task_detail" => "Performed weight and balance calculations", "category" => "C2", "ATA" => "5"],
            ["trainee_id" => 7, "logbook_id" => 3, "work_order_no" => 3, "task_detail" => "Conducted flight simulation sessions", "category" => "C2", "ATA" => "8"],
            ["trainee_id" => 2, "logbook_id" => 4, "work_order_no" => 1, "task_detail" => "Inspected aircraft avionics systems", "category" => "A", "ATA" => "4"],
            ["trainee_id" => 2, "logbook_id" => 4, "work_order_no" => 2, "task_detail" => "Performed engine run-up tests", "category" => "A", "ATA" => "7"],
            ["trainee_id" => 7, "logbook_id" => 3, "work_order_no" => 4, "task_detail" => "Reviewed aircraft aerodynamics principles", "category" => "C2", "ATA" => "6"],
            ["trainee_id" => 7, "logbook_id" => 3, "work_order_no" => 5, "task_detail" => "Studied aircraft lift generation mechanisms", "category" => "C2", "ATA" => "6"],
            ["trainee_id" => 7, "logbook_id" => 3, "work_order_no" => 6, "task_detail" => "Investigated aircraft drag reduction methods", "category" => "C2", "ATA" => "6"],
            ["trainee_id" => 8, "logbook_id" => 5, "work_order_no" => 1, "task_detail" => "Conducted safety inspections on aircraft", "category" => "A", "ATA" => "14"],
            ["trainee_id" => 8, "logbook_id" => 5, "work_order_no" => 2, "task_detail" => "Checked aircraft emergency equipment", "category" => "A", "ATA" => "24"],
            ["trainee_id" => 8, "logbook_id" => 5, "work_order_no" => 3, "task_detail" => "Reviewed aircraft fire detection systems", "category" => "B", "ATA" => "26"],
            ["trainee_id" => 5, "logbook_id" => 7, "work_order_no" => 4, "task_detail" => "Conducted research on aerodynamics", "category" => "C2", "ATA" => "6"],
            ["trainee_id" => 5, "logbook_id" => 7, "work_order_no" => 5, "task_detail" => "Studied aircraft propulsion systems", "category" => "", "ATA" => "6"],
            ["trainee_id" => 5, "logbook_id" => 7, "work_order_no" => 6, "task_detail" => "", "category" => "C2", "ATA" => "6"],
            ["trainee_id" => 3, "logbook_id" => 6, "work_order_no" => 1, "task_detail" => "Reviewed aircraft navigation principles", "category" => "A1", "ATA" => "22"],
            ["trainee_id" => 3, "logbook_id" => 6, "work_order_no" => 2, "task_detail" => "Practiced using aircraft navigation instruments", "category" => "A1", "ATA" => "22"],
            ["trainee_id" => 3, "logbook_id" => 6, "work_order_no" => 3, "task_detail" => "Explored aircraft flight planning procedures", "category" => "A1", "ATA" => "22"],
        ];

        foreach ($tasks as $task) {
            trainee_logbook::create($task);
        }
    }
}
