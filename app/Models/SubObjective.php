<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubObjective extends Model
{
    use HasFactory;

    protected $fillable = ['objective_id', 'name'];

    public function classes()
    {
        return $this->hasMany(StudentClass::class);
    }

}
