<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'role' => 'admin',
            'email' => 'superadmin@gmail.com',
            'password' => 'Password!',
            'status' => 'active',
        ]);

        User::factory()->create([
            'name' => 'Cashier',
            'role' => 'cashier',
            'email' => 'cashier@gmail.com',
            'password' => 'Password!',
            'status' => 'active',
        ]);

        User::factory(10)->create(['role' => 'cashier']);

        User::factory(50)->create();
    }
}
