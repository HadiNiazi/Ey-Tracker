<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentEmergencySeeder extends Seeder
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

            DB::connection('mysql')->table('student_emergency_contacts')->insert([
                'student_id' => $studentId,

                'name_1' => $data->ename1,
                'phone_1' => $data->econtact1,
                'relationship_1' => $data->erelation1,

                'name_2' => $data->ename2,
                'phone_2' => $data->econtact2,
                'relationship_2' => $data->erelation2,

                'name_3' => $data->ename3,
                'phone_3' => $data->econtact3,
                'relationship_3' => $data->erelation3
            ]);

            $studentId++;
        }
    }
}
