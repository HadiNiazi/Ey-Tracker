<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['language_id', 'family_id', 'surname', 'middlename', 'forename', 'dob', 'type', 'status_date'];

    public function studentAddress()
    {
        return $this->hasOne(StudentAddressDetail::class);
    }

    public function studentAttendance()
    {
        return $this->hasOne(StudentAttendance::class);
    }

    public function studentContact()
    {
        return $this->hasOne(StudentContact::class);
    }

    public function studentDetail()
    {
        return $this->hasOne(StudentDetail::class);
    }

    public function studentEmergency()
    {
        return $this->hasOne(StudentEmergencyContact::class);
    }

    public function studentFee()
    {
        return $this->hasOne(StudentFee::class);
    }

    public function studentHealth()
    {
        return $this->hasOne(StudentHealthDetail::class);
    }

    public function studentParent()
    {
        return $this->hasOne(StudentParentDetail::class);
    }

    public function studentPayment()
    {
        return $this->hasOne(StudentPaymentDetail::class);
    }

    public function studentPermission()
    {
        return $this->hasOne(StudentPermissionDetail::class);
    }

    public function studentSchool()
    {
        return $this->hasOne(StudentSchoolDetail::class);
    }

    // public function class()
    // {
    //     return $this->hasManyThrough(StudentClass::class, StudentDetail::class, 'student_id', 'id');
    // }

    public function class()
    {
        return $this->hasManyThrough(StudentClass::class, StudentDetail::class, 'student_id', 'id', 'id', 'class_id');
    }

    public function grade()
    {
        return $this->hasOne(Grade::class);
    }

}
