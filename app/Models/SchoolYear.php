<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;
    protected $fillable = [
        'startYear',
        'endYear'
    ];
    public static function alldropdown() {
        $schoolyears = SchoolYear::all();
        $rarray = array();
        $rarray[0]="Select";
        foreach ($schoolyears as $year) {
            $rarray[$year->id]=$year->startYear . "/" . $year->endYear;
        }
        return $rarray;
    }

    public function classrooms()
    {
        return $this->hasMany('App\Models\Classroom','schoolyear_id');
    }
}
