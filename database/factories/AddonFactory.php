<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Addon>
 */
class AddonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => fake()->numberBetween(1, 50),
            'name' => fake()->randomElement(['Extra Sauce', 'Double Portion', 'Gluten-Free Option', 'Vegan Option', 'Spicy Level: Mild', 'Spicy Level: Medium', 'Spicy Level: Hot', 'Extra Cheese', 'Add Bacon', 'Add Avocado']),
            'additional_price' => fake()->numberBetween(1, 50),
        ];
    }
}
