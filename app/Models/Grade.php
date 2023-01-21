<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['main_objective_id', 'sub_objective_id', 'student_class_id', 'student_id',
        'objective_id', 'objective_achieved', 'objective_achieved_date'
    ];

    public function objectives()
    {
        return $this->belongsToMany(Objective::class, 'grade_objective', 'objective_id')->withPivot('sub_objective_id', 'objective_achieved_date');
    }

    // public function subObjective()
    // {
    //     return $this->belongsTo(SubObjective::class);
    // }

    public function subObjectives()
    {
        return $this->belongsToMany(SubObjective::class);
    }

    public function class()
    {
        return $this->belongsTo(StudentClass::class, 'student_class_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
