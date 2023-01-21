<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'class_id', 'fsm', 'eal', 'sen', 'ethnicity', 'other_ethnicity', 'other_ethnicity', 'lives_with', 'pupil_lives_with', 'gender', 'type'];

    public function class()
    {
        return $this->belongsTo(StudentClass::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'student_id', 'student_id');
    }
}
