<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->create(['name' => 'Main Courses', 'status' => true]);
        Category::factory()->create(['name' => 'Salads', 'status' => true]);
        Category::factory()->create(['name' => 'Seafood', 'status' => true]);
        Category::factory()->create(['name' => 'Desserts', 'status' => true]);
        Category::factory()->create(['name' => 'Breakfast', 'status' => true]);
        Category::factory()->create(['name' => 'Kids Menu', 'status' => true]);
        Category::factory()->create(['name' => 'Burgers', 'status' => true]);
        Category::factory()->create(['name' => 'Pasta', 'status' => true]);
        Category::factory()->create(['name' => 'Vegetarian', 'status' => true]);
        Category::factory()->create(['name' => 'Drinks', 'status' => true]);
    }
}
