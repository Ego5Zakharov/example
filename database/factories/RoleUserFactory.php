<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleUserFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id'=>$this->faker->numberBetween(6,8),
            'role_id'=>$this->faker->numberBetween(1,4)
        ];
    }
}
