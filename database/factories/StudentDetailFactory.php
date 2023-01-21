<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentDetail>
 */
class StudentDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $student = Student::first();
        return [
            'student_id' => $student->id,
            'fsm' => Str::random(5),
            'eal' => Str::random(5),
            'sen' => Str::random(5),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'type' => Str::random(3),
            'ethnicity' => Str::random(3),
            'other_ethnicity' => Str::random(3),
            'live_with' => $this->faker->randomElement(['father', 'mother']),

        ];
    }
}
