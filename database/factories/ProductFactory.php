<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'category_id' => rand(1, 9),
            'short_description' => fake()->sentence(15),
            'full_description' => fake()->paragraph(),
            'photo' => 'product/' . md5(rand(1,20)) . 'jpg'
        ];
    }
}
