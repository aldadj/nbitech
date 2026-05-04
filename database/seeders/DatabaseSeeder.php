<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user for testing
        User::factory()->create([
            'name' => 'Admin NBI TECH',
            'email' => 'admin@nbitech.bfa',
            'password' => bcrypt('password123'),
        ]);

        // Seed products
        $this->call(ProductSeeder::class);
    }
}
