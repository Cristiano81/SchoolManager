<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Teacher;
use Database\Factories\SchoolYearFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('classroom_student')->truncate();
        DB::table('classroom_teacher')->truncate();
        DB::table('students')->truncate();
        DB::table('teachers')->truncate();
        DB::table('classrooms')->truncate();
        DB::table('school_years')->truncate();

        SchoolYear::factory(5)->has(
            Classroom::factory(10)
        )->create();
        Student::factory( 200)->create();

        Teacher::factory( 50)->create();

        // Get all the teacher attaching 3 random teacher to each classroom and 20 students
        $teachers = Teacher::all();
        $students = Student::all();

        // Populate the pivot table
        Classroom::all()->each(function ($classroom) use ($teachers) {
            $classroom->teachers()->attach(
                $teachers->random( 3)->pluck('id')->toArray()
            );
        });
        Classroom::all()->each(function ($classroom) use ($students) {
            $classroom->students()->attach(
                $students->random( 20)->pluck('id')->toArray()
            );
        });
    }
}
