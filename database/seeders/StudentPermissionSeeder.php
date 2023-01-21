<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentPermissionSeeder extends Seeder
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

            DB::connection('mysql')->table('student_permission_details')->insert([
                'student_id' => $studentId,

                'consent_1' => $data->consent1 == 'Yes' ? 1: 0,
                'consent_2' => $data->consent2 == 'Yes' ? 1: 0,
                'consent_3' => $data->consent3 == 'Yes' ? 1: 0,
                'consent_4' => $data->consent4 == 'Yes' ? 1: 0,
                'consent_5' => $data->consent5 == 'Yes' ? 1: 0,
                'additional_notes' => $data->additional_notes
            ]);

            $studentId++;
        }
    }
}
