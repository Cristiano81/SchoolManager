<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'surname',
        'email',
        'telephone'
    ];
    public function classrooms() {
        return $this->belongsToMany('App\Models\Classroom','classroom_teacher')->withTimestamps();
    }
}
