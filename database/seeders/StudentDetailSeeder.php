<?php

namespace Database\Seeders;

use App\Models\StudentClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentDetailSeeder extends Seeder
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

            DB::connection('mysql')->table('student_details')->insert([
                'student_id' => $studentId,
                // 'class_id' => $class->id,
                'fsm' => $data->fsm == 'Yes' ? 1: 0,
                'eal' => $data->eal == 'Yes' ? 1: 0,
                'sen' => $data->sen == 'Yes' ? 1: 0,
                'gender' => $data->gender,
                'ethnicity' => $data->ethnicity,
                'other_ethnicity' => $data->other_ethnicity,
                'lives_with' => $data->lives_with,
                'pupil_lives_with' => ''
            ]);

            $studentId++;
        }
    }
}
