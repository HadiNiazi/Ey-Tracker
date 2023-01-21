<?php

namespace Database\Seeders;

use App\Models\MainObjective;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainObjectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Physical, Social and Emotional Development', 'Literacy', 'Understanding the World',
            'Communication and Language', 'Mathematics', 'Expresive Arts and Design', 'Physical Development'
        ];


        if (count($names) > 0) {
            foreach ($names as $name) {
                MainObjective::create([
                    'name' => $name
                ]);
            }
        }

    }
}
