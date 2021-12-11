<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CostumerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->word(),
            'last_name' => $this->faker->word(),
            'birthday' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber()
        ];
    }
}
