<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'class_id', 'attendance_status_id', 'date', 'time', 'note'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function status()
    {
        return $this->belongsTo(AttendanceStatus::class, 'attendance_status_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id');
    }
}
