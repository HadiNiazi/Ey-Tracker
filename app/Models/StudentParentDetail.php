<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentParentDetail extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'father_name', 'father_home_telephone', 'father_work_telephone', 'father_mobile', 'father_ocuupation', 'father_address', 
    'mother_name', 'mother_home_telephone', 'mother_work_telephone', 'mother_mobile', 'mother_ocuupation', 'mother_address'];
}
