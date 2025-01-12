<?php

namespace Database\Factories;

use App\Models\Teachers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subjects>
 */
class SubjectsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Asignaturas aleatorias
            'name' =>fake()->randomElement(['Math', 'Science', 'History', 'Art', 'Biology']), // Cursos ficticios
            // Cursos disponibles : 1 o 2
            'course' => fake()->numberBetween(1, 2),
            'grade' => fake()->numberBetween(1, 10), 
            // Asignar un teachers_id aleatorio entre los teachers_ids existentes
             'teachers_id' => Teachers::all()->random()->id,
        ];
    }
}
