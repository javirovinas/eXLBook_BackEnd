<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstructorLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            ['logbook_id' => 1, 'work_order_no' => 500234, 'task_detail' => 'Completed all transit checks', 'category' => 'B', 'ATA' => '21'],
            ['logbook_id' => 1, 'work_order_no' => 500236,'task_detail' => 'Maintenance pre-flight checks completed', 'category' => 'B', 'ATA' => '21'],
            ['logbook_id' => 2, 'work_order_no' => 637951, 'task_detail' => 'Tested aeronautical radio systems', 'category' => 'A1', 'ATA' => '13'],
            ['logbook_id' => 2, 'work_order_no' => 637952, 'task_detail' => 'Fixed VHF radios', 'category' => 'A1', 'ATA' => '13',],
            ['logbook_id' => 2, 'work_order_no' => 637953, 'task_detail' => 'Evaluated range performance of communication technologies', 'category' => 'A1', 'ATA' => '13'],
            ['logbook_id' => 3, 'work_order_no' => 712008, 'task_detail' => 'Calculated aerodynamic questions', 'category' => 'C2', 'ATA' => '07'],
            ['logbook_id' => 3, 'work_order_no' => 712009, 'task_detail' => 'Experimented with different aircraft lifts', 'category' => 'C2', 'ATA' => '07'],
            ['logbook_id' => 3, 'work_order_no' => 712010, 'task_detail' => 'Studied how drag affects flight', 'category' => 'C2', 'ATA' => '07'],
            ['logbook_id' => 3, 'work_order_no' => 712011, 'task_detail' => 'Explored physics concepts involved in aviation', 'category' => 'C2', 'ATA' => '07'],
            ['logbook_id' => 4, 'work_order_no' => 854209, 'task_detail' => 'Fixed some in-flight connectivity issues', 'category' => 'A', 'ATA' => '19'],
        ]);
    }
}
