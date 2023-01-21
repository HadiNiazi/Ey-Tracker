<?php

namespace Database\Factories;

use App\Models\Family;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $language = Language::first();
        $family = Family::first();

        return [
            'language_id' => $language->id,
            'language_id' => $family->id,
            'surname' => $this->faker->name(),
            'middle_name' => $this->faker->name(),
            'forename' => $this->faker->name(),
            'type' => $this->faker->randomElement(['waiting-students', 'leave-students', 'graduate-students', 'current-students']),
            'dob' => now(),
        ];
    }
}
