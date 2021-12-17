<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' => $this->faker->sentences(2, true),
            'gradebook_id' => $this->faker->numberBetween($min = 30, $max = 33),
            'user_id' => $this->faker->numberBetween($min = 1, $max = 10)
        ];
    }
}
