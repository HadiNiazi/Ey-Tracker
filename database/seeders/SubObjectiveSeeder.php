<?php

namespace Database\Seeders;

use App\Models\MainObjective;
use App\Models\Objective;
use App\Models\SubObjective;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubObjectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->objectiveFirst();
        $this->objectiveTwo();
        $this->objectiveThree();
        $this->objectiveFour();
        $this->objectiveFifth();
        $this->objectiveSix();
        $this->objectiveSeven();


    }

    private function objectiveFirst()
    {
        $objective_1 = MainObjective::where('name', 'Physical, Social and Emotional Development')->first();

        if ($objective_1) {
            SubObjective::create([
                'main_objective_id' => $objective_1->id,
                'name' => 'Self-Regulation'
            ]);

            SubObjective::create([
                'main_objective_id' => $objective_1->id,
                'name' => 'Managing Self'
            ]);

            SubObjective::create([
                'main_objective_id' => $objective_1->id,
                'name' => 'Building Relationships'
            ]);
        }
    }

    private function objectiveTwo()
    {
        $objective_2 = MainObjective::where('name', 'Literacy')->first();

        if ($objective_2) {
            SubObjective::create([
                'main_objective_id' => $objective_2->id,
                'name' => 'Comprehension'
            ]);

            SubObjective::create([
                'main_objective_id' => $objective_2->id,
                'name' => 'Word Reading'
            ]);

            SubObjective::create([
                'main_objective_id' => $objective_2->id,
                'name' => 'Writing'
            ]);
        }
    }

    private function objectiveThree()
    {
        $objective_3 = MainObjective::where('name', 'Understanding the World')->first();

        if ($objective_3) {
            SubObjective::create([
                'main_objective_id' => $objective_3->id,
                'name' => 'Past and Present'
            ]);

            SubObjective::create([
                'main_objective_id' => $objective_3->id,
                'name' => 'People, Culture and Communities'
            ]);

            SubObjective::create([
                'main_objective_id' => $objective_3->id,
                'name' => 'The Natural World'
            ]);
        }
    }

    private function objectiveFour()
    {
        $objective_4 = MainObjective::where('name', 'Communication and Language')->first();

        if ($objective_4) {
            SubObjective::create([
                'main_objective_id' => $objective_4->id,
                'name' => 'Listening, Attention and Understanding'
            ]);

            SubObjective::create([
                'main_objective_id' => $objective_4->id,
                'name' => 'Speaking'
            ]);
        }
    }

    private function objectiveFifth()
    {
        $objective_5 = MainObjective::where('name', 'Mathematics')->first();

        if ($objective_5) {
            SubObjective::create([
                'main_objective_id' => $objective_5->id,
                'name' => 'Number'
            ]);

            SubObjective::create([
                'main_objective_id' => $objective_5->id,
                'name' => 'Numerical Patterns'
            ]);
        }

    }

    private function objectiveSix()
    {
        $objective_6 = MainObjective::where('name', 'Expresive Arts and Design')->first();

        if ($objective_6) {
            SubObjective::create([
                'main_objective_id' => $objective_6->id,
                'name' => 'Creating with Materials'
            ]);

            SubObjective::create([
                'main_objective_id' => $objective_6->id,
                'name' => 'Being Imaginative and Expressive'
            ]);
        }

    }

    private function objectiveSeven()
    {
        $objective_7 = MainObjective::where('name', 'Physical Development')->first();

        if ($objective_7) {
            SubObjective::create([
                'main_objective_id' => $objective_7->id,
                'name' => 'Gross Motor Skills'
            ]);

            SubObjective::create([
                'main_objective_id' => $objective_7->id,
                'name' => 'Fine Motor Skills'
            ]);
        }

    }

}
