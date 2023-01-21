<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'title'];

    public function subObjective()
    {
        return $this->belongsTo(SubObjective::class, 'grade_objective', 'objective_id', 'id');
    }
}
