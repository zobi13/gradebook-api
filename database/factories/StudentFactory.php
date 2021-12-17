<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gradebook_id' => $this->faker->numberBetween($min = 21, $max = 30),
            'profile_pic_url' => 'https://thumbs.dreamstime.com/z/businessman-icon-image-male-avatar-profile-vector-glasses-beard-hairstyle-179728610.jpg'
        ];
    }
}
