<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainObjective extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function subObjectives()
    {
        return $this->hasMany(SubObjective::class, 'main_objective_id', 'id');
    }
}
