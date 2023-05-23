<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(1,50),
            'category_id' => $this->faker->unique()->numberBetween(1,50),
        ];
    }
}
