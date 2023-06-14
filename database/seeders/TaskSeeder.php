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
            ["trainee_id" => 2, "logbook_id" => 1, "work_order_no" => 500234, "task_detail" => "Completed all transit checks", "category" => "B", "ATA" => "21"],
            ["trainee_id" => 2, "logbook_id" => 1, "work_order_no" => 500236, "task_detail" => "Maintenance pre-flight checks completed", "category" => "B", "ATA" => "21"],
            ["trainee_id" => 4, "logbook_id" => 2, "work_order_no" => 637951, "task_detail" => "Tested aeronautical radio systems", "category" => "A1", "ATA" => "13"],
            ["trainee_id" => 4, "logbook_id" => 2, "work_order_no" => 637952, "task_detail" => "Fixed VHF radios", "category" => "A1", "ATA" => "13",],
            ["trainee_id" => 4, "logbook_id" => 2, "work_order_no" => 637953, "task_detail" => "Evaluated range performance of communication technologies", "category" => "A1", "ATA" => "13"],
            ["trainee_id" => 1, "logbook_id" => 3, "work_order_no" => 712008, "task_detail" => "Calculated aerodynamics questions", "category" => "C2", "ATA" => "07"],
            ["trainee_id" => 1, "logbook_id" => 3, "work_order_no" => 712009, "task_detail" => "Experimented with different aircraft lifts", "category" => "C2", "ATA" => "07"],
            ["trainee_id" => 1, "logbook_id" => 3, "work_order_no" => 712010, "task_detail" => "Studied how drag affects flight", "category" => "C2", "ATA" => "07"],
            ["trainee_id" => 1, "logbook_id" => 3, "work_order_no" => 712011, "task_detail" => "Explored physics concepts involved in aviation", "category" => "C2", "ATA" => "07"],
            ["trainee_id" => 3, "logbook_id" => 4, "work_order_no" => 854209, "task_detail" => "Fixed some in-flight connectivity issues", "category" => "A", "ATA" => "19"],
            ["trainee_id" => 2, "logbook_id" => 1, "work_order_no" => 500238, "task_detail" => "Performed engine inspections", "category" => "B", "ATA" => "71"],
            ["trainee_id" => 2, "logbook_id" => 1, "work_order_no" => 500240, "task_detail" => "Conducted aircraft fueling operations", "category" => "B", "ATA" => "73"],
            ["trainee_id" => 4, "logbook_id" => 2, "work_order_no" => 637955, "task_detail" => "Inspected aircraft landing gear", "category" => "A1", "ATA" => "32"],
            ["trainee_id" => 4, "logbook_id" => 2, "work_order_no" => 637956, "task_detail" => "Tested aircraft hydraulic systems", "category" => "A1", "ATA" => "29"],
            ["trainee_id" => 4, "logbook_id" => 2, "work_order_no" => 637958, "task_detail" => "Checked aircraft navigation instruments", "category" => "A1", "ATA" => "22"],
            ["trainee_id" => 1, "logbook_id" => 3, "work_order_no" => 712013, "task_detail" => "Practiced aircraft emergency procedures", "category" => "C2", "ATA" => "76"],
            ["trainee_id" => 1, "logbook_id" => 3, "work_order_no" => 712015, "task_detail" => "Performed weight and balance calculations", "category" => "C2", "ATA" => "75"],
            ["trainee_id" => 1, "logbook_id" => 3, "work_order_no" => 712017, "task_detail" => "Conducted flight simulation sessions", "category" => "C2", "ATA" => "78"],
            ["trainee_id" => 3, "logbook_id" => 4, "work_order_no" => 854213, "task_detail" => "Inspected aircraft avionics systems", "category" => "A", "ATA" => "34"],
            ["trainee_id" => 3, "logbook_id" => 4, "work_order_no" => 854215, "task_detail" => "Performed engine run-up tests", "category" => "A", "ATA" => "72"]
        ];

        foreach ($tasks as $task) {
            trainee_logbook::create($task);
        }
    }
}
