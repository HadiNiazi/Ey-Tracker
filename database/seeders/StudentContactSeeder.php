<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentContactSeeder extends Seeder
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

            DB::connection('mysql')->table('student_contacts')->insert([
                'student_id' => $studentId,
                'email' => $data->email,
                'telephone' => $data->contact
            ]);

            $studentId++;
        }
    }
}
