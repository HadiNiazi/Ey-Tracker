<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentHealthDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $old_student_date = DB::connection('mysql2')->table('admissions')->get();
        $studentId = 1; 

        foreach ($old_student_date as $data) {

            DB::connection('mysql')->table('student_health_details')->insert([
                'student_id' => $studentId,
                'doctor_name' => $data->doctor_name,
                'doctor_telephone' => $data->doctor_contact,
                'doctor_address' => $data->doctor_address,
                'medical_condition' => $data->allergy
            ]);

            $studentId++;
        }
    }
}
