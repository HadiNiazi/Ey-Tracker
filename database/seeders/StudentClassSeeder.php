<?php

namespace Database\Seeders;

use App\Models\StudentClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classNames = ['Birth 0-3', 'Birth 3-4', 'Birth 4-5'];
        $i = 0;

        foreach($classNames as $class) {
            StudentClass::create([
                'name' => $class
            ]);
        }
    }
}
