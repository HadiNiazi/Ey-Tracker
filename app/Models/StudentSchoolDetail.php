<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSchoolDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'class_id', 'status', 'previous_school', 'previous_school_joining_date', 'previous_school_left_date', 
        'new_school', 'reason_for_leaving', 'student_missing_note', 'student_missing_date', 'previous_school_address', 
        'new_school_address','student_missing_status', 'student_la_contacted'
    ];
}
