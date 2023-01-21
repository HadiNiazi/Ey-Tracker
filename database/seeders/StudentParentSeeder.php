<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentParentSeeder extends Seeder
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

            DB::connection('mysql')->table('student_parent_details')->insert([
                'student_id' => $studentId,

                'father_name' => $data->fname,
                'father_home_telephone' => $data->fhome_no,
                'father_work_telephone' => $data->fwork,
                'father_mobile' => $data->fmobile,
                'father_ocuupation' => $data->foccupation,
                'father_address' => $data->faddress,

                'mother_name' => $data->mname,
                'mother_home_telephone' => $data->mhome_no,
                'mother_work_telephone' => $data->mwork,
                'mother_mobile' => $data->mmobile,
                'mother_ocuupation' => $data->moccupation,
                'mother_address' => $data->maddress,
            ]);

            $studentId++;
        }
    }
}
