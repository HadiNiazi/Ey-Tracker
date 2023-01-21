<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSchoolSeeder extends Seeder
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

            $previousFakeDate = null;
            $previous_date = $data->previous_date_left;
            // $missingFakeDate = null;

            // $missing_date = $data->student_missing_date;

            if (preg_match('/0{4}/' , $previous_date))
            {
                $previousFakeDate = '2020-01-01';
            }

            // if (preg_match('/0{4}/' , $missing_date))
            // {
            //     $missingFakeDate = '2020-01-01';
            // }

            DB::connection('mysql')->table('student_school_details')->insert([
                'student_id' => $studentId,
                'previous_school_left_date' => $previousFakeDate == null ? $data->previous_date_left: $previousFakeDate,
                'previous_school' => $data->previous_school,
                'reason_for_leaving' => '',
                'previous_school_address' => '',

                'new_school' => $data->new_school,
                'new_school_address' => '',

                'student_missing_status' => $data->missing == 'Yes' ? 1: 0,
                'student_la_contacted' => $data->new_local_contacted == 'Yes' ? 1: 0,
                'student_missing_note' => $data->missing,
                // 'student_missing_date' => $missingFakeDate == null ? $data->student_missing_date: $missingFakeDate,
            ]);

            $studentId++;
            $previousFakeDate = null;
            $missingFakeDate = null;
        }
    }
}
