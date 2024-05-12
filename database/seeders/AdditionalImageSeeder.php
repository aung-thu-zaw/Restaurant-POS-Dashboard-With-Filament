<?php

namespace Database\Seeders;

use App\Models\AdditionalImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdditionalImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdditionalImage::factory(500)->create();
    }
}
