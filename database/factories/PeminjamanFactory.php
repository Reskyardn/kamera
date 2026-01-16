<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peminjaman>
 */
class PeminjamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'tanggal_pinjam' => $this->faker->date(),
            'tanggal_kembali_rencana' => $this->faker->dateTimeBetween('now', '+1 week'),
            'status_peminjaman' => $this->faker->randomElement(['Dipinjam', 'Kembali', 'Terlambat']),
        ];
    }
}
