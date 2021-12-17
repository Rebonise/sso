<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name,
            'key' => '$2y$10$28QepbXeF5sRAS.Y3Y.rkuDR1r4g/PyTcDZtgfmBJsStRtUjy7Spq', // thisisrandomkey
        ];
    }
}
