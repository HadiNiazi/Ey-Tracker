<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $old_student_date = DB::connection('mysql2')->table('admissions')->get();

        foreach ($old_student_date as $data) {

            $fakeDate = null;
            $date = $data->dob;

            if(preg_match('/0{4}/' , $date))
            {
                $fakeDate = '2020-01-01';
            }

            DB::connection('mysql')->table('students')->insert([
                'surname' => $data->ssurname ? $data->ssurname: '',
                'middlename' => $data->smiddle ? $data->smiddle: '',
                'forename' => $data->sforename ? $data->sforename: '',
                'dob' => $fakeDate == null ? $data->dob: $fakeDate,
                'type' => 'current',
                'status_date' => now()->format('Y-m-d'),  
            ]);

            $fakeDate == null;
       }
    }
}
