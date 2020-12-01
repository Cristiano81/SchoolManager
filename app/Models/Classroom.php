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
    
    public function schoolyear()
    {
        return $this->belongsTo('App\Models\SchoolYear','schoolyear_id');
    }
    public function students() {
        return $this->belongsToMany('App\Models\Student','classroom_student');
    }
    public function teachers() {
        return $this->belongsToMany('App\Models\Teacher','classroom_teacher');
    }
}
