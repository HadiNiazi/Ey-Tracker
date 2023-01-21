<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPermissionDetail extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'consent_1', 'consent_2', 'consent_3', 'consent_4', 'consent_5'];

    public const ALLOW = 1;
    public const DENY = 0;

}
