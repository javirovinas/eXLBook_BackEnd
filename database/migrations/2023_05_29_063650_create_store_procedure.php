<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $store_procedure = "
            DROP PROCEDURE IF EXISTS `Insert_into_instructors`;

            CREATE PROCEDURE `Insert_into_instructors`(IN UID VARCHAR(255), IN first_name VARCHAR(255), IN family_name VARCHAR(255), IN i_username VARCHAR(255), IN i_password VARCHAR(255), IN email VARCHAR(255))
            BEGIN
                INSERT INTO instructors (UID, first_name, family_name, i_username, i_password, email)
                VALUES  
                ('105', 'Rory', 'McCarthy', 'rorymcc', 'owefh23', 'rorymcc@gmail.com'),
                ('110', 'John', 'Doe', 'j.doe', 'oethwe34', 'jdoe@gmail.com'),
                ('200', 'Emily', 'Swift', 'em.swift', 'reoghiro54', 'eswift@gmail.com'),
                ('103', 'Kate', 'Maher', 'kat.maher1', 'sfjsohi92', 'kmaher@gmail.com');
            END;

            DROP PROCEDURE IF EXISTS `Insert_into_logbooks`;

            CREATE PROCEDURE `Insert_into_logbooks`(IN logbook_name VARCHAR(255), IN trainee_id BIGINT(20) UNSIGNED, IN instructor_id BIGINT(20) UNSIGNED)
            BEGIN
                INSERT INTO logbooks (logbook_name, trainee_id, instructor_id)
                VALUES  
                ('logbook1', 1003, 102),
                ('logbook2', 1000, 101),
                ('logbook3', 1002, 100),
                ('logbook4', 1001, 103);
            END;

            DROP PROCEDURE IF EXISTS `Insert_into_tasks`;

            CREATE PROCEDURE `Insert_into_tasks`(IN logbook_id BIGINT(20) UNSIGNED, IN work_order_no INT(10) UNSIGNED, IN log_name VARCHAR(255), IN task_detail VARCHAR(255), IN category VARCHAR(255), IN ATA VARCHAR(255), IN archived TINYINT(1))
            BEGIN
                INSERT INTO tasks (logbook_id, work_order_no, log_name, task_detail, category, ATA, archived)
                VALUES  
                ('10005', '1', 'logbook_1', 'This is task number 1', 'B', '21', '0'),
                ('10005', '2', 'logbook_1', 'This is task number 2 (archived)', 'B', '21', '1'),
                ('10005', '3', 'logbook_1', 'This is task number 2 re-entered', 'B', '21', '0'),
                ('10005', '4', 'logbook_1', 'This is task number 3', 'B', '23', '0'),
                ('10005', '5', 'logbook_1', 'This is task number 4', 'B', '23', '0'),
                ('10006', '1', 'logbook_2', 'Entering a task here', 'A1', '13', '0'),
                ('10006', '2', 'logbook_2', 'Entering a task for task 2 here', 'A1', '13', '0'),
                ('10006', '3', 'logbook_2', 'Entering a task for task 3 here', 'A1', '14', '0'),
                ('10007', '1', 'logbook_3', 'Student filled task 1', 'C2', '07', '0'),
                ('10007', '2', 'logbook_3', 'Student filled task 2', 'C2', '07', '0'),
                ('10007', '3', 'logbook_3', 'Student filled task 3', 'C2', '07', '0'),
                ('10007', '4', 'logbook_3', 'Student filled task 3 (archived)', 'C2', '07', '1'),
                ('10007', '5', 'logbook_3', 'Student filled task 3 again', 'C2', '07', '0');
            END;

            DROP PROCEDURE IF EXISTS `Insert_into_trainees`;

            CREATE PROCEDURE `Insert_into_trainees`(IN UID varchar(255), IN first_name VARCHAR(255), IN family_name VARCHAR(255), IN t_username VARCHAR(255), IN t_password VARCHAR(255), IN email VARCHAR(255))
            BEGIN
            INSERT INTO trainees (UID, first_name, family_name, t_username, t_password, email)
            VALUES  
                ('1050', 'Terry', 'Miller', 't.miller1', 'jsgeey159', 'tmiller@gmail.com'),
                ('1234', 'Jane', 'Ryan', 'j.ryan', 'wywooev739', 'jdoe@gmail.com'), 
                ('2345', 'Barry', 'Sweeney', 'b.sweeney12', 'oiwqwwehqy98', 'bsweeney@gmail.com'),
                ('1879', 'Lisa', 'Brennan', 'liz.brenn1', 'hewaiu09', 'lbrennan@gmail.com');
            END;
        ";

        DB::unprepared($store_procedure);

        // Insert data into tables

        DB::table('instructors')->insert([
            ['UID' => '105', 'first_name' => 'Rory', 'family_name' => 'McCarthy', 'i_username' => 'rorymcc', 'i_password' => 'owefh23', 'email' => 'rorymcc@gmail.com'],
            ['UID' => '110', 'first_name' => 'John', 'family_name' => 'Doe', 'i_username' => 'j.doe', 'i_password' => 'oethwe34', 'email' => 'jdoe@gmail.com'],
            ['UID' => '200', 'first_name' => 'Emily', 'family_name' => 'Swift', 'i_username' => 'em.swift', 'i_password' => 'reoghiro54', 'email' => 'eswift@gmail.com'],
            ['UID' => '103', 'first_name' => 'Kate', 'family_name' => 'Maher', 'i_username' => 'kat.maher1', 'i_password' => 'sfjsohi92', 'email' => 'kmaher@gmail.com'],
        ]);

        DB::table('tasks')->insert([
            ['logbook_id' => 10005, 'work_order_no' => 1, 'log_name' => 'logbook_1', 'task_detail' => 'This is task number 1', 'category' => 'B', 'ATA' => '21', 'archived' => 0],
            ['logbook_id' => 10005, 'work_order_no' => 2, 'log_name' => 'logbook_1', 'task_detail' => 'This is task number 2 (archived)', 'category' => 'B', 'ATA' => '21', 'archived' => 1],
            ['logbook_id' => 10005, 'work_order_no' => 3, 'log_name' => 'logbook_1', 'task_detail' => 'This is task number 2 re-entered', 'category' => 'B', 'ATA' => '21', 'archived' => 0],
            ['logbook_id' => 10005, 'work_order_no' => 4, 'log_name' => 'logbook_1', 'task_detail' => 'This is task number 3', 'category' => 'B', 'ATA' => '23', 'archived' => 0],
            ['logbook_id' => 10005, 'work_order_no' => 5, 'log_name' => 'logbook_1', 'task_detail' => 'This is task number 4', 'category' => 'B', 'ATA' => '23', 'archived' => 0],
            ['logbook_id' => 10006, 'work_order_no' => 1, 'log_name' => 'logbook_2', 'task_detail' => 'Entering a task here', 'category' => 'A1', 'ATA' => '13', 'archived' => 0],
            ['logbook_id' => 10006, 'work_order_no' => 2, 'log_name' => 'logbook_2', 'task_detail' => 'Entering a task for task 2 here', 'category' => 'A1', 'ATA' => '13', 'archived' => 0],
            ['logbook_id' => 10006, 'work_order_no' => 3, 'log_name' => 'logbook_2', 'task_detail' => 'Entering a task for task 3 here', 'category' => 'A1', 'ATA' => '14', 'archived' => 0],
            ['logbook_id' => 10007, 'work_order_no' => 1, 'log_name' => 'logbook_3', 'task_detail' => 'Student filled task 1', 'category' => 'C2', 'ATA' => '07', 'archived' => 0],
            ['logbook_id' => 10007, 'work_order_no' => 2, 'log_name' => 'logbook_3', 'task_detail' => 'Student filled task 2', 'category' => 'C2', 'ATA' => '07', 'archived' => 0],
            ['logbook_id' => 10007, 'work_order_no' => 3, 'log_name' => 'logbook_3', 'task_detail' => 'Student filled task 3', 'category' => 'C2', 'ATA' => '07', 'archived' => 0],
            ['logbook_id' => 10007, 'work_order_no' => 4, 'log_name' => 'logbook_3', 'task_detail' => 'Student filled task 3 (archived)', 'category' => 'C2', 'ATA' => '07', 'archived' => 1],
            ['logbook_id' => 10007, 'work_order_no' => 5, 'log_name' => 'logbook_3', 'task_detail' => 'Student filled task 3 again', 'category' => 'C2', 'ATA' => '07', 'archived' => 0],
        ]);

        DB::table('trainees')->insert([
            ['UID' => '1050', 'first_name' => 'Terry', 'family_name' => 'Miller', 't_username' => 't.miller1', 't_password' => 'jsgeey159', 'email' => 'tmiller@gmail.com'],
            ['UID' => '1234', 'first_name' => 'Jane', 'family_name' => 'Ryan', 't_username' => 'j.ryan', 't_password' => 'wywooev739', 'email' => 'jdoe@gmail.com'],
            ['UID' => '2345', 'first_name' => 'Barry', 'family_name' => 'Sweeney', 't_username' => 'b.sweeney12', 't_password' => 'oiwqwwehqy98', 'email' => 'bsweeney@gmail.com'],
            ['UID' => '1879', 'first_name' => 'Lisa', 'family_name' => 'Brennan', 't_username' => 'liz.brenn1', 't_password' => 'hewaiu09', 'email' => 'lbrennan@gmail.com'],
        ]);

        DB::table('logbooks')->insert([
            ['logbook_name' => 'logbook1', 'trainee_id' => 1003, 'instructor_id' => 102],
            ['logbook_name' => 'logbook2', 'trainee_id' => 1000, 'instructor_id' => 101],
            ['logbook_name' => 'logbook3', 'trainee_id' => 1002, 'instructor_id' => 100],
            ['logbook_name' => 'logbook4', 'trainee_id' => 1001, 'instructor_id' => 103],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS `Insert_into_instructors`;");
        DB::unprepared("DROP PROCEDURE IF EXISTS `Insert_into_logbooks`;");
        DB::unprepared("DROP PROCEDURE IF EXISTS `Insert_into_tasks`;");
        DB::unprepared("DROP PROCEDURE IF EXISTS `Insert_into_trainees`;");

        Schema::dropIfExists('instructors');
        Schema::dropIfExists('trainees');
        Schema::dropIfExists('logbooks');
        Schema::dropIfExists('tasks');
    }
};

