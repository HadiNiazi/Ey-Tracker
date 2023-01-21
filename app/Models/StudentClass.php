<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class StudentClass extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function student()
    {
        return $this->hasOne(StudentDetail::class, 'class_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(StudentDetail::class, 'class_id', 'id');
    }

}
