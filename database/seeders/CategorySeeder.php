<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect([
            ['name' => 'Main Courses', 'status' => true],
            ['name' => 'Salads', 'status' => true],
            ['name' => 'Seafood', 'status' => true],
            ['name' => 'Desserts', 'status' => true],
            ['name' => 'Breakfast', 'status' => true],
            ['name' => 'Kids Menu', 'status' => true],
            ['name' => 'Burgers', 'status' => true],
            ['name' => 'Pasta', 'status' => true],
            ['name' => 'Vegetarian', 'status' => true],
            ['name' => 'Drinks', 'status' => true],
        ]);

        $categories->each(fn (Category $category) => Category::factory()->create($category));
    }
}
