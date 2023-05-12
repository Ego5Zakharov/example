<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCardFactory extends Factory
{
    public function definition()
    {
        return [
            'card_id'=>$this->faker->numberBetween(2,3),
            'product_id'=>$this->faker->numberBetween(1,32)
        ];
    }
}
