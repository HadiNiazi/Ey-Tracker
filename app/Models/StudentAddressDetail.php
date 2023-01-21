<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAddressDetail extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'country_id', 'post_code', 'address'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
