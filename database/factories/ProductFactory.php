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
            'categoryId' => fake()->randomElement([1, 2]),
            'supplierId' => fake()->randomElement([1, 2, 3, 4, 5]),
            'name' => fake()->sentence(2, true),
            'description' => fake()->sentence(6, true),
            'code' => fake()->numerify('#-####'),
            'stock' => fake()->numberBetween(1, 10),
            'price' => fake()->randomFloat(2, 0, 50),
            'type' => fake()->randomElement(['Male', 'Female', 'Unisex'])
        ];
    }
}
