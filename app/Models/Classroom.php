<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','schoolyear_id'
    ];
    public static function alldropdown() {
        $classrooms = Classroom::all();
        $rarray = array();
        $rarray[0]="Select";
        foreach ($classrooms as $classroom) {
            $rarray[$classroom->id]=$classroom->name . " A.S. " . $classroom->schoolyear->startYear . "/" . $classroom->schoolyear->endYear;
        }
        return $rarray;
    }
    public function schoolyear()
    {
        return $this->belongsTo('App\Models\SchoolYear','schoolyear_id');
    }
    public function students() {
        return $this->belongsToMany('App\Models\Student','classroom_student')->withTimestamps();
    }
    public function teachers() {
        return $this->belongsToMany('App\Models\Teacher','classroom_teacher')->withTimestamps();
    }
}
