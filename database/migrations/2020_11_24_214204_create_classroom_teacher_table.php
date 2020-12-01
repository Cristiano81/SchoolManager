<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_teacher', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("classroom_id")->unsigned();
            $table->bigInteger("teacher_id")->unsigned();
            $table->timestamps();
            $table->foreign('classroom_id')
                ->references('id')
                ->on('classrooms')
                ->onCascade('delete');
            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers')
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
        Schema::dropIfExists('classroom_teacher');
    }
}
