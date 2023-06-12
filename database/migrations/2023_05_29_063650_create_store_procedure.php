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
                ('105857', 'Rory', 'McCarthy', 'rorymcc', 'owefh23', 'rorymcc@gmail.com');
            END;

            DROP PROCEDURE IF EXISTS `Insert_into_logbooks`;
            CREATE PROCEDURE `Insert_into_logbooks`(IN logbook_name VARCHAR(255), IN trainee_id BIGINT(20) UNSIGNED, IN instructor_id BIGINT(20) UNSIGNED)
            BEGIN
                INSERT INTO logbooks (logbook_name, trainee_id, instructor_id)
                VALUES  
                ('logbook1', 3, 2);
            END;

            DROP PROCEDURE IF EXISTS `Insert_into_tasks`;
            CREATE PROCEDURE `Insert_into_tasks`(IN logbook_id BIGINT(20) UNSIGNED, IN work_order_no INT(10) UNSIGNED, IN task_detail VARCHAR(255), IN category VARCHAR(255), IN ATA VARCHAR(255), IN archived TINYINT(1))
            BEGIN
                INSERT INTO tasks (logbook_id, work_order_no, task_detail, category, ATA, archived)
                VALUES  
                ('1', '1', 'Maintenance_Logbook', 'Completed all transit checks', 'B', '21', '0');
            END;
            
            DROP PROCEDURE IF EXISTS `Insert_into_trainees`;
            CREATE PROCEDURE `Insert_into_trainees`(IN UID varchar(255), IN first_name VARCHAR(255), IN family_name VARCHAR(255), IN t_username VARCHAR(255), IN t_password VARCHAR(255), IN email VARCHAR(255))
            BEGIN
            INSERT INTO trainees (UID, first_name, family_name, t_username, t_password, email)
            VALUES  
                ('1050739', 'Terry', 'Miller', 't.miller1', 'jsgeey159', 'tmiller@gmail.com');
            END;
        ";
        DB::unprepared($store_procedure);
        // Insert data into tables
        DB::table('instructors')->insert([
            ['UID' => '105840', 'first_name' => 'Rory', 'family_name' => 'McCarthy', 'i_username' => 'rorymcc', 'i_password' => 'owefh23', 'email' => 'rorymcc@gmail.com'],
            ['UID' => '110254', 'first_name' => 'John', 'family_name' => 'Doe', 'i_username' => 'j.doe', 'i_password' => 'oethwe34', 'email' => 'jdoe@gmail.com'],
            ['UID' => '200227', 'first_name' => 'Emily', 'family_name' => 'Swift', 'i_username' => 'em.swift', 'i_password' => 'reoghiro54', 'email' => 'eswift@gmail.com'],
            ['UID' => '203735', 'first_name' => 'Kate', 'family_name' => 'Maher', 'i_username' => 'kat.maher1', 'i_password' => 'sfjsohi92', 'email' => 'kmaher@gmail.com'],
        ]);
        
        DB::table('trainees')->insert([
            ['UID' => '105085', 'first_name' => 'Terry', 'family_name' => 'Miller', 't_username' => 't.miller1', 't_password' => 'jsgeey159', 'email' => 'tmiller@gmail.com'],
            ['UID' => '123495', 'first_name' => 'Jane', 'family_name' => 'Ryan', 't_username' => 'j.ryan', 't_password' => 'wywooev739', 'email' => 'jdoe@gmail.com'],
            ['UID' => '234534', 'first_name' => 'Barry', 'family_name' => 'Sweeney', 't_username' => 'b.sweeney12', 't_password' => 'oiwqwwehqy98', 'email' => 'bsweeney@gmail.com'],
            ['UID' => '187962', 'first_name' => 'Lisa', 'family_name' => 'Brennan', 't_username' => 'liz.brenn1', 't_password' => 'hewaiu09', 'email' => 'lbrennan@gmail.com'],
        ]);

        DB::table('logbooks')->insert([
            ['logbook_name' => 'Maintenance_Logbook', 'trainee_id' => 4, 'instructor_id' => 3],
            ['logbook_name' => 'Communications_Logbook', 'trainee_id' => 1, 'instructor_id' => 2],
            ['logbook_name' => 'Physics_Logbook', 'trainee_id' => 3, 'instructor_id' => 1],
            ['logbook_name' => 'Technologies_Logbook', 'trainee_id' => 2, 'instructor_id' => 4],
        ]);

        /*DB::table('tasks')->insert([
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
        ]);*/
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

        Schema::dropIfExists('logbooks');
        Schema::dropIfExists('trainees');
        Schema::dropIfExists('instructors');
        Schema::dropIfExists('tasks');
    }
};