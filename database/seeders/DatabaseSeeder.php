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
        // Admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        // Regular user
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'role' => 'user',
        ]);

        $this->call([
            KameraSeeder::class,
            PeminjamanSeeder::class,
            DetailPeminjamanSeeder::class,
            PengembalianSeeder::class,
        ]);
    }
}
