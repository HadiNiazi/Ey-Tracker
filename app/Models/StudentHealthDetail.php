<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentHealthDetail extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'doctor_name', 'doctor_telephone', 'doctor_address', 'medical_condition'];
}
