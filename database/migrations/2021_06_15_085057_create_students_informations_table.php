<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_informations', function (Blueprint $table) {
            $table->increments('student_id');
			$table->string('students_name');
			$table->integer('students_id');
			$table->string('fathers_name');
			$table->string('mobile_number');
			$table->string('blood_group');
			$table->integer('religion');
			$table->integer('marial_status');
			$table->integer('nationality');
			$table->string('passport_number');
			$table->string('mobile_number');
			$table->string('present_address');
			$table>integer('permanent_address');
			$table->string('students_image');
			$table->string('students_image');
			$table->integer('active_status');
			$table->string('father_occupation');
			$table->integer('session');
			$table->string('batch_no');
			$table->integer('course_type');
			$table->integer('department');
			$table->string('course_name');
			$table->integer('gender');
			$table->integer('created_by');
			$table->integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_informations');
    }
}
