<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEmergencyContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_1', 'phone_1', 'relationship_1', 'name_2', 'phone_2', 'relationship_2', 
        'name_3', 'phone_3', 'relationship_3', 'student_id'
    ];
}
