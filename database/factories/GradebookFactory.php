<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GradebookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2, false),
            'user_id' => $this->faker->numberBetween($min = 1, $max = 10)
        ];
    }
}
