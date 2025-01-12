<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Schools;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teachers>
 */
class TeachersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' =>fake()->name(),
            'age' => fake()->numberBetween(18, 70), 
            'salary' => fake()->numberBetween(1500, 3000), 
            // Asignar un schools_id aleatorio entre los schools_ids existentes
            'schools_id' => Schools::all()->random()->id,

        ];
    }
}
