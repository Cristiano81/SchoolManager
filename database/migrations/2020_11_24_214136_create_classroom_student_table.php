<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_student', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("classroom_id")->unsigned();
            $table->bigInteger("student_id")->unsigned();
            $table->timestamps();
            $table->foreign('classroom_id')
                ->references('id')
                ->on('classrooms')
                ->onCascade('delete');
            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classroom_student');
    }
}
