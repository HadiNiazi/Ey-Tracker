<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeSubObjective extends Model
{
    use HasFactory;

    protected $table = 'grade_sub_objective';

    public $timestamps = false;

    protected $fillable = ['grade_id', 'sub_objective_id', 'main_objective_id'];
}
