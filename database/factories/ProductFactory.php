<?php

namespace Database\Factories;

use App\Models\Category;
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
        $categories = Category::pluck('id')->toArray();

        return [
            'category_id' => fake()->randomElement($categories),
            'image' => fake()->imageUrl(),
            'name' => fake()->unique()->sentence(),
            'ingredients' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'qty' => fake()->numberBetween(1, 20),
            'is_available' => fake()->boolean(),
            'base_price' => fake()->numberBetween(10, 1000),
            'discount_price' => fake()->numberBetween(5, 200),
            'discount_end_date' => fake()->dateTimeBetween(now(), '+2 weeks'),
            'status' => fake()->randomElement(['draft', 'published', 'hidden']),
        ];
    }
}
